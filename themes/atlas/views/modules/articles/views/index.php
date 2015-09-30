<?php
$this->pageTitle .= ' - '.tt("FAQ");
$this->breadcrumbs=array(
	tt("FAQ"),
);
?>

<h1 class="title highlight-left-right">
	<span><?php echo tt("FAQ"); ?></span>
</h1>
<div class="clear"></div><br />

<div class="block_news">
	<?php if ($articles):?>
		<div class="b_news">
			<?php foreach ($articles as $article) : ?>
				<div class="b_news__item b_news__item_no_src">
					<div class="b_news__item_post b_news__item_post_no_src">
						<div class="title">
							<?php echo CHtml::link($article['page_title'], $article->getUrl(), array('class'=>'title')); ?>
						</div><br />
						<div class="new_desc">
							<?php echo truncateText($article['page_body'], 50); ?>
						</div>
						<?php echo CHtml::link(Yii::t('module_articles', 'Read more &raquo;'), $article->getUrl(), array('class' => 'read_more'))?>
					</div>
				</div>
				<div class="clear"></div>
			<?php endforeach; ?>
		</div>
	<?php endif;?>
</div>
<div class="clear"></div>

<?php if($pages && $pages->pageCount > 1):?>
	<div class="pagination">
		<?php
		$this->widget('itemPaginatorAtlas',
			array(
				'pages' => $pages,
				'header' => '',
				'selectedPageCssClass' => 'current',
				'htmlOptions' => array(
					'class' => ''
				)
			)
		);
		?>
	</div>
	<div class="clear"></div>
<?php endif; ?>