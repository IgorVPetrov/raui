<?php
/* * ********************************************************************************************
 *								Raui ORE

 

 *

 * * This file is part of Raui ORE
 *
 * ********************************************************************************************* */

class BlogImage extends ParentModel {
	public $imageInstance = null;
	public $path = 'webroot.uploads.blog';

	const SMALL_THUMB_WIDTH = 115;
	const SMALL_THUMB_HEIGHT = 115;

	const FULL_THUMB_WIDTH = 480;
	const FULL_THUMB_HEIGHT = 480;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{blog_image}}';
	}

	public function rules() {
		return array(

		);
	}

	public function relations() {
		return array(

		);
	}

	public function fullHref(){
		return Yii::app()->getBaseUrl().'/uploads/blog/'.$this->name;
	}

	public function getThumb($width, $height){
		$path = Yii::getPathOfAlias($this->path);
		$filePath = $path.DIRECTORY_SEPARATOR.'thumb_'.$width.'x'.$height."_".$this->name;
		$fileName = 'thumb_'.$width.'x'.$height."_".$this->name;
		if(file_exists($filePath)){
			return $fileName;
		} else {
			$image = new CImageHandler();
			if($image->load($path.DIRECTORY_SEPARATOR.$this->name)){
				$image->adaptiveThumb($width, $height)
					->save($filePath);
				return $fileName;
			} else {
				return null;
			}
		}
	}

	public function getFullThumbLink(){
		$name = $this->getThumb(self::FULL_THUMB_WIDTH, self::FULL_THUMB_HEIGHT);
		if($name !== null){
			return Yii::app()->getBaseUrl().'/uploads/blog/'.$name;
		} else {
			return null;
		}
	}

	public function getSmallThumbLink(){
		$name = $this->getThumb(self::SMALL_THUMB_WIDTH, self::SMALL_THUMB_HEIGHT);
		if($name !== null){
			return Yii::app()->getBaseUrl().'/uploads/blog/'.$name;
		} else {
			return null;
		}
	}

	public function beforeSave(){
		if($this->imageInstance){
			$path = Yii::getPathOfAlias($this->path);
			$name = $this->imageInstance->getName();

			while(file_exists($path.DIRECTORY_SEPARATOR.$name)){
				$name = rand(0, 9).$name;
			}

			if($this->imageInstance->saveAs($path.DIRECTORY_SEPARATOR.$name)){
				$this->name = $name;
			} else {
				return false;
			}
		}

		return parent::beforeSave();
	}

	public function beforeDelete(){
		@unlink(Yii::getPathOfAlias($this->path).DIRECTORY_SEPARATOR.$this->name);

		$fileName = 'thumb_'.self::FULL_THUMB_WIDTH.'x'.self::FULL_THUMB_HEIGHT."_".$this->name;
		@unlink(Yii::getPathOfAlias($this->path).DIRECTORY_SEPARATOR.$fileName);

		return parent::beforeDelete();
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_created',
				'updateAttribute' => null,
			),
		);
	}


}