<?php
$this->pageTitle=Yii::app()->name . ' - ' . BlogModule::t('Add blog');

$this->menu = array(
    array('label' => tt('Manage blog'), 'url' => array('admin')),
);

$this->adminTitle = BlogModule::t('Add blog');
?>

<?php echo $this->renderPartial('/backend/_form', array('model'=>$model)); ?>