
    <?php if($this->searchShowLabel){ ?>
	<div class="<?php echo $textClass; ?>"><?php echo Yii::t('common', 'Property type'); ?>:</div>
    <?php } ?>
	<li>
    <?php
    echo CHtml::dropDownList(
        'objType',
        isset($this->objType) ? $this->objType : 0, CMap::mergeArray(array(0 => Yii::t('common', 'Property type')),
        Apartment::getObjTypesArray()),
        array('class' => $fieldClass)
    );
    ?>
	</li>
