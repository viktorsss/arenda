/* Global variables */

var viewportHeight = document.documentElement.clientHeight;
var widthLessThen1280;
var sliderNeedReinit = false;


/* Запускаем когда страница готова | trigger when page is ready */
$(document).ready(function () {

    // Добавляйте Ваши функции сюда | your functions go here

    //Layout Dimensions
    if ($('.wrapper').height() < viewportHeight) {
	$('.wrapper').addClass('lessthanviewport');
    }


    // Sliders 
    //Region-slider
    var region_search = $('.region-search');
    $('.region-slider .slides').slick({
	dots: false,
	arrows: false,
	infinite: false,
	speed: 300,
	slidesToShow: 5,
	touchMove: false,
	slidesToScroll: 1,
	responsive: [{
		breakpoint: 1260,
		settings: {
		    slidesToShow: 4,
		    slidesToScroll: 1,
		    arrows: false,
		    dots: false,
		    infinite: false
		}
	    }],
	onInit: function () {
	    setTimeout(function () {
		region_search.addClass('hidden');
	    }, 1000);
	}
    });

    $('.region-slider').find('.pagination li a').click(function () {
	$('.pagination li a.current').removeClass('current');
	var reg_slides = $('.region-slider .slides');

	var slide_to_show = reg_slides.find('.slide[data-letter="' + $(this).attr('data-letter') + '"]').index();
	var total_slides = reg_slides.find('.slide').length;

	if (total_slides - slide_to_show < 5) {
	    reg_slides.slickGoTo(total_slides - 5);
	} else
	    reg_slides.slickGoTo(slide_to_show);

	$(this).addClass('current');
    });


    //Reviews-slider
    $('.reviews-slider .slides').slick({
	dots: false,
	arrows: true,
	infinite: true,
	speed: 300,
	slidesToShow: 2,
	touchMove: false,
	slidesToScroll: 2
    });

    //Object-slider
    $('.object-slider .slides').slick({
	dots: false,
	arrows: true,
	infinite: true,
	speed: 500
    });
    $('.object-slider').find('.pagination li a').click(function (e) {
	$('.pagination li a.current').removeClass('current');
	$('.object-slider .slides').slickGoTo($(this).closest('li').index());
	e.preventDefault();
	$(this).addClass('current');
    });


    // jScrollPane
    $('aside .scroll-pane').jScrollPane({
	autoReinitialise: true,
	animateScroll: true,
	animateDuration: 800,
	contentWidth: 273
    });

    // jScrollPane
    $('.tabs .scroll-pane').jScrollPane({
	autoReinitialise: true,
	animateScroll: true,
	animateDuration: 800
    });

    // jScrollPane
    $('.messages-field .scroll-pane').jScrollPane({
	autoReinitialise: true,
	animateScroll: true,
	animateDuration: 800
    });

    //Tabs (index.html)
    $('dl.tabs dt').click(function () {
	$(this).siblings().removeClass('selected').end().next('dd').andSelf().addClass('selected');
	// jScrollPane
	$('.tabs .scroll-pane').jScrollPane({
	    autoReinitialise: true,
	    animateScroll: true,
	    animateDuration: 800
	});
    });

    // Стиллизация чекбоксов
    $(document).on('click', 'label input[type=checkbox]', function () {
	if ($(this).is(':checked')) {
	    $(this).closest('label').addClass('checked');
	} else {
	    //alert('bla bla bla');
	    $(this).closest('label').removeClass('checked');
	}
    });

    //Стиллизация радиобаттонов
    $(document).on('click', 'label input[type=radio]', function () {
	//$('label input[type=radio]').each(function(){
	//if ($(this).is(':checked')) $(this).closest('label').addClass('checked');
	//$(this).change(function(){
	var nm = $(this).attr('name');
	$('label input[name=' + nm + ']').each(function () {
	    if ($(this).is(':checked')) {
		$(this).closest('label').addClass('checked');
	    } else {
		$(this).closest('label').removeClass('checked');
	    }
	});
	//});
	//});
    });

    // Input Placeholders

    $('input[placeholder], textarea[placeholder]').each(function (index, element) {
	var pl_val = $(this).attr('placeholder');
	var pl_color = '#959595';
	var txt_color = '#262626'
	if ($(this).hasClass('placeholder-white')) {
	    pl_color = '#fff';
	    txt_color = '#fff';
	}
	$(this).removeAttr('placeholder');
	$(this).attr('plholder', pl_val);
	if ($(this).val() == '') {
	    $(this).val($(this).attr('plholder')).css({color: pl_color});
	}
	$(this).blur(function () {
	    if ($(this).val() == '') {
		$(this).val($(this).attr('plholder')).css({color: pl_color});
	    }
	});
	$(this).focus(function () {
	    if ($(this).val() == $(this).attr('plholder')) {
		$(this).val('').css({color: txt_color});
	    }
	});
    });


    // Switcher-box value 
    if ($('.switcher-box label').is(':checked'))
	$(this).closest('.switcher-box').addClass('checked');
    $('.switcher-box label').change(function () {
	if($(this).hasClass('checked')) {
	    $('#komerc').show();
	    $('#nokomerc').hide();
	} else {
	    $('#komerc').hide();
	    $('#nokomerc').show();
	}
	$(this).closest('.switcher-box').toggleClass('checked');
    });

    // Color animation
    function blinkTitle() {
	if ($(".sidebar-filter").is(":visible")) {
	    colorAnimate($("aside .button.back-to"), "#ff9000", "#606060");
	}
	if ($(".sidebar-content").is(":visible")) {
	    colorAnimate($(".sidebar-content p.subtitle"), "#ff9000", "#ffffff");
	}
    }

    function colorAnimate(element, fromColor, toColor) {
	element.stop(true, true);

	for (var i = 0; i < 3; i++) {
	    element.animate({color: fromColor}, 500)
		    .animate({color: toColor}, 500);
	}
    }

    //Show-hide sidebar (< 1280px)
    if ($(window).width() < 1260) {
	widthLessThen1280 = true;
	$('.wrapper').addClass('lessthan1280');
	$('.region-search').addClass('lessthan1280');
	$('.left-sidebar').css('left', '55px');
	if (!$('.wrapper').hasClass('with-sidebar-icon')) {
	    $('.page').css('left', '276px');
	}
	$('.fixed-block').addClass('adaptive').removeClass('regular');
	blinkTitle();
    } else {
	widthLessThen1280 = false;
	$('.wrapper').removeClass('lessthan1280');
	$('.region-search').removeClass('lessthan1280');
	if (!$('.wrapper').hasClass('with-sidebar-icon')) {
	    $('.page').css('left', '0');
	    $('.left-sidebar').css('left', '0');
	}
	$('.fixed-block').removeClass('adaptive').addClass('regular');
	blinkTitle();
    }

    $('aside.regular .open-sidebar').click(function () {
	var slideBlock = $(this).closest('aside').find('.left-sidebar');
	var slideContent = $(this).closest('.wrapper').find('.page');
	slideBlock.stop(true, true).animate({left: parseInt(slideBlock.css('left'), 10) == 55 ? -slideBlock.outerWidth() : 55});
	slideContent.stop(true, true).animate({left: parseInt(slideContent.css('left'), 10) == 0 ? +slideBlock.outerWidth() : 0});
	$(this).toggleClass("active");
	if ($(this).hasClass("active")) {
	    blinkTitle();
	}
    });

    $('a.sidebar-icon').on('click', function () {
	$('aside').addClass('visible');
	$('a.open-sidebar').addClass('active').show();
	$('.left-sidebar').css('left', '55px');
    });

    $('aside.min .open-sidebar').on('click', function () {
	$('aside').removeClass('visible');
	$('a.sidebar-icon').show();
	$('a.open-sidebar').hide();
    });




    // Region search active
    $('#region-link').click(function () {
	$('.right-sidebar-links').addClass('not-fixed');
	$('.fixed-block').addClass('not-fixed');
	$('aside').addClass('not-fixed');
	if (!region_search.hasClass('hidden'))
	    region_search.addClass('hidden');

	region_search.slideToggle(300, function () {
	    if (region_search.is(':visible')) {
		$('.right-sidebar-links').css({marginTop: region_search.outerHeight()});
		$('.fixed-block').css({marginTop: region_search.outerHeight()});
		$('aside').css({marginTop: region_search.outerHeight()});
	    } else {
		$('.right-sidebar-links').css({marginTop: 0});
		$('.fixed-block').css({marginTop: 0});
		$('aside').css({marginTop: 0});
	    }
	    $('.right-sidebar-links').removeClass('not-fixed');
	    $('.fixed-block').removeClass('not-fixed');
	    $('aside').removeClass('not-fixed');
	});
	$(this).toggleClass('active');

	if (sliderNeedReinit) {
	    setTimeout(function () {
		$('.region-slider .slides').slickSetOption('autoplay', false, true);
	    }, 30);
	    sliderNeedReinit = false;
	}
    });

    $(window).scroll(function () {
	var offset = $(window).scrollTop();
	if (region_search.is(':visible')) {
	    offset = offset - region_search.outerHeight();
	}
	if (offset > 0) {
	    $('.to-top').fadeIn('slow');
	    $('.right-sidebar-links').css({marginTop: 0});
	    $('.fixed-block').css({marginTop: 0});
	    $('aside').css({marginTop: 0});
	} else {
	    $('.right-sidebar-links').css({marginTop: -offset});
	    $('.fixed-block').css({marginTop: -offset});
	    $('aside').css({marginTop: -offset});
	    $('.to-top').fadeOut('fast');

	}
    });

    $('.to-top').click(function () {
	$("html, body").animate({scrollTop: 0}, "slow");
    });

    //Right-sidebar-links position
    $('.right-sidebar-links').css({marginRight: -$('.wrapper').width() / 2});

    //Fixed-block position
    $('.fixed-block.regular').css({marginRight: -$('.wrapper').width() / 2 + 97});
    $('.fixed-block.adaptive').css({marginRight: -$('.wrapper').width() / 2 + 26});


    //Region search close 
    $('.region-search .close').on('click', function () {
	$('#region-link').click();
    });


    // Change region
    $('.city-list li a').on('click', function () {
	var newValue = $(this).html();
	$('#region-link').click();
	$('#region-link span').html(newValue);
    });

    // Left-sidebar advanced-field show-hide
    $('.hidden-wrap > a').click(function () {
	$('.hidden').removeClass('visible');
	var isClose = $(this).hasClass('active');
	$('.hidden-wrap > a').removeClass('active');
	if (isClose) {
	    return;
	}
	var advancedField = $(this).closest('.hidden-wrap').find('.hidden');
	advancedField.addClass('visible');
	if (document.documentElement.clientHeight + $(window).scrollTop() > $(this).offset().top + advancedField.outerHeight()) {
	    advancedField.removeClass('top');
	} else {
	    advancedField.addClass('top');
	}
	$(this).addClass('active');
    });

    // Исчезновение по клику вне
    $(document).click(function (e) {
	if ($('.hidden:visible').length && !($(e.target).closest('.hidden-wrap').length)) {
	    $('.hidden').removeClass('visible');
	    $('.hidden-wrap > a').removeClass('active');
	}
    });

    // Show-hide hidden elements
    $(".show-hide-link").on('click', function () {
	$(this).closest('div').find('.hidden-block').slideToggle("fast");
	$(this).toggleClass("active");
    });

    // Show-hide hidden elements (next block)
    $(".show-hide-next").on('click', function () {
	$(this).closest('div').next('.hidden-block').slideToggle("fast");
	$(this).toggleClass("active");
    });

    // Show-hide hidden elements (ul.search-object)
    $(document).on('click', '.search-object-item a.show-extra', function () {
	event.preventDefault();
	//alert('foo bar');
	var search_object_item = $(this).closest('.search-object-item');
	var extra_info = search_object_item.find('.extra-info');

	if (extra_info.is(':visible')) {
	    extra_info.slideUp('fast');
	    $(this).removeClass('active');
	} else {
	    if ($('.search-object-item .extra-info:visible').length) {
		$('.search-object-item .extra-info:visible').slideUp('fast');
		$('.search-object-item a.show-extra').removeClass('active');
	    }
	    extra_info.slideDown('fast');
	    $(this).addClass('active');
	}
    });

    // Show-hide hidden elements (.request-block))
    $(document).on('click', ".request-result > a.button", function () {
	var request_block = $(this).closest('.request-block');
	var request = request_block.find('.request');
	var request_result = request_block.find('.request-result');
	var search_object = request_result.find('.search-object');

	if (search_object.is(':visible')) {
	    search_object.slideUp('fast');
	    $(this).removeClass('active');
	    request_result.removeClass('active');
	    request.removeClass('active');
	} else {
	    if ($('.request-result .search-object:visible').length) {
		$('.request-result .search-object:visible').slideUp('fast');
		$('.request-result > a.button').removeClass('active');
		$('.request-result').removeClass('active');
		$('.request').removeClass('active');
	    }
	    search_object.slideDown('fast');
	    $(this).addClass('active');
	    request_result.addClass('active');
	    request.addClass('active');
	}
    });

    // Show-hide hidden elements
    $("a.open-legend").click(function () {
	var slideBlock = $(this).closest('.map-wrap').find('.map-info');
	var slideDistance = $(this).attr('data-dist');

	slideBlock.stop(true, true).animate({right: parseInt(slideBlock.css('right'), 10) == 0 ? -slideBlock.outerWidth() : 0});
	$(this).stop(true, true).animate({right: parseInt($(this).css('right'), 10) == slideDistance ? 0 : slideDistance});
	$(this).toggleClass("active");
    });

    // Show-hide hidden elements
    $(".start-module a.more").click(function () {
	var hidden_block = $(this).closest('.description').find('.hidden-content');
	if (hidden_block.is(':visible')) {
	    hidden_block.hide();
	    $(this).removeClass('active');
	} else {
	    if ($('.description .hidden-content:visible').length) {
		$('.description .hidden-content:visible').hide();
		$('.description a.more').removeClass('active');
	    }
	    var heading = $(this).closest('.description').find('.heading');
	    var heading_offset = heading.offset().top - 34;
	    hidden_block.show();
	    $(this).addClass('active');
	    $('html:not(:animated),body:not(:animated)').animate({scrollTop: heading_offset}, 500);
	}
    });


    // SELECT stylization 

    /*$('.select-wrap').each(function(){
     $(this).find('input[type=hidden]').val($(this).find('.option-list li:first').attr('data-value'));		
     }); */

    $(document).on('click', '.select', function () {
	var select_wrap = $(this).closest('.select-wrap');
	var option_list = select_wrap.find('.option-list');

	if (option_list.is(':visible')) {
	    option_list.slideUp('fast');
	    $(this).find('.arrow').removeClass('active');
	    select_wrap.removeClass('active');
	} else {
	    if ($('.select-wrap .option-list:visible').length) {
		$('.select-wrap .option-list:visible').hide();
		$('.select-wrap .arrow').removeClass('active');
		$('.select-wrap').removeClass('active');
	    }
	    option_list.slideDown('fast');
	    $(this).find('.arrow').addClass('active');
	    select_wrap.addClass('active');
	}
    });

    $(document).on('click', '.option-list li', function () {
	var title = $(this).closest('.select-wrap').find('.select .title');
	var option = $(this).html();
	$(this).closest('.select-wrap').find('input[type=hidden]').val($(this).attr('data-value'));
	title.empty();
	title.html(option);
	$(this).closest('.option-list').slideUp(300);
	$('.select-wrap .option-list').slideUp(300);
	$(this).closest('.select-wrap').find('.arrow').removeClass('active');
	$(this).closest('.select-wrap').removeClass('active');
    });

    $(document).click(function (e) {
	if ($('.select-wrap .option-list:visible').length && !$(e.target).closest('.select-wrap').length) {
	    $('.select-wrap .option-list').slideUp(300);
	    $('.select-wrap .arrow').removeClass('active');
	    $('.select-wrap').removeClass('active');
	}
    });
    $(document).keyup(function (e) {
	if (e.keyCode == 27) {
	    $('.select-wrap .option-list').slideUp(300);
	}
    });

    //Spinbox 
    $('.spinbox a.minus').click(function () {
	var inp = $(this).closest('.spinbox').find('span.value');
	var v = parseInt(inp.html());
	if (v > 0) {
	    v--;
	    inp.html('+' + v);
	}
	return false;
    });

    $('.spinbox a.plus').click(function () {
	var inp = $(this).closest('.spinbox').find('span.value');
	var v = parseInt(inp.html());
	v++;
	inp.html('+' + v);
	return false;
    });

    /*
     // Popup (enter-popup) $(document).on(
     $(document).on('click', '.enter-register .enter', function(e){
     $('#shadow').fadeIn(300);
     $('.enter-popup').css({top: $(window).scrollTop()+ 40}).fadeIn(300);
     $('.enter-popup .popup-block').css('display','none');
     $('.enter-popup').find('.enter-block').css('display','block');
     e.preventDefault();
     });
     $(document).on('click', '.enter-register .register', function(e){
     $('#shadow').fadeIn(300);
     $('.enter-popup').css({top: $(window).scrollTop()+ 40}).fadeIn(300);
     $('.enter-popup .popup-block').css('display','none');
     $('.enter-popup').find('.registration-block').css('display','block');
     e.preventDefault();
     });
     $('.register-link').click(function(){
     $(this).closest('.enter-block').hide();
     $(this).closest('.enter-popup').find('.registration-block').show();
     });
     $('.enter-link').click(function(){
     $(this).closest('.registration-block').hide();
     $(this).closest('.enter-popup').find('.enter-block').show();
     });
     
     /*$('.enter-block input[type=submit]').click(function(e){
     $(this).closest('.enter-block').hide();
     $(this).closest('.enter-popup').find('.enter-person-block').show();
     e.preventDefault();
     });
     $('.registration-block input[type=submit]').click(function(e){
     $(this).closest('.registration-block').hide();
     $(this).closest('.enter-popup').find('.registration-ok-block').show();
     e.preventDefault();
     });
     $('.registration-ok-block input[type=submit]').click(function(){
     $('.popup .close').click();
     });
     $('.enter-person-block input[type=submit]').click(function(){
     $('.popup .close').click();
     });
     $('.enter-person-block a.button').click(function(){
     $('.popup .close').click();
     });*/

    // Popup (add-popup)
    $('.add-popup-link').click(function (e) {
	$('#shadow').fadeIn(300);
	$('.add-popup').css({top: $(window).scrollTop() + 40}).fadeIn(300);
	e.preventDefault();
    });


    $('.popup .close').click(function (e) {
	$(this).closest('.popup').fadeOut();
	$('#shadow').fadeOut(300);
	e.preventDefault();
    });

    // Исчезновение по клику вне
    $(document).click(function (e) {
	if ($('.enter-popup:visible').length && !($(e.target).closest('.left-sidebar').length || $(e.target).closest('.content-white').length || $(e.target).closest('.container').length)) {
	    $('.enter-popup .close').click();
	}
	if ($('.add-popup:visible').length && !($(e.target).closest('.new-request-popup').length || $(e.target).closest('.container').length)) {
	    $('.add-popup .close').click();
	}
    });

    // Исчезновение по ESC
    $(document).keyup(function (e) {
	if (e.keyCode == 27) {
	    $('.popup .close').click();
	}
    });




    $('a[href=#]').click(function (e) {
	e.preventDefault();
    });

    //------------------------- DmitrWP Edit ----------------------
    
    $(".stars").attr('style', 'display:none');

    $(document).on('click', '.enter-register .enter', function (e) {
	$.arcticmodal({
	    type: 'ajax',
	    url: '/site/login',
	});
    });

    $(document).on('click', '.enter-register .register', function (e) {
	$.arcticmodal({
	    type: 'ajax',
	    url: '/site/registration',
	});
    });

    $(document).on('click', '.register-link', function () {
	$.arcticmodal('close');
	$.arcticmodal({
	    type: 'ajax',
	    url: '/site/registration',
	});
    });

    $(document).on('click', '.enter-link', function () {
	$.arcticmodal('close');
	$.arcticmodal({
	    type: 'ajax',
	    url: '/site/login',
	});
    });
    
    $(".back-to").click(function() {
	$(".sidebar-filter").hide();
	$(".sidebar-content").show();
    });

    $('#city').autocomplete({
	serviceUrl: '/site/selectcity', // Страница для обработки запросов автозаполнения
	minChars: 1, // Минимальная длина запроса для срабатывания автозаполнения
	delimiter: /(,|;)\s*/, // Разделитель для нескольких запросов, символ или регулярное выражение
	maxHeight: 400, // Максимальная высота списка подсказок, в пикселях
	width: 316, // Ширина списка
	zIndex: 9999, // z-index списка
	deferRequestBy: 300, // Задержка запроса (мсек), на случай, если мы не хотим слать миллион запросов, пока пользователь печатает. Я обычно ставлю 300.
	onSelect: function (data, value) {
	    //data = data.data.split('-');
	},
    });

    $('a.exit').click(function () {
	$.post('/site/logout');
	document.location.href = '/';
    });

    $("#searchCity").keyup(function () {
	text = $(".slides").html();
	word = $(this).val();
	console.log(word);
	if(word != "") {
	    url = '/site/searchcity?q=' + word;
	    $.post(url, function (data) {
		$('.region-slider .slides').html(data);
	    });
	} else {
	    $(".region-slider").html(text);
	}
	//console.log(text);
    });

});

