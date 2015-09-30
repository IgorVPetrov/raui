<?php if(isset($page) && $page && isset($page->page)):?>
	<?php if ($page->page->widget && $page->page->widget_position == InfoPages::POSITION_TOP):?>
		<?php Yii::import('application.modules.'.$page->page->widget.'.components.*');
		if($page->page->widget == 'contactform'){
			$this->widget('ContactformWidget', array('page' => 'index'));
		} else {
			$this->widget(ucfirst($page->page->widget).'Widget');
		}?>
	<?php endif;?>
<?php endif;?>

<?php if(isset($page) && $page && isset($page->page)):?>
	<div class="welcome">
		<?php
			if($page->page->title){
				echo '<h3 class="title highlight-left-right"><span>'.CHtml::encode($page->page->title).'</span></h3>';
			}
		?>

		<?php if($page->page->body):?>
			<?php echo $page->page->body;?>
		<?php endif;?>
	</div>
<?php endif;?>

<?php if (isset($newsIndex) && $newsIndex) : ?>
	<div class="news">
		<h3 class="title highlight-left-right">
			<span><?php echo tt('News', 'news');?></span>
		</h3>

		<?php
		$total = count($newsIndex);
		$counter = 0;
		?>
		<?php foreach($newsIndex as $news) : ?>
			<?php $counter++;?>
			<?php $announce = ($news->getAnnounce()) ? $news->getAnnounce() : '&nbsp;';?>

			<div class="new">
				<div class="title">
					<?php //echo CHtml::link(truncateText($news->getStrByLang('title'), 4), $news->getUrl());?>
					<?php echo CHtml::link($news->getStrByLang('title'), $news->getUrl()); ?>
				</div>

				<?php
					$class = 'no-image-text';
					if($news->image){
						$src = $news->image->getThumb(80, 60);
						if($src){
							$class = 'text';
							echo CHtml::image(Yii::app()->getBaseUrl().'/uploads/news/'.$src, $news->getStrByLang('title'), array('align' => 'left'));
						}
					}
				?>

				<div class="<?php echo $class; ?>">
					<?php
						if($class == 'text'){
							//echo truncateText($announce, 10);
							echo truncateText($announce, 25);
						} else {
							//echo truncateText($announce, 15);
							echo truncateText($announce, 40);
						}

					?>
				</div>
			</div>

			<?php if($counter != $total):?>
				<div class="dotted_line"></div>
			<?php endif;?>
		<?php endforeach;?>
	</div>
<?php endif;?>
<div class="clear"></div>

<?php if(isset($page) && $page && isset($page->page)):?>
	<?php if ($page->page->widget && $page->page->widget_position == InfoPages::POSITION_BOTTOM):?>
		<?php Yii::import('application.modules.'.$page->page->widget.'.components.*');
		$widgetData = array();

		switch($page->page->widget){
			case 'contactform':
				$widgetData = array('page' => 'index');
				break;

			case 'apartments':
				$widgetData = array('criteria' => $page->page->getCriteriaForAdList());
				break;
		}
		$this->widget(ucfirst($page->page->widget).'Widget', $widgetData);

		?>
	<?php endif;?>
<?php endif;?>