<?php
$count = $index + 1;
$isLast = ($count % 3) ? false : true;
$addClass = ($isLast) ? 'last' : '';
?>


<?php //print_r($data)?>
<div class="item-block">
                            <a href="<?php echo $data->getUrl()?>"><?php
        $data->renderAva(true, '', true);
        $additionalInfo = 'additional_info_'.Yii::app()->language;
        if (isset($data->$additionalInfo) && !empty($data->$additionalInfo)){
            echo CHtml::encode(truncateText($data->$additionalInfo, 40));
        }
		?></a>
                            <div>
                                <span><?php echo $data->getTypeName();?>: <?php echo CHtml::link( ($data->type == User::TYPE_AGENCY ? $data->agency_name : $data->username ), $data->getUrl() );?></span>
                                <ul>
                                    <li>продажа квартир (14053)</li>
                                    <li>продажа домов (83)</li>
                                </ul>
                            </div>
                        </div>

