(function (objCommon) {
	window.addEventListener("hashchange", hashHandler, false);
	function hashHandler(event) {
		routeProvider();
	};
	var strJsScript;
	objCommon.ajax('js/js.js', 'get', '', function (res) {
		strJsScript = res;
		routeProvider();
	});
	function hideAllPgBox() {
		var arrStrPgBox = ['filter_box', 'home_box', 'about_us_box', 'news_box', 'home_box', 'auto_box', 'rent_box', 'wr_black_translucent', 'wr_tb', 'contact_box', 'news_details_box', 'personal_area_favorites_box', 'personal_area_history_box', 'personal_area_orders_box', 'personal_area_settings_box', 'question_box', 'results_box', 'reviews_box', 'services_box', 'stock_box'];
		for (var i = 0; i < arrStrPgBox.length; i++) {
			var el = document.querySelector('.' + arrStrPgBox[i]);
			if (el) {
				el.style.position = 'absolute';
				el.style.left = '-10000px';
				el.style.top = '-10000px';
			}
		}
	}
	function routeProvider() {
		var regexpSearchHashWithout = new RegExp('#[^?]*', 'g');
		var arrSearchHashWithout = location.hash.match(regexpSearchHashWithout);
		var strSearchHashWithoutUrl = arrSearchHashWithout ? arrSearchHashWithout[0] : false;
		var regexpSearch = new RegExp('[?].+$', 'g');
		var arrSearch = location.hash.match(regexpSearch);
		var strUrlData = arrSearch ? arrSearch[0].slice(1) : false;
		switch (strSearchHashWithoutUrl) {
		case '#/language':
			history.back();
			console.log(strUrlData);
			break;
		case '#/registration':
			history.back();
			alert('Вход в страницу "registration". (В разработке)');
			break;
		case '#/login':
			alert('Вход в страницу "login". После, попадаем в "Личный кабинет". (В разработке)');
			location.href = '#/personal_area_favorites';
			var el_loginJs = document.querySelector('.login_js');
			var el_logOutJs = document.querySelector('.log_out_js');
			el_loginJs.style.display = 'none';
			el_logOutJs.style.display = 'block';
			break;
		case '#/log_out':
			alert('Действие log_out. (В разработке)');
			location.href = '#/home';
			var el_loginJs = document.querySelector('.login_js');
			var el_logOutJs = document.querySelector('.log_out_js');
			el_loginJs.style.display = 'block';
			el_logOutJs.style.display = 'none';
			break;
		case '#/home':
			homePgController();
			break;
		case '#/about_us':
			aboutUsPgController();
			break;
		case '#/auto':
			alert('Передача на сервер через GET параметра: ' + strUrlData + ' (Должен быть какой-то параметр (не false))\n' + 'Следующая страница будет формироваться исходя из передаваемого GET.');
			autoPgController(strUrlData);
			break;
		case '#/rent':
			rentPgController();
			break;
		case '#/rent_accept':
			alert('В разработке');
			history.go(-2);
			break;
		case '#/contact':
			contactPgController();
			break;
		case '#/news':
			newsPgController();
			break;
		case '#/news_details':
			alert('Передача на сервер через GET параметра: ' + strUrlData + ' (Должен быть какой-то параметр (не false))\n' + 'Следующая страница будет формироваться исходя из передаваемого GET.');
			newsDetailsPgController(strUrlData);
			break;
		case '#/personal_area_favorites':
			personalAreaFavoritesPgController();
			break;
		case '#/personal_area_history':
			personalAreaHistoryPgController();
			break;
		case '#/personal_area_orders':
			personalAreaOrdersPgController();
			break;
		case '#/personal_area_settings':
			personalAreaSettingsPgController();
			break;
		case '#/question':
			questionPgController();
			break;
		case '#/results':
			resultsPgController();
			break;
		case '#/reviews':
			reviewsPgController();
			break;
		case '#/services':
			servicesPgController();
			break;
		case '#/stock':
			stockPgController();
			break;
		case '#/tariffs':
			history.back();
			alert('Вход в страницу "tariffs". (В разработке)');
			break;
		default:
			homePgController();
		}
	}
	function homePgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная';
		}
		var el = document.querySelector('.home_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/home_box.html', 'home_box_ajax', function () {
				objCommon.ajax('json/home/reviews.json', 'get', '', function (res) {
					var objReviews = eval(res);
					var elFeedback = document.querySelector('.bk_feedback_customer');
					var el_repeatLi = elFeedback.querySelector('.repeat_js');
					el_repeatLi.className = el_repeatLi.className.replace('repeat_js', '');
					for (var i = 0; i < objReviews.length; i++) {
						var el_newLi = el_repeatLi.cloneNode(true);
						var elNewImg = el_newLi.querySelector('.img_client');
						elNewImg.src = objReviews[i].imageUrl;
						elNewImg.alt = objReviews[i].imageAlt;
						var elA = elNewImg.parentNode;
						elA.href = objReviews[i].hrefUrl;
						var elClientName = el_newLi.querySelector('.font_name_client');
						elClientName.innerHTML = objReviews[i].name;
						var elClientTxt = el_newLi.querySelector('.font_text_client');
						elClientTxt.innerHTML = objReviews[i].txt;
						var elDate = el_newLi.querySelector('.font_text_client_date');
						elDate.innerHTML = objReviews[i].date;
						var parentElem = el_repeatLi.parentNode;
						parentElem.insertBefore(el_newLi, el_repeatLi);
					}
					parentElem.removeChild(el_repeatLi);
					eval(strJsScript);
				});
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function newsPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ <span class="font5_1">Новости</span>';
		}
		var el = document.querySelector('.news_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/news_box.html', 'news_box_ajax', function () {
				objCommon.ajax('json/news/news.json', 'get', '', function (res) {
					var obj = eval(res);
					var el_newsBox1 = document.querySelector('.news_box1');
					var el_repeat = el_newsBox1.querySelector('.repeat_js');
					el_repeat.className = el_repeat.className.replace('repeat_js', '');
					var parentElem = el_repeat.parentNode;
					for (var i = 0; i < obj.length; i++) {
						var el_newRepeat = el_repeat.cloneNode(true);
						var elNewH4 = el_newRepeat.querySelector('h4');
						elNewH4.innerHTML = obj[i].title;
						var elNewDate = el_newRepeat.querySelector('.news_date');
						elNewDate.innerHTML = obj[i].date;
						var elNewImg = el_newRepeat.querySelector('img');
						elNewImg.src = obj[i].smallImgUrl;
						elNewImg.alt = obj[i].smallImgAlt;
						var elA = elNewImg.parentNode;
						elA.href = obj[i].bigImgUrl;
						elA.title = obj[i].bigImgAlt;
						elA.rel = 'lightbox[news' + i + ']';
						var elNewText = el_newRepeat.querySelector('.news_text');
						elNewText.innerHTML = obj[i].snippet;
						var elNewMoreA = el_newRepeat.querySelector('.a_read_more');
						elNewMoreA.href = obj[i].moreUrl;
						if (i >= 4) {
							el_newRepeat.style.display = 'none';
						}
						parentElem.insertBefore(el_newRepeat, el_repeat);
					}
					parentElem.removeChild(el_repeat);
					var el_newsBox = document.querySelector('.news_box');
					var el_sldrNews = el_newsBox.querySelector('.sldr_news');
					var el_repeat = el_sldrNews.querySelector('.repeat_js');
					el_repeat.className = el_repeat.className.replace('repeat_js', '');
					var parentElem = el_repeat.parentNode;
					var countPg = Math.ceil(obj.length / 4);
					for (var i = 0; i < countPg; i++) {
						var el_newRepeat = el_repeat.cloneNode(true);
						var elA = el_newRepeat.querySelector('a');
						if (!i) {
							elA.className = 'a_num_active ' + elA.className;
						}
						elA.innerHTML = i + 1;
						parentElem.insertBefore(el_newRepeat, el_repeat);
					}
					parentElem.removeChild(el_repeat);
					eval(strJsScript);
				});
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function aboutUsPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ <span class="font5_1">О компании</span>';
		}
		var el = document.querySelector('.about_us_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/about_us_box.html', 'about_us_box_ajax', function () {
				objCommon.ajax('json/about_us/our_staff.json', 'get', '', function (res) {
					var obj = eval(res);
					var elAboutUsSldrContent = document.querySelector('.about_us_sldr_content');
					var el_repeatLi = elAboutUsSldrContent.querySelector('.repeat_js');
					el_repeatLi.className = el_repeatLi.className.replace('repeat_js', '');
					for (var i = 0; i < obj.length; i++) {
						var el_newLi = el_repeatLi.cloneNode(true);
						var elNewImg = el_newLi.querySelector('img');
						elNewImg.src = obj[i].smallImgUrl;
						var elA = elNewImg.parentNode;
						elNewImg.alt = obj[i].smallImgAlt;
						var elAboutUsBk1Img = document.querySelector('.about_us_bk1_img');
						var elAboutUsBk1H1 = document.querySelector('.about_us_bk1 h1');
						var elAboutUsBk1Txt = document.querySelector('.about_us_bk1 .about_us_bk1_txt');
						if (!i) {
							elAboutUsBk1H1.innerHTML = obj[i].name;
							elAboutUsBk1Img.src = obj[i].bigImgUrl;
							elAboutUsBk1Img.alt = obj[i].bigImgAlt;
							elAboutUsBk1Txt.innerHTML = obj[i].txt;
						}
						(function (elH1, strName, elImg, imgUrl, imgAlt, elTxt, txt) {
							elA.addEventListener('click', function () {
								elH1.innerHTML = strName;
								elImg.src = imgUrl;
								elImg.alt = imgAlt;
								elTxt.innerHTML = txt;
							}, false);
						}
							(elAboutUsBk1H1, obj[i].name, elAboutUsBk1Img, obj[i].bigImgUrl, obj[i].bigImgAlt, elAboutUsBk1Txt, obj[i].txt));
						var parentElem = el_repeatLi.parentNode;
						parentElem.insertBefore(el_newLi, el_repeatLi);
					}
					parentElem.removeChild(el_repeatLi);
					eval(strJsScript);
				});
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function autoPgController(strUrlData) {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ Результаты поиска \\ <span class="font5_1">Авто</span>';
		}
		var el = document.querySelector('.auto_box');
		if (el) {
			el.className = 'auto_box_ajax ' + el.className;
		} {
			objCommon.replaceAjaxElem('partials/auto_box.html', 'auto_box_ajax', function () {
				objCommon.ajax('json/auto/current_auto_gallery.json', 'get', '', function (res) {
					eval('var obj0 = ' + res + '; ');
					var elAutoPgName = document.querySelector('.auto_box div');
					elAutoPgName.innerHTML = obj0.name;
					var elAutoPgTextBk = document.querySelector('.auto_pg_text_bk');
					elAutoPgTextBk.querySelector('.font26').innerHTML = obj0.price;
					elAutoPgTextBk.querySelector('.auto_pg_text_bk1').innerHTML = obj0.txt;
					var obj = obj0.gallery;
					var elAutoSldrContent = document.querySelector('.auto_sldr_content');
					var el_repeatLi = elAutoSldrContent.querySelector('.repeat_js');
					el_repeatLi.className = el_repeatLi.className.replace('repeat_js', '');
					var elAutoPgBk1Gall = document.querySelector('.auto_pg_bk1_gall');
					var el_repeatGallA = elAutoPgBk1Gall.querySelector('.repeat_js');
					el_repeatGallA.className = el_repeatGallA.className.replace('repeat_js', '');
					for (var i = 0; i < obj.length; i++) {
						var el_newLi = el_repeatLi.cloneNode(true);
						var elNewImg = el_newLi.querySelector('img');
						elNewImg.src = obj[i].smallImgUrl;
						var elA = elNewImg.parentNode;
						elNewImg.alt = obj[i].smallImgAlt;
						var el_newGallA = el_repeatGallA.cloneNode(true);
						var el_gallImg = el_newGallA.querySelector('img');
						el_gallImg.src = obj[i].middleImgUrl;
						el_gallImg.alt = obj[i].middleImgAlt;
						el_newGallA.href = obj[i].bigImgUrl;
						el_newGallA.title = obj[i].bigImgAlt;
						var parentElem_GallA = el_repeatGallA.parentNode;
						parentElem_GallA.insertBefore(el_newGallA, el_repeatGallA);
						if (!i) {
							el_newGallA.className = el_newGallA.className.replace('auto_pg_middle_img_a_hide', '');
						}
						(function (i, elAutoPgBk1Gall) {
							elA.addEventListener('click', function () {
								var arrElA = document.getElementsByClassName('auto_pg_middle_img_a');
								for (var j = 0; j < arrElA.length; j++) {
									var r_hide = new RegExp('\\b' + 'auto_pg_middle_img_a_hide' + '\\b', 'g');
									if (!r_hide.test(arrElA[j].className)) {
										arrElA[j].className = 'auto_pg_middle_img_a_hide ' + arrElA[j].className;
									}
								}
								arrElA[i].className = arrElA[i].className.replace('auto_pg_middle_img_a_hide', '');
							}, false);
						}
							(i, elAutoPgBk1Gall));
						var parentElem = el_repeatLi.parentNode;
						parentElem.insertBefore(el_newLi, el_repeatLi);
					}
					parentElem_GallA.removeChild(el_repeatGallA);
					parentElem.removeChild(el_repeatLi);
					eval(strJsScript);
				});
				objCommon.ajax('json/news/news.json', 'get', '', function (res) {
					eval(strJsScript);
					var obj = eval(res);
					var fun_addLinck = function () {
						var el_autoPgCalendarContainer = document.querySelector('.auto_pg_calendar_container');
						var el_monthYear = el_autoPgCalendarContainer.querySelector('.month_year');
						if (el_monthYear) {
							var el_hiddenInput = el_monthYear.querySelector('input');
							var arrHiddenInputValue = el_hiddenInput.value.split(' ');
							var monthNum = ~~arrHiddenInputValue[0] + 1;
							var yearNum = ~~arrHiddenInputValue[1];
						}
						var arrEl_inMonthTd = el_autoPgCalendarContainer.querySelectorAll('.in_month');
						for (var i1 = 0; i1 < arrEl_inMonthTd.length; i1++) {
							var elA = arrEl_inMonthTd[i1].querySelector('a');
							for (var i2 = 0; i2 < obj.length; i2++) {
								var arrJsonDate = obj[i2].date.split('.');
								if (monthNum == ~~arrJsonDate[1] && yearNum == arrJsonDate[2] && elA.innerHTML == ~~arrJsonDate[0]) {
									elA.style.textDecoration = 'underline';
									elA.style.color = '#000000';
									(function (linckPath) {
										elA.addEventListener('click', function () {
											location.href = linckPath;
										}, false);
									}
										(obj[i2].moreUrl));
								}
							}
						}
					};
					fun_addLinck();
					(function fun_addEventMYA() {
						var el_autoPgCalendarContainer = document.querySelector('.auto_pg_calendar_container');
						var arrEl_captionA = el_autoPgCalendarContainer.querySelectorAll('.caption a');
						for (var i = 0; i < arrEl_captionA.length; i++) {
							(function (fun_addEventMYA) {
								arrEl_captionA[i].addEventListener('click', function () {
									fun_addEventMYA();
									fun_addLinck();
								}, false);
							}
								(fun_addEventMYA));
						}
					}
						());
				});
				objCommon.ajax('json/auto/similar_offers.json', 'get', '', function (res) {
					var obj = eval(res);
					var el_similarOffersBk = document.querySelector('.similar_offers_bk');
					var el_repeat = el_similarOffersBk.querySelector('.repeat_js');
					el_repeat.className = el_repeat.className.replace('repeat_js', '');
					var parentElem = el_repeat.parentNode;
					for (var i = 0; i < obj.length; i++) {
						var el_new = el_repeat.cloneNode(true);
						var elNewImg = el_new.querySelector('img');
						elNewImg.src = obj[i].smallImgUrl;
						var elA = elNewImg.parentNode;
						elNewImg.alt = obj[i].smallImgAlt;
						elA.href = obj[i].bigImgUrl;
						elA.title = obj[i].bigImgAlt;
						var elNewName = el_new.querySelector('.bk_name_specials');
						elNewName.innerHTML = obj[i].name;
						var elNewClass = el_new.querySelector('.bk_name_specials');
						elNewName.innerHTML = obj[i].name;
						var arrElNewParam = el_new.getElementsByClassName('stock_page_txt3');
						arrElNewParam[0].innerHTML = obj[i].class;
						arrElNewParam[1].innerHTML = obj[i].bodyType;
						arrElNewParam[2].innerHTML = obj[i].numberOfSeats;
						arrElNewParam[3].innerHTML = obj[i].cost;
						var elBtn = el_new.querySelector('.similar_offers_btn');
						elBtn.href = obj[i].hrefUrl;
						parentElem.insertBefore(el_new, el_repeat);
					}
					parentElem.removeChild(el_repeat);
					eval(strJsScript);
				});
			}, strUrlData);
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function rentPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ Результаты поиска \\ <span class="font5_1">Авто</span>';
		}
		var el = document.querySelector('.auto_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/auto_box.html', 'auto_box_ajax', function () {
				eval(strJsScript);
			});
		}
		var el = document.querySelector('.rent_box');
		var fun_fixed_true = function () {
			var el1 = document.querySelector('.wr_black_translucent');
			var el2 = document.querySelector('.wr_tb');
			if (440 > el1.offsetWidth || 550 > el1.offsetHeight) {
				var el_wr_tb = document.querySelector('.wr_tb');
				el_wr_tb.style.position = 'absolute';
				el_wr_tb.style.height = 'auto';
				el_wr_tb.style.width = 'auto';
				el2.style.position = 'absolute';
				document.documentElement.scrollTop = 0;
				document.documentElement.scrollLeft = 0;
			}
		};
		if (el) {
			el.style.position = 'absolute';
			el.style.left = '0px';
			el.style.top = '0px';
			var el1 = document.querySelector('.wr_black_translucent');
			el1.style.position = 'fixed';
			el1.style.left = '0px';
			el1.style.top = '0px';
			var el2 = document.querySelector('.wr_tb');
			el2.style.position = 'fixed';
			el2.style.left = '0px';
			el2.style.top = '0px';
			var el_divAlert1 = document.querySelector('.div_alert_1');
			fun_fixed_true();
		} else {
			objCommon.replaceAjaxElem('partials/rent_box.html', 'rent_box_ajax', function () {
				eval(strJsScript);
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function contactPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ <span class="font5_1">Контакты</span>';
		}
		var el = document.querySelector('.contact_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/contact_box.html', 'contact_box_ajax', function () {
				eval(strJsScript);
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function newsDetailsPgController(strUrlData) {
		hideAllPgBox();
		var el = document.querySelector('.news_details_box');
		if (el) {
			el.className = 'news_details_box_ajax ' + el.className;
		} {
			objCommon.replaceAjaxElem('partials/news_details_box.html', 'news_details_box_ajax', function () {
				objCommon.ajax('json/news_details/news_details.json', 'get', '', function (res) {
					eval('var obj0 = ' + res + '; ');
					var el = document.querySelector('.js_path_name');
					if (el) {
						el.innerHTML = 'Главная \\ Новости \\ <span class="font5_1">' + obj0.name + '</span>';
					}
					var el_newsDetailsBox = document.querySelector('.news_details_box');
					var el_newsTitleDetails = el_newsDetailsBox.querySelector('.news_title_details');
					el_newsTitleDetails.innerHTML = obj0.name;
					var el_date = el_newsDetailsBox.querySelector('.news_date .date');
					el_date.innerHTML = obj0.date;
					var el_newsText = el_newsDetailsBox.querySelector('.news_text');
					el_newsText.innerHTML = obj0.txt;
					var obj = obj0.imgs;
					var el_repeat = el_newsDetailsBox.querySelector('.repeat_js');
					el_repeat.className = el_repeat.className.replace('repeat_js', '');
					var parentElem = el_repeat.parentNode;
					for (var i = 0; i < obj.length; i++) {
						var el_new = el_repeat.cloneNode(true);
						var elNewImg = el_new.querySelector('img');
						elNewImg.src = obj[i].smallImgUrl;
						var elA = elNewImg.parentNode;
						elNewImg.alt = obj[i].smallImgAlt;
						elA.href = obj[i].bigImgUrl;
						elA.title = obj[i].bigImgAlt;
						parentElem.insertBefore(el_new, el_repeat);
					}
					parentElem.removeChild(el_repeat);
					eval(strJsScript);
				});
				objCommon.ajax('json/news_details/read_also.json', 'get', '', function (res) {
					eval('var obj = ' + res + '; ');
					var el_sldrNewsDetails = document.querySelector('.content_sldr_news_details');
					var el_repeat = el_sldrNewsDetails.querySelector('.repeat_js');
					el_repeat.className = el_repeat.className.replace('repeat_js', '');
					var parentElem = el_repeat.parentNode;
					for (var i = 0; i < obj.length; i++) {
						var el_new = el_repeat.cloneNode(true);
						var elNewImg = el_new.querySelector('img');
						elNewImg.src = obj[i].imgUrl;
						var elA = elNewImg.parentNode;
						elNewImg.alt = obj[i].imgAlt;
						var elDate = el_new.querySelector('.font12');
						elDate.innerHTML = obj[i].date;
						elA.href = obj[i].hrefUrl;
						parentElem.insertBefore(el_new, el_repeat);
					}
					parentElem.removeChild(el_repeat);
					eval(strJsScript);
				});
			}, strUrlData);
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function personalAreaFavoritesPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ Личный кабинет \\ <span class="font5_1">Избранное</span>';
		}
		var el = document.querySelector('.personal_area_favorites_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/personal_area_favorites_box.html', 'personal_area_favorites_box_ajax', function () {
				objCommon.ajax('json/personal_area/favorites.json', 'get', '', function (res) {
					eval('var obj = ' + res + '; ');
					var showNum = 3;
					var el_personalAreaFavoritesBox = document.querySelector('.personal_area_favorites_box');
					var el_displayBy = el_personalAreaFavoritesBox.querySelector('.display_by');
					if (el_displayBy) {
						var el_displayByAActive = el_personalAreaFavoritesBox.querySelector('.display_by_a_active');
						showNum = el_displayByAActive.innerHTML;
					}
					var el_repeat = el_personalAreaFavoritesBox.querySelector('.selected_offers_sub_bk');
					el_repeat.className = el_repeat.className.replace('repeat_js', '');
					var parentElem = el_repeat.parentNode;
					for (var i = 0; i < obj.length; i++) {
						var el_newRepeat = el_repeat.cloneNode(true);
						var elName = el_newRepeat.querySelector('.font30');
						elName.innerHTML = obj[i].name;
						var elNewImg = el_newRepeat.querySelector('img');
						elNewImg.src = obj[i].smallImgUrl;
						elNewImg.alt = obj[i].smallImgAlt;
						var elA = elNewImg.parentNode;
						elA.href = obj[i].bigImgUrl;
						elA.title = obj[i].bigImgAlt;
						var elPrice = el_newRepeat.querySelector('.font32');
						elPrice.innerHTML = obj[i].price;
						var elNewText = el_newRepeat.querySelector('.personal_area_favorites_txt');
						elNewText.innerHTML = obj[i].txt;
						var elNew_rentBtn = el_newRepeat.querySelector('.btn_rent');
						elNew_rentBtn.href = obj[i].btnHref;
						if (i >= showNum) {
							el_newRepeat.style.display = 'none';
						}
						parentElem.insertBefore(el_newRepeat, el_repeat);
					}
					parentElem.removeChild(el_repeat);
					var el_favoritesBox = document.querySelector('.personal_area_favorites_box');
					var el_sldr = el_favoritesBox.querySelector('.personal_area_favorites_sldr');
					var el_repeat = el_sldr.querySelector('.repeat_js');
					el_repeat.className = el_repeat.className.replace('repeat_js', '');
					var parentElem = el_repeat.parentNode;
					var countPg = Math.ceil(obj.length / showNum);
					for (var i = 0; i < countPg; i++) {
						var el_newRepeat = el_repeat.cloneNode(true);
						var elA = el_newRepeat.querySelector('a');
						if (!i) {
							elA.className = 'a_num_active ' + elA.className;
						}
						elA.innerHTML = i + 1;
						parentElem.insertBefore(el_newRepeat, el_repeat);
					}
					parentElem.removeChild(el_repeat);
					eval(strJsScript);
				});
			});
		}
	}
	function personalAreaHistoryPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ Личный кабинет \\ <span class="font5_1">История</span>';
		}
		var el = document.querySelector('.personal_area_history_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/personal_area_history_box.html', 'personal_area_history_box_ajax', function () {
				objCommon.ajax('json/personal_area/history.json', 'get', '', function (res) {
					eval('var obj = ' + res + '; ');
				});
			});
		}
	}
	function personalAreaOrdersPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ Личный кабинет \\ <span class="font5_1">Заказы</span>';
		}
		var el = document.querySelector('.personal_area_orders_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/personal_area_orders_box.html', 'personal_area_orders_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function personalAreaSettingsPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ Личный кабинет \\ <span class="font5_1">Настройки</span>';
		}
		var el = document.querySelector('.personal_area_settings_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/personal_area_settings_box.html', 'personal_area_settings_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function questionPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная';
		}
		var el = document.querySelector('.question_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/question_box.html', 'question_box_ajax', function () {
				eval(strJsScript);
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function resultsPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная';
		}
		var el = document.querySelector('.results_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/results_box.html', 'results_box_ajax', function () {
				eval(strJsScript);
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function reviewsPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ <span class="font5_1">Отзывы</span>';
		}
		var el = document.querySelector('.reviews_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/reviews_box.html', 'reviews_box_ajax', function () {
				eval(strJsScript);
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function servicesPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ <span class="font5_1">Услуги</span>';
		}
		var el = document.querySelector('.services_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/services_box.html', 'services_box_ajax', function () {
				eval(strJsScript);
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
	function stockPgController() {
		hideAllPgBox();
		var el = document.querySelector('.js_path_name');
		if (el) {
			el.innerHTML = 'Главная \\ <span class="font5_1">Акции</span>';
		}
		var el = document.querySelector('.stock_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/stock_box.html', 'stock_box_ajax', function () {
				eval(strJsScript);
			});
		}
		var el = document.querySelector('.filter_box');
		if (el) {
			el.style.position = 'relative';
			el.style.left = '0px';
			el.style.top = '0px';
		} else {
			objCommon.replaceAjaxElem('partials/filter_box.html', 'filter_box_ajax', function () {
				eval(strJsScript);
			});
		}
	}
}
	(function () {
		var objCommon = {};
		objCommon.ajax = function (url, type, data, callbackFun) {
			var xmlHttp = false;
			try {
				xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e2) {
					xmlHttp = false;
				}
			}
			if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
				xmlHttp = new XMLHttpRequest();
			}
			(function () {
				if (type.toUpperCase() == 'POST') {
					xmlHttp.open('POST', url, true);
					xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xmlHttp.onreadystatechange = updatePage;
					xmlHttp.send(data);
				}
				if (type.toUpperCase() == 'GET') {
					if (data && data.length) {
						xmlHttp.open("GET", url + '?' + data, true);
					} else {
						xmlHttp.open("GET", url, true);
					}
					xmlHttp.onreadystatechange = updatePage;
					xmlHttp.send(null);
				}
			}
				());
			function updatePage() {
				if (xmlHttp.readyState == 4) {
					var expression = xmlHttp.responseText;
					callbackFun(expression);
				}
			}
		};
		objCommon.replaceAjaxElem = function (strPath, strClassName, callbackFun, strUrlData) {
			if (typeof strUrlData == 'undefined') {
				strUrlData = '';
			}
			objCommon.ajax(strPath, 'get', strUrlData, function (res) {
				var fl = false;
				var arrEl = document.getElementsByClassName(strClassName);
				for (var i = 0; i < arrEl.length; i++) {
					arrEl[i].outerHTML = res;
					fl = true;
				}
				if (fl) {
					callbackFun();
				}
			});
		};
		return objCommon;
	}
		()));