// DmitryWP Function
function validate(objForm, objSubm) {
    $(objForm).submit(function () {
	return false;
    });
    $(objForm).each(function () {
	// Объявляем переменные (форма и кнопка отправки)
	var form = $(this), btn = form.find(objSubm);
	// Добавляем каждому проверяемому полю, указание что поле пустое
	form.find('.rfield').addClass('empty_field');

	// Функция проверки полей формы
	function checkInput() {
	    form.find('.rfield').each(function () {
		if ($(this).val() != '') {
		    // Если поле не пустое удаляем класс-указание
		    $(this).removeClass('empty_field');
		} else {
		    // Если поле пустое добавляем класс-указание
		    $(this).addClass('empty_field');
		}
	    });
	}

	// Функция подсветки незаполненных полей
	function lightEmpty() {
	    form.find('.empty_field').css({'border-color': '#d8512d'});
	    // Через полсекунды удаляем подсветку
	    setTimeout(function () {
		form.find('.empty_field').removeAttr('style');
	    }, 500);
	}
	// Проверка в режиме реального времени
	setInterval(function () {
	    // Запускаем функцию проверки полей на заполненность
	    checkInput();
	    // Считаем к-во незаполненных полей
	    var sizeEmpty = form.find('.empty_field').size();
	    // Вешаем условие-тригер на кнопку отправки формы
	    if (sizeEmpty > 0) {
		if (btn.hasClass('disabled')) {
		    return false
		} else {
		    btn.addClass('disabled')
		}
	    } else {
		btn.removeClass('disabled')
	    }
	}, 500);

	// Событие клика по кнопке отправить
	btn.click(function () {
	    if ($(this).hasClass('disabled')) {
		// подсвечиваем незаполненные поля и форму не отправляем, если есть незаполненные поля
		lightEmpty();
		return false;
	    } else {
		return true;
	    }
	});
    });
}



$(window).load(function () { // Когда страница полностью загружена

    //Floating articles (Masonry)
    if ($('.articles-list').length) {
	var container = document.querySelector('.articles-list');
	var msnry = new Masonry(container, {
	    itemSelector: '.item',
	    columnWidth: 208,
	    gutter: 10
	});
	eventie.bind(container, 'click', function (event) {
	    // don't proceed if item was not clicked on
	    if (!classie.has(event.target, 'show-hide-article')) {
		return;
	    }
	    var itemGigante = $(event.target).closest('.gigante');
	    if (itemGigante.is(':visible')) {
		itemGigante.removeClass('gigante');
		msnry.layout();
	    } else {
		if ($('.articles-list .gigante:visible').length) {
		    $('.articles-list .gigante:visible').removeClass('gigante');
		    msnry.layout();
		}
		// change size of item via class
		$(event.target).closest('.item').addClass('gigante');
		msnry.layout();
		setTimeout(function () {
		    var destination = $(event.target).closest('.gigante').offset().top - 15;
		    console.log(destination);
		    $('html:not(:animated),body:not(:animated)').animate({scrollTop: destination}, 500);
		}, 500);
	    }
	});
    }

});

$(window).resize(function () { // Когда изменили размеры окна браузера

    //Layout Dimensions
    if ($('.wrapper').height() < viewportHeight) {
	$('.wrapper').addClass('lessthanviewport');
    }

    //Show-hide sidebar (< 1280px)
    if ($(window).width() < 1260) {
	if (!widthLessThen1280) {
	    widthLessThen1280 = true;
	    $('.wrapper').addClass('lessthan1280');
	    $('.region-search').addClass('lessthan1280');
	    $('.left-sidebar').css('left', '55px');
	    if (!$('.wrapper').hasClass('with-sidebar-icon')) {
		$('.page').css('left', '276px');
	    }
	    $('.fixed-block').addClass('adaptive').removeClass('regular');
	}
    } else {
	if (widthLessThen1280) {
	    widthLessThen1280 = false;
	    $('.wrapper').removeClass('lessthan1280');
	    $('.region-search').removeClass('lessthan1280');
	    if (!$('.wrapper').hasClass('with-sidebar-icon')) {
		$('.page').css('left', '0');
		$('.left-sidebar').css('left', '0');
	    }
	    $('.fixed-block').removeClass('adaptive').addClass('regular');
	}
    }

    //Fixed-block position
    $('.fixed-block.regular').css({marginRight: -$('.wrapper').width() / 2 + 96});
    $('.fixed-block.adaptive').css({marginRight: -$('.wrapper').width() / 2 + 26});

    //Right-sidebar-links position
    $('.right-sidebar-links').css({marginRight: -$('.wrapper').width() / 2});
    sliderNeedReinit = true;


});




/*! jquery.mousewheel.js
 /*! Copyright (c) 2013 Brandon Aaron (http://brandon.aaron.sh)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 3.1.11
 *
 * Requires: jQuery 1.2.2+
 */
!function (a) {
    "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof exports ? module.exports = a : a(jQuery)
}(function (a) {
    function b(b) {
	var g = b || window.event, h = i.call(arguments, 1), j = 0, l = 0, m = 0, n = 0, o = 0, p = 0;
	if (b = a.event.fix(g), b.type = "mousewheel", "detail"in g && (m = -1 * g.detail), "wheelDelta"in g && (m = g.wheelDelta), "wheelDeltaY"in g && (m = g.wheelDeltaY), "wheelDeltaX"in g && (l = -1 * g.wheelDeltaX), "axis"in g && g.axis === g.HORIZONTAL_AXIS && (l = -1 * m, m = 0), j = 0 === m ? l : m, "deltaY"in g && (m = -1 * g.deltaY, j = m), "deltaX"in g && (l = g.deltaX, 0 === m && (j = -1 * l)), 0 !== m || 0 !== l) {
	    if (1 === g.deltaMode) {
		var q = a.data(this, "mousewheel-line-height");
		j *= q, m *= q, l *= q
	    } else if (2 === g.deltaMode) {
		var r = a.data(this, "mousewheel-page-height");
		j *= r, m *= r, l *= r
	    }
	    if (n = Math.max(Math.abs(m), Math.abs(l)), (!f || f > n) && (f = n, d(g, n) && (f /= 40)), d(g, n) && (j /= 40, l /= 40, m /= 40), j = Math[j >= 1 ? "floor" : "ceil"](j / f), l = Math[l >= 1 ? "floor" : "ceil"](l / f), m = Math[m >= 1 ? "floor" : "ceil"](m / f), k.settings.normalizeOffset && this.getBoundingClientRect) {
		var s = this.getBoundingClientRect();
		o = b.clientX - s.left, p = b.clientY - s.top
	    }
	    return b.deltaX = l, b.deltaY = m, b.deltaFactor = f, b.offsetX = o, b.offsetY = p, b.deltaMode = 0, h.unshift(b, j, l, m), e && clearTimeout(e), e = setTimeout(c, 200), (a.event.dispatch || a.event.handle).apply(this, h)
	}
    }
    function c() {
	f = null
    }
    function d(a, b) {
	return k.settings.adjustOldDeltas && "mousewheel" === a.type && b % 120 === 0
    }
    var e, f, g = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"], h = "onwheel"in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"], i = Array.prototype.slice;
    if (a.event.fixHooks)
	for (var j = g.length; j; )
	    a.event.fixHooks[g[--j]] = a.event.mouseHooks;
    var k = a.event.special.mousewheel = {version: "3.1.11", setup: function () {
	    if (this.addEventListener)
		for (var c = h.length; c; )
		    this.addEventListener(h[--c], b, !1);
	    else
		this.onmousewheel = b;
	    a.data(this, "mousewheel-line-height", k.getLineHeight(this)), a.data(this, "mousewheel-page-height", k.getPageHeight(this))
	}, teardown: function () {
	    if (this.removeEventListener)
		for (var c = h.length; c; )
		    this.removeEventListener(h[--c], b, !1);
	    else
		this.onmousewheel = null;
	    a.removeData(this, "mousewheel-line-height"), a.removeData(this, "mousewheel-page-height")
	}, getLineHeight: function (b) {
	    var c = a(b)["offsetParent"in a.fn ? "offsetParent" : "parent"]();
	    return c.length || (c = a("body")), parseInt(c.css("fontSize"), 10)
	}, getPageHeight: function (b) {
	    return a(b).height()
	}, settings: {adjustOldDeltas: !0, normalizeOffset: !0}};
    a.fn.extend({mousewheel: function (a) {
	    return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
	}, unmousewheel: function (a) {
	    return this.unbind("mousewheel", a)
	}})
});



/*!
 * jScrollPane - v2.0.19 - 2013-11-16
 * http://jscrollpane.kelvinluck.com/
 *
 * Copyright (c) 2013 Kelvin Luck
 * Dual licensed under the MIT or GPL licenses.
 */
