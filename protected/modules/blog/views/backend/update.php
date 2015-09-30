<?php
$this->pageTitle=Yii::app()->name . ' - ' . BlogModule::t('Edit blog');

$this->menu = array(
    array('label' => tt('Manage blog'), 'url' => array('admin')),
	array('label' => BlogModule::t('Add blog'), 'url' => array('create')),
	array('label' => tt('Delete blog', 'blog'),
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array('delete','id'=>$model->id),
			'confirm'=> tc('Are you sure you want to delete this item?')
		),
	)
);
$this->adminTitle = BlogModule::t('Edit blog').': <i>'.CHtml::encode($model->title).'</i>';
?>

<?php echo $this->renderPartial('/backend/_form', array('model'=>$model)); ?>