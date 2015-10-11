<?php $this->beginContent('//layouts/main'); ?>




		<?php if(issetModule('advertising')) :?>
			<?php //$this->renderPartial('//modules/advertising/views/advert-top', array());?>
		<?php endif; ?>


            
			<div class="main-content-wrapper">
				<?php
					foreach(Yii::app()->user->getFlashes() as $key => $message) {
						if ($key=='error' || $key == 'success' || $key == 'notice'){
							echo "<div class='flash-{$key}'>{$message}</div>";
						}
					}
				?>
				<?php echo $content; ?>
			</div>


<?php $this->endContent(); ?>