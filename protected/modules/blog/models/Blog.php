<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class Blog extends ParentModel {
	public $title;
	public $dateCreated;
	public $dateCreatedLong;
	public $supportedExt = 'jpg, png, gif';

	public $blogImage;
	public $maxImageSize;
	public $maxImageSizeMb;

	private static $_lastBlog;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{blog}}';
	}

	public function rules() {
		return array(
			array('title, body', 'i18nRequired'),
			array('title', 'i18nLength', 'max' => 128),
			array('cat', 'length', 'min'=>1, 'max'=>255),
			array(
				'blogImage', 'file',
				'types' => $this->supportedExt,
				'maxSize' => $this->maxImageSize,
				'tooLarge' => Yii::t('module_apartments', 'The file was larger than {size}MB. Please upload a smaller file.', array('{size}' => $this->maxImageSizeMb)),
				'allowEmpty' => true,
			),
			array($this->getI18nFieldSafe(), 'safe'),
		);
	}

    public function i18nFields(){
        return array(
            'title' => 'varchar(255) not null',
            'body' => 'text not null',
			'announce' => 'text not null',
        );
    }

	public function seoFields() {
		return array(
			'fieldTitle' => 'title',
			'fieldDescription' => 'body'
		);
	}

	public function	init(){
		$fileMaxSize['postSize'] = toBytes(ini_get('post_max_size'));
		$fileMaxSize['uploadSize'] = toBytes(ini_get('upload_max_filesize'));
		$this->maxImageSize = min($fileMaxSize);
		$this->maxImageSizeMb = round($this->maxImageSize / (1024*1024));


		parent::init();
	}

    public function getTitle(){
        return $this->getStrByLang('title');
    }

    public function getBody(){
        return $this->getStrByLang('body');
    }

	public function getAnnounce(){
		return $this->getStrByLang('announce');
	}

	public function relations(){
		return array(
			'image' => array(self::BELONGS_TO, 'BlogImage', 'image_id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'cat' => 'cat',
			'title' => tt('Blog title', 'blog'),
			'body' => tt('Blog body', 'blog'),
			'date_created' => tt('Creation date', 'blog'),
			'dateCreated' => tt('Creation date', 'blog'),
			'announce' => tt('Announce', 'blog'),
			'blogImage' => tt('Image for blog', 'blog'),
		);
	}

	public function getUrl() {
		if(issetModule('seo') && param('genFirendlyUrl')){
			$seo = SeoFriendlyUrl::getForUrl($this->id, 'Blog');

			if($seo){
				$field = 'url_'.Yii::app()->language;
				if($seo->$field){
					return Yii::app()->createAbsoluteUrl('/blog/main/view', array(
						'url' => $seo->$field . ( param('urlExtension') ? '.html' : '' ),
					));
				}
			}
		}

		return Yii::app()->createAbsoluteUrl('/blog/main/view', array(
			'id' => $this->id,
		));
	}

	public function search() {
		$criteria = new CDbCriteria;

        $titleField = 'title_'.Yii::app()->language;
		$criteria->compare($titleField, $this->$titleField, true);
        $bodyField = 'body_'.Yii::app()->language;
		$criteria->compare($bodyField, $this->$bodyField, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'defaultOrder' => 'date_created DESC',
			),
			'pagination' => array(
				'pageSize' => param('adminPaginationPageSize', 20),
			),
		));
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_created',
				'updateAttribute' => 'date_updated',
			),
		);
	}

	protected function afterFind() {
		$dateFormat = param('blogModule_dateFormat', 0) ? param('blogModule_dateFormat') : param('dateFormat', 'd.m.Y H:i:s');
		$this->dateCreated = date($dateFormat, strtotime($this->date_created));

		$this->dateCreatedLong = Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat('long'), CDateTimeParser::parse($this->date_created, 'yyyy-MM-dd hh:mm:ss'));

		return parent::afterFind();
	}

	public function beforeSave(){
		if($this->blogImage){
			if($this->image){
				$this->image->delete();
			}
			$image = new BlogImage();
			$image->imageInstance = $this->blogImage;
			$image->save();
			if($image->id){
				$this->image_id = $image->id;
			}
		}

		return parent::beforeSave();
	}


	public function afterSave() {
		if(issetModule('seo') && param('genFirendlyUrl')){
			SeoFriendlyUrl::getAndCreateForModel($this);
		}
		return parent::afterSave();
	}

	public function beforeDelete() {
		if(issetModule('seo') && param('genFirendlyUrl')){
			$sql = 'DELETE FROM {{seo_friendly_url}} WHERE model_id="'.$this->id.'" AND model_name = "Blog"';
			Yii::app()->db->createCommand($sql)->execute();
		}
		if($this->image){
			$this->image->delete();
		}

		$sql = 'DELETE FROM {{comments}} WHERE model_id=:id AND model_name="Blog"';
		Yii::app()->db->createCommand($sql)->execute(array(':id' => $this->id));

		return parent::beforeDelete();
	}

	public function getAllWithPagination($inCriteria = null){
		if($inCriteria === null){
			$criteria = new CDbCriteria;
			$criteria->order = 't.date_created DESC';
		} else {
			$criteria = $inCriteria;
		}

		$pages = new CPagination($this->count($criteria));
		$pages->pageSize = param('moduleBlog_blogPerPage', 10);
		$pages->applyLimit($criteria);

		$dependency = new CDbCacheDependency('SELECT MAX(date_updated) FROM {{blog}}');

		$criteria->with = array('image');
		$items = $this->cache(param('cachingTime', 1209600), $dependency)->findAll($criteria);

		return array(
			'items' => $items,
			'pages' => $pages,
		);
	}

	public static function getLastBlog(){
		if(self::$_lastBlog === null){
			$criteriaBlog = new CDbCriteria();
			$criteriaBlog->limit = 4;
			$criteriaBlog->order = 't.date_created DESC';
			$criteriaBlog->with = array('image');

			self::$_lastBlog = Blog::model()->findAll($criteriaBlog);
		}
		return self::$_lastBlog;
	}
}