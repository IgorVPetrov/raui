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
?>
<style>
#googleMap, #ymap, #osmap {
    width: 958px;
    height: 729px;
	float: right;
}
</style>


<!-- New building -->
        <section class="container-full clearfix">

            <div class="luxury-housing clearfix">
                <div class="luxury-housing-quantity">
                <?php if($model->getStrByLang('title')=='Новостройки'): ?>
                    Заполните поля для формирования поискового запроса либо изучите <a href="/search?objType=7">все предложения</a> на рынке
                <?php elseif($model->getStrByLang('title')=='Элитное жилье'): ?>
               		Заполните поля для формирования поискового запроса либо изучите <a href="/search?objType=6">все предложения</a> на рынке
                <?php endif ?>
                    
                </div>
                <div class="sidebar-left pull-left">

                   <?php Yii::app()->controller->renderPartial('//site/new-search'); ?>

                </div>
                <div class="map" style="width: 958px;float: left;">
              <?php $this->widget(ucfirst($model->widget).'WidgetMap', $widgetData); ?>
                </div>
            </div>
</section>