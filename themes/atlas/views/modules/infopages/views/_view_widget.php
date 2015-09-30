<?php
Yii::import('application.modules.'.$model->widget.'.components.*');
$widgetData = array();

switch($model->widget){
    case 'contactform':
        $widgetData = array();
        break;

    case 'apartments':
        $widgetData = array('criteria' => $model->getCriteriaForAdList(), 'showWidgetTitle' => false);
        break;
}
$this->widget(ucfirst($model->widget).'Widget', $widgetData);

echo '</div>';
echo '<div class="clear"></div>';

?>