!function (a, b, c) {
    a.fn.jScrollPane = function (d) {
	function e(d, e) {
	    function f(b) {
		var e, h, j, l, m, n, q = !1, r = !1;
		if (P = b, Q === c)
		    m = d.scrollTop(), n = d.scrollLeft(), d.css({overflow: "hidden", padding: 0}), R = d.innerWidth() + tb, S = d.innerHeight(), d.width(R), Q = a('<div class="jspPane" />').css("padding", sb).append(d.children()), T = a('<div class="jspContainer" />').css({width: R + "px", height: S + "px"}).append(Q).appendTo(d);
		else {
		    if (d.css("width", ""), q = P.stickToBottom && C(), r = P.stickToRight && D(), l = d.innerWidth() + tb != R || d.outerHeight() != S, l && (R = d.innerWidth() + tb, S = d.innerHeight(), T.css({width: R + "px", height: S + "px"})), !l && ub == U && Q.outerHeight() == V)
			return d.width(R), void 0;
		    ub = U, Q.css("width", ""), d.width(R), T.find(">.jspVerticalBar,>.jspHorizontalBar").remove().end()
		}
		Q.css("overflow", "auto"), U = b.contentWidth ? b.contentWidth : Q[0].scrollWidth, V = Q[0].scrollHeight, Q.css("overflow", ""), W = U / R, X = V / S, Y = X > 1, Z = W > 1, Z || Y ? (d.addClass("jspScrollable"), e = P.maintainPosition && (ab || db), e && (h = A(), j = B()), g(), i(), k(), e && (y(r ? U - R : h, !1), x(q ? V - S : j, !1)), H(), E(), N(), P.enableKeyboardNavigation && J(), P.clickOnTrack && o(), L(), P.hijackInternalLinks && M()) : (d.removeClass("jspScrollable"), Q.css({top: 0, left: 0, width: T.width() - tb}), F(), I(), K(), p()), P.autoReinitialise && !rb ? rb = setInterval(function () {
		    f(P)
		}, P.autoReinitialiseDelay) : !P.autoReinitialise && rb && clearInterval(rb), m && d.scrollTop(0) && x(m, !1), n && d.scrollLeft(0) && y(n, !1), d.trigger("jsp-initialised", [Z || Y])
	    }
	    function g() {
		Y && (T.append(a('<div class="jspVerticalBar" />').append(a('<div class="jspCap jspCapTop" />'), a('<div class="jspTrack" />').append(a('<div class="jspDrag" />').append(a('<div class="jspDragTop" />'), a('<div class="jspDragBottom" />'))), a('<div class="jspCap jspCapBottom" />'))), eb = T.find(">.jspVerticalBar"), fb = eb.find(">.jspTrack"), $ = fb.find(">.jspDrag"), P.showArrows && (jb = a('<a class="jspArrow jspArrowUp" />').bind("mousedown.jsp", m(0, -1)).bind("click.jsp", G), kb = a('<a class="jspArrow jspArrowDown" />').bind("mousedown.jsp", m(0, 1)).bind("click.jsp", G), P.arrowScrollOnHover && (jb.bind("mouseover.jsp", m(0, -1, jb)), kb.bind("mouseover.jsp", m(0, 1, kb))), l(fb, P.verticalArrowPositions, jb, kb)), hb = S, T.find(">.jspVerticalBar>.jspCap:visible,>.jspVerticalBar>.jspArrow").each(function () {
		    hb -= a(this).outerHeight()
		}), $.hover(function () {
		    $.addClass("jspHover")
		}, function () {
		    $.removeClass("jspHover")
		}).bind("mousedown.jsp", function (b) {
		    a("html").bind("dragstart.jsp selectstart.jsp", G), $.addClass("jspActive");
		    var c = b.pageY - $.position().top;
		    return a("html").bind("mousemove.jsp", function (a) {
			r(a.pageY - c, !1)
		    }).bind("mouseup.jsp mouseleave.jsp", q), !1
		}), h())
	    }
	    function h() {
		fb.height(hb + "px"), ab = 0, gb = P.verticalGutter + fb.outerWidth(), Q.width(R - gb - tb);
		try {
		    0 === eb.position().left && Q.css("margin-left", gb + "px")
		} catch (a) {
		}
	    }
	    function i() {
		Z && (T.append(a('<div class="jspHorizontalBar" />').append(a('<div class="jspCap jspCapLeft" />'), a('<div class="jspTrack" />').append(a('<div class="jspDrag" />').append(a('<div class="jspDragLeft" />'), a('<div class="jspDragRight" />'))), a('<div class="jspCap jspCapRight" />'))), lb = T.find(">.jspHorizontalBar"), mb = lb.find(">.jspTrack"), bb = mb.find(">.jspDrag"), P.showArrows && (pb = a('<a class="jspArrow jspArrowLeft" />').bind("mousedown.jsp", m(-1, 0)).bind("click.jsp", G), qb = a('<a class="jspArrow jspArrowRight" />').bind("mousedown.jsp", m(1, 0)).bind("click.jsp", G), P.arrowScrollOnHover && (pb.bind("mouseover.jsp", m(-1, 0, pb)), qb.bind("mouseover.jsp", m(1, 0, qb))), l(mb, P.horizontalArrowPositions, pb, qb)), bb.hover(function () {
		    bb.addClass("jspHover")
		}, function () {
		    bb.removeClass("jspHover")
		}).bind("mousedown.jsp", function (b) {
		    a("html").bind("dragstart.jsp selectstart.jsp", G), bb.addClass("jspActive");
		    var c = b.pageX - bb.position().left;
		    return a("html").bind("mousemove.jsp", function (a) {
			t(a.pageX - c, !1)
		    }).bind("mouseup.jsp mouseleave.jsp", q), !1
		}), nb = T.innerWidth(), j())
	    }
	    function j() {
		T.find(">.jspHorizontalBar>.jspCap:visible,>.jspHorizontalBar>.jspArrow").each(function () {
		    nb -= a(this).outerWidth()
		}), mb.width(nb + "px"), db = 0
	    }
	    function k() {
		if (Z && Y) {
		    var b = mb.outerHeight(), c = fb.outerWidth();
		    hb -= b, a(lb).find(">.jspCap:visible,>.jspArrow").each(function () {
			nb += a(this).outerWidth()
		    }), nb -= c, S -= c, R -= b, mb.parent().append(a('<div class="jspCorner" />').css("width", b + "px")), h(), j()
		}
		Z && Q.width(T.outerWidth() - tb + "px"), V = Q.outerHeight(), X = V / S, Z && (ob = Math.ceil(1 / W * nb), ob > P.horizontalDragMaxWidth ? ob = P.horizontalDragMaxWidth : ob < P.horizontalDragMinWidth && (ob = P.horizontalDragMinWidth), bb.width(ob + "px"), cb = nb - ob, u(db)), Y && (ib = Math.ceil(1 / X * hb), ib > P.verticalDragMaxHeight ? ib = P.verticalDragMaxHeight : ib < P.verticalDragMinHeight && (ib = P.verticalDragMinHeight), $.height(ib + "px"), _ = hb - ib, s(ab))
	    }
	    function l(a, b, c, d) {
		var e, f = "before", g = "after";
		"os" == b && (b = /Mac/.test(navigator.platform) ? "after" : "split"), b == f ? g = b : b == g && (f = b, e = c, c = d, d = e), a[f](c)[g](d)
	    }
	    function m(a, b, c) {
		return function () {
		    return n(a, b, this, c), this.blur(), !1
		}
	    }
	    function n(b, c, d, e) {
		d = a(d).addClass("jspActive");
		var f, g, h = !0, i = function () {
		    0 !== b && vb.scrollByX(b * P.arrowButtonSpeed), 0 !== c && vb.scrollByY(c * P.arrowButtonSpeed), g = setTimeout(i, h ? P.initialDelay : P.arrowRepeatFreq), h = !1
		};
		i(), f = e ? "mouseout.jsp" : "mouseup.jsp", e = e || a("html"), e.bind(f, function () {
		    d.removeClass("jspActive"), g && clearTimeout(g), g = null, e.unbind(f)
		})
	    }
	    function o() {
		p(), Y && fb.bind("mousedown.jsp", function (b) {
		    if (b.originalTarget === c || b.originalTarget == b.currentTarget) {
			var d, e = a(this), f = e.offset(), g = b.pageY - f.top - ab, h = !0, i = function () {
			    var a = e.offset(), c = b.pageY - a.top - ib / 2, f = S * P.scrollPagePercent, k = _ * f / (V - S);
			    if (0 > g)
				ab - k > c ? vb.scrollByY(-f) : r(c);
			    else {
				if (!(g > 0))
				    return j(), void 0;
				c > ab + k ? vb.scrollByY(f) : r(c)
			    }
			    d = setTimeout(i, h ? P.initialDelay : P.trackClickRepeatFreq), h = !1
			}, j = function () {
			    d && clearTimeout(d), d = null, a(document).unbind("mouseup.jsp", j)
			};
			return i(), a(document).bind("mouseup.jsp", j), !1
		    }
		}), Z && mb.bind("mousedown.jsp", function (b) {
		    if (b.originalTarget === c || b.originalTarget == b.currentTarget) {
			var d, e = a(this), f = e.offset(), g = b.pageX - f.left - db, h = !0, i = function () {
			    var a = e.offset(), c = b.pageX - a.left - ob / 2, f = R * P.scrollPagePercent, k = cb * f / (U - R);
			    if (0 > g)
				db - k > c ? vb.scrollByX(-f) : t(c);
			    else {
				if (!(g > 0))
				    return j(), void 0;
				c > db + k ? vb.scrollByX(f) : t(c)
			    }
			    d = setTimeout(i, h ? P.initialDelay : P.trackClickRepeatFreq), h = !1
			}, j = function () {
			    d && clearTimeout(d), d = null, a(document).unbind("mouseup.jsp", j)
			};
			return i(), a(document).bind("mouseup.jsp", j), !1
		    }
		})
	    }
	    function p() {
		mb && mb.unbind("mousedown.jsp"), fb && fb.unbind("mousedown.jsp")
	    }
	    function q() {
		a("html").unbind("dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp"), $ && $.removeClass("jspActive"), bb && bb.removeClass("jspActive")
	    }
	    function r(a, b) {
		Y && (0 > a ? a = 0 : a > _ && (a = _), b === c && (b = P.animateScroll), b ? vb.animate($, "top", a, s) : ($.css("top", a), s(a)))
	    }
	    function s(a) {
		a === c && (a = $.position().top), T.scrollTop(0), ab = a;
		var b = 0 === ab, e = ab == _, f = a / _, g = -f * (V - S);
		(wb != b || yb != e) && (wb = b, yb = e, d.trigger("jsp-arrow-change", [wb, yb, xb, zb])), v(b, e), Q.css("top", g), d.trigger("jsp-scroll-y", [-g, b, e]).trigger("scroll")
	    }
	    function t(a, b) {
		Z && (0 > a ? a = 0 : a > cb && (a = cb), b === c && (b = P.animateScroll), b ? vb.animate(bb, "left", a, u) : (bb.css("left", a), u(a)))
	    }
	    function u(a) {
		a === c && (a = bb.position().left), T.scrollTop(0), db = a;
		var b = 0 === db, e = db == cb, f = a / cb, g = -f * (U - R);
		(xb != b || zb != e) && (xb = b, zb = e, d.trigger("jsp-arrow-change", [wb, yb, xb, zb])), w(b, e), Q.css("left", g), d.trigger("jsp-scroll-x", [-g, b, e]).trigger("scroll")
	    }
	    function v(a, b) {
		P.showArrows && (jb[a ? "addClass" : "removeClass"]("jspDisabled"), kb[b ? "addClass" : "removeClass"]("jspDisabled"))
	    }
	    function w(a, b) {
		P.showArrows && (pb[a ? "addClass" : "removeClass"]("jspDisabled"), qb[b ? "addClass" : "removeClass"]("jspDisabled"))
	    }
	    function x(a, b) {
		var c = a / (V - S);
		r(c * _, b)
	    }
	    function y(a, b) {
		var c = a / (U - R);
		t(c * cb, b)
	    }
	    function z(b, c, d) {
		var e, f, g, h, i, j, k, l, m, n = 0, o = 0;
		try {
		    e = a(b)
		} catch (p) {
		    return
		}
		for (f = e.outerHeight(), g = e.outerWidth(), T.scrollTop(0), T.scrollLeft(0); !e.is(".jspPane"); )
		    if (n += e.position().top, o += e.position().left, e = e.offsetParent(), /^body|html$/i.test(e[0].nodeName))
			return;
		h = B(), j = h + S, h > n || c ? l = n - P.horizontalGutter : n + f > j && (l = n - S + f + P.horizontalGutter), isNaN(l) || x(l, d), i = A(), k = i + R, i > o || c ? m = o - P.horizontalGutter : o + g > k && (m = o - R + g + P.horizontalGutter), isNaN(m) || y(m, d)
	    }
	    function A() {
		return-Q.position().left
	    }
	    function B() {
		return-Q.position().top
	    }
	    function C() {
		var a = V - S;
		return a > 20 && a - B() < 10
	    }
	    function D() {
		var a = U - R;
		return a > 20 && a - A() < 10
	    }
	    function E() {
		T.unbind(Bb).bind(Bb, function (a, b, c, d) {
		    var e = db, f = ab, g = a.deltaFactor || P.mouseWheelSpeed;
		    return vb.scrollBy(c * g, -d * g, !1), e == db && f == ab
		})
	    }
	    function F() {
		T.unbind(Bb)
	    }
	    function G() {
		return!1
	    }
	    function H() {
		Q.find(":input,a").unbind("focus.jsp").bind("focus.jsp", function (a) {
		    z(a.target, !1)
		})
	    }
	    function I() {
		Q.find(":input,a").unbind("focus.jsp")
	    }
	    function J() {
		function b() {
		    var a = db, b = ab;
		    switch (c) {
			case 40:
			    vb.scrollByY(P.keyboardSpeed, !1);
			    break;
			case 38:
			    vb.scrollByY(-P.keyboardSpeed, !1);
			    break;
			case 34:
			case 32:
			    vb.scrollByY(S * P.scrollPagePercent, !1);
			    break;
			case 33:
			    vb.scrollByY(-S * P.scrollPagePercent, !1);
			    break;
			case 39:
			    vb.scrollByX(P.keyboardSpeed, !1);
			    break;
			case 37:
			    vb.scrollByX(-P.keyboardSpeed, !1)
		    }
		    return e = a != db || b != ab
		}
		var c, e, f = [];
		Z && f.push(lb[0]), Y && f.push(eb[0]), Q.focus(function () {
		    d.focus()
		}), d.attr("tabindex", 0).unbind("keydown.jsp keypress.jsp").bind("keydown.jsp", function (d) {
		    if (d.target === this || f.length && a(d.target).closest(f).length) {
			var g = db, h = ab;
			switch (d.keyCode) {
			    case 40:
			    case 38:
			    case 34:
			    case 32:
			    case 33:
			    case 39:
			    case 37:
				c = d.keyCode, b();
				break;
			    case 35:
				x(V - S), c = null;
				break;
			    case 36:
				x(0), c = null
			}
			return e = d.keyCode == c && g != db || h != ab, !e
		    }
		}).bind("keypress.jsp", function (a) {
		    return a.keyCode == c && b(), !e
		}), P.hideFocus ? (d.css("outline", "none"), "hideFocus"in T[0] && d.attr("hideFocus", !0)) : (d.css("outline", ""), "hideFocus"in T[0] && d.attr("hideFocus", !1))
	    }
	    function K() {
		d.attr("tabindex", "-1").removeAttr("tabindex").unbind("keydown.jsp keypress.jsp")
	    }
	    function L() {
		if (location.hash && location.hash.length > 1) {
		    var b, c, d = escape(location.hash.substr(1));
		    try {
			b = a("#" + d + ', a[name="' + d + '"]')
		    } catch (e) {
			return
		    }
		    b.length && Q.find(d) && (0 === T.scrollTop() ? c = setInterval(function () {
			T.scrollTop() > 0 && (z(b, !0), a(document).scrollTop(T.position().top), clearInterval(c))
		    }, 50) : (z(b, !0), a(document).scrollTop(T.position().top)))
		}
	    }
	    function M() {
		a(document.body).data("jspHijack") || (a(document.body).data("jspHijack", !0), a(document.body).delegate("a[href*=#]", "click", function (c) {
		    var d, e, f, g, h, i, j = this.href.substr(0, this.href.indexOf("#")), k = location.href;
		    if (-1 !== location.href.indexOf("#") && (k = location.href.substr(0, location.href.indexOf("#"))), j === k) {
			d = escape(this.href.substr(this.href.indexOf("#") + 1));
			try {
			    e = a("#" + d + ', a[name="' + d + '"]')
			} catch (l) {
			    return
			}
			e.length && (f = e.closest(".jspScrollable"), g = f.data("jsp"), g.scrollToElement(e, !0), f[0].scrollIntoView && (h = a(b).scrollTop(), i = e.offset().top, (h > i || i > h + a(b).height()) && f[0].scrollIntoView()), c.preventDefault())
		    }
		}))
	    }
	    function N() {
		var a, b, c, d, e, f = !1;
		T.unbind("touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick").bind("touchstart.jsp", function (g) {
		    var h = g.originalEvent.touches[0];
		    a = A(), b = B(), c = h.pageX, d = h.pageY, e = !1, f = !0
		}).bind("touchmove.jsp", function (g) {
		    if (f) {
			var h = g.originalEvent.touches[0], i = db, j = ab;
			return vb.scrollTo(a + c - h.pageX, b + d - h.pageY), e = e || Math.abs(c - h.pageX) > 5 || Math.abs(d - h.pageY) > 5, i == db && j == ab
		    }
		}).bind("touchend.jsp", function () {
		    f = !1
		}).bind("click.jsp-touchclick", function () {
		    return e ? (e = !1, !1) : void 0
		})
	    }
	    function O() {
		var a = B(), b = A();
		d.removeClass("jspScrollable").unbind(".jsp"), d.replaceWith(Ab.append(Q.children())), Ab.scrollTop(a), Ab.scrollLeft(b), rb && clearInterval(rb)
	    }
	    var P, Q, R, S, T, U, V, W, X, Y, Z, $, _, ab, bb, cb, db, eb, fb, gb, hb, ib, jb, kb, lb, mb, nb, ob, pb, qb, rb, sb, tb, ub, vb = this, wb = !0, xb = !0, yb = !1, zb = !1, Ab = d.clone(!1, !1).empty(), Bb = a.fn.mwheelIntent ? "mwheelIntent.jsp" : "mousewheel.jsp";
	    "border-box" === d.css("box-sizing") ? (sb = 0, tb = 0) : (sb = d.css("paddingTop") + " " + d.css("paddingRight") + " " + d.css("paddingBottom") + " " + d.css("paddingLeft"), tb = (parseInt(d.css("paddingLeft"), 10) || 0) + (parseInt(d.css("paddingRight"), 10) || 0)), a.extend(vb, {reinitialise: function (b) {
		    b = a.extend({}, P, b), f(b)
		}, scrollToElement: function (a, b, c) {
		    z(a, b, c)
		}, scrollTo: function (a, b, c) {
		    y(a, c), x(b, c)
		}, scrollToX: function (a, b) {
		    y(a, b)
		}, scrollToY: function (a, b) {
		    x(a, b)
		}, scrollToPercentX: function (a, b) {
		    y(a * (U - R), b)
		}, scrollToPercentY: function (a, b) {
		    x(a * (V - S), b)
		}, scrollBy: function (a, b, c) {
		    vb.scrollByX(a, c), vb.scrollByY(b, c)
		}, scrollByX: function (a, b) {
		    var c = A() + Math[0 > a ? "floor" : "ceil"](a), d = c / (U - R);
		    t(d * cb, b)
		}, scrollByY: function (a, b) {
		    var c = B() + Math[0 > a ? "floor" : "ceil"](a), d = c / (V - S);
		    r(d * _, b)
		}, positionDragX: function (a, b) {
		    t(a, b)
		}, positionDragY: function (a, b) {
		    r(a, b)
		}, animate: function (a, b, c, d) {
		    var e = {};
		    e[b] = c, a.animate(e, {duration: P.animateDuration, easing: P.animateEase, queue: !1, step: d})
		}, getContentPositionX: function () {
		    return A()
		}, getContentPositionY: function () {
		    return B()
		}, getContentWidth: function () {
		    return U
		}, getContentHeight: function () {
		    return V
		}, getPercentScrolledX: function () {
		    return A() / (U - R)
		}, getPercentScrolledY: function () {
		    return B() / (V - S)
		}, getIsScrollableH: function () {
		    return Z
		}, getIsScrollableV: function () {
		    return Y
		}, getContentPane: function () {
		    return Q
		}, scrollToBottom: function (a) {
		    r(_, a)
		}, hijackInternalLinks: a.noop, destroy: function () {
		    O()
		}}), f(e)
	}
	return d = a.extend({}, a.fn.jScrollPane.defaults, d), a.each(["arrowButtonSpeed", "trackClickSpeed", "keyboardSpeed"], function () {
	    d[this] = d[this] || d.speed
	}), this.each(function () {
	    var b = a(this), c = b.data("jsp");
	    c ? c.reinitialise(d) : (a("script", b).filter('[type="text/javascript"],:not([type])').remove(), c = new e(b, d), b.data("jsp", c))
	})
    }, a.fn.jScrollPane.defaults = {showArrows: !1, maintainPosition: !0, stickToBottom: !1, stickToRight: !1, clickOnTrack: !0, autoReinitialise: !1, autoReinitialiseDelay: 500, verticalDragMinHeight: 0, verticalDragMaxHeight: 99999, horizontalDragMinWidth: 0, horizontalDragMaxWidth: 99999, contentWidth: c, animateScroll: !1, animateDuration: 300, animateEase: "linear", hijackInternalLinks: !1, verticalGutter: 4, horizontalGutter: 4, mouseWheelSpeed: 3, arrowButtonSpeed: 0, arrowRepeatFreq: 50, arrowScrollOnHover: !1, trackClickSpeed: 0, trackClickRepeatFreq: 70, verticalArrowPositions: "split", horizontalArrowPositions: "split", enableKeyboardNavigation: !0, hideFocus: !1, keyboardSpeed: 0, initialDelay: 300, speed: 30, scrollPagePercent: .8}
}(jQuery, this);


