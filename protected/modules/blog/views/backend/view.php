<?php

$this->menu = array(
	array('label' => BlogModule::t('Add blog'), 'url' => array('create')),
	array('label' => BlogModule::t('Edit blog'), 'url' => array('update', 'id' => $model->id)),
	array('label' => tt('Delete blog', 'blog'), 'url' => '#',
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array('delete','id'=>$model->id),
			'confirm'=> tt('Are you sure you want to delete this item?')
		),
	),

);

$this->renderPartial('//modules/blog/views/view', array(
	'model' => $model,
));