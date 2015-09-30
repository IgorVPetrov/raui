<?php	$model = new Bookingcalendar;	foreach($apartment->bookingCalendar as $item) :		$model->dateStartDb[$item->id] = $item->date_start;		$model->dateEndDb[$item->id] = $item->date_end;?>	<li id="li-element-db-<?php echo $item->id ?>">		<?php echo CHtml::activeLabel($model, 'dateStart', array('class' => 'noblock')); ?> /		<?php echo CHtml::activeLabel($model, 'dateEnd', array('class' => 'noblock')); ?><br />		<?php			$this->widget('application.extensions.FJuiDatePicker', array(				'model'=>$model,				'attribute'=> 'dateStartDb['.$item->id.']',				'range' => 'eval_period_db_'.$item->id.'',				'language' => Yii::app()->language,				'options'=>array(					'showAnim'=>'fold',					'dateFormat'=>'yy-mm-dd',					'minDate'=>'new Date()',				),				'htmlOptions'=>array(					'class' => 'width100',					'readonly' => 'true',				),			));		?>		/		<?php			$this->widget('application.extensions.FJuiDatePicker', array(				'model'=>$model,				'attribute'=> 'dateEndDb['.$item->id.']',				'range' => 'eval_period_db_'.$item->id.'',				'language' => Yii::app()->language,				'options'=>array(					'showAnim'=>'fold',					'dateFormat'=>'yy-mm-dd',					'minDate'=>'new Date()',				),				'htmlOptions'=>array(					'class' => 'width100',					'readonly' => 'true',				),			));		?>		<?php echo CHtml::dropDownList('statusDb['.$item->id.']', $item->status, Bookingcalendar::getAllStatuses())?>		<?php echo CHtml::button(tt('Edit', 'bookingcalendar'), array('id' => 'bookings-db-edit-'.$item->id.'', 'class' => 'bookings-save'))?>		<?php echo CHtml::button(tc('Delete'), array('id' => 'bookings-db-delete-'.$item->id.'', 'class' => 'bookings-delete'))?>		<span id="status-db-save-<?php echo $item->id; ?>">&nbsp;</span>		<div id="date_db_<?php echo $item->id?>_error" class="errorMessage" style="display: none;"><?php echo tt('Fill fields', 'bookingcalendar'); ?></div>	</li>	<script>	$(document).ready(function() {		var idDb = "<?php echo $item->id;?>";		$("#bookings-db-delete-<?php echo $item->id;?>").click(function() {			if (confirm('<?php echo tt("Are you sure?", "bookingcalendar") ?>')) {				$.ajax({					success: function(msg){						if (msg == "ok") {							$("#li-element-db-<?php echo $item->id;?>").hide('slow');						}						else if (msg == "access_error") {							$("#status-db-save-"+idDb).addClass('status-save-error').html('<?php echo tt("Access denied", "bookingcalendar") ?>');						}						else if (msg == "error"){							$("#status-db-save-"+idDb).addClass('status-save-error').html('<?php echo tt("Delete error", "bookingcalendar") ?>');						}						setTimeout('hideMessageDb($("#status-db-save-<?php echo $item->id;?>"))', 4000);					},					type: 'get',					url: booking_delete_url,					data: {idDb: idDb, apId: apId},					cache: false				});			}			return false;		});		$("#bookings-db-edit-<?php echo $item->id;?>").click(function(){			if ($('#Bookingcalendar_dateStartDb_'+idDb).val().length > 0 && $('#Bookingcalendar_dateEndDb_'+idDb).val().length > 0) {				var bookingStart = $('#Bookingcalendar_dateStartDb_'+idDb).val();				var bookingEnd =  $('#Bookingcalendar_dateEndDb_'+idDb).val();				var bookingStatus = $('#statusDb_'+idDb).val();				$('#date_db_'+idDb+'_error').hide();				$.ajax({					success: function(msg){						if (msg == "ok") {							$("#status-db-save-"+idDb).addClass('status-save-success').html('<?php echo tt("Success save", "bookingcalendar") ?>');						}						else if (msg == "access_error") {							$("#status-db-save-"+idDb).addClass('status-save-error').html('<?php echo tt("Access denied", "bookingcalendar") ?>');						}						else if (msg == "error_filling") {							$('#date_db_'+idDb+'_error').show();						}						else if (msg == "error_save"){							$("#status-db-save-"+idDb).addClass('status-save-error').html('<?php echo tt("Save error", "bookingcalendar") ?>');						}						setTimeout('hideMessageDb($("#status-db-save-<?php echo $item->id;?>"))', 4000);					},					type: 'get',					url: booking_edit_url,					data: {dateStart: bookingStart, dateEnd: bookingEnd, dateStatus: bookingStatus, apId: apId, idDb: idDb},					cache: false				});			}			else {				$('#date_db_'+idDb+'_error').show();			}			return false;		});	});	</script><?php endforeach; ?>