/*!
 _ _      _       _
 ___| (_) ___| | __  (_)___
 / __| | |/ __| |/ /  | / __|
 \__ \ | | (__|   < _ | \__ \
 |___/_|_|\___|_|\_(_)/ |___/
 |__/
 
 Author: Ken Wheeler
 Website: http://kenwheeler.github.io
 Docs: http://kenwheeler.github.io/slick
 Repo: http://github.com/kenwheeler/slick
 Issues: http://github.com/kenwheeler/slick/issues
 
 */
!function (a) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
}(function (a) {
    "use strict";
    var b = window.Slick || {};
    b = function () {
	function c(c, d) {
	    var f, g, e = this;
	    if (e.defaults = {accessibility: !0, arrows: !0, autoplay: !1, autoplaySpeed: 3e3, centerMode: !1, centerPadding: "50px", cssEase: "ease", customPaging: function (a, b) {
		    return'<button type="button">' + (b + 1) + "</button>"
		}, dots: !1, draggable: !0, easing: "linear", fade: !1, infinite: !0, lazyLoad: "ondemand", onBeforeChange: null, onAfterChange: null, onInit: null, onReInit: null, pauseOnHover: !0, responsive: null, slide: "div", slidesToShow: 1, slidesToScroll: 1, speed: 300, swipe: !0, touchMove: !0, touchThreshold: 5, useCSS: !0, vertical: !1}, e.initials = {animating: !1, autoPlayTimer: null, currentSlide: 0, currentLeft: null, direction: 1, $dots: null, listWidth: null, listHeight: null, loadIndex: 0, $nextArrow: null, $prevArrow: null, slideCount: null, slideWidth: null, $slideTrack: null, $slides: null, sliding: !1, slideOffset: 0, swipeLeft: null, $list: null, touchObject: {}, transformsEnabled: !1}, a.extend(e, e.initials), e.activeBreakpoint = null, e.animType = null, e.animProp = null, e.breakpoints = [], e.breakpointSettings = [], e.cssTransitions = !1, e.paused = !1, e.positionProp = null, e.$slider = a(c), e.$slidesCache = null, e.transformType = null, e.transitionType = null, e.windowWidth = 0, e.windowTimer = null, e.options = a.extend({}, e.defaults, d), e.originalSettings = e.options, f = e.options.responsive || null, f && f.length > -1) {
		for (g in f)
		    f.hasOwnProperty(g) && (e.breakpoints.push(f[g].breakpoint), e.breakpointSettings[f[g].breakpoint] = f[g].settings);
		e.breakpoints.sort(function (a, b) {
		    return b - a
		})
	    }
	    e.autoPlay = a.proxy(e.autoPlay, e), e.autoPlayClear = a.proxy(e.autoPlayClear, e), e.changeSlide = a.proxy(e.changeSlide, e), e.setPosition = a.proxy(e.setPosition, e), e.swipeHandler = a.proxy(e.swipeHandler, e), e.dragHandler = a.proxy(e.dragHandler, e), e.keyHandler = a.proxy(e.keyHandler, e), e.autoPlayIterator = a.proxy(e.autoPlayIterator, e), e.instanceUid = b++, e.init()
	}
	var b = 0;
	return c
    }(), b.prototype.addSlide = function (b, c, d) {
	var e = this;
	if ("boolean" == typeof c)
	    d = c, c = null;
	else if (0 > c || c >= e.slideCount)
	    return!1;
	e.unload(), "number" == typeof c ? 0 === c && 0 === e.$slides.length ? a(b).appendTo(e.$slideTrack) : d ? a(b).insertBefore(e.$slides.eq(c)) : a(b).insertAfter(e.$slides.eq(c)) : d === !0 ? a(b).prependTo(e.$slideTrack) : a(b).appendTo(e.$slideTrack), e.$slides = e.$slideTrack.children(this.options.slide), e.$slideTrack.children(this.options.slide).remove(), e.$slideTrack.append(e.$slides), e.$slidesCache = e.$slides, e.reinit()
    }, b.prototype.animateSlide = function (b, c) {
	var d = {}, e = this;
	e.transformsEnabled === !1 ? e.options.vertical === !1 ? e.$slideTrack.animate({left: b}, e.options.speed, e.options.easing, c) : e.$slideTrack.animate({top: b}, e.options.speed, e.options.easing, c) : e.cssTransitions === !1 ? a({animStart: e.currentLeft}).animate({animStart: b}, {duration: e.options.speed, easing: e.options.easing, step: function (a) {
		e.options.vertical === !1 ? (d[e.animType] = "translate(" + a + "px, 0px)", e.$slideTrack.css(d)) : (d[e.animType] = "translate(0px," + a + "px)", e.$slideTrack.css(d))
	    }, complete: function () {
		c && c.call()
	    }}) : (e.applyTransition(), d[e.animType] = e.options.vertical === !1 ? "translate3d(" + b + "px, 0px, 0px)" : "translate3d(0px," + b + "px, 0px)", e.$slideTrack.css(d), c && setTimeout(function () {
	    e.disableTransition(), c.call()
	}, e.options.speed))
    }, b.prototype.applyTransition = function (a) {
	var b = this, c = {};
	c[b.transitionType] = b.options.fade === !1 ? b.transformType + " " + b.options.speed + "ms " + b.options.cssEase : "opacity " + b.options.speed + "ms " + b.options.cssEase, b.options.fade === !1 ? b.$slideTrack.css(c) : b.$slides.eq(a).css(c)
    }, b.prototype.autoPlay = function () {
	var a = this;
	a.autoPlayTimer && clearInterval(a.autoPlayTimer), a.slideCount > a.options.slidesToShow && a.paused !== !0 && (a.autoPlayTimer = setInterval(a.autoPlayIterator, a.options.autoplaySpeed))
    }, b.prototype.autoPlayClear = function () {
	var a = this;
	a.autoPlayTimer && clearInterval(a.autoPlayTimer)
    }, b.prototype.autoPlayIterator = function () {
	var a = this;
	a.options.infinite === !1 ? 1 === a.direction ? (a.currentSlide + 1 === a.slideCount - 1 && (a.direction = 0), a.slideHandler(a.currentSlide + a.options.slidesToScroll)) : (0 === a.currentSlide - 1 && (a.direction = 1), a.slideHandler(a.currentSlide - a.options.slidesToScroll)) : a.slideHandler(a.currentSlide + a.options.slidesToScroll)
    }, b.prototype.buildArrows = function () {
	var b = this;
	b.options.arrows === !0 && b.slideCount > b.options.slidesToShow && (b.$prevArrow = a('<button type="button" class="slick-prev">Previous</button>').appendTo(b.$slider), b.$nextArrow = a('<button type="button" class="slick-next">Next</button>').appendTo(b.$slider), b.options.infinite !== !0 && b.$prevArrow.addClass("slick-disabled"))
    }, b.prototype.buildDots = function () {
	var c, d, b = this;
	if (b.options.dots === !0 && b.slideCount > b.options.slidesToShow) {
	    for (d = '<ul class="slick-dots">', c = 0; c <= b.getDotCount(); c += 1)
		d += "<li>" + b.options.customPaging.call(this, b, c) + "</li>";
	    d += "</ul>", b.$dots = a(d).appendTo(b.$slider), b.$dots.find("li").first().addClass("slick-active")
	}
    }, b.prototype.buildOut = function () {
	var b = this;
	b.$slides = b.$slider.children(b.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), b.slideCount = b.$slides.length, b.$slidesCache = b.$slides, b.$slider.addClass("slick-slider"), b.$slideTrack = 0 === b.slideCount ? a('<div class="slick-track"/>').appendTo(b.$slider) : b.$slides.wrapAll('<div class="slick-track"/>').parent(), b.$list = b.$slideTrack.wrap('<div class="slick-list"/>').parent(), b.$slideTrack.css("opacity", 0), b.options.centerMode === !0 && (b.options.infinite = !0, b.options.slidesToScroll = 1, 0 === b.options.slidesToShow % 2 && (b.options.slidesToShow = 3)), a("img[data-lazy]", b.$slider).not("[src]").addClass("slick-loading"), b.setupInfinite(), b.buildArrows(), b.buildDots(), b.options.accessibility === !0 && b.$list.prop("tabIndex", 0), b.setSlideClasses(0), b.options.draggable === !0 && b.$list.addClass("draggable")
    }, b.prototype.checkResponsive = function () {
	var c, d, b = this;
	if (b.originalSettings.responsive && b.originalSettings.responsive.length > -1 && null !== b.originalSettings.responsive) {
	    d = null;
	    for (c in b.breakpoints)
		b.breakpoints.hasOwnProperty(c) && a(window).width() < b.breakpoints[c] && (d = b.breakpoints[c]);
	    null !== d ? null !== b.activeBreakpoint ? d !== b.activeBreakpoint && (b.activeBreakpoint = d, b.options = a.extend({}, b.defaults, b.breakpointSettings[d]), b.refresh()) : (b.activeBreakpoint = d, b.options = a.extend({}, b.defaults, b.breakpointSettings[d]), b.refresh()) : null !== b.activeBreakpoint && (b.activeBreakpoint = null, b.options = a.extend({}, b.defaults, b.originalSettings), b.refresh())
	}
    }, b.prototype.changeSlide = function (b) {
	var c = this;
	switch (b.data.message) {
	    case"previous":
		c.slideHandler(c.currentSlide - c.options.slidesToScroll);
		break;
	    case"next":
		c.slideHandler(c.currentSlide + c.options.slidesToScroll);
		break;
	    case"index":
		c.slideHandler(a(b.target).parent().index() * c.options.slidesToScroll);
		break;
	    default:
		return!1
	    }
    }, b.prototype.destroy = function () {
	var b = this;
	b.autoPlayClear(), b.touchObject = {}, a(".slick-cloned", b.$slider).remove(), b.$dots && b.$dots.remove(), b.$prevArrow && (b.$prevArrow.remove(), b.$nextArrow.remove()), b.$slides.unwrap().unwrap(), b.$slides.removeClass("slick-slide slick-active slick-visible").removeAttr("style"), b.$slider.removeClass("slick-slider"), b.$slider.removeClass("slick-initialized"), b.$list.off(".slick"), a(window).off(".slick-" + b.instanceUid)
    }, b.prototype.disableTransition = function (a) {
	var b = this, c = {};
	c[b.transitionType] = "", b.options.fade === !1 ? b.$slideTrack.css(c) : b.$slides.eq(a).css(c)
    }, b.prototype.fadeSlide = function (a, b) {
	var c = this;
	c.cssTransitions === !1 ? (c.$slides.eq(a).css({zIndex: 1e3}), c.$slides.eq(a).animate({opacity: 1}, c.options.speed, c.options.easing, b)) : (c.applyTransition(a), c.$slides.eq(a).css({opacity: 1, zIndex: 1e3}), b && setTimeout(function () {
	    c.disableTransition(a), b.call()
	}, c.options.speed))
    }, b.prototype.filterSlides = function (a) {
	var b = this;
	null !== a && (b.unload(), b.$slideTrack.children(this.options.slide).remove(), b.$slidesCache.filter(a).appendTo(b.$slideTrack), b.reinit())
    }, b.prototype.getCurrent = function () {
	var a = this;
	return a.currentSlide
    }, b.prototype.getDotCount = function () {
	var e, a = this, b = 0, c = 0, d = 0;
	for (e = a.options.infinite === !0?a.slideCount + a.options.slidesToShow - a.options.slidesToScroll:a.slideCount; e > b; )
	    d++, c += a.options.slidesToScroll, b = c + a.options.slidesToShow;
	return d
    }, b.prototype.getLeft = function (a) {
	var c, d, b = this, e = 0;
	return b.slideOffset = 0, d = b.$slides.first().outerHeight(), b.options.infinite === !0 ? (b.slideCount > b.options.slidesToShow && (b.slideOffset = -1 * b.slideWidth * b.options.slidesToShow, e = -1 * d * b.options.slidesToShow), 0 !== b.slideCount % b.options.slidesToScroll && a + b.options.slidesToScroll > b.slideCount && b.slideCount > b.options.slidesToShow && (b.slideOffset = -1 * b.slideCount % b.options.slidesToShow * b.slideWidth, e = -1 * b.slideCount % b.options.slidesToShow * d)) : 0 !== b.slideCount % b.options.slidesToShow && a + b.options.slidesToScroll > b.slideCount && b.slideCount > b.options.slidesToShow && (b.slideOffset = b.options.slidesToShow * b.slideWidth - b.slideCount % b.options.slidesToShow * b.slideWidth, e = b.slideCount % b.options.slidesToShow * d), b.options.centerMode === !0 && (b.slideOffset += b.slideWidth * Math.floor(b.options.slidesToShow / 2) - b.slideWidth), c = b.options.vertical === !1 ? -1 * a * b.slideWidth + b.slideOffset : -1 * a * d + e
    }, b.prototype.init = function () {
	var b = this;
	a(b.$slider).hasClass("slick-initialized") || (a(b.$slider).addClass("slick-initialized"), b.buildOut(), b.setProps(), b.startLoad(), b.loadSlider(), b.initializeEvents(), b.checkResponsive()), null !== b.options.onInit && b.options.onInit.call(this, b)
    }, b.prototype.initArrowEvents = function () {
	var a = this;
	a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.on("click.slick", {message: "previous"}, a.changeSlide), a.$nextArrow.on("click.slick", {message: "next"}, a.changeSlide))
    }, b.prototype.initDotEvents = function () {
	var b = this;
	b.options.dots === !0 && b.slideCount > b.options.slidesToShow && a("li", b.$dots).on("click.slick", {message: "index"}, b.changeSlide)
    }, b.prototype.initializeEvents = function () {
	var b = this;
	b.initArrowEvents(), b.initDotEvents(), b.$list.on("touchstart.slick mousedown.slick", {action: "start"}, b.swipeHandler), b.$list.on("touchmove.slick mousemove.slick", {action: "move"}, b.swipeHandler), b.$list.on("touchend.slick mouseup.slick", {action: "end"}, b.swipeHandler), b.$list.on("touchcancel.slick mouseleave.slick", {action: "end"}, b.swipeHandler), b.options.pauseOnHover === !0 && b.options.autoplay === !0 && (b.$list.on("mouseenter.slick", b.autoPlayClear), b.$list.on("mouseleave.slick", b.autoPlay)), b.options.accessibility === !0 && b.$list.on("keydown.slick", b.keyHandler), a(window).on("orientationchange.slick.slick-" + b.instanceUid, function () {
	    b.checkResponsive(), b.setPosition()
	}), a(window).on("resize.slick.slick-" + b.instanceUid, function () {
	    a(window).width !== b.windowWidth && (clearTimeout(b.windowDelay), b.windowDelay = window.setTimeout(function () {
		b.windowWidth = a(window).width(), b.checkResponsive(), b.setPosition()
	    }, 50))
	}), a(window).on("load.slick.slick-" + b.instanceUid, b.setPosition)
    }, b.prototype.initUI = function () {
	var a = this;
	a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.show(), a.$nextArrow.show()), a.options.dots === !0 && a.slideCount > a.options.slidesToShow && a.$dots.show(), a.options.autoplay === !0 && a.autoPlay()
    }, b.prototype.keyHandler = function (a) {
	var b = this;
	37 === a.keyCode ? b.changeSlide({data: {message: "previous"}}) : 39 === a.keyCode && b.changeSlide({data: {message: "next"}})
    }, b.prototype.lazyLoad = function () {
	var c, d, e, f, b = this;
	b.options.centerMode === !0 ? (e = b.options.slidesToShow + b.currentSlide - 1, f = e + b.options.slidesToShow + 2) : (e = b.options.infinite ? b.options.slidesToShow + b.currentSlide : b.currentSlide, f = e + b.options.slidesToShow), c = b.$slider.find(".slick-slide").slice(e, f), a("img[data-lazy]", c).not("[src]").each(function () {
	    a(this).css({opacity: 0}).attr("src", a(this).attr("data-lazy")).removeClass("slick-loading").load(function () {
		a(this).animate({opacity: 1}, 200)
	    })
	}), b.currentSlide >= b.slideCount - b.options.slidesToShow ? (d = b.$slider.find(".slick-cloned").slice(0, b.options.slidesToShow), a("img[data-lazy]", d).not("[src]").each(function () {
	    a(this).css({opacity: 0}).attr("src", a(this).attr("data-lazy")).removeClass("slick-loading").load(function () {
		a(this).animate({opacity: 1}, 200)
	    })
	})) : 0 === b.currentSlide && (d = b.$slider.find(".slick-cloned").slice(-1 * b.options.slidesToShow), a("img[data-lazy]", d).not("[src]").each(function () {
	    a(this).css({opacity: 0}).attr("src", a(this).attr("data-lazy")).removeClass("slick-loading").load(function () {
		a(this).animate({opacity: 1}, 200)
	    })
	}))
    }, b.prototype.loadSlider = function () {
	var a = this;
	a.setPosition(), a.$slideTrack.css({opacity: 1}), a.$slider.removeClass("slick-loading"), a.initUI(), "progressive" === a.options.lazyLoad && a.progressiveLazyLoad()
    }, b.prototype.postSlide = function (a) {
	var b = this;
	null !== b.options.onAfterChange && b.options.onAfterChange.call(this, b, a), b.animating = !1, b.setPosition(), b.swipeLeft = null, b.options.autoplay === !0 && b.paused === !1 && b.autoPlay()
    }, b.prototype.progressiveLazyLoad = function () {
	var c, d, b = this;
	c = a("img[data-lazy]").not("[src]").length, c > 0 && (d = a(a("img[data-lazy]", b.$slider).not("[src]").get(0)), d.attr("src", d.attr("data-lazy")).removeClass("slick-loading").load(function () {
	    b.progressiveLazyLoad()
	}))
    }, b.prototype.refresh = function () {
	var b = this;
	b.destroy(), a.extend(b, b.initials), b.init()
    }, b.prototype.reinit = function () {
	var a = this;
	a.$slides = a.$slideTrack.children(a.options.slide).addClass("slick-slide"), a.slideCount = a.$slides.length, a.currentSlide >= a.slideCount && 0 !== a.currentSlide && (a.currentSlide = a.currentSlide - a.options.slidesToScroll), a.setProps(), a.setupInfinite(), a.buildArrows(), a.updateArrows(), a.initArrowEvents(), a.buildDots(), a.updateDots(), a.initDotEvents(), a.setSlideClasses(0), a.setPosition(), null !== a.options.onReInit && a.options.onReInit.call(this, a)
    }, b.prototype.removeSlide = function (a, b) {
	var c = this;
	return"boolean" == typeof a ? (b = a, a = b === !0 ? 0 : c.slideCount - 1) : a = b === !0 ? --a : a, c.slideCount < 1 || 0 > a || a > c.slideCount - 1 ? !1 : (c.unload(), c.$slideTrack.children(this.options.slide).eq(a).remove(), c.$slides = c.$slideTrack.children(this.options.slide), c.$slideTrack.children(this.options.slide).remove(), c.$slideTrack.append(c.$slides), c.$slidesCache = c.$slides, c.reinit(), void 0)
    }, b.prototype.setCSS = function (a) {
	var d, e, b = this, c = {};
	d = "left" == b.positionProp ? a + "px" : "0px", e = "top" == b.positionProp ? a + "px" : "0px", c[b.positionProp] = a, b.transformsEnabled === !1 ? b.$slideTrack.css(c) : (c = {}, b.cssTransitions === !1 ? (c[b.animType] = "translate(" + d + ", " + e + ")", b.$slideTrack.css(c)) : (c[b.animType] = "translate3d(" + d + ", " + e + ", 0px)", b.$slideTrack.css(c)))
    }, b.prototype.setDimensions = function () {
	var a = this;
	a.options.centerMode === !0 ? a.$slideTrack.children(".slick-slide").width(a.slideWidth) : a.$slideTrack.children(".slick-slide").width(a.slideWidth), a.options.vertical === !1 ? (a.$slideTrack.width(Math.ceil(a.slideWidth * a.$slideTrack.children(".slick-slide").length)), a.options.centerMode === !0 && a.$list.css({padding: "0px " + a.options.centerPadding})) : (a.$list.height(a.$slides.first().outerHeight() * a.options.slidesToShow), a.$slideTrack.height(Math.ceil(a.$slides.first().outerHeight() * a.$slideTrack.children(".slick-slide").length)), a.options.centerMode === !0 && a.$list.css({padding: a.options.centerPadding + " 0px"}))
    }, b.prototype.setFade = function () {
	var c, b = this;
	b.$slides.each(function (d, e) {
	    c = -1 * b.slideWidth * d, a(e).css({position: "relative", left: c, top: 0, zIndex: 800, opacity: 0})
	}), b.$slides.eq(b.currentSlide).css({zIndex: 900, opacity: 1})
    }, b.prototype.setPosition = function () {
	var a = this;
	a.setValues(), a.setDimensions(), a.options.fade === !1 ? a.setCSS(a.getLeft(a.currentSlide)) : a.setFade()
    }, b.prototype.setProps = function () {
	var a = this;
	a.positionProp = a.options.vertical === !0 ? "top" : "left", "top" === a.positionProp ? a.$slider.addClass("slick-vertical") : a.$slider.removeClass("slick-vertical"), (void 0 !== document.body.style.WebkitTransition || void 0 !== document.body.style.MozTransition || void 0 !== document.body.style.msTransition) && a.options.useCSS === !0 && (a.cssTransitions = !0), void 0 !== document.body.style.MozTransform && (a.animType = "MozTransform", a.transformType = "-moz-transform", a.transitionType = "MozTransition"), void 0 !== document.body.style.webkitTransform && (a.animType = "webkitTransform", a.transformType = "-webkit-transform", a.transitionType = "webkitTransition"), void 0 !== document.body.style.msTransform && (a.animType = "transform", a.transformType = "transform", a.transitionType = "transition"), a.transformsEnabled = null !== a.animType
    }, b.prototype.setValues = function () {
	var a = this;
	a.listWidth = a.$list.width(), a.listHeight = a.$list.height(), a.slideWidth = a.options.vertical === !1 ? Math.ceil(a.listWidth / a.options.slidesToShow) : Math.ceil(a.listWidth)
    }, b.prototype.setSlideClasses = function (a) {
	var c, d, e, b = this;
	b.$slider.find(".slick-slide").removeClass("slick-active").removeClass("slick-center"), d = b.$slider.find(".slick-slide"), b.options.centerMode === !0 ? (c = Math.floor(b.options.slidesToShow / 2), a >= c && a <= b.slideCount - 1 - c ? b.$slides.slice(a - c, a + c + 1).addClass("slick-active") : (e = b.options.slidesToShow + a, d.slice(e - c + 1, e + c + 2).addClass("slick-active")), 0 === a ? d.eq(d.length - 1 - b.options.slidesToShow).addClass("slick-center") : a === b.slideCount - 1 && d.eq(b.options.slidesToShow).addClass("slick-center"), b.$slides.eq(a).addClass("slick-center")) : a > 0 && a < b.slideCount - b.options.slidesToShow ? b.$slides.slice(a, a + b.options.slidesToShow).addClass("slick-active") : (e = b.options.infinite === !0 ? b.options.slidesToShow + a : a, d.slice(e, e + b.options.slidesToShow).addClass("slick-active")), "ondemand" === b.options.lazyLoad && b.lazyLoad()
    }, b.prototype.setupInfinite = function () {
	var c, d, e, b = this;
	if ((b.options.fade === !0 || b.options.vertical === !0) && (b.options.centerMode = !1), b.options.infinite === !0 && b.options.fade === !1 && (d = null, b.slideCount > b.options.slidesToShow)) {
	    for (e = b.options.centerMode === !0?b.options.slidesToShow + 1:b.options.slidesToShow, c = b.slideCount; c > b.slideCount - e; c -= 1)
		d = c - 1, a(b.$slides[d]).clone().attr("id", "").prependTo(b.$slideTrack).addClass("slick-cloned");
	    for (c = 0; e > c; c += 1)
		d = c, a(b.$slides[d]).clone().attr("id", "").appendTo(b.$slideTrack).addClass("slick-cloned");
	    b.$slideTrack.find(".slick-cloned").find("[id]").each(function () {
		a(this).attr("id", "")
	    })
	}
    }, b.prototype.slideHandler = function (a) {
	var b, c, d, e, f = null, g = this;
	return g.animating === !0 ? !1 : (b = a, f = g.getLeft(b), d = g.getLeft(g.currentSlide), e = 0 !== g.slideCount % g.options.slidesToScroll ? g.options.slidesToScroll : 0, g.currentLeft = null === g.swipeLeft ? d : g.swipeLeft, g.options.infinite === !1 && (0 > a || a > g.slideCount - g.options.slidesToShow + e) ? (b = g.currentSlide, g.animateSlide(d, function () {
	    g.postSlide(b)
	}), !1) : (g.options.autoplay === !0 && clearInterval(g.autoPlayTimer), c = 0 > b ? 0 !== g.slideCount % g.options.slidesToScroll ? g.slideCount - g.slideCount % g.options.slidesToScroll : g.slideCount - g.options.slidesToScroll : b > g.slideCount - 1 ? 0 : b, g.animating = !0, null !== g.options.onBeforeChange && a !== g.currentSlide && g.options.onBeforeChange.call(this, g, g.currentSlide, c), g.currentSlide = c, g.setSlideClasses(g.currentSlide), g.updateDots(), g.updateArrows(), g.options.fade === !0 ? (g.fadeSlide(c, function () {
	    g.postSlide(c)
	}), !1) : (g.animateSlide(f, function () {
	    g.postSlide(c)
	}), void 0)))
    }, b.prototype.startLoad = function () {
	var a = this;
	a.options.arrows === !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.hide(), a.$nextArrow.hide()), a.options.dots === !0 && a.slideCount > a.options.slidesToShow && a.$dots.hide(), a.$slider.addClass("slick-loading")
    }, b.prototype.swipeDirection = function () {
	var a, b, c, d, e = this;
	return a = e.touchObject.startX - e.touchObject.curX, b = e.touchObject.startY - e.touchObject.curY, c = Math.atan2(b, a), d = Math.round(180 * c / Math.PI), 0 > d && (d = 360 - Math.abs(d)), 45 >= d && d >= 0 ? "left" : 360 >= d && d >= 315 ? "left" : d >= 135 && 225 >= d ? "right" : "vertical"
    }, b.prototype.swipeEnd = function (b) {
	var c = this;
	if (c.$list.removeClass("dragging"), void 0 === c.touchObject.curX)
	    return!1;
	if (c.touchObject.swipeLength >= c.touchObject.minSwipe)
	    switch (a(b.target).on("click.slick", function (b) {
		    b.stopImmediatePropagation(), b.stopPropagation(), b.preventDefault(), a(b.target).off("click.slick")
		}), c.swipeDirection()){case"left":
		    c.slideHandler(c.currentSlide + c.options.slidesToScroll), c.touchObject = {};
		    break;
		case"right":
		    c.slideHandler(c.currentSlide - c.options.slidesToScroll), c.touchObject = {}
	    }
	else
	    c.touchObject.startX !== c.touchObject.curX && (c.slideHandler(c.currentSlide), c.touchObject = {})
    }, b.prototype.swipeHandler = function (a) {
	var b = this;
	if ("ontouchend"in document && b.options.swipe === !1)
	    return!1;
	if (b.options.draggable === !1 && !a.originalEvent.touches)
	    return!1;
	switch (b.touchObject.fingerCount = a.originalEvent && void 0 !== a.originalEvent.touches ? a.originalEvent.touches.length : 1, b.touchObject.minSwipe = b.listWidth / b.options.touchThreshold, a.data.action) {
	    case"start":
		b.swipeStart(a);
		break;
	    case"move":
		b.swipeMove(a);
		break;
	    case"end":
		b.swipeEnd(a)
	    }
    }, b.prototype.swipeMove = function (a) {
	var c, d, e, f, b = this;
	return f = void 0 !== a.originalEvent ? a.originalEvent.touches : null, c = b.getLeft(b.currentSlide), !b.$list.hasClass("dragging") || f && 1 !== f.length ? !1 : (b.touchObject.curX = void 0 !== f ? f[0].pageX : a.clientX, b.touchObject.curY = void 0 !== f ? f[0].pageY : a.clientY, b.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(b.touchObject.curX - b.touchObject.startX, 2))), d = b.swipeDirection(), "vertical" !== d ? (void 0 !== a.originalEvent && b.touchObject.swipeLength > 4 && a.preventDefault(), e = b.touchObject.curX > b.touchObject.startX ? 1 : -1, b.swipeLeft = b.options.vertical === !1 ? c + b.touchObject.swipeLength * e : c + b.touchObject.swipeLength * (b.$list.height() / b.listWidth) * e, b.options.fade === !0 || b.options.touchMove === !1 ? !1 : b.animating === !0 ? (b.swipeLeft = null, !1) : (b.setCSS(b.swipeLeft), void 0)) : void 0)
    }, b.prototype.swipeStart = function (a) {
	var c, b = this;
	return 1 !== b.touchObject.fingerCount || b.slideCount <= b.options.slidesToShow ? (b.touchObject = {}, !1) : (void 0 !== a.originalEvent && void 0 !== a.originalEvent.touches && (c = a.originalEvent.touches[0]), b.touchObject.startX = b.touchObject.curX = void 0 !== c ? c.pageX : a.clientX, b.touchObject.startY = b.touchObject.curY = void 0 !== c ? c.pageY : a.clientY, b.$list.addClass("dragging"), void 0)
    }, b.prototype.unfilterSlides = function () {
	var a = this;
	null !== a.$slidesCache && (a.unload(), a.$slideTrack.children(this.options.slide).remove(), a.$slidesCache.appendTo(a.$slideTrack), a.reinit())
    }, b.prototype.unload = function () {
	var b = this;
	a(".slick-cloned", b.$slider).remove(), b.$dots && b.$dots.remove(), b.$prevArrow && (b.$prevArrow.remove(), b.$nextArrow.remove()), b.$slides.removeClass("slick-slide slick-active slick-visible").removeAttr("style")
    }, b.prototype.updateArrows = function () {
	var a = this;
	a.options.arrows === !0 && a.options.infinite !== !0 && a.slideCount > a.options.slidesToShow && (a.$prevArrow.removeClass("slick-disabled"), a.$nextArrow.removeClass("slick-disabled"), 0 === a.currentSlide ? (a.$prevArrow.addClass("slick-disabled"), a.$nextArrow.removeClass("slick-disabled")) : a.currentSlide >= a.slideCount - a.options.slidesToShow && (a.$nextArrow.addClass("slick-disabled"), a.$prevArrow.removeClass("slick-disabled")))
    }, b.prototype.updateDots = function () {
	var a = this;
	null !== a.$dots && (a.$dots.find("li").removeClass("slick-active"), a.$dots.find("li").eq(a.currentSlide / a.options.slidesToScroll).addClass("slick-active"))
    }, a.fn.slick = function (a) {
	var c = this;
	return c.each(function (c, d) {
	    d.slick = new b(d, a)
	})
    }, a.fn.slickAdd = function (a, b, c) {
	var d = this;
	return d.each(function (d, e) {
	    e.slick.addSlide(a, b, c)
	})
    }, a.fn.slickCurrentSlide = function () {
	var a = this;
	return a.get(0).slick.getCurrent()
    }, a.fn.slickFilter = function (a) {
	var b = this;
	return b.each(function (b, c) {
	    c.slick.filterSlides(a)
	})
    }, a.fn.slickGoTo = function (a) {
	var b = this;
	return b.each(function (b, c) {
	    c.slick.slideHandler(a)
	})
    }, a.fn.slickNext = function () {
	var a = this;
	return a.each(function (a, b) {
	    b.slick.changeSlide({data: {message: "next"}})
	})
    }, a.fn.slickPause = function () {
	var a = this;
	return a.each(function (a, b) {
	    b.slick.autoPlayClear(), b.slick.paused = !0
	})
    }, a.fn.slickPlay = function () {
	var a = this;
	return a.each(function (a, b) {
	    b.slick.paused = !1, b.slick.autoPlay()
	})
    }, a.fn.slickPrev = function () {
	var a = this;
	return a.each(function (a, b) {
	    b.slick.changeSlide({data: {message: "previous"}})
	})
    }, a.fn.slickRemove = function (a, b) {
	var c = this;
	return c.each(function (c, d) {
	    d.slick.removeSlide(a, b)
	})
    }, a.fn.slickSetOption = function (a, b, c) {
	var d = this;
	return d.each(function (d, e) {
	    e.slick.options[a] = b, c === !0 && (e.slick.unload(), e.slick.reinit())
	})
    }, a.fn.slickUnfilter = function () {
	var a = this;
	return a.each(function (a, b) {
	    b.slick.unfilterSlides()
	})
    }, a.fn.unslick = function () {
	var a = this;
	return a.each(function (a, b) {
	    b.slick.destroy()
	})
    }
});


