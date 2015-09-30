<div class="form">

    <?php
    $translate = isset($translate) ? $translate : $model->getTranslateModel();

    $form=$this->beginWidget('CustomForm', array(
        'id'=>$this->modelName.'-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note"><?php Yii::t('common', 'Fields with <span class="required">*</span> are required.');?></p>

    <?php
    echo $form->errorSummary(array($model, $translate));

    if($model->type != FormDesigner::TYPE_DEFAULT){
        if($model->isNewRecord){
            echo $form->dropDownListRow($model, 'type', FormDesigner::getTypesList());
            ?>

            <div id="selReferenceBox" style="display: none;">
                <?php
                $references = HFormEditor::getReferencesList();
                if($references){
                    echo $form->dropDownListRow($model, 'reference_id', $references);
                } else {
                    echo CHtml::link(tt('Please add the new category to the form editor', 'formeditor'), Yii::app()->createUrl('/referencecategories/backend/main/admin'));
                }
                ?>
            </div>
        <?php
        } else {
            echo '<br/>';
            echo '<b>'.tt('The name of a field in a table', 'formeditor').'</b>: '.$model->field.'';
            echo '<br/>';
            echo '<b>'.$model->getAttributeLabel('type').'</b>: '.$model->getTypeName().'';
            echo '<br/>';
        }

        $this->widget('application.modules.lang.components.langFieldWidget', array(
            'model' => $model,
            'field' => 'label',
            'type' => 'string',
        ));
    }

    echo $form->dropDownListRow($model, 'view_in', FormDesigner::getViewInList());

    echo $form->dropDownListRow($model, 'rules', FormDesigner::getRulesList());

    //echo $form->dropDownListRow($model, 'view_in', FormDesigner::getViewInList());

    echo $form->checkBoxRow($model, 'visible');

    echo $form->checkBoxListRow($model, 'objTypesArray', ApartmentObjType::getList());

    $this->widget('application.modules.lang.components.langFieldWidget', array(
        'model' => $model,
        'field' => 'tip',
        'type' => 'string',
    ));

    echo '<div class="fields_for_search">';
    echo '<h5>'.tt('For search').'</h5>';

    $this->widget('application.modules.lang.components.langFieldWidget', array(
        'model' => $translate,
        'field' => 'translation',
        'type' => 'string',
    ));
    echo $form->dropDownListRow($model, 'compare_type', FormDesigner::getCompareList());

    echo '</div>';
    ?>

    <div id="selMeasureUnitBox" style="display: none;">
        <?php echo $form->textFieldRow($model, 'measure_unit'); ?>
    </div>

    <br/>

    <div class="rowold buttons">
        <?php $this->widget('bootstrap.widgets.TbButton',
            array('buttonType'=>'submit',
                'type'=>'primary',
                'icon'=>'ok white',
                'label'=> tc('Save'),
            )); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $(function(){
        formEditor.checkType();
        //formEditor.checkRules();

        $('#FormDesigner_type').on('change', function(){
            formEditor.checkType();
        });

//        $('#FormDesigner_rules').on('change', function(){
//            formEditor.checkRules();
//        });
    });

    var formEditor = {
        checkType: function(){
            var type = $('#FormDesigner_type').val();
            if(type == <?php echo CJavaScript::encode(FormDesigner::TYPE_REFERENCE);?>){
                $('#selReferenceBox').show();
            } else {
                $('#selReferenceBox').hide();
            }

            if(type == <?php echo CJavaScript::encode(FormDesigner::TYPE_INT);?>){
                $('#selMeasureUnitBox').show();
            } else {
                $('#FormDesigner_measure_unit').val('');
                $('#selMeasureUnitBox').hide();
            }
        }

    }
</script>