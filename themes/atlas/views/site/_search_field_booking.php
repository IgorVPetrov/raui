<div class="<?php echo $divClass; ?>">
    <div class="<?php echo $controlClass; ?>">
        <?php
        $bStart = isset($this->bStart) ? $this->bStart : HDate::formatForDatePicker(time());
        $bEnd = isset($this->bEnd) ? $this->bEnd : null;

        echo tc('Booking from').':&nbsp;';
        $this->widget('application.extensions.FJuiDatePicker', array(
            'name'=>'b_start',
            'value' => $bStart,
            'range' => 'eval_period',
            'language' => Yii::app()->controller->datePickerLang,
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>Booking::getJsDateFormat(),
                'minDate'=>'new Date()',
                //'maxDate'=>'+12M',
            ),
            'htmlOptions' => array(
                'class' => 'width70',
				'readonly' => 'true',
            ),
        ));

        echo ' '.tc('to').':&nbsp;';
        $this->widget('application.extensions.FJuiDatePicker', array(
            'name' => 'b_end',
            'value' => $bEnd,
            'range' => 'eval_period',
            'language' => Yii::app()->controller->datePickerLang,
            'options'=>array(
                'showAnim'=>'fold',
                'dateFormat'=>Booking::getJsDateFormat(),
                'minDate'=>'new Date()',
            ),
            'htmlOptions' => array(
                'class' => 'width70',
				'readonly' => 'true',
            ),
        ));
        ?>
    </div>
</div>