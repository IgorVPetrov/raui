$( document ).ready(function() {
    /* Search panel */
    $('.search-housing-btn').click(function(){
        if($('.search-housing').hasClass('hide')){
            $('.search-housing').removeClass('hide').addClass('show');
            $(this).addClass('search-btn-active');
        } else {
            $('.search-housing').removeClass('show').addClass('hide');
            $('.search-filter-panel').removeClass('show').addClass('hide');
            $(this).removeClass('search-btn-active');
        }
    });
    /* Filter search panel */
    $('.filter-search-btn').click(function(){
        if($('.search-filter-panel').hasClass('hide')){
            $('.search-filter-panel').removeClass('hide').addClass('show');
            //$(this).addClass('search-btn-active');
        } else {
            $('.search-filter-panel').removeClass('show').addClass('hide');
            //$(this).removeClass('search-btn-active');
        }
    });
    $('.btn').button();
    /* slider main */
    /*$('#slider-main').carousel({
        interval: 5000,
        cycle: true,
        pause: false
    });*/
    /* slider best agency and agents */
    $('#slider-best-agency').carousel({
        interval: false,
        pause: false
    });
    /* slider latest ads */
    $('#latest-ads').carousel({
        interval: false,
        pause: false
    });
    /* slider partnership */
    $('#slider-partnership').carousel({
        interval: 8000,
        pause: false
    });
    /* slider menu */
    $('#slider-menu').carousel({
        interval: 7000,
        pause: false
    });
    /* slider modal window object */
    $('[id^=carousel-selector-]').click( function(){
        var id_selector = $(this).attr("id");
        var id = id_selector.substr(id_selector.length -1);
        var id = parseInt(id);
        $('#slider-object').carousel(id);
    });
    /* select plugins */
    $('.selectpicker').selectpicker('');
    $('.selectpicker-search').selectpicker('');
    $('.selectpicker-vacancies').selectpicker('');
    $('.slider-price select').selectpicker('');
    /* modal */
    $('#about-text').modal({
        show: true,
        backdrop: false
    });
    /* counter likes */
    $(".click-like").click(function () {
        $('.counter').html(+$(".counter").html() + 1);
    });
    /* number of rooms */
    $('.down').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.up').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
    /* slider price */
    $(function() {
        $( "#slider_price" ).slider({
            range: true,
            min: 0,
            max: 100000,
            values: [ 30000, 50000 ],
            slide: function( event, ui ) {
                $( "#price" ).val(ui.values[ 0 ]);
                $("#price2").val(ui.values[1]);			}
        });
        $( "#price" ).val($( "#slider_price" ).slider( "values", 0 ));
        $("#price2").val($("#slider_price").slider( "values", 1 ));
    });
    /* telephone object */
    $('#telephone').click(function(){
        var telephone = $(this).next('span').text();
        $(this).text(telephone);
    });
    $('.tel-search-res').click(function(){
        var telephone = $(this).next('span').text();
        $(this).children('span').text(telephone);
    });
    /* filter news */
    $(function() {
        var newSelection = "";
        $("#filter-nav a").click(function(){
            $("#filter-news").fadeTo(200, 0.10);
            $("#filter-nav a").removeClass("current");
            $(this).addClass("current");
            newSelection = $(this).attr("rel");
            $(".filter-news-list").not("."+newSelection).slideUp();
            $("."+newSelection).slideDown();
            $("#filter-news").fadeTo(600, 1);

        });
        /*$('.readmore').click(function(){
            $(this).prev('.filter-news-text').toggleClass('full-text');
        });*/
    });
    /* Filter news, blog and search result */
    var filterPl = (function( $ ) {
        'use strict';
        var $grid = $('#grid'),
            $filterOptions = $('.filter-options'),
            $sizer = $grid.find('.shuffle__sizer'),
            init = function() {
                setTimeout(function() {
                    setupFilters();
                    setupSorting();
                    setupSearching();
                }, 100);
                $grid.shuffle({
                    itemSelector: '.picture-item',
                    sizer: $sizer
                });
            },
            setupFilters = function() {
                var $btns = $filterOptions.children();
                $btns.on('click', function() {
                    var $this = $(this),
                        isActive = $this.hasClass( 'active' ),
                        group = isActive ? 'all' : $this.data('group');
                    if ( !isActive ) {
                        $('.filter-options .active').removeClass('active');
                    }
                    $this.toggleClass('active');
                    $grid.shuffle( 'shuffle', group );
                });
                $btns = null;
            },
            setupSorting = function() {
                $('#date-created').on('click', function() {
                    var opts = {};
                    $('#popularity').removeClass('current');
                    $(this).addClass('current');
                    opts = {
                        reverse: true,
                        by: function($el) {
                            return $el.data('date-created');
                        }
                    };
                    $grid.shuffle('sort', opts);
                });
                $('#popularity').on('click', function() {
                    var opts = {};
                    $('#date-created').removeClass('current');
                    $(this).addClass('current');
                    opts = {
                        reverse: true,
                        by: function($el) {
                            return $el.data('popularity');
                        }
                    };
                    $grid.shuffle('sort', opts);
                });
            },
            setupSearching = function() {
                $('.js-shuffle-search').on('keyup change', function() {
                    var val = this.value.toLowerCase();
                    $grid.shuffle('shuffle', function($el, shuffle) {
                        // Only search elements in the current group
                        if (shuffle.group !== 'all' && $.inArray(shuffle.group, $el.data('groups')) === -1) {
                            return false;
                        }
                        var text = $.trim( $el.find('.picture-item__title').text() ).toLowerCase();
                        return text.indexOf(val) !== -1;
                    });
                });
            }
        return {
            init: init
        };
    }( jQuery ));
    $(document).ready(function() {filterPl.init();});
    /* textarea autoResize */
    (function($){
        $.fn.textareaExpander = function(options){
            var defaults = {
                minHeight: 'inherit',
                animate: true,
                animateDuration: 100
            };
            options = $.extend({}, defaults, options);
            var checkResize = function(){
                var $this = $(this),
                    prevHeight = $this.height(),
                    rowHeight = $this.css('fontSize'),
                    newHeight = 0;
                $this.height(rowHeight);
                newHeight = this.scrollHeight;
                $this.height(prevHeight);
                if (newHeight < options.minHeight) {
                    newHeight = options.minHeight;
                }
                options.animate ?
                    $this.stop().animate({
                        height: newHeight
                    }, options.animateDuration)
                    : $this.height(newHeight);
            }
            return this.filter('textarea').each(function(){
                var $this = $(this);
                if (options.minHeight == 'inherit') {
                    options.minHeight = $this.height();
                }
                $this
                    .css({
                        resize: 'none',
                        overflowY: 'hidden',
                        overflowX: 'hidden'
                    }).bind(
                    'expand keyup keydown change',
                    checkResize
                ).trigger('expand');
                return this;
            });
        };
    })(jQuery);
    $(function(){$('textarea').textareaExpander();});
    /* full text vacancies */
    $('.full-text').on('click', function() {
        if(!$(this).hasClass('full-text-open')){
            $(this).addClass('full-text-open').parents('tr').addClass('show-text-open');
        } else {
            $(this).removeClass('full-text-open').parents('tr').removeClass('show-text-open');
        }
    });
    /* full text */
    $('.hidden-text-open').on('click', function() {
        $(this).prev('.hidden-text').toggleClass('show-text');
    });
});
