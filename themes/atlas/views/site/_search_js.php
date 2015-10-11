<?php
$isInner = isset($isInner) ? $isInner : 0;
$compact = param("useCompactInnerSearchForm", true);
$loc = (issetModule('location') && param('useLocation', 1)) ? 1 : 0;
$urlReloadForm = Yii::app()->createUrl('/quicksearch/main/loadForm', array('lang' => Yii::app()->language));
?>

	var sliderRangeFields = <?php echo CJavaScript::encode(SearchForm::getSliderRangeFields());?>;
	var cityField = <?php echo CJavaScript::encode(SearchForm::getCityField());?>;
	var loc = <?php echo CJavaScript::encode($loc);?>;
	var countFiled = <?php echo CJavaScript::encode(SearchForm::getCountFiled() + ($loc ? 2 : 0));?>;
	var isInner = <?php echo CJavaScript::encode($isInner);?>;
	var heightField = 54;
	var advancedIsOpen = 0;
	var compact = <?php echo $compact ? 1 : 0;?>;
	var minHeight = isInner ? 80 : 360;
	var searchCache = [];
	var objType = <?php echo isset($this->objType) ? $this->objType : SearchFormModel::OBJ_TYPE_ID_DEFAULT;?>;
	var useSearchCache = false;

	var search = {
		init: function(){

			if(sliderRangeFields){
				$.each(sliderRangeFields, function() {
					search.initSliderRange(this.params);
				});
			}

			if(countFiled <= 6){
				if(advancedIsOpen){
					if(isInner){
						search.innerSetAdvanced();
					}else{
						search.indexSetNormal();
						$('#more-options-link').hide();
					}
				} else if(!isInner){
					$('#more-options-link').hide();
				}
			} else {
				if(!isInner){
					$('#more-options-link').show();
				}

				if(advancedIsOpen){
					if(isInner){
						search.innerSetAdvanced();
					} else {
						search.indexSetAdvanced();
					}
				}
			}

			if($("#search_term_text").length){
				search.initTerm();
			}

		},

		initTerm: function(){
			$(".search-term input#search_term_text").keypress(function(e) {
				var code = (e.keyCode ? e.keyCode : e.which);
				if(code == 13) { // Enter keycode
					prepareSearch();
					return false;
				}
			});
		},

		initSliderRange: function(sliderParams){
			$( "#slider-range-"+sliderParams.field ).slider({
				range: true,
				min: sliderParams.min,
				max: sliderParams.max,
				values: [ sliderParams.min_sel , sliderParams.max_sel ],
				step: sliderParams.step,
				slide: function( e, ui ) {
					$( "#"+sliderParams.field+"_min_val" ).html( ui.values[ 0 ] );
					$( "#"+sliderParams.field+"_min" ).val( ui.values[ 0 ] );
					$( "#"+sliderParams.field+"_max_val" ).html( ui.values[ 1 ] );
					$( "#"+sliderParams.field+"_max" ).val( ui.values[ 1 ] );
				},
				stop: function(e, ui) {  changeSearch(); }
			});
		},

		indexSetNormal: function(){
			$(".forma").animate({"height" : "380"});
			$("div.index-header-form").animate({"height" : "334"});
			$("div.searchform-index").animate({"height" : "367"});
			$("#more-options-link").html("<?php echo tc("More options");?>");
			advancedIsOpen = 0;
		},

		indexSetAdvanced: function(){
			var height = search.getHeight();

			$(".forma").animate({"height" : height + 52});
			$("div.index-header-form").animate({"height" : height + 52});
			$("div.searchform-index").animate({"height" : height + 52});


			$("#more-options-link").html("<?php echo tc("Less options");?>");
			advancedIsOpen = 1;
		},

		innerSetNormal: function(){
			$("div.filtr").addClass("collapsed");
			advancedIsOpen = 0;
		},

		innerSetAdvanced: function(){
            if($(window).height >= 1024){
                var height = search.getHeight();
                $("div.filtr").removeClass("collapsed").animate({"height" : height });
                $("#search_form").animate({"height" : height});
            }
            advancedIsOpen = 1;
		},

		getHeight: function(){
			var height = isInner ? parseInt(countFiled / 3) * heightField + 30 : countFiled * heightField;
			if(height < minHeight){
				return minHeight;
			}

			return height;
		},

		renderForm: function(obj_type_id){
			$('#search_form').html(searchCache[obj_type_id].html);
			sliderRangeFields = searchCache[obj_type_id].sliderRangeFields;
			cityField = searchCache[obj_type_id].cityField;
			countFiled = searchCache[obj_type_id].countFiled + (loc ? 2 : 0);
			search.init();
			if(!useSearchCache){
				delete(searchCache[obj_type_id]);
			}
			changeSearch();
		}
	}

	$(function(){
		search.init();

		$('#objType').on('change', function(){
			var obj_type_id = $(this).val();
			if(typeof searchCache[obj_type_id] == 'undefined'){
				$.ajax({
					url: <?php echo CJavaScript::encode($urlReloadForm); ?> + '?' + $('#search-form').serialize(),
					dataType: 'json',
					type: 'GET',
					data: { obj_type_id: obj_type_id, is_inner: <?php echo CJavaScript::encode($isInner);?>, compact: advancedIsOpen ? 0 : 1 },
					success: function(data){
						if(data.status == 'ok'){
							searchCache[obj_type_id] = [];
							searchCache[obj_type_id].html = data.html;
							searchCache[obj_type_id].sliderRangeFields = data.sliderRangeFields;
							searchCache[obj_type_id].cityField = data.cityField;
							searchCache[obj_type_id].countFiled = data.countFiled;
							search.renderForm(obj_type_id);
						}
					}
				})
			} else {
				search.renderForm(obj_type_id);
			}
		});

		if(isInner){
			$("#more-options-link-inner, #more-options-img").on('click', function(){
				if (advancedIsOpen) {
					search.innerSetNormal();
				} else {
					search.innerSetAdvanced();
				}
			});
		} else {
			$("#more-options-link").on('click', function(){
				if(advancedIsOpen){
					search.indexSetNormal();
				} else {
					search.indexSetAdvanced();
				}
			});
		}

		if(isInner && !compact){
			search.innerSetAdvanced();
		}
	});


function prepareSearch() {
	var term = $(".search-term input#search_term_text").val();

	if (term != <?php echo CJavaScript::encode(tc("Search by description or address")) ?>) {
		if (term.length >= <?php echo (int) Yii::app()->controller->minLengthSearch ?>) {
			term = term.split(" ");
			term = term.join("+");
			$("#do-term-search").val(1);
				window.location.replace("<?php echo Yii::app()->createAbsoluteUrl('/quicksearch/main/mainsearch', array('lang' => Yii::app()->language)) ?>?term="+term+"&do-term-search=1");
			} else {
				alert(<?php echo CJavaScript::encode(Yii::t('common', 'Minimum {min} characters.', array('{min}' => Yii::app()->controller->minLengthSearch))) ?>);
		}
	}
}