/*! jQuery Color v@2.1.2 http://github.com/jquery/jquery-color | jquery.org/license */
(function (a, b) {
    function m(a, b, c) {
	var d = h[b.type] || {};
	return a == null ? c || !b.def ? null : b.def : (a = d.floor ? ~~a : parseFloat(a), isNaN(a) ? b.def : d.mod ? (a + d.mod) % d.mod : 0 > a ? 0 : d.max < a ? d.max : a)
    }
    function n(b) {
	var c = f(), d = c._rgba = [];
	return b = b.toLowerCase(), l(e, function (a, e) {
	    var f, h = e.re.exec(b), i = h && e.parse(h), j = e.space || "rgba";
	    if (i)
		return f = c[j](i), c[g[j].cache] = f[g[j].cache], d = c._rgba = f._rgba, !1
	}), d.length ? (d.join() === "0,0,0,0" && a.extend(d, k.transparent), c) : k[b]
    }
    function o(a, b, c) {
	return c = (c + 1) % 1, c * 6 < 1 ? a + (b - a) * c * 6 : c * 2 < 1 ? b : c * 3 < 2 ? a + (b - a) * (2 / 3 - c) * 6 : a
    }
    var c = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor", d = /^([\-+])=\s*(\d+\.?\d*)/, e = [{re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, parse: function (a) {
		return[a[1], a[2], a[3], a[4]]
	    }}, {re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, parse: function (a) {
		return[a[1] * 2.55, a[2] * 2.55, a[3] * 2.55, a[4]]
	    }}, {re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/, parse: function (a) {
		return[parseInt(a[1], 16), parseInt(a[2], 16), parseInt(a[3], 16)]
	    }}, {re: /#([a-f0-9])([a-f0-9])([a-f0-9])/, parse: function (a) {
		return[parseInt(a[1] + a[1], 16), parseInt(a[2] + a[2], 16), parseInt(a[3] + a[3], 16)]
	    }}, {re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, space: "hsla", parse: function (a) {
		return[a[1], a[2] / 100, a[3] / 100, a[4]]
	    }}], f = a.Color = function (b, c, d, e) {
	return new a.Color.fn.parse(b, c, d, e)
    }, g = {rgba: {props: {red: {idx: 0, type: "byte"}, green: {idx: 1, type: "byte"}, blue: {idx: 2, type: "byte"}}}, hsla: {props: {hue: {idx: 0, type: "degrees"}, saturation: {idx: 1, type: "percent"}, lightness: {idx: 2, type: "percent"}}}}, h = {"byte": {floor: !0, max: 255}, percent: {max: 1}, degrees: {mod: 360, floor: !0}}, i = f.support = {}, j = a("<p>")[0], k, l = a.each;
    j.style.cssText = "background-color:rgba(1,1,1,.5)", i.rgba = j.style.backgroundColor.indexOf("rgba") > -1, l(g, function (a, b) {
	b.cache = "_" + a, b.props.alpha = {idx: 3, type: "percent", def: 1}
    }), f.fn = a.extend(f.prototype, {parse: function (c, d, e, h) {
	    if (c === b)
		return this._rgba = [null, null, null, null], this;
	    if (c.jquery || c.nodeType)
		c = a(c).css(d), d = b;
	    var i = this, j = a.type(c), o = this._rgba = [];
	    d !== b && (c = [c, d, e, h], j = "array");
	    if (j === "string")
		return this.parse(n(c) || k._default);
	    if (j === "array")
		return l(g.rgba.props, function (a, b) {
		    o[b.idx] = m(c[b.idx], b)
		}), this;
	    if (j === "object")
		return c instanceof f ? l(g, function (a, b) {
		    c[b.cache] && (i[b.cache] = c[b.cache].slice())
		}) : l(g, function (b, d) {
		    var e = d.cache;
		    l(d.props, function (a, b) {
			if (!i[e] && d.to) {
			    if (a === "alpha" || c[a] == null)
				return;
			    i[e] = d.to(i._rgba)
			}
			i[e][b.idx] = m(c[a], b, !0)
		    }), i[e] && a.inArray(null, i[e].slice(0, 3)) < 0 && (i[e][3] = 1, d.from && (i._rgba = d.from(i[e])))
		}), this
	}, is: function (a) {
	    var b = f(a), c = !0, d = this;
	    return l(g, function (a, e) {
		var f, g = b[e.cache];
		return g && (f = d[e.cache] || e.to && e.to(d._rgba) || [], l(e.props, function (a, b) {
		    if (g[b.idx] != null)
			return c = g[b.idx] === f[b.idx], c
		})), c
	    }), c
	}, _space: function () {
	    var a = [], b = this;
	    return l(g, function (c, d) {
		b[d.cache] && a.push(c)
	    }), a.pop()
	}, transition: function (a, b) {
	    var c = f(a), d = c._space(), e = g[d], i = this.alpha() === 0 ? f("transparent") : this, j = i[e.cache] || e.to(i._rgba), k = j.slice();
	    return c = c[e.cache], l(e.props, function (a, d) {
		var e = d.idx, f = j[e], g = c[e], i = h[d.type] || {};
		if (g === null)
		    return;
		f === null ? k[e] = g : (i.mod && (g - f > i.mod / 2 ? f += i.mod : f - g > i.mod / 2 && (f -= i.mod)), k[e] = m((g - f) * b + f, d))
	    }), this[d](k)
	}, blend: function (b) {
	    if (this._rgba[3] === 1)
		return this;
	    var c = this._rgba.slice(), d = c.pop(), e = f(b)._rgba;
	    return f(a.map(c, function (a, b) {
		return(1 - d) * e[b] + d * a
	    }))
	}, toRgbaString: function () {
	    var b = "rgba(", c = a.map(this._rgba, function (a, b) {
		return a == null ? b > 2 ? 1 : 0 : a
	    });
	    return c[3] === 1 && (c.pop(), b = "rgb("), b + c.join() + ")"
	}, toHslaString: function () {
	    var b = "hsla(", c = a.map(this.hsla(), function (a, b) {
		return a == null && (a = b > 2 ? 1 : 0), b && b < 3 && (a = Math.round(a * 100) + "%"), a
	    });
	    return c[3] === 1 && (c.pop(), b = "hsl("), b + c.join() + ")"
	}, toHexString: function (b) {
	    var c = this._rgba.slice(), d = c.pop();
	    return b && c.push(~~(d * 255)), "#" + a.map(c, function (a) {
		return a = (a || 0).toString(16), a.length === 1 ? "0" + a : a
	    }).join("")
	}, toString: function () {
	    return this._rgba[3] === 0 ? "transparent" : this.toRgbaString()
	}}), f.fn.parse.prototype = f.fn, g.hsla.to = function (a) {
	if (a[0] == null || a[1] == null || a[2] == null)
	    return[null, null, null, a[3]];
	var b = a[0] / 255, c = a[1] / 255, d = a[2] / 255, e = a[3], f = Math.max(b, c, d), g = Math.min(b, c, d), h = f - g, i = f + g, j = i * .5, k, l;
	return g === f ? k = 0 : b === f ? k = 60 * (c - d) / h + 360 : c === f ? k = 60 * (d - b) / h + 120 : k = 60 * (b - c) / h + 240, h === 0 ? l = 0 : j <= .5 ? l = h / i : l = h / (2 - i), [Math.round(k) % 360, l, j, e == null ? 1 : e]
    }, g.hsla.from = function (a) {
	if (a[0] == null || a[1] == null || a[2] == null)
	    return[null, null, null, a[3]];
	var b = a[0] / 360, c = a[1], d = a[2], e = a[3], f = d <= .5 ? d * (1 + c) : d + c - d * c, g = 2 * d - f;
	return[Math.round(o(g, f, b + 1 / 3) * 255), Math.round(o(g, f, b) * 255), Math.round(o(g, f, b - 1 / 3) * 255), e]
    }, l(g, function (c, e) {
	var g = e.props, h = e.cache, i = e.to, j = e.from;
	f.fn[c] = function (c) {
	    i && !this[h] && (this[h] = i(this._rgba));
	    if (c === b)
		return this[h].slice();
	    var d, e = a.type(c), k = e === "array" || e === "object" ? c : arguments, n = this[h].slice();
	    return l(g, function (a, b) {
		var c = k[e === "object" ? a : b.idx];
		c == null && (c = n[b.idx]), n[b.idx] = m(c, b)
	    }), j ? (d = f(j(n)), d[h] = n, d) : f(n)
	}, l(g, function (b, e) {
	    if (f.fn[b])
		return;
	    f.fn[b] = function (f) {
		var g = a.type(f), h = b === "alpha" ? this._hsla ? "hsla" : "rgba" : c, i = this[h](), j = i[e.idx], k;
		return g === "undefined" ? j : (g === "function" && (f = f.call(this, j), g = a.type(f)), f == null && e.empty ? this : (g === "string" && (k = d.exec(f), k && (f = j + parseFloat(k[2]) * (k[1] === "+" ? 1 : -1))), i[e.idx] = f, this[h](i)))
	    }
	})
    }), f.hook = function (b) {
	var c = b.split(" ");
	l(c, function (b, c) {
	    a.cssHooks[c] = {set: function (b, d) {
		    var e, g, h = "";
		    if (d !== "transparent" && (a.type(d) !== "string" || (e = n(d)))) {
			d = f(e || d);
			if (!i.rgba && d._rgba[3] !== 1) {
			    g = c === "backgroundColor" ? b.parentNode : b;
			    while ((h === "" || h === "transparent") && g && g.style)
				try {
				    h = a.css(g, "backgroundColor"), g = g.parentNode
				} catch (j) {
				}
			    d = d.blend(h && h !== "transparent" ? h : "_default")
			}
			d = d.toRgbaString()
		    }
		    try {
			b.style[c] = d
		    } catch (j) {
		    }
		}}, a.fx.step[c] = function (b) {
		b.colorInit || (b.start = f(b.elem, c), b.end = f(b.end), b.colorInit = !0), a.cssHooks[c].set(b.elem, b.start.transition(b.end, b.pos))
	    }
	})
    }, f.hook(c), a.cssHooks.borderColor = {expand: function (a) {
	    var b = {};
	    return l(["Top", "Right", "Bottom", "Left"], function (c, d) {
		b["border" + d + "Color"] = a
	    }), b
	}}, k = a.Color.names = {aqua: "#00ffff", black: "#000000", blue: "#0000ff", fuchsia: "#ff00ff", gray: "#808080", green: "#008000", lime: "#00ff00", maroon: "#800000", navy: "#000080", olive: "#808000", purple: "#800080", red: "#ff0000", silver: "#c0c0c0", teal: "#008080", white: "#ffffff", yellow: "#ffff00", transparent: [null, null, null, 0], _default: "#ffffff"}
})(jQuery);


