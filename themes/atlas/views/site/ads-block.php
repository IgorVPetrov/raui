<div id="ore-ads-block">
    <div style="margin: 0 auto; width: 960px;">
        <ul>
			<li>
				<?php
				$linkTitle = Yii::t('module_install', 'Buy', array(), 'messagesInFile', Yii::app()->language);
				$linkHref = (Yii::app()->language == 'ru') ? '#' : '#';

				echo CHtml::link(
					'<span class="download"></span>' . $linkTitle,
					$linkHref,
					array(
						'class' => 'button green'
					)
				);
				?>
			</li>
			<?php if (isFree()):?>
				<li>
					<?php
					echo CHtml::link(
						Yii::t('module_install', 'PRO version demo', array(), 'messagesInFile', Yii::app()->language),
						'#',
						array(
							'class' => 'button green'
						)
					);
					?>
				</li>

				<li>
					<?php
					echo CHtml::link(
						Yii::t('module_install', 'Add-ons', array(), 'messagesInFile', Yii::app()->language),
						(Yii::app()->language == 'ru') ? '#' : '#',
						array(
							'class' => 'button cyan'
						)
					);
					?>
				</li>
			<?php endif;?>
            <li>
                <?php
                echo CHtml::link(
                    Yii::t('module_install', 'About product', array(), 'messagesInFile', Yii::app()->language),
                    (Yii::app()->language == 'ru') ? '#' : '#',
                    array(
                        'class' => 'button cyan'
                    )
                );
                ?>
            </li>
            <li>
                <?php
                echo CHtml::link(
                    Yii::t('module_install', 'Contact us', array(), 'messagesInFile', Yii::app()->language),
                    (Yii::app()->language == 'ru') ? '#' : '#',
                    array(
                        'class' => 'button cyan'
                    )
                );
                ?>
            </li>
            <li>
                <?php
                $themeList = Themes::getColorThemesList();

                echo Yii::t('module_install', 'Color theme', array(), 'messagesInFile', Yii::app()->language) . ': ';

                echo CHtml::dropDownList('theme', Themes::getParam('color_theme'), $themeList, array(
                    'onchange' => 'js: changeTheme(this.value);'
                ));
                ?>
            </li>
        </ul>
    </div>
</div>

<script type="text/javascript">
    function changeTheme(theme){
        location.href = URL_add_parameter(location.href, 'theme', theme);
    }

    function URL_add_parameter(url, param, value){
        var hash       = {};
        var parser     = document.createElement('a');

        parser.href    = url;

        var parameters = parser.search.split(/\?|&/);

        for(var i=0; i < parameters.length; i++) {
            if(!parameters[i])
                continue;

            var ary      = parameters[i].split('=');
            hash[ary[0]] = ary[1];
        }

        hash[param] = value;

        var list = [];
        Object.keys(hash).forEach(function (key) {
            list.push(key + '=' + hash[key]);
        });

        parser.search = '?' + list.join('&');
        return parser.href;
    }
</script>