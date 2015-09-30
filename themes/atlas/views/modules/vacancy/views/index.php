<!-- Slider main -->
        <section class="slider  container-full">
            <div id="slider-main" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <div class="active item">
                        <img src="/themes/atlas/temp/images/slides/slide-vacancies.png">
                    </div>
                </div>
            </div>
        </section>

        <!-- Vacancies -->
        <section class="container-full">
            <div class="vacancies" id="vacancies">
                <div class="control-panel">
                    <ul class="pull-right">
                        <li><a>Мои вакансии</a></li>
                        <li>|</li>
                        <li><a href="#add-position" role="button" data-toggle="modal">Добавить вакансию</a></li>
                        <li><a href="#add-position" role="button" data-toggle="modal" class="add-position-btn"><i></i></a></li>
                    </ul>
                </div>
                
                
                
                                <table>
                    <tr>
                        <th width="108">Дата</th>
                        <th width="473">
                            <select name="" id="" class="selectpicker-vacancies">
                                <option value="">Показать все вакансии</option>
                                <option value="">Показать все вакансии</option>
                                <option value="">Показать все вакансии</option>
                            </select>
                        </th>
                        <th width="473">
                            <select name="" id="" class="selectpicker-vacancies">
                                <option value="">Вакансии в любом городе</option>
                                <option value="">Вакансии в любом городе</option>
                                <option value="">Вакансии в любом городе</option>
                            </select>
                        </th>
                        <th>
                            Последние / все
                        </th>
                    </tr>
                    
                    
                    
                    <?php if ($vacancy) : ?>
                    
                    	<?php foreach ($vacancy as $review) :?>
                    
                    <tr>
                        <td><?php echo $review->dateCreatedFormat; ?></td> <!--Дата-->
                        <td>
                        
                            <?php echo CHtml::encode($review->name); ?> <!--Название-->
                            <?php // print_r($review) ?>

                        </td>
                        <td>
                            <div class="show-text">
                                <?php echo $review->body; ?> <!--Описание-->
                            </div>
                        </td>
                        <td>
                            <ul class="option-panel pull-right">
                                <li><a href="#add-position" role="button" data-toggle="modal"></a></li>
                                <li><a class="delete-vacancies"></a></li>
                            </ul>
                            <a class="full-text"></a>
                        </td>
                    </tr>
                    
                    	<?php endforeach; ?>
                    
                    <?php endif; ?>
                    
                    
                    <?php if(!$vacancy) : ?>
                    
                    
	<tr><td>Список вакансий пуст</td></tr>
    
    
					<?php endif; ?>
                    
                    

                </table>
                
                
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
        <div class="text-center clearfix">
                    <?php if(issetModule('advertising')) :?>
						<?php $this->renderPartial('//modules/advertising/views/advert-bottom', array());?>
					<?php endif; ?>
        </div>
        
	</div>
	
				<?php endif; ?>
                
                
                <div class="add-review-link">
		<?php echo CHtml::link(tt('Add_feedback', 'vacancy'), Yii::app()->createUrl('/vacancy/main/add'), array('class' => 'apt_btn fancy link_blue'));?>
				</div>
                
              </div>
         </section>



	<div class="modal hide add-form" id="add-position" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="">
                    <table>
                        <tr>
                            <th width="110">Компания</th>
                            <td width="440">
                                <ul class="ul-default">
                                    <li><input type="text" placeholder="Название *"></li>
                                    <li>|</li>
                                    <li><input type="text" placeholder="Город *"></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>О компании</th>
                            <td><textarea placeholder="Краткое описание"></textarea></td>
                        </tr>
                        <tr>
                            <th>Вакансия</th>
                            <td>
                                <ul class="ul-default">
                                    <li><input type="text" class="textarea-color" placeholder="Должность *"></textarea></li>
                                    <li><textarea class="expand" placeholder="Требования"></textarea></li>
                                    <li><textarea class="expand" placeholder="Обязаности"></textarea></li>
                                    <li><textarea class="expand" placeholder="Условия"></textarea></li>
                                    <li><textarea class="expand" placeholder="Дополнительно"></textarea></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Контакты</th>
                            <td>
                                <ul class="ul-default">
                                    <li><input type="text" placeholder="E-mail *"></li>
                                    <li>|</li>
                                    <li><input type="text" placeholder="Телефон *"></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button id=""><i></i></button>
                            </td>
                            <td class="text-right">
                                <hr>
                                <span>* - поля, обязательные для заполнения</span>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>