/*!
 * Masonry PACKAGED v3.1.5
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */

!function (a) {
    function b() {
    }
    function c(a) {
	function c(b) {
	    b.prototype.option || (b.prototype.option = function (b) {
		a.isPlainObject(b) && (this.options = a.extend(!0, this.options, b))
	    })
	}
	function e(b, c) {
	    a.fn[b] = function (e) {
		if ("string" == typeof e) {
		    for (var g = d.call(arguments, 1), h = 0, i = this.length; i > h; h++) {
			var j = this[h], k = a.data(j, b);
			if (k)
			    if (a.isFunction(k[e]) && "_" !== e.charAt(0)) {
				var l = k[e].apply(k, g);
				if (void 0 !== l)
				    return l
			    } else
				f("no such method '" + e + "' for " + b + " instance");
			else
			    f("cannot call methods on " + b + " prior to initialization; attempted to call '" + e + "'")
		    }
		    return this
		}
		return this.each(function () {
		    var d = a.data(this, b);
		    d ? (d.option(e), d._init()) : (d = new c(this, e), a.data(this, b, d))
		})
	    }
	}
	if (a) {
	    var f = "undefined" == typeof console ? b : function (a) {
		console.error(a)
	    };
	    return a.bridget = function (a, b) {
		c(b), e(a, b)
	    }, a.bridget
	}
    }
    var d = Array.prototype.slice;
    "function" == typeof define && define.amd ? define("jquery-bridget/jquery.bridget", ["jquery"], c) : c(a.jQuery)
}(window), function (a) {
    function b(b) {
	var c = a.event;
	return c.target = c.target || c.srcElement || b, c
    }
    var c = document.documentElement, d = function () {
    };
    c.addEventListener ? d = function (a, b, c) {
	a.addEventListener(b, c, !1)
    } : c.attachEvent && (d = function (a, c, d) {
	a[c + d] = d.handleEvent ? function () {
	    var c = b(a);
	    d.handleEvent.call(d, c)
	} : function () {
	    var c = b(a);
	    d.call(a, c)
	}, a.attachEvent("on" + c, a[c + d])
    });
    var e = function () {
    };
    c.removeEventListener ? e = function (a, b, c) {
	a.removeEventListener(b, c, !1)
    } : c.detachEvent && (e = function (a, b, c) {
	a.detachEvent("on" + b, a[b + c]);
	try {
	    delete a[b + c]
	} catch (d) {
	    a[b + c] = void 0
	}
    });
    var f = {bind: d, unbind: e};
    "function" == typeof define && define.amd ? define("eventie/eventie", f) : "object" == typeof exports ? module.exports = f : a.eventie = f
}(this), function (a) {
    function b(a) {
	"function" == typeof a && (b.isReady ? a() : f.push(a))
    }
    function c(a) {
	var c = "readystatechange" === a.type && "complete" !== e.readyState;
	if (!b.isReady && !c) {
	    b.isReady = !0;
	    for (var d = 0, g = f.length; g > d; d++) {
		var h = f[d];
		h()
	    }
	}
    }
    function d(d) {
	return d.bind(e, "DOMContentLoaded", c), d.bind(e, "readystatechange", c), d.bind(a, "load", c), b
    }
    var e = a.document, f = [];
    b.isReady = !1, "function" == typeof define && define.amd ? (b.isReady = "function" == typeof requirejs, define("doc-ready/doc-ready", ["eventie/eventie"], d)) : a.docReady = d(a.eventie)
}(this), function () {
    function a() {
    }
    function b(a, b) {
	for (var c = a.length; c--; )
	    if (a[c].listener === b)
		return c;
	return-1
    }
    function c(a) {
	return function () {
	    return this[a].apply(this, arguments)
	}
    }
    var d = a.prototype, e = this, f = e.EventEmitter;
    d.getListeners = function (a) {
	var b, c, d = this._getEvents();
	if (a instanceof RegExp) {
	    b = {};
	    for (c in d)
		d.hasOwnProperty(c) && a.test(c) && (b[c] = d[c])
	} else
	    b = d[a] || (d[a] = []);
	return b
    }, d.flattenListeners = function (a) {
	var b, c = [];
	for (b = 0; b < a.length; b += 1)
	    c.push(a[b].listener);
	return c
    }, d.getListenersAsObject = function (a) {
	var b, c = this.getListeners(a);
	return c instanceof Array && (b = {}, b[a] = c), b || c
    }, d.addListener = function (a, c) {
	var d, e = this.getListenersAsObject(a), f = "object" == typeof c;
	for (d in e)
	    e.hasOwnProperty(d) && -1 === b(e[d], c) && e[d].push(f ? c : {listener: c, once: !1});
	return this
    }, d.on = c("addListener"), d.addOnceListener = function (a, b) {
	return this.addListener(a, {listener: b, once: !0})
    }, d.once = c("addOnceListener"), d.defineEvent = function (a) {
	return this.getListeners(a), this
    }, d.defineEvents = function (a) {
	for (var b = 0; b < a.length; b += 1)
	    this.defineEvent(a[b]);
	return this
    }, d.removeListener = function (a, c) {
	var d, e, f = this.getListenersAsObject(a);
	for (e in f)
	    f.hasOwnProperty(e) && (d = b(f[e], c), -1 !== d && f[e].splice(d, 1));
	return this
    }, d.off = c("removeListener"), d.addListeners = function (a, b) {
	return this.manipulateListeners(!1, a, b)
    }, d.removeListeners = function (a, b) {
	return this.manipulateListeners(!0, a, b)
    }, d.manipulateListeners = function (a, b, c) {
	var d, e, f = a ? this.removeListener : this.addListener, g = a ? this.removeListeners : this.addListeners;
	if ("object" != typeof b || b instanceof RegExp)
	    for (d = c.length; d--; )
		f.call(this, b, c[d]);
	else
	    for (d in b)
		b.hasOwnProperty(d) && (e = b[d]) && ("function" == typeof e ? f.call(this, d, e) : g.call(this, d, e));
	return this
    }, d.removeEvent = function (a) {
	var b, c = typeof a, d = this._getEvents();
	if ("string" === c)
	    delete d[a];
	else if (a instanceof RegExp)
	    for (b in d)
		d.hasOwnProperty(b) && a.test(b) && delete d[b];
	else
	    delete this._events;
	return this
    }, d.removeAllListeners = c("removeEvent"), d.emitEvent = function (a, b) {
	var c, d, e, f, g = this.getListenersAsObject(a);
	for (e in g)
	    if (g.hasOwnProperty(e))
		for (d = g[e].length; d--; )
		    c = g[e][d], c.once === !0 && this.removeListener(a, c.listener), f = c.listener.apply(this, b || []), f === this._getOnceReturnValue() && this.removeListener(a, c.listener);
	return this
    }, d.trigger = c("emitEvent"), d.emit = function (a) {
	var b = Array.prototype.slice.call(arguments, 1);
	return this.emitEvent(a, b)
    }, d.setOnceReturnValue = function (a) {
	return this._onceReturnValue = a, this
    }, d._getOnceReturnValue = function () {
	return this.hasOwnProperty("_onceReturnValue") ? this._onceReturnValue : !0
    }, d._getEvents = function () {
	return this._events || (this._events = {})
    }, a.noConflict = function () {
	return e.EventEmitter = f, a
    }, "function" == typeof define && define.amd ? define("eventEmitter/EventEmitter", [], function () {
	return a
    }) : "object" == typeof module && module.exports ? module.exports = a : this.EventEmitter = a
}.call(this), function (a) {
    function b(a) {
	if (a) {
	    if ("string" == typeof d[a])
		return a;
	    a = a.charAt(0).toUpperCase() + a.slice(1);
	    for (var b, e = 0, f = c.length; f > e; e++)
		if (b = c[e] + a, "string" == typeof d[b])
		    return b
	}
    }
    var c = "Webkit Moz ms Ms O".split(" "), d = document.documentElement.style;
    "function" == typeof define && define.amd ? define("get-style-property/get-style-property", [], function () {
	return b
    }) : "object" == typeof exports ? module.exports = b : a.getStyleProperty = b
}(window), function (a) {
    function b(a) {
	var b = parseFloat(a), c = -1 === a.indexOf("%") && !isNaN(b);
	return c && b
    }
    function c() {
	for (var a = {width: 0, height: 0, innerWidth: 0, innerHeight: 0, outerWidth: 0, outerHeight: 0}, b = 0, c = g.length; c > b; b++) {
	    var d = g[b];
	    a[d] = 0
	}
	return a
    }
    function d(a) {
	function d(a) {
	    if ("string" == typeof a && (a = document.querySelector(a)), a && "object" == typeof a && a.nodeType) {
		var d = f(a);
		if ("none" === d.display)
		    return c();
		var e = {};
		e.width = a.offsetWidth, e.height = a.offsetHeight;
		for (var k = e.isBorderBox = !(!j || !d[j] || "border-box" !== d[j]), l = 0, m = g.length; m > l; l++) {
		    var n = g[l], o = d[n];
		    o = h(a, o);
		    var p = parseFloat(o);
		    e[n] = isNaN(p) ? 0 : p
		}
		var q = e.paddingLeft + e.paddingRight, r = e.paddingTop + e.paddingBottom, s = e.marginLeft + e.marginRight, t = e.marginTop + e.marginBottom, u = e.borderLeftWidth + e.borderRightWidth, v = e.borderTopWidth + e.borderBottomWidth, w = k && i, x = b(d.width);
		x !== !1 && (e.width = x + (w ? 0 : q + u));
		var y = b(d.height);
		return y !== !1 && (e.height = y + (w ? 0 : r + v)), e.innerWidth = e.width - (q + u), e.innerHeight = e.height - (r + v), e.outerWidth = e.width + s, e.outerHeight = e.height + t, e
	    }
	}
	function h(a, b) {
	    if (e || -1 === b.indexOf("%"))
		return b;
	    var c = a.style, d = c.left, f = a.runtimeStyle, g = f && f.left;
	    return g && (f.left = a.currentStyle.left), c.left = b, b = c.pixelLeft, c.left = d, g && (f.left = g), b
	}
	var i, j = a("boxSizing");
	return function () {
	    if (j) {
		var a = document.createElement("div");
		a.style.width = "200px", a.style.padding = "1px 2px 3px 4px", a.style.borderStyle = "solid", a.style.borderWidth = "1px 2px 3px 4px", a.style[j] = "border-box";
		var c = document.body || document.documentElement;
		c.appendChild(a);
		var d = f(a);
		i = 200 === b(d.width), c.removeChild(a)
	    }
	}(), d
    }
    var e = a.getComputedStyle, f = e ? function (a) {
	return e(a, null)
    } : function (a) {
	return a.currentStyle
    }, g = ["paddingLeft", "paddingRight", "paddingTop", "paddingBottom", "marginLeft", "marginRight", "marginTop", "marginBottom", "borderLeftWidth", "borderRightWidth", "borderTopWidth", "borderBottomWidth"];
    "function" == typeof define && define.amd ? define("get-size/get-size", ["get-style-property/get-style-property"], d) : "object" == typeof exports ? module.exports = d(require("get-style-property")) : a.getSize = d(a.getStyleProperty)
}(window), function (a, b) {
    function c(a, b) {
	return a[h](b)
    }
    function d(a) {
	if (!a.parentNode) {
	    var b = document.createDocumentFragment();
	    b.appendChild(a)
	}
    }
    function e(a, b) {
	d(a);
	for (var c = a.parentNode.querySelectorAll(b), e = 0, f = c.length; f > e; e++)
	    if (c[e] === a)
		return!0;
	return!1
    }
    function f(a, b) {
	return d(a), c(a, b)
    }
    var g, h = function () {
	if (b.matchesSelector)
	    return"matchesSelector";
	for (var a = ["webkit", "moz", "ms", "o"], c = 0, d = a.length; d > c; c++) {
	    var e = a[c], f = e + "MatchesSelector";
	    if (b[f])
		return f
	}
    }();
    if (h) {
	var i = document.createElement("div"), j = c(i, "div");
	g = j ? c : f
    } else
	g = e;
    "function" == typeof define && define.amd ? define("matches-selector/matches-selector", [], function () {
	return g
    }) : window.matchesSelector = g
}(this, Element.prototype), function (a) {
    function b(a, b) {
	for (var c in b)
	    a[c] = b[c];
	return a
    }
    function c(a) {
	for (var b in a)
	    return!1;
	return b = null, !0
    }
    function d(a) {
	return a.replace(/([A-Z])/g, function (a) {
	    return"-" + a.toLowerCase()
	})
    }
    function e(a, e, f) {
	function h(a, b) {
	    a && (this.element = a, this.layout = b, this.position = {x: 0, y: 0}, this._create())
	}
	var i = f("transition"), j = f("transform"), k = i && j, l = !!f("perspective"), m = {WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "otransitionend", transition: "transitionend"}[i], n = ["transform", "transition", "transitionDuration", "transitionProperty"], o = function () {
	    for (var a = {}, b = 0, c = n.length; c > b; b++) {
		var d = n[b], e = f(d);
		e && e !== d && (a[d] = e)
	    }
	    return a
	}();
	b(h.prototype, a.prototype), h.prototype._create = function () {
	    this._transn = {ingProperties: {}, clean: {}, onEnd: {}}, this.css({position: "absolute"})
	}, h.prototype.handleEvent = function (a) {
	    var b = "on" + a.type;
	    this[b] && this[b](a)
	}, h.prototype.getSize = function () {
	    this.size = e(this.element)
	}, h.prototype.css = function (a) {
	    var b = this.element.style;
	    for (var c in a) {
		var d = o[c] || c;
		b[d] = a[c]
	    }
	}, h.prototype.getPosition = function () {
	    var a = g(this.element), b = this.layout.options, c = b.isOriginLeft, d = b.isOriginTop, e = parseInt(a[c ? "left" : "right"], 10), f = parseInt(a[d ? "top" : "bottom"], 10);
	    e = isNaN(e) ? 0 : e, f = isNaN(f) ? 0 : f;
	    var h = this.layout.size;
	    e -= c ? h.paddingLeft : h.paddingRight, f -= d ? h.paddingTop : h.paddingBottom, this.position.x = e, this.position.y = f
	}, h.prototype.layoutPosition = function () {
	    var a = this.layout.size, b = this.layout.options, c = {};
	    b.isOriginLeft ? (c.left = this.position.x + a.paddingLeft + "px", c.right = "") : (c.right = this.position.x + a.paddingRight + "px", c.left = ""), b.isOriginTop ? (c.top = this.position.y + a.paddingTop + "px", c.bottom = "") : (c.bottom = this.position.y + a.paddingBottom + "px", c.top = ""), this.css(c), this.emitEvent("layout", [this])
	};
	var p = l ? function (a, b) {
	    return"translate3d(" + a + "px, " + b + "px, 0)"
	} : function (a, b) {
	    return"translate(" + a + "px, " + b + "px)"
	};
	h.prototype._transitionTo = function (a, b) {
	    this.getPosition();
	    var c = this.position.x, d = this.position.y, e = parseInt(a, 10), f = parseInt(b, 10), g = e === this.position.x && f === this.position.y;
	    if (this.setPosition(a, b), g && !this.isTransitioning)
		return void this.layoutPosition();
	    var h = a - c, i = b - d, j = {}, k = this.layout.options;
	    h = k.isOriginLeft ? h : -h, i = k.isOriginTop ? i : -i, j.transform = p(h, i), this.transition({to: j, onTransitionEnd: {transform: this.layoutPosition}, isCleaning: !0})
	}, h.prototype.goTo = function (a, b) {
	    this.setPosition(a, b), this.layoutPosition()
	}, h.prototype.moveTo = k ? h.prototype._transitionTo : h.prototype.goTo, h.prototype.setPosition = function (a, b) {
	    this.position.x = parseInt(a, 10), this.position.y = parseInt(b, 10)
	}, h.prototype._nonTransition = function (a) {
	    this.css(a.to), a.isCleaning && this._removeStyles(a.to);
	    for (var b in a.onTransitionEnd)
		a.onTransitionEnd[b].call(this)
	}, h.prototype._transition = function (a) {
	    if (!parseFloat(this.layout.options.transitionDuration))
		return void this._nonTransition(a);
	    var b = this._transn;
	    for (var c in a.onTransitionEnd)
		b.onEnd[c] = a.onTransitionEnd[c];
	    for (c in a.to)
		b.ingProperties[c] = !0, a.isCleaning && (b.clean[c] = !0);
	    if (a.from) {
		this.css(a.from);
		var d = this.element.offsetHeight;
		d = null
	    }
	    this.enableTransition(a.to), this.css(a.to), this.isTransitioning = !0
	};
	var q = j && d(j) + ",opacity";
	h.prototype.enableTransition = function () {
	    this.isTransitioning || (this.css({transitionProperty: q, transitionDuration: this.layout.options.transitionDuration}), this.element.addEventListener(m, this, !1))
	}, h.prototype.transition = h.prototype[i ? "_transition" : "_nonTransition"], h.prototype.onwebkitTransitionEnd = function (a) {
	    this.ontransitionend(a)
	}, h.prototype.onotransitionend = function (a) {
	    this.ontransitionend(a)
	};
	var r = {"-webkit-transform": "transform", "-moz-transform": "transform", "-o-transform": "transform"};
	h.prototype.ontransitionend = function (a) {
	    if (a.target === this.element) {
		var b = this._transn, d = r[a.propertyName] || a.propertyName;
		if (delete b.ingProperties[d], c(b.ingProperties) && this.disableTransition(), d in b.clean && (this.element.style[a.propertyName] = "", delete b.clean[d]), d in b.onEnd) {
		    var e = b.onEnd[d];
		    e.call(this), delete b.onEnd[d]
		}
		this.emitEvent("transitionEnd", [this])
	    }
	}, h.prototype.disableTransition = function () {
	    this.removeTransitionStyles(), this.element.removeEventListener(m, this, !1), this.isTransitioning = !1
	}, h.prototype._removeStyles = function (a) {
	    var b = {};
	    for (var c in a)
		b[c] = "";
	    this.css(b)
	};
	var s = {transitionProperty: "", transitionDuration: ""};
	return h.prototype.removeTransitionStyles = function () {
	    this.css(s)
	}, h.prototype.removeElem = function () {
	    this.element.parentNode.removeChild(this.element), this.emitEvent("remove", [this])
	}, h.prototype.remove = function () {
	    if (!i || !parseFloat(this.layout.options.transitionDuration))
		return void this.removeElem();
	    var a = this;
	    this.on("transitionEnd", function () {
		return a.removeElem(), !0
	    }), this.hide()
	}, h.prototype.reveal = function () {
	    delete this.isHidden, this.css({display: ""});
	    var a = this.layout.options;
	    this.transition({from: a.hiddenStyle, to: a.visibleStyle, isCleaning: !0})
	}, h.prototype.hide = function () {
	    this.isHidden = !0, this.css({display: ""});
	    var a = this.layout.options;
	    this.transition({from: a.visibleStyle, to: a.hiddenStyle, isCleaning: !0, onTransitionEnd: {opacity: function () {
			this.isHidden && this.css({display: "none"})
		    }}})
	}, h.prototype.destroy = function () {
	    this.css({position: "", left: "", right: "", top: "", bottom: "", transition: "", transform: ""})
	}, h
    }
    var f = a.getComputedStyle, g = f ? function (a) {
	return f(a, null)
    } : function (a) {
	return a.currentStyle
    };
    "function" == typeof define && define.amd ? define("outlayer/item", ["eventEmitter/EventEmitter", "get-size/get-size", "get-style-property/get-style-property"], e) : (a.Outlayer = {}, a.Outlayer.Item = e(a.EventEmitter, a.getSize, a.getStyleProperty))
}(window), function (a) {
    function b(a, b) {
	for (var c in b)
	    a[c] = b[c];
	return a
    }
    function c(a) {
	return"[object Array]" === l.call(a)
    }
    function d(a) {
	var b = [];
	if (c(a))
	    b = a;
	else if (a && "number" == typeof a.length)
	    for (var d = 0, e = a.length; e > d; d++)
		b.push(a[d]);
	else
	    b.push(a);
	return b
    }
    function e(a, b) {
	var c = n(b, a);
	-1 !== c && b.splice(c, 1)
    }
    function f(a) {
	return a.replace(/(.)([A-Z])/g, function (a, b, c) {
	    return b + "-" + c
	}).toLowerCase()
    }
    function g(c, g, l, n, o, p) {
	function q(a, c) {
	    if ("string" == typeof a && (a = h.querySelector(a)), !a || !m(a))
		return void(i && i.error("Bad " + this.constructor.namespace + " element: " + a));
	    this.element = a, this.options = b({}, this.constructor.defaults), this.option(c);
	    var d = ++r;
	    this.element.outlayerGUID = d, s[d] = this, this._create(), this.options.isInitLayout && this.layout()
	}
	var r = 0, s = {};
	return q.namespace = "outlayer", q.Item = p, q.defaults = {containerStyle: {position: "relative"}, isInitLayout: !0, isOriginLeft: !0, isOriginTop: !0, isResizeBound: !0, isResizingContainer: !0, transitionDuration: "0.4s", hiddenStyle: {opacity: 0, transform: "scale(0.001)"}, visibleStyle: {opacity: 1, transform: "scale(1)"}}, b(q.prototype, l.prototype), q.prototype.option = function (a) {
	    b(this.options, a)
	}, q.prototype._create = function () {
	    this.reloadItems(), this.stamps = [], this.stamp(this.options.stamp), b(this.element.style, this.options.containerStyle), this.options.isResizeBound && this.bindResize()
	}, q.prototype.reloadItems = function () {
	    this.items = this._itemize(this.element.children)
	}, q.prototype._itemize = function (a) {
	    for (var b = this._filterFindItemElements(a), c = this.constructor.Item, d = [], e = 0, f = b.length; f > e; e++) {
		var g = b[e], h = new c(g, this);
		d.push(h)
	    }
	    return d
	}, q.prototype._filterFindItemElements = function (a) {
	    a = d(a);
	    for (var b = this.options.itemSelector, c = [], e = 0, f = a.length; f > e; e++) {
		var g = a[e];
		if (m(g))
		    if (b) {
			o(g, b) && c.push(g);
			for (var h = g.querySelectorAll(b), i = 0, j = h.length; j > i; i++)
			    c.push(h[i])
		    } else
			c.push(g)
	    }
	    return c
	}, q.prototype.getItemElements = function () {
	    for (var a = [], b = 0, c = this.items.length; c > b; b++)
		a.push(this.items[b].element);
	    return a
	}, q.prototype.layout = function () {
	    this._resetLayout(), this._manageStamps();
	    var a = void 0 !== this.options.isLayoutInstant ? this.options.isLayoutInstant : !this._isLayoutInited;
	    this.layoutItems(this.items, a), this._isLayoutInited = !0
	}, q.prototype._init = q.prototype.layout, q.prototype._resetLayout = function () {
	    this.getSize()
	}, q.prototype.getSize = function () {
	    this.size = n(this.element)
	}, q.prototype._getMeasurement = function (a, b) {
	    var c, d = this.options[a];
	    d ? ("string" == typeof d ? c = this.element.querySelector(d) : m(d) && (c = d), this[a] = c ? n(c)[b] : d) : this[a] = 0
	}, q.prototype.layoutItems = function (a, b) {
	    a = this._getItemsForLayout(a), this._layoutItems(a, b), this._postLayout()
	}, q.prototype._getItemsForLayout = function (a) {
	    for (var b = [], c = 0, d = a.length; d > c; c++) {
		var e = a[c];
		e.isIgnored || b.push(e)
	    }
	    return b
	}, q.prototype._layoutItems = function (a, b) {
	    function c() {
		d.emitEvent("layoutComplete", [d, a])
	    }
	    var d = this;
	    if (!a || !a.length)
		return void c();
	    this._itemsOn(a, "layout", c);
	    for (var e = [], f = 0, g = a.length; g > f; f++) {
		var h = a[f], i = this._getItemLayoutPosition(h);
		i.item = h, i.isInstant = b || h.isLayoutInstant, e.push(i)
	    }
	    this._processLayoutQueue(e)
	}, q.prototype._getItemLayoutPosition = function () {
	    return{x: 0, y: 0}
	}, q.prototype._processLayoutQueue = function (a) {
	    for (var b = 0, c = a.length; c > b; b++) {
		var d = a[b];
		this._positionItem(d.item, d.x, d.y, d.isInstant)
	    }
	}, q.prototype._positionItem = function (a, b, c, d) {
	    d ? a.goTo(b, c) : a.moveTo(b, c)
	}, q.prototype._postLayout = function () {
	    this.resizeContainer()
	}, q.prototype.resizeContainer = function () {
	    if (this.options.isResizingContainer) {
		var a = this._getContainerSize();
		a && (this._setContainerMeasure(a.width, !0), this._setContainerMeasure(a.height, !1))
	    }
	}, q.prototype._getContainerSize = k, q.prototype._setContainerMeasure = function (a, b) {
	    if (void 0 !== a) {
		var c = this.size;
		c.isBorderBox && (a += b ? c.paddingLeft + c.paddingRight + c.borderLeftWidth + c.borderRightWidth : c.paddingBottom + c.paddingTop + c.borderTopWidth + c.borderBottomWidth), a = Math.max(a, 0), this.element.style[b ? "width" : "height"] = a + "px"
	    }
	}, q.prototype._itemsOn = function (a, b, c) {
	    function d() {
		return e++, e === f && c.call(g), !0
	    }
	    for (var e = 0, f = a.length, g = this, h = 0, i = a.length; i > h; h++) {
		var j = a[h];
		j.on(b, d)
	    }
	}, q.prototype.ignore = function (a) {
	    var b = this.getItem(a);
	    b && (b.isIgnored = !0)
	}, q.prototype.unignore = function (a) {
	    var b = this.getItem(a);
	    b && delete b.isIgnored
	}, q.prototype.stamp = function (a) {
	    if (a = this._find(a)) {
		this.stamps = this.stamps.concat(a);
		for (var b = 0, c = a.length; c > b; b++) {
		    var d = a[b];
		    this.ignore(d)
		}
	    }
	}, q.prototype.unstamp = function (a) {
	    if (a = this._find(a))
		for (var b = 0, c = a.length; c > b; b++) {
		    var d = a[b];
		    e(d, this.stamps), this.unignore(d)
		}
	}, q.prototype._find = function (a) {
	    return a ? ("string" == typeof a && (a = this.element.querySelectorAll(a)), a = d(a)) : void 0
	}, q.prototype._manageStamps = function () {
	    if (this.stamps && this.stamps.length) {
		this._getBoundingRect();
		for (var a = 0, b = this.stamps.length; b > a; a++) {
		    var c = this.stamps[a];
		    this._manageStamp(c)
		}
	    }
	}, q.prototype._getBoundingRect = function () {
	    var a = this.element.getBoundingClientRect(), b = this.size;
	    this._boundingRect = {left: a.left + b.paddingLeft + b.borderLeftWidth, top: a.top + b.paddingTop + b.borderTopWidth, right: a.right - (b.paddingRight + b.borderRightWidth), bottom: a.bottom - (b.paddingBottom + b.borderBottomWidth)}
	}, q.prototype._manageStamp = k, q.prototype._getElementOffset = function (a) {
	    var b = a.getBoundingClientRect(), c = this._boundingRect, d = n(a), e = {left: b.left - c.left - d.marginLeft, top: b.top - c.top - d.marginTop, right: c.right - b.right - d.marginRight, bottom: c.bottom - b.bottom - d.marginBottom};
	    return e
	}, q.prototype.handleEvent = function (a) {
	    var b = "on" + a.type;
	    this[b] && this[b](a)
	}, q.prototype.bindResize = function () {
	    this.isResizeBound || (c.bind(a, "resize", this), this.isResizeBound = !0)
	}, q.prototype.unbindResize = function () {
	    this.isResizeBound && c.unbind(a, "resize", this), this.isResizeBound = !1
	}, q.prototype.onresize = function () {
	    function a() {
		b.resize(), delete b.resizeTimeout
	    }
	    this.resizeTimeout && clearTimeout(this.resizeTimeout);
	    var b = this;
	    this.resizeTimeout = setTimeout(a, 100)
	}, q.prototype.resize = function () {
	    this.isResizeBound && this.needsResizeLayout() && this.layout()
	}, q.prototype.needsResizeLayout = function () {
	    var a = n(this.element), b = this.size && a;
	    return b && a.innerWidth !== this.size.innerWidth
	}, q.prototype.addItems = function (a) {
	    var b = this._itemize(a);
	    return b.length && (this.items = this.items.concat(b)), b
	}, q.prototype.appended = function (a) {
	    var b = this.addItems(a);
	    b.length && (this.layoutItems(b, !0), this.reveal(b))
	}, q.prototype.prepended = function (a) {
	    var b = this._itemize(a);
	    if (b.length) {
		var c = this.items.slice(0);
		this.items = b.concat(c), this._resetLayout(), this._manageStamps(), this.layoutItems(b, !0), this.reveal(b), this.layoutItems(c)
	    }
	}, q.prototype.reveal = function (a) {
	    var b = a && a.length;
	    if (b)
		for (var c = 0; b > c; c++) {
		    var d = a[c];
		    d.reveal()
		}
	}, q.prototype.hide = function (a) {
	    var b = a && a.length;
	    if (b)
		for (var c = 0; b > c; c++) {
		    var d = a[c];
		    d.hide()
		}
	}, q.prototype.getItem = function (a) {
	    for (var b = 0, c = this.items.length; c > b; b++) {
		var d = this.items[b];
		if (d.element === a)
		    return d
	    }
	}, q.prototype.getItems = function (a) {
	    if (a && a.length) {
		for (var b = [], c = 0, d = a.length; d > c; c++) {
		    var e = a[c], f = this.getItem(e);
		    f && b.push(f)
		}
		return b
	    }
	}, q.prototype.remove = function (a) {
	    a = d(a);
	    var b = this.getItems(a);
	    if (b && b.length) {
		this._itemsOn(b, "remove", function () {
		    this.emitEvent("removeComplete", [this, b])
		});
		for (var c = 0, f = b.length; f > c; c++) {
		    var g = b[c];
		    g.remove(), e(g, this.items)
		}
	    }
	}, q.prototype.destroy = function () {
	    var a = this.element.style;
	    a.height = "", a.position = "", a.width = "";
	    for (var b = 0, c = this.items.length; c > b; b++) {
		var d = this.items[b];
		d.destroy()
	    }
	    this.unbindResize(), delete this.element.outlayerGUID, j && j.removeData(this.element, this.constructor.namespace)
	}, q.data = function (a) {
	    var b = a && a.outlayerGUID;
	    return b && s[b]
	}, q.create = function (a, c) {
	    function d() {
		q.apply(this, arguments)
	    }
	    return Object.create ? d.prototype = Object.create(q.prototype) : b(d.prototype, q.prototype), d.prototype.constructor = d, d.defaults = b({}, q.defaults), b(d.defaults, c), d.prototype.settings = {}, d.namespace = a, d.data = q.data, d.Item = function () {
		p.apply(this, arguments)
	    }, d.Item.prototype = new p, g(function () {
		for (var b = f(a), c = h.querySelectorAll(".js-" + b), e = "data-" + b + "-options", g = 0, k = c.length; k > g; g++) {
		    var l, m = c[g], n = m.getAttribute(e);
		    try {
			l = n && JSON.parse(n)
		    } catch (o) {
			i && i.error("Error parsing " + e + " on " + m.nodeName.toLowerCase() + (m.id ? "#" + m.id : "") + ": " + o);
			continue
		    }
		    var p = new d(m, l);
		    j && j.data(m, a, p)
		}
	    }), j && j.bridget && j.bridget(a, d), d
	}, q.Item = p, q
    }
    var h = a.document, i = a.console, j = a.jQuery, k = function () {
    }, l = Object.prototype.toString, m = "object" == typeof HTMLElement ? function (a) {
	return a instanceof HTMLElement
    } : function (a) {
	return a && "object" == typeof a && 1 === a.nodeType && "string" == typeof a.nodeName
    }, n = Array.prototype.indexOf ? function (a, b) {
	return a.indexOf(b)
    } : function (a, b) {
	for (var c = 0, d = a.length; d > c; c++)
	    if (a[c] === b)
		return c;
	return-1
    };
    "function" == typeof define && define.amd ? define("outlayer/outlayer", ["eventie/eventie", "doc-ready/doc-ready", "eventEmitter/EventEmitter", "get-size/get-size", "matches-selector/matches-selector", "./item"], g) : a.Outlayer = g(a.eventie, a.docReady, a.EventEmitter, a.getSize, a.matchesSelector, a.Outlayer.Item)
}(window), function (a) {
    function b(a, b) {
	var d = a.create("masonry");
	return d.prototype._resetLayout = function () {
	    this.getSize(), this._getMeasurement("columnWidth", "outerWidth"), this._getMeasurement("gutter", "outerWidth"), this.measureColumns();
	    var a = this.cols;
	    for (this.colYs = []; a--; )
		this.colYs.push(0);
	    this.maxY = 0
	}, d.prototype.measureColumns = function () {
	    if (this.getContainerWidth(), !this.columnWidth) {
		var a = this.items[0], c = a && a.element;
		this.columnWidth = c && b(c).outerWidth || this.containerWidth
	    }
	    this.columnWidth += this.gutter, this.cols = Math.floor((this.containerWidth + this.gutter) / this.columnWidth), this.cols = Math.max(this.cols, 1)
	}, d.prototype.getContainerWidth = function () {
	    var a = this.options.isFitWidth ? this.element.parentNode : this.element, c = b(a);
	    this.containerWidth = c && c.innerWidth
	}, d.prototype._getItemLayoutPosition = function (a) {
	    a.getSize();
	    var b = a.size.outerWidth % this.columnWidth, d = b && 1 > b ? "round" : "ceil", e = Math[d](a.size.outerWidth / this.columnWidth);
	    e = Math.min(e, this.cols);
	    for (var f = this._getColGroup(e), g = Math.min.apply(Math, f), h = c(f, g), i = {x: this.columnWidth * h, y: g}, j = g + a.size.outerHeight, k = this.cols + 1 - f.length, l = 0; k > l; l++)
		this.colYs[h + l] = j;
	    return i
	}, d.prototype._getColGroup = function (a) {
	    if (2 > a)
		return this.colYs;
	    for (var b = [], c = this.cols + 1 - a, d = 0; c > d; d++) {
		var e = this.colYs.slice(d, d + a);
		b[d] = Math.max.apply(Math, e)
	    }
	    return b
	}, d.prototype._manageStamp = function (a) {
	    var c = b(a), d = this._getElementOffset(a), e = this.options.isOriginLeft ? d.left : d.right, f = e + c.outerWidth, g = Math.floor(e / this.columnWidth);
	    g = Math.max(0, g);
	    var h = Math.floor(f / this.columnWidth);
	    h -= f % this.columnWidth ? 0 : 1, h = Math.min(this.cols - 1, h);
	    for (var i = (this.options.isOriginTop ? d.top : d.bottom) + c.outerHeight, j = g; h >= j; j++)
		this.colYs[j] = Math.max(i, this.colYs[j])
	}, d.prototype._getContainerSize = function () {
	    this.maxY = Math.max.apply(Math, this.colYs);
	    var a = {height: this.maxY};
	    return this.options.isFitWidth && (a.width = this._getContainerFitWidth()), a
	}, d.prototype._getContainerFitWidth = function () {
	    for (var a = 0, b = this.cols; --b && 0 === this.colYs[b]; )
		a++;
	    return(this.cols - a) * this.columnWidth - this.gutter
	}, d.prototype.needsResizeLayout = function () {
	    var a = this.containerWidth;
	    return this.getContainerWidth(), a !== this.containerWidth
	}, d
    }
    var c = Array.prototype.indexOf ? function (a, b) {
	return a.indexOf(b)
    } : function (a, b) {
	for (var c = 0, d = a.length; d > c; c++) {
	    var e = a[c];
	    if (e === b)
		return c
	}
	return-1
    };
    "function" == typeof define && define.amd ? define(["outlayer/outlayer", "get-size/get-size"], b) : a.Masonry = b(a.Outlayer, a.getSize)
}(window);

