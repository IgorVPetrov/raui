<?php
	$this->pageTitle .= ' - '.BlogModule::t('Blog').' - '.CHtml::encode($model->getStrByLang('title'));
	$this->breadcrumbs=array(
		BlogModule::t('Blog') => array('/blog/main/index'),
		truncateText(CHtml::encode($model->getStrByLang('title')), 10),
	);
?>

<!--<h1 class="title highlight-left-right">
	<span><?php echo CHtml::encode($model->getStrByLang('title'));?></span>
</h1>-->




        <!-- One article page -->
        <section class="container-full">
            <div class="one-article">
                <h2><?php echo CHtml::encode($model->getStrByLang('title'));?></h2>
                <div class="clearfix">
                    <span class="pull-left"><?php echo $model->dateCreatedLong ?></span>
                    <span class="pull-right">Автор: <a href="">Сергей Есенин</a></span>
                </div>
                
                <?php if($model->image) : ?>
                <div class="image"><img src="<?php echo $model->image->fullHref()?>"></div>
                <?php else:?>
                <div class="image"></div>
                <?php endif; ?>
                
                
                <div class="text-description">
                
                   <?php echo $model->body;?>
                   
                </div>
                <div class="info-panel">
                    <hr>
                    <ul class="pull-left ul-default">
                        <li><span><i></i>213</span></li>
                        <li>
                            <button class="click-like counter">205</button>
                        </li>
                        <li><span><i></i>96</span></li>
                    </ul>
                    <a class="pull-right" href="/blog/">Вернуться к статьям</a>
                </div>
            </div>
        </section>



<?php /*?><div class="block_new">
	<?php if($model->image) : ?>
		<?php $src = $model->image->getFullThumbLink(); ?>
		<?php if($src) : ?>
				<?php echo '<div class="blog-image">'.CHtml::link(CHtml::image($src, $model->getStrByLang('title')), $model->image->fullHref(), array('class' => 'fancy')).'</div>';?>
				
		<?php endif; ?>
	<?php endif; ?>

	<?php echo $model->body;?>
</div><?php */?>


<?php if(param('enableCommentsForBlog', 1)): ?>
	<div id="comments">
		<?php
		$this->widget('application.modules.comments.components.commentListWidget', array(
			'model' => $model,
			'url' => $model->getUrl(),
			'showRating' => false,
		));
		?>
	</div>

<?php endif; ?>