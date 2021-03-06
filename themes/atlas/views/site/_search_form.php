<?php
$compact = isset($compact) ? $compact : 0;
$isInner = isset($isInner) ? $isInner : 0;

if (isset($this->objType) && $this->objType) {
    $searchFields = SearchFormModel::model()->sort()->findAllByAttributes(array('obj_type_id' => $this->objType), array('group' => 'field'));
    if (!$searchFields) {
        $searchFields = SearchFormModel::model()->sort()->findAllByAttributes(array('obj_type_id' => SearchFormModel::OBJ_TYPE_ID_DEFAULT), array('group' => 'field'));
    }
} else {
    $searchFields = SearchFormModel::model()->sort()->findAllByAttributes(array('obj_type_id' => SearchFormModel::OBJ_TYPE_ID_DEFAULT), array('group' => 'field'));
}

$i = 1;
foreach ($searchFields as $search) {
    if ($isInner) {
        $divClass = 'search_inner_row';
    } else {
        $divClass = 'header-form-line';
    }

    if ($search->status <= SearchFormModel::STATUS_NOT_REMOVE) {
        $this->renderPartial('//site/_search_field_' . $search->field, array(
            'divClass' => $divClass,
            'textClass' => 'formalabel',
            'controlClass' => 'formacontrol',
            'fieldClass' => 'width290 search-input-new',
            'minWidth' => '290',
            'isInner' => $isInner,
        ));
    } else {
        $this->renderPartial('//site/_search_new_field', array(
            'divClass' => $divClass,
            'textClass' => 'formalabel',
            'controlClass' => 'formacontrol',
            'fieldClass' => 'width290 search-input-new',
            'minWidth' => '290',
            'search' => $search,
            'isInner' => $isInner,
        ));
    }

    $i++;

    if (!$isInner) {
        echo '<div class="clear"></div>';
    }

    SearchForm::increaseJsCounter();
}