/*!
 * classie v1.0.1
 * class helper functions
 * from bonzo https://github.com/ded/bonzo
 * MIT license
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, module: false */

(function (window) {

    'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

    function classReg(className) {
	return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
    }

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
    var hasClass, addClass, removeClass;

    if ('classList' in document.documentElement) {
	hasClass = function (elem, c) {
	    return elem.classList.contains(c);
	};
	addClass = function (elem, c) {
	    elem.classList.add(c);
	};
	removeClass = function (elem, c) {
	    elem.classList.remove(c);
	};
    }
    else {
	hasClass = function (elem, c) {
	    return classReg(c).test(elem.className);
	};
	addClass = function (elem, c) {
	    if (!hasClass(elem, c)) {
		elem.className = elem.className + ' ' + c;
	    }
	};
	removeClass = function (elem, c) {
	    elem.className = elem.className.replace(classReg(c), ' ');
	};
    }

    function toggleClass(elem, c) {
	var fn = hasClass(elem, c) ? removeClass : addClass;
	fn(elem, c);
    }

    var classie = {
	// full names
	hasClass: hasClass,
	addClass: addClass,
	removeClass: removeClass,
	toggleClass: toggleClass,
	// short names
	has: hasClass,
	add: addClass,
	remove: removeClass,
	toggle: toggleClass
    };

// transport
    if (typeof define === 'function' && define.amd) {
	// AMD
	define(classie);
    } else if (typeof exports === 'object') {
	// CommonJS
	module.exports = classie;
    } else {
	// browser global
	window.classie = classie;
    }

})(window);