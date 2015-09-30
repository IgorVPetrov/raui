<h1 class="title highlight-left-right">
	<span><?php echo tt('Update apartment', 'apartments'); ?></span>
</h1>
<div class="clear"></div><br />

<?php
$this->pageTitle .= ' - '.tt('Update apartment', 'apartments');
$this->breadcrumbs = array(
	Yii::t('common', 'Control panel') => array('/usercpanel/main/index'),
	tt('Update apartment', 'apartments')
);

if(!Yii::app()->user->isGuest){
    $menuItems = array(
    		array('label' => tt('Manage apartments', 'apartments'), 'url'=>array('/usercpanel/main/index')),
    		array('label' => tt('Add apartment', 'apartments'), 'url'=>array('create')),
    		array(
    			'label' => tt('Delete apartment', 'apartments'),
    			'url'=>'#',
    			'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tc('Are you sure you want to delete this item?'))
    ));
} else {
    $menuItems = array();
}

if(issetModule('paidservices')){
	$paidServices = PaidServices::model()->findAll('active = 1');

	foreach($paidServices as $paid){
		$menuItems[] = array(
			'label' => $paid->name,
			'url'=>array('/paidservices/main/index',
				'id'=>$model->id,
				'paid_id'=>$paid->id,
			),
			'linkOptions'=>array('class'=>'fancy')
		);
	}
}


$this->widget('CustomMenu', array(
	'items' => $menuItems
));

if(isset($show) && $show){
	Yii::app()->clientScript->registerScript('scroll-to','
			scrollto("'.CHtml::encode($show).'");
		',CClientScript::POS_READY
	);
}

//$model->metroStations = $model->getMetroStations();
$this->renderPartial('_form',array(
	'model'=>$model,
	'supportvideoext' => $supportvideoext,
	'supportvideomaxsize' => $supportvideomaxsize,
));

