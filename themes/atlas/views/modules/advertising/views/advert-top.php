<?php if ($this->advertPos1 || $this->advertPos2 || $this->advertPos3): ?>
	<?php if ($this->advertPos1 || $this->advertPos2): ?>
			<div class="rkl-blocks-top" style="padding:0">
				<?php if ($this->advertPos1):?>
					<?php $i = 0; ?>
					<div class="rkl-blocks-top-left"> <!--Слева-->
						<?php
							foreach ($this->advertPos1 as $item) : ?>
								<div <?php if ($i != 0) echo 'style="padding-top: 5px;"'; ?>>
									<?php
										$this->renderPartial('//modules/advertising/views/show', array('item' => $item));

										$i++;
									?>
								</div>
						<?php endforeach; ?>
					</div> <!--!Слева-->
				<?php endif; ?>
				<?php if ($this->advertPos2): ?>
					<?php $i = 0; ?>
					<!-- <div class="rkl-blocks-top-right"> Справа-->
						<?php
							foreach ($this->advertPos2 as $item) : ?>
								<div <?php if ($i != 0) echo 'style="padding-top: 5px;"'; ?>>
									<?php
										$this->renderPartial('//modules/advertising/views/show', array('item' => $item));

										$i++;
									?>
								</div>
						<?php endforeach; ?>
				<!--!	</div> Справа-->
				<?php endif; ?>
			</div>
	<?php endif; ?>

	<?php if($this->advertPos3): ?>
		<?php $i = 0; ?>
		<div class="bg">
			<div class="rkl-blocks-top rkl-blocks-top-center">
				<?php
					foreach ($this->advertPos3 as $item) : ?>
						<div <?php if ($i != 0) echo 'style="padding-top: 5px;"'; ?>>
							<?php
								$this->renderPartial('//modules/advertising/views/show', array('item' => $item));

								$i++;
							?>
						</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>