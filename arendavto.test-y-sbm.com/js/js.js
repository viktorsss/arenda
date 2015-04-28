(function (objCommon) {
	function scriptDoneCheck(elem, strScriptDoneClass) {
		if (typeof strScriptDoneClass == 'undefined') {
			var strScriptDoneClass = 'script_done';
		}
		var rScriptDone = new RegExp('\\b' + strScriptDoneClass + '\\b', 'g');
		if (rScriptDone.test(elem.className)) {
			return true;
		}
		elem.className = strScriptDoneClass + ' ' + elem.className;
		return false;
	}
	(function () {
		objCommon.addPressedState('fl_i', 'fl_down');
		var arrEl = document.getElementsByClassName('fl_i');
		for (var i = 0; i < arrEl.length; i++) {
			(function () {
				if (scriptDoneCheck(arrEl[i]))
					return;
				objCommon.addEvent(arrEl[i], 'click', function () {
					for (var j = 0; j < arrEl.length; j++) {
						arrEl[j].className = arrEl[j].className.replace('fl_active', '');
					}
					this.className = 'fl_active' + ' ' + this.className;
				});
			}
				());
		}
	}
		());
	(function () {
		objCommon.addPressedState('menu_item', 'menu_item_down');
		var arrEl = document.getElementsByClassName('menu_item');
		for (var i = 0; i < arrEl.length; i++) {
			(function () {
				if (scriptDoneCheck(arrEl[i]))
					return;
				objCommon.addEvent(arrEl[i], 'click', function () {
					for (var j = 0; j < arrEl.length; j++) {
						arrEl[j].className = arrEl[j].className.replace('menu_item_active', '');
					}
					this.className = 'menu_item_active' + ' ' + this.className;
				});
			}
				());
		}
	}
		());
	objCommon.addPressedState('btn_to_order', 'btn_to_order_down');
	(function () {
		var arrElem_inputCalendar = document.getElementsByClassName('input_calendar');
		for (var i = 0; i < arrElem_inputCalendar.length; i++) {
			(function () {
				if (scriptDoneCheck(arrElem_inputCalendar[i]))
					return;
				var date = new Date();
				var dd = '' + date.getDate();
				if (dd.length < 2) {
					dd = '0' + dd;
				}
				var mm = '' + (date.getMonth() + 1);
				if (mm.length < 2) {
					mm = '0' + mm;
				}
				var yy = ('' + date.getFullYear()).slice(-2);
				var strResult = dd + '.' + mm + '.' + yy;
				arrElem_inputCalendar[i].value = strResult;
			}
				());
		}
	}
		());
	var createCalendar = function (elem_cal_placeholder, elem_input_date, funCallBack) {
		if (!fcp)
			var fcp = new Object();
		if (!fcp.msg)
			fcp.msg = new Object();
		if (!fcp)
			var fcp = new Object();
		if (!fcp.msg)
			fcp.msg = new Object();
		fcp.week_days = ["Пн", "Вт", "Ср", "Чт", "Пн", "Сб", "Вс"];
		fcp.months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
		fcp.msg.prev_year = "предыдущий год";
		fcp.msg.prev_month = "предыдущий месяц";
		fcp.msg.next_month = "следующий месяц";
		fcp.msg.next_year = "следующий год";
		fcp.Calendar = function (element, show_clock) {
			if (!element.childNodes)
				throw "HTML element expected";
			this.element = element;
			this.selection = new Date();
			this.show_clock = show_clock;
			this.selected_cell = undefined;
			this.generate_month();
			this.render_calendar();
		};
		fcp.Calendar.prototype.set_date_time = function (date_time) {
			if (date_time.constructor == Date) {
				this.selection = date_time;
				this.generate_month();
				this.render_calendar();
			} else {
				throw "Date object expected (in fcp.Calendar.set_date_time)";
			}
		};
		fcp.Calendar.prototype.next_month = function () {
			var month = this.selection.getMonth();
			if (month == 11) {
				this.selection.setMonth(0);
				this.selection.setYear(this.selection.getFullYear() + 1);
			} else {
				this.selection.setMonth(month + 1);
			}
			this.generate_month();
			this.render_calendar();
		};
		fcp.Calendar.prototype.prev_month = function () {
			var month = this.selection.getMonth();
			if (month == 0) {
				this.selection.setMonth(11);
				this.selection.setYear(this.selection.getFullYear() - 1);
			} else {
				this.selection.setMonth(month - 1);
			}
			this.generate_month();
			this.render_calendar();
		};
		fcp.Calendar.prototype.next_year = function () {
			var is_feb29 = (this.selection.getMonth() == 1) && (this.selection.getDate() == 29);
			if (is_feb29) {
				this.selection.setDate(1);
				this.selection.setMonth(2);
			}
			this.selection.setFullYear(this.selection.getFullYear() + 1);
			this.generate_month();
			this.render_calendar();
		};
		fcp.Calendar.prototype.prev_year = function () {
			var is_feb29 = (this.selection.getMonth() == 1) && (this.selection.getDate() == 29);
			if (is_feb29) {
				this.selection.setDate(1);
				this.selection.setMonth(2);
			}
			this.selection.setFullYear(this.selection.getFullYear() - 1);
			this.generate_month();
			this.render_calendar();
		};
		fcp.Calendar.prototype.generate_month = function () {
			this.raw_data = new Array();
			var week = 0;
			this.raw_data[week] = new Array(7);
			var first_of_month = fcp.Calendar.clone_date(this.selection);
			first_of_month.setDate(1);
			var first_weekday = first_of_month.getDay();
			first_weekday = (first_weekday == 0) ? 6 : first_weekday - 1;
			for (var i = 0; i < first_weekday; i++) {
				this.raw_data[week][i] = 0;
			}
			var last_of_month = fcp.Calendar.days_in_month(this.selection.getYear(), this.selection.getMonth());
			var weekday = first_weekday;
			for (var i = 1; i <= last_of_month; i++) {
				this.raw_data[week][weekday] = i;
				weekday++;
				if (weekday > 6) {
					weekday = 0;
					week++;
					this.raw_data[week] = new Array(7);
				}
			}
			for (var i = weekday; i < 7; i++) {
				this.raw_data[week][i] = 0;
			}
		};
		fcp.Calendar.prototype.render_calendar = function () {
			this.element.selected_cell = undefined;
			this.element.innerHTML = "";
			this.element.appendChild(this.render_month());
		};
		fcp.Calendar.prototype.render_heading = function () {
			var heading = document.createElement("td");
			heading.className = 'caption';
			heading.colSpan = 7;
			var prev_year = document.createElement("a");
			prev_year.href = "#";
			prev_year.calendar = this;
			prev_year.onclick = function () {
				this.calendar.prev_year();
				return false;
			};
			prev_year.innerHTML = "<<";
			prev_year.title = fcp.msg.prev_year;
			var prev_month = document.createElement("a");
			prev_month.href = "#";
			prev_month.calendar = this;
			prev_month.onclick = function () {
				this.calendar.prev_month();
				return false;
			};
			prev_month.innerHTML = "<";
			prev_month.title = fcp.msg.prev_month;
			var month_year = document.createTextNode(fcp.months[this.selection.getMonth()] + " " + this.selection.getFullYear());
			var next_month = document.createElement("a");
			next_month.href = "#";
			next_month.calendar = this;
			next_month.onclick = function () {
				this.calendar.next_month();
				return false;
			};
			next_month.innerHTML = ">";
			next_month.title = fcp.msg.next_month;
			var next_year = document.createElement("a");
			next_year.href = "#";
			next_year.calendar = this;
			next_year.onclick = function () {
				this.calendar.next_year();
				return false;
			};
			next_year.innerHTML = ">>";
			next_year.title = fcp.msg.next_year;
			heading.appendChild(prev_year);
			heading.appendChild(document.createTextNode("\u00a0"));
			heading.appendChild(prev_month);
			var elemSpan = document.createElement("span");
			var elemInput = document.createElement("input");
			elemInput.type = 'hidden';
			elemInput.value = this.selection.getMonth() + ' ' + this.selection.getFullYear();
			elemSpan.appendChild(elemInput);
			elemSpan.appendChild(month_year);
			elemSpan.className = 'month_year';
			heading.appendChild(elemSpan);
			heading.appendChild(next_month);
			heading.appendChild(document.createTextNode("\u00a0"));
			heading.appendChild(next_year);
			var elemTr = document.createElement("tr");
			elemTr.appendChild(heading);
			return heading;
		};
		fcp.Calendar.prototype.render_month = function () {
			var html_month = document.createElement("table");
			html_month.className = "calendar";
			html_month.appendChild(this.render_heading());
			var tr = document.createElement("tr");
			for (var i = 0; i < fcp.week_days.length; i++) {
				var th = document.createElement("th");
				th.innerHTML = fcp.week_days[i];
				if (i == 5 || i == 6)
					th.className = 'th_day_off';
				tr.appendChild(th);
			}
			html_month.appendChild(tr);
			for (var i = 0; i < this.raw_data.length; i++) {
				html_month.appendChild(this.render_week(this.raw_data[i]));
			}
			return html_month;
		};
		fcp.Calendar.prototype.render_week = function (day_numbers) {
			var html_week = document.createElement("tr");
			html_week.align = "right";
			for (var i = 0; i < 7; i++) {
				var td = this.render_day(day_numbers[i]);
				if ((i == 5 || i == 6) && /in_month/.test(td.className)) {
					td.className += ' day_off';
				}
				html_week.appendChild(td);
			}
			return html_week;
		};
		fcp.Calendar.prototype.render_day = function (day_number) {
			var td = document.createElement("td");
			if (day_number >= 1 && day_number <= 31) {
				var anchor = document.createElement("a");
				anchor.href = "#";
				anchor.innerHTML = day_number;
				anchor.calendar = this;
				anchor.date = day_number;
				anchor.onclick = fcp.Calendar.handle_select;
				td.appendChild(anchor);
				if (day_number == this.selection.getDate()) {
					this.selected_cell = td;
					td.className = "in_month selected";
				} else {
					td.className = "in_month";
				}
			}
			return td;
		};
		fcp.Calendar.prototype.onselect = function () {};
		fcp.Calendar.clone_date = function (date_obj) {
			if (date_obj.constructor != Date)
				throw "Date object expected (in fcp.Calendar.clone_date)";
			else
				return new Date(date_obj.getFullYear(), date_obj.getMonth(), date_obj.getDate(), date_obj.getHours(), date_obj.getMinutes(), date_obj.getSeconds());
		};
		fcp.Calendar.days_in_month = function (year, month) {
			if (month < 0 || month > 11)
				throw "Month must be between 0 and 11";
			var day_count = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
			if (month != 1) {
				return day_count[month];
			} else if ((year % 4) != 0) {
				return 28;
			} else if ((year % 400) == 0) {
				return 29;
			} else if ((year % 100) == 0) {
				return 28;
			} else {
				return 29;
			}
		};
		fcp.Calendar.handle_select = function () {
			if (this.calendar.selected_cell) {
				var elemOut = this.calendar.selected_cell;
				elemOut.className = elemOut.className.replace('selected', '');
			}
			this.calendar.selected_cell = this.parentNode;
			var elemSelected = this.parentNode;
			elemSelected.className = "selected " + elemSelected.className;
			this.calendar.selection.setDate(this.date);
			this.calendar.onselect(this.calendar.selection);
			return false;
		};
		cal = new fcp.Calendar(elem_cal_placeholder);
		cal.onselect = function (date) {
			var dd = '' + date.getDate();
			if (dd.length < 2) {
				dd = '0' + dd;
			}
			var mm = '' + (date.getMonth() + 1);
			if (mm.length < 2) {
				mm = '0' + mm;
			}
			var yy = ('' + date.getFullYear()).slice(-2);
			var strResult = dd + '.' + mm + '.' + yy;
			if (elem_input_date) {
				elem_input_date.value = strResult;
			}
			if (typeof(funCallBack) != "undefined") {
				funCallBack();
			}
		};
	};
	(function () {
		var arrEl_dropDownCalendar = document.getElementsByClassName('drop_down_calendar');
		for (var i = 0; i < arrEl_dropDownCalendar.length; i++) {
			(function (elemDropDownCalendar, elResponse) {
				if (scriptDoneCheck(elemDropDownCalendar))
					return;
				objCommon.addEvent(elemDropDownCalendar, 'mouseover', function () {
					elResponse.className = 'calendar_field_of_response_hover ' + elResponse.className;
				});
				objCommon.addEvent(elemDropDownCalendar, 'mouseout', function () {
					var r = new RegExp('\\b' + 'calendar_field_of_response_hover' + '\\b', 'g');
					elResponse.className = elResponse.className.replace(r, '');
				});
				var elemCalendarContainer = elemDropDownCalendar.querySelector('.calendar_container');
				if (elemCalendarContainer) {
					(function (elemCalendarContainer) {
						objCommon.addEvent(document.body, 'click', function () {
							elemCalendarContainer.className = elemCalendarContainer.className.replace('calendar_container_show', '');
						});
					}
						(elemCalendarContainer));
					objCommon.addEvent(elemCalendarContainer, 'click', function (evt) {
						evt.cancelBubble = true;
					});
					var elemInputCalendar = elemCalendarContainer.parentNode.querySelector('.input_calendar');
					(function (elemCalendarContainer) {
						createCalendar(elemCalendarContainer, elemInputCalendar, function () {
							elemCalendarContainer.className = elemCalendarContainer.className.replace('calendar_container_show', '');
						});
					}
						(elemCalendarContainer));
					(function (elemCalendarContainer) {
						objCommon.addEvent(elemDropDownCalendar, 'click', function () {
							if (elemCalendarContainer) {
								if (!elemCalendarContainer.offsetHeight) {
									setTimeout(function () {
										elemCalendarContainer.className += ' calendar_container_show';
									}, 0);
								} else {
									elemCalendarContainer.className = elemCalendarContainer.className.replace('calendar_container_show', '');
								}
							}
						});
					}
						(elemCalendarContainer));
				}
			}
				(arrEl_dropDownCalendar[i], arrEl_dropDownCalendar[i].querySelector('.calendar_field_of_response')));
		}
	}
		());
	(function () {
		var elem_priceRound = document.querySelector('.price_round');
		if (!elem_priceRound) {
			return;
		}
		if (scriptDoneCheck(elem_priceRound))
			return;
		var numberMultiplicityRounding = parseInt(elem_priceRound.value);
		var pageX;
		var dX;
		var xMousedown;
		var fl_enableMove_elemArrow = false;
		var numberLeftStyle_elemArrow;
		var elemMove;
		var numElemMove;
		var xMin;
		var xLeftSl;
		var xRightSl;
		var xMax;
		var zIndexCurent = 0;
		var elem_areaOfSlider = document.querySelector('.area_of_slider');
		if (!elem_areaOfSlider) {
			return;
		}
		var elem_inputMinPrice = elem_areaOfSlider.querySelector('.min_price');
		var elem_inputMaxPrice = elem_areaOfSlider.querySelector('.max_price');
		var elem_inputMinPriceCurrent = elem_areaOfSlider.querySelector('.min_price_current');
		var elem_inputMaxPriceCurrent = elem_areaOfSlider.querySelector('.max_price_current');
		if (!elem_inputMinPrice || !elem_inputMaxPrice || !elem_inputMinPriceCurrent || !elem_inputMaxPriceCurrent) {
			return;
		}
		var minPrice = elem_inputMinPrice.value;
		var maxPrice = elem_inputMaxPrice.value;
		var fun_elemArrowMousedown = function (elem_regionActionsSl, i) {
			elemMove = elem_regionActionsSl;
			elemMove.style.zIndex = ++zIndexCurent;
			objCommon.disableSelection();
			numberLeftStyle_elemArrow = elem_regionActionsSl.offsetLeft;
			dX = 0;
			xMousedown = pageX;
			fl_enableMove_elemArrow = true;
			numElemMove = i;
			for (var i = 0; i < arrElem_lightingArea.length; i++) {
				arrElem_lightingArea[i].className = 'lighting_area_move ' + arrElem_lightingArea[i].className;
			}
		};
		var fun_documentMouseup = function () {
			objCommon.enableSelection();
			fl_enableMove_elemArrow = false;
			if (elemMove) {
				if (!numElemMove) {
					xLeftSl = elemMove.offsetLeft;
				} else {
					xRightSl = elemMove.offsetLeft;
				}
			}
			if (arrElem_lightingArea) {
				for (var i = 0; i < arrElem_lightingArea.length; i++) {
					arrElem_lightingArea[i].className = arrElem_lightingArea[i].className.replace('lighting_area_move', '');
				}
			}
		};
		objCommon.addEvent(document, 'mouseup', fun_documentMouseup);
		var arrElem_areaOfSlider = document.getElementsByClassName('area_of_slider');
		var arrElem_sliderValue = document.getElementsByClassName('slider_value');
		for (var i = 0; i < arrElem_areaOfSlider.length; i++) {
			var arrElem_lightingArea = arrElem_areaOfSlider[i].getElementsByClassName('lighting_area');
			(function (arrElem_lightingArea) {
				objCommon.addEvent(arrElem_areaOfSlider[i], 'mouseover', function () {
					for (var i = 0; i < arrElem_lightingArea.length; i++) {
						arrElem_lightingArea[i].className = 'lighting_area_show ' + arrElem_lightingArea[i].className;
					}
				});
				objCommon.addEvent(arrElem_areaOfSlider[i], 'mouseout', function () {
					for (var i = 0; i < arrElem_lightingArea.length; i++) {
						arrElem_lightingArea[i].className = arrElem_lightingArea[i].className.replace('lighting_area_show', '');
					}
				});
			}
				(arrElem_lightingArea));
			var arrElem_regionActionsSl = arrElem_areaOfSlider[i].getElementsByClassName('region_actions_sl');
			var elemRange = arrElem_areaOfSlider[i].querySelector('.range');
			if (elemRange && arrElem_regionActionsSl.length) {
				xMin = 2 - arrElem_regionActionsSl[0].offsetWidth / 2;
				xMax = elemRange.offsetWidth - arrElem_regionActionsSl[0].offsetWidth / 2 - 4;
			}
			var price_1px = (maxPrice - minPrice) / (xMax - xMin);
			arrElem_regionActionsSl[0].style.left = Math.round((elem_inputMinPriceCurrent.value - minPrice) / price_1px + xMin) + 'px';
			arrElem_regionActionsSl[1].style.left = Math.round((elem_inputMaxPriceCurrent.value - minPrice) / price_1px + xMin) + 'px';
			arrElem_sliderValue[0].innerHTML = elem_inputMinPriceCurrent.value;
			arrElem_sliderValue[1].innerHTML = elem_inputMaxPriceCurrent.value;
			for (var i1 = 0; i1 < arrElem_regionActionsSl.length; i1++) {
				if (!i1) {
					var xLeftSl = arrElem_regionActionsSl[i1].offsetLeft;
				} else {
					var xRightSl = arrElem_regionActionsSl[i1].offsetLeft;
				}
				var elemLighting = arrElem_regionActionsSl[i1].querySelector('.lighting_area');
				if (elemLighting) {
					(function (elem_regionActionsSl, elemLighting) {
						objCommon.addEvent(elem_regionActionsSl, 'mouseover', function () {
							elemLighting.className = 'lighting_area_hover ' + elemLighting.className;
						});
						objCommon.addEvent(elem_regionActionsSl, 'mouseout', function () {
							elemLighting.className = elemLighting.className.replace('lighting_area_hover', '');
						});
					}
						(arrElem_regionActionsSl[i1], elemLighting));
				}
				(function (elem_regionActionsSl, i) {
					objCommon.addEvent(elem_regionActionsSl, 'mousedown', function () {
						fun_elemArrowMousedown(elem_regionActionsSl, i);
					});
				}
					(arrElem_regionActionsSl[i1], i1));
			}
		}
		var fun_move = function (event) {
			var coordinatesMouse = objCommon.updateInfo(event);
			pageX = coordinatesMouse.x;
			dX = coordinatesMouse.x - xMousedown;
			if (fl_enableMove_elemArrow) {
				var xNew = numberLeftStyle_elemArrow + dX;
				var xMinCurent;
				var xMaxCurent;
				if (!numElemMove) {
					xMinCurent = xMin;
					xMaxCurent = xRightSl;
				} else {
					xMinCurent = xLeftSl;
					xMaxCurent = xMax;
				}
				if (xNew > xMinCurent && xNew < xMaxCurent) {
					elemMove.style.left = xNew + 'px';
					arrElem_sliderValue[numElemMove].innerHTML = objCommon.funRound((xNew - xMin) * price_1px + parseInt(minPrice), numberMultiplicityRounding);
				} else if (xNew < xMinCurent) {
					elemMove.style.left = xMinCurent + 'px';
					arrElem_sliderValue[numElemMove].innerHTML = objCommon.funRound((xMinCurent - xMin) * price_1px + parseInt(minPrice), numberMultiplicityRounding);
				} else if (xNew > xMaxCurent) {
					elemMove.style.left = xMaxCurent + 'px';
					arrElem_sliderValue[numElemMove].innerHTML = objCommon.funRound((xMaxCurent - xMin) * price_1px + parseInt(minPrice), numberMultiplicityRounding);
				}
				arrElem_sliderValue[0].style.left = '0px';
				arrElem_sliderValue[1].style.left = '0px';
				arrElem_sliderValue[1].style.display = 'inline-block';
				var pos_1 = objCommon.getElementPosition(arrElem_sliderValue[0]);
				var pos_2 = objCommon.getElementPosition(arrElem_sliderValue[1]);
				if (pos_1.left + pos_1.width > pos_2.left) {
					if (arrElem_sliderValue[0].innerHTML == arrElem_sliderValue[1].innerHTML) {
						arrElem_sliderValue[1].style.display = 'none';
					} else {
						var d = Math.round((pos_1.left + pos_1.width - pos_2.left) / 2);
						arrElem_sliderValue[0].style.left = '-' + d + 'px';
						arrElem_sliderValue[1].style.left = d + 'px';
					}
				}
			}
		};
		objCommon.addEvent(document, 'mousemove', fun_move);
	}
		());
	(function () {
		var elem_bkSldr = document.querySelector('.bk_sldr');
		if (!elem_bkSldr) {
			return;
		}
		if (scriptDoneCheck(elem_bkSldr))
			return;
		var numSlCurrent = 0;
		var timeOfAnimation = 1500;
		var flAnimation = false;
		objCommon.addPressedState('btn_sldr_left', 'btn_sldr_left_down');
		objCommon.addPressedState('btn_sldr_right', 'btn_sldr_right_down');
		var elem_sldr = document.querySelector('.sldr');
		if (!elem_sldr) {
			return;
		}
		var arrLiTemp = elem_sldr.childNodes;
		var arrLi = [];
		for (var i = 0; i < arrLiTemp.length; i++) {
			if (arrLiTemp[i].innerHTML) {
				arrLi.push(arrLiTemp[i]);
				arrLiTemp[i].style.left = '-10000px';
			}
		}
		var countSlAll = arrLi.length;
		if (countSlAll == 1) {
			var elem_btnSldrLeft = document.querySelector('.btn_sldr_left');
			if (elem_btnSldrLeft) {
				elem_btnSldrLeft.style.display = 'none';
			}
			var elem_btnSldrRight = document.querySelector('.btn_sldr_right');
			if (elem_btnSldrRight) {
				elem_btnSldrRight.style.display = 'none';
			}
			var elem_sldrLlistItem = document.querySelector('.sldr_list_item');
			if (elem_sldrLlistItem) {
				elem_sldrLlistItem.style.display = 'none';
			}
		}
		var objShowElem = {};
		var fun_objParalInfo = function (numElemLi) {
			var obj = {};
			var arrElem = arrLi[numElemLi].getElementsByTagName('*');
			var arrEl_layer = [];
			var arr_layerNum = [];
			var arr_xLReal = [];
			for (var i = 0; i < arrElem.length; i++) {
				var arr_classListCurrent = arrElem[i].className.split(' ');
				for (var i1 = 0; i1 < arr_classListCurrent.length; i1++) {
					if (/sldr_layer-\d+/g.test(arr_classListCurrent[i1])) {
						arrEl_layer.push(arrElem[i]);
						arr_xLReal.push(arrElem[i].offsetLeft);
						arr_layerNum.push('' + /\d+/.exec(arr_classListCurrent[i1]));
					}
				}
			}
			var minNum = Math.min.apply(Math, arr_layerNum);
			var arr_k = [];
			for (var i = 0; i < arr_layerNum.length; i++) {
				arr_k.push(arr_layerNum[i] / minNum);
			}
			obj.arrEl_layer = arrEl_layer;
			obj.arr_xLReal = arr_xLReal;
			obj.arr_k = arr_k;
			return obj;
		};
		for (var i = 0; i < arrLi.length; i++) {
			objShowElem[i] = fun_objParalInfo(i);
		}
		var elem_sldrCircle = document.querySelector('.sldr_list_item');
		var elemBkSerialNumber = elem_sldrCircle.parentNode;
		var newElem_sldrCircle = elem_sldrCircle.cloneNode(true);
		elemBkSerialNumber.removeChild(elem_sldrCircle);
		for (var i = 0; i < countSlAll; i++) {
			var newElem_sldrCircleIns = newElem_sldrCircle.cloneNode(true);
			if (!i) {
				newElem_sldrCircleIns.className = 'sldr_list_item_active ' + newElem_sldrCircleIns.className;
			}
			elemBkSerialNumber.appendChild(newElem_sldrCircleIns);
		}
		var arrElem_sldrCircle = elemBkSerialNumber.getElementsByClassName('sldr_list_item');
		arrLi[0].style.left = '0px';
		var widthLi = arrLi[0].offsetWidth;
		var elem_btnSldrLeft = elem_bkSldr.querySelector('.btn_sldr_left');
		var elem_btnSldrRight = elem_bkSldr.querySelector('.btn_sldr_right');
		objCommon.addEvent(elem_btnSldrLeft, 'click', function () {
			if (flAnimation) {
				return;
			} else {
				flAnimation = true;
			}
			var numElem_1 = numSlCurrent;
			numSlCurrent--;
			if (numSlCurrent < 0) {
				numSlCurrent = countSlAll - 1;
			}
			var numElem_2 = numSlCurrent;
			objCommon.fun_animation(0, widthLi, timeOfAnimation, function (x) {
				arrLi[numElem_1].style.left = x + 'px';
				arrLi[numElem_2].style.left = x - widthLi + 'px';
				for (var i = 0; i < objShowElem[numElem_1]['arrEl_layer'].length; i++) {
					objShowElem[numElem_1]['arrEl_layer'][i].style.left = objShowElem[numElem_1]['arr_xLReal'][i] + (objShowElem[numElem_1]['arr_k'][i] - 1) * x + 'px';
				}
				for (var i = 0; i < objShowElem[numElem_2]['arrEl_layer'].length; i++) {
					objShowElem[numElem_2]['arrEl_layer'][i].style.left = objShowElem[numElem_2]['arr_xLReal'][i] + (objShowElem[numElem_2]['arr_k'][i] - 1) * (x - widthLi) + 'px';
				}
			}, function () {
				flAnimation = false;
				arrElem_sldrCircle[numElem_1].className = arrElem_sldrCircle[numElem_1].className.replace('sldr_list_item_active', '');
				arrElem_sldrCircle[numElem_2].className = 'sldr_list_item_active ' + arrElem_sldrCircle[numElem_2].className;
			});
		});
		objCommon.addEvent(elem_btnSldrRight, 'click', function () {
			if (flAnimation) {
				return;
			} else {
				flAnimation = true;
			}
			var numElem_1 = numSlCurrent;
			numSlCurrent++;
			if (numSlCurrent >= countSlAll) {
				numSlCurrent = 0;
			}
			var numElem_2 = numSlCurrent;
			objCommon.fun_animation(widthLi, 0, timeOfAnimation, function (x) {
				arrLi[numElem_1].style.left = x - widthLi + 'px';
				arrLi[numElem_2].style.left = x + 'px';
				for (var i = 0; i < objShowElem[numElem_1]['arrEl_layer'].length; i++) {
					objShowElem[numElem_1]['arrEl_layer'][i].style.left = objShowElem[numElem_1]['arr_xLReal'][i] + (objShowElem[numElem_1]['arr_k'][i] - 1) * (x - widthLi) + 'px';
				}
				for (var i = 0; i < objShowElem[numElem_2]['arrEl_layer'].length; i++) {
					objShowElem[numElem_2]['arrEl_layer'][i].style.left = objShowElem[numElem_2]['arr_xLReal'][i] + (objShowElem[numElem_2]['arr_k'][i] - 1) * x + 'px';
				}
			}, function () {
				flAnimation = false;
				arrElem_sldrCircle[numElem_1].className = arrElem_sldrCircle[numElem_1].className.replace('sldr_list_item_active', '');
				arrElem_sldrCircle[numElem_2].className = 'sldr_list_item_active ' + arrElem_sldrCircle[numElem_2].className;
			});
		});
	}
		());
	(function (addEvent, fun_animation) {
		var timeOfAnimation = 700;
		objCommon.addPressedState('scroll_sldr_left_btn', 'button_slider_2_left_down');
		objCommon.addPressedState('scroll_sldr_right_btn', 'button_slider_2_right_down');
		var arrElemScrollSldr = document.getElementsByClassName('scroll_sldr');
		for (var j = 0; j < arrElemScrollSldr.length; j++) {
			(function () {
				if (arrElemScrollSldr[j].querySelector('.repeat_js'))
					return;
				if (scriptDoneCheck(arrElemScrollSldr[j]))
					return;
				var elem_button_slider_2_left = arrElemScrollSldr[j].querySelector('.scroll_sldr_left_btn');
				var elem_button_slider_2_right = arrElemScrollSldr[j].querySelector('.scroll_sldr_right_btn');
				var elem_div_overflow_slider_2;
				var arrElemScrollSldrChildNodes = arrElemScrollSldr[j].childNodes;
				for (var i = 0; i < arrElemScrollSldrChildNodes.length; i++) {
					if (arrElemScrollSldrChildNodes[i].tagName == 'DIV') {
						elem_div_overflow_slider_2 = arrElemScrollSldrChildNodes[i];
						break;
					}
				}
				var arrElemLi = [];
				if (elem_div_overflow_slider_2) {
					var arrElem_overflowChildNodes = elem_div_overflow_slider_2.childNodes;
					for (var i = 0; i < arrElem_overflowChildNodes.length; i++) {
						if (arrElem_overflowChildNodes[i].tagName == 'UL') {
							var elemUl = arrElem_overflowChildNodes[i];
							var arrElemUlChildNodes = elemUl.childNodes;
							for (var i1 = 0; i1 < arrElemUlChildNodes.length; i1++) {
								if (arrElemUlChildNodes[i1].tagName == 'LI') {
									arrElemLi.push(arrElemUlChildNodes[i1]);
								}
							}
							break;
						}
					}
				} else {
					return;
				}
				var flScroll = false;
				if (!arrElemLi.length) {
					return;
				}
				for (var i = 0; i < arrElemLi.length; i++) {
					elemUl.appendChild(arrElemLi[i]);
				}
				var pos_divOverflow = objCommon.getElementPosition(elem_div_overflow_slider_2);
				var xR_divOverflow = pos_divOverflow.left + pos_divOverflow.width;
				for (var i = 0; i < arrElemLi.length; i++) {
					var pos_customerReview = objCommon.getElementPosition(arrElemLi[i]);
					if (pos_customerReview.left + pos_customerReview.width - 1 > xR_divOverflow) {
						flScroll = true;
						break;
					}
				}
				var numberOfShown = i;
				if (!flScroll) {
					elem_button_slider_2_left.style.display = 'none';
					elem_button_slider_2_right.style.display = 'none';
					return;
				}
				(function (elem_div_overflow_slider_2, elem_button_slider_2_left, elem_button_slider_2_right, arrElemLi, numberOfShown) {
					var xEnd;
					var countClick = 0;
					var flEnable = true;
					addEvent(elem_button_slider_2_left, 'click', function () {
						if (flEnable) {
							if (elem_div_overflow_slider_2.scrollLeft <= 0) {
								return;
							}
							xEnd = arrElemLi[countClick * numberOfShown - numberOfShown].offsetLeft;
							fun_animation(elem_div_overflow_slider_2.scrollLeft, xEnd, timeOfAnimation, function (x) {
								elem_div_overflow_slider_2.scrollLeft = x;
							}, function () {
								flEnable = true;
								elem_button_slider_2_right.className = elem_button_slider_2_right.className.replace(/\bdisabled\b/g, '');
								if (elem_div_overflow_slider_2.scrollLeft == 0) {
									if (document.all && !window.atob) {
										elem_div_overflow_slider_2.scrollLeft = 1;
									}
									countClick = 0;
									elem_button_slider_2_left.className = elem_button_slider_2_left.className + ' ' + 'disabled';
								} else {
									countClick--;
									flEnable_left = true;
								}
							});
							flEnable = false;
						}
					});
					addEvent(elem_button_slider_2_right, 'click', function () {
						if (flEnable && countClick * numberOfShown + numberOfShown < arrElemLi.length) {
							xEnd = arrElemLi[countClick * numberOfShown + numberOfShown].offsetLeft;
							fun_animation(elem_div_overflow_slider_2.scrollLeft, xEnd, timeOfAnimation, function (x) {
								elem_div_overflow_slider_2.scrollLeft = x;
							}, function () {
								flEnable = true;
								elem_button_slider_2_left.className = elem_button_slider_2_left.className.replace(/\bdisabled\b/g, '');
								if ((arrElemLi.length - (countClick + 1) * numberOfShown) <= numberOfShown) {
									countClick++;
									elem_button_slider_2_right.className = 'disabled' + ' ' + elem_button_slider_2_right.className;
								} else {
									countClick++;
									flEnable_right = true;
								}
							});
							flEnable = false;
						}
					});
				}
					(elem_div_overflow_slider_2, elem_button_slider_2_left, elem_button_slider_2_right, arrElemLi, numberOfShown));
			}
				());
		}
	}
		(objCommon.addEvent, objCommon.fun_animation));
	objCommon.addPressedState('a_greatly_back', 'a_greatly_back_down');
	objCommon.addPressedState('sldr_news_l', 'sldr_news_l_down', 'sldr_news_down_script_done');
	objCommon.addPressedState('sldr_news_r', 'sldr_news_r_down', 'sldr_news_down_script_done');
	var funShow = function (el_newActive, elThis) {
		var fl = true;
		var el_overflowDiv = el_newActive.parentNode.parentNode.parentNode;
		var pos_elOverflowDiv = objCommon.getElementPosition(el_overflowDiv);
		var pos_elNewActive = objCommon.getElementPosition(el_newActive);
		if (pos_elOverflowDiv.left + pos_elOverflowDiv.width < pos_elNewActive.left - el_overflowDiv.scrollLeft) {
			fl = false;
			var el_rightBtn = elThis.parentNode.querySelector('.scroll_sldr_right_btn');
			if (el_rightBtn) {
				el_rightBtn.click();
			}
		}
		if (pos_elOverflowDiv.left > pos_elNewActive.left - el_overflowDiv.scrollLeft) {
			fl = false;
			var el_leftBtn = elThis.parentNode.querySelector('.scroll_sldr_left_btn');
			if (el_leftBtn) {
				el_leftBtn.click();
			}
		}
		return fl;
	};
	(function () {
		objCommon.addPressedState('a_back', 'a_back_down');
		var arrEl = document.getElementsByClassName('a_back');
		for (var i = 0; i < arrEl.length; i++) {
			(function (el) {
				var elParent = el.parentNode;
				if (elParent.querySelector('.repeat_js'))
					return;
				var arrEl_aNum = elParent.getElementsByClassName('a_num');
				if (arrEl_aNum.length == 1) {
					el.style.display = 'none';
					return;
				}
				if (scriptDoneCheck(el))
					return;
				objCommon.addEvent(el, 'click', function () {
					var arrEl_aNum = this.parentNode.getElementsByClassName('a_num');
					var el_newActive;
					for (var i = 1; i < arrEl_aNum.length; i++) {
						var r_aNumActive = new RegExp('\\b' + 'a_num_active' + '\\b', 'g');
						if (r_aNumActive.test(arrEl_aNum[i].className)) {
							arrEl_aNum[i].className = arrEl_aNum[i].className.replace('a_num_active', '');
							arrEl_aNum[i - 1].className = 'a_num_active' + ' ' + arrEl_aNum[i - 1].className;
							el_newActive = arrEl_aNum[i - 1];
							el_newActive.click();
							break;
						}
					}
					if (el_newActive) {
						var elThis = this;
						var timerId = setInterval(function () {
								if (funShow(el_newActive, elThis)) {
									clearInterval(timerId);
								}
							}, 100);
					}
				});
			}
				(arrEl[i]));
		}
	}
		());
	(function () {
		objCommon.addPressedState('a_forward', 'a_forward_down');
		var arrEl = document.getElementsByClassName('a_forward');
		for (var i = 0; i < arrEl.length; i++) {
			(function (el) {
				var elParent = el.parentNode;
				if (elParent.querySelector('.repeat_js'))
					return;
				var arrEl_aNum = elParent.getElementsByClassName('a_num');
				if (arrEl_aNum.length == 1) {
					el.style.display = 'none';
					return;
				}
				if (scriptDoneCheck(el))
					return;
				objCommon.addEvent(el, 'click', function () {
					var arrEl_aNum = this.parentNode.getElementsByClassName('a_num');
					var el_newActive;
					for (var i = 0; i < arrEl_aNum.length - 1; i++) {
						var r_aNumActive = new RegExp('\\b' + 'a_num_active' + '\\b', 'g');
						if (r_aNumActive.test(arrEl_aNum[i].className)) {
							arrEl_aNum[i].className = arrEl_aNum[i].className.replace('a_num_active', '');
							arrEl_aNum[i + 1].className = 'a_num_active' + ' ' + arrEl_aNum[i + 1].className;
							el_newActive = arrEl_aNum[i + 1];
							el_newActive.click();
							break;
						}
					}
					if (el_newActive) {
						var elThis = this;
						var timerId = setInterval(function () {
								if (funShow(el_newActive, elThis)) {
									clearInterval(timerId);
								}
							}, 100);
					}
				});
			}
				(arrEl[i]));
		}
	}
		());
	(function () {
		if (document.querySelector('.repeat_js')) {
			return;
		}
		objCommon.addPressedState('a_num', 'a_num_down');
		var arrEl = document.getElementsByClassName('a_num');
		for (var i = 0; i < arrEl.length; i++) {
			(function () {
				if (scriptDoneCheck(arrEl[i]))
					return;
				objCommon.addEvent(arrEl[i], 'click', function () {
					var arrEl1 = this.parentNode.parentNode.getElementsByClassName('a_num');
					for (var j = 0; j < arrEl1.length; j++) {
						arrEl1[j].className = arrEl1[j].className.replace('a_num_active', '');
					}
					this.className = 'a_num_active' + ' ' + this.className;
				});
			}
				());
		}
	}
		());
	function flippingPages(strParentClass, strRepeatingUnitsClass) {
		var el_newsBox = document.querySelector('.' + strParentClass);
		if (!el_newsBox)
			return;
		if (el_newsBox.querySelector('.repeat_js'))
			return;
		var arrEl_bk_news = el_newsBox.getElementsByClassName(strRepeatingUnitsClass);
		var arrEl_ANum = el_newsBox.getElementsByClassName('a_num');
		var newsBkCount = 0;
		for (var i = 0; i < arrEl_bk_news.length; i++) {
			if (arrEl_bk_news[i].offsetHeight) {
				newsBkCount++;
			}
		}
		for (var i = 0; i < arrEl_ANum.length; i++) {
			(function (arrEl_bk_news, i, newsBkCount) {
				objCommon.addEvent(arrEl_ANum[i], 'click', function () {
					for (var i1 = 0; i1 < arrEl_bk_news.length; i1++) {
						arrEl_bk_news[i1].style.display = 'none';
						if (i * newsBkCount < i1 + 1 && (i + 1) * newsBkCount > i1) {
							arrEl_bk_news[i1].style.display = 'block';
						}
					}
				});
			}
				(arrEl_bk_news, i, newsBkCount));
		}
	}
	flippingPages('news_box', 'bk_news');
	objCommon.addPressedState('display_by_a', 'display_by_a_down');
	function display_by() {
		var arrEl_displayByA = document.getElementsByClassName('display_by_a');
		for (var i = 0; i < arrEl_displayByA.length; i++) {
			(function () {
				if (scriptDoneCheck(arrEl_displayByA[i]))
					return;
				objCommon.addEvent(arrEl_displayByA[i], 'click', function () {
					var elParent = this.parentNode;
					var arrEl_currentDisplayByA = elParent.getElementsByClassName('display_by_a');
					for (var j = 0; j < arrEl_currentDisplayByA.length; j++) {
						arrEl_currentDisplayByA[j].className = arrEl_currentDisplayByA[j].className.replace('display_by_a_active', '');
					}
					this.className = 'display_by_a_active' + ' ' + this.className;
					var showNum = ~~this.innerHTML;
					if (!showNum) {
						showNum = 1000000;
					}
					var elem = this;
					var arrEl_displayByThis = [];
					while (elem) {
						arrEl_displayByThis = elem.getElementsByClassName('display_by_this');
						if (arrEl_displayByThis.length) {
							break;
						}
						elem = elem.parentNode;
					}
					for (var i1 = 0; i1 < arrEl_displayByThis.length; i1++) {
						if (showNum) {
							if (i1 >= showNum) {
								arrEl_displayByThis[i1].style.display = 'none';
							} else {
								arrEl_displayByThis[i1].style.display = 'block';
							}
						} else {
							arrEl_displayByThis[i1].style.display = 'block';
						}
					}
					var countPg = Math.ceil(arrEl_displayByThis.length / showNum);
					var strInsert = '';
					for (var i2 = 0; i2 < countPg; i2++) {
						if (!i2) {
							strInsert += '<li> <a class="a_num_active a_num" href="#" onClick="return false;">' + (i2 + 1) + '</a> </li>';
						} else {
							strInsert += '<li> <a class="a_num" href="#" onClick="return false;">' + (i2 + 1) + '</a> </li>';
						}
					}
					if (!elem)
						return;
					var elScrollSldr = elem.querySelector('.scroll_sldr');
					elScrollSldr.className = elScrollSldr.className.replace('script_done', '');
					elScrollSldr.innerHTML = '<div> <ul>' + strInsert + '</ul> </div> <a class="a_back" href="#" onClick="return false;"></a> <a class="a_forward" href="#" onClick="return false;"></a> <div class="sldr_news_l disabled scroll_sldr_left_btn"></div> <div class="sldr_news_r scroll_sldr_right_btn"></div>';
					objCommon.ajax('js/js.js', 'get', '', function (res) {
						eval(res);
					});
				});
			}
				());
		}
	}
	display_by();
	objCommon.addPressedState('btn_sldr_3_l', 'btn_sldr_3_l_down', 'btn_sldr_3_down_script_done');
	objCommon.addPressedState('btn_sldr_3_r', 'btn_sldr_3_r_down', 'btn_sldr_3_down_script_done');
	objCommon.addPressedState('hstr_pg_menu_item', 'hstr_pg_menu_item_down');
	flippingPages('personal_area_favorites_box', 'selected_offers_sub_bk');
	(function () {
		objCommon.addPressedState('btn_book_car', 'btn_book_car_down');
		objCommon.addPressedState('a_stock_pg_details', 'a_stock_pg_details_down');
		var arrElem_aStockPgDetails = document.getElementsByClassName('a_stock_pg_details');
		for (var i = 0; i < arrElem_aStockPgDetails.length; i++) {
			(function () {
				if (scriptDoneCheck(arrElem_aStockPgDetails[i]))
					return;
				objCommon.addEvent(arrElem_aStockPgDetails[i], 'click', function () {
					var animationTime = 300;
					var nextEl = this.nextElementSibling;
					if (/a_stock_pg_details_close/g.test(this.className)) {
						this.className = this.className.replace('a_stock_pg_details_close', '');
						if (nextEl) {
							nextEl.style.overflow = 'hidden';
							objCommon.fun_animation(nextEl.offsetHeight, 0, animationTime, function (x) {
								nextEl.style.height = x + 'px';
							}, function () {
								nextEl.style.display = 'none';
								nextEl.style.overflow = 'auto';
							});
							objCommon.fun_animation(1, 0, animationTime, function (x) {
								nextEl.style.opacity = x;
							}, function () {
								nextEl.style.opacity = 0;
							});
						}
					} else {
						this.className = 'a_stock_pg_details_close ' + this.className;
						if (nextEl) {
							nextEl.style.height = '1px';
							nextEl.style.display = 'block';
							var newWidth = nextEl.offsetWidth;
							var newElem = nextEl.cloneNode(true);
							newElem.style.display = 'block';
							newElem.style.position = 'absolute';
							newElem.style.left = '-10000px';
							newElem.style.top = '-10000px';
							newElem.style.height = 'auto';
							newElem.style.width = newWidth + 'px';
							document.body.appendChild(newElem);
							var heightEndEl = newElem.offsetHeight;
							newElem.parentNode.removeChild(newElem);
							nextEl.style.height = '0px';
							nextEl.style.overflow = 'hidden';
							objCommon.fun_animation(0, heightEndEl, animationTime, function (x) {
								nextEl.style.height = x + 'px';
							}, function () {
								nextEl.style.height = 'auto';
								nextEl.style.overflow = 'auto';
							});
							objCommon.fun_animation(0, 1, animationTime, function (x) {
								nextEl.style.opacity = x;
							}, function () {
								nextEl.style.opacity = 1;
							});
						}
					}
				});
			}
				());
		}
	}
		());
	(function () {
		var arrElemCalendarContainer = [document.querySelector('.auto_pg_calendar_container'), document.querySelector('.rent_pg_calendar_container')];
		for (var i = 0; i < arrElemCalendarContainer.length; i++) {
			(function () {
				if (!arrElemCalendarContainer[i])
					return;
				if (scriptDoneCheck(arrElemCalendarContainer[i]))
					return;
				createCalendar(arrElemCalendarContainer[i], false, function () {});
			}
				());
		}
	}
		());
	objCommon.addPressedState('add_to_favorites', 'add_to_favorites_down');
	objCommon.addPressedState('auto_sldr_l_btn', 'auto_sldr_l_btn_down', 'auto_sldr_js_down');
	objCommon.addPressedState('auto_sldr_r_btn', 'auto_sldr_r_btn_down', 'auto_sldr_js_down');
	(function () {
		if (document.querySelector('.similar_offers_bk .repeat_js'))
			return;
		objCommon.addPressedState('similar_offers_btn', 'similar_offers_btn_down');
	}
		());
	objCommon.addPressedState('btn_rent', 'btn_rent_down');
	objCommon.addPressedState('delete', 'delete_down');
	objCommon.addPressedState('amend', 'amend_doown');
	objCommon.addPressedState('about_us_sldr_l_btn', 'about_us_sldr_l_btn_down', 'about_us_sldr_down_script_done');
	objCommon.addPressedState('about_us_sldr_r_btn', 'about_us_sldr_r_btn_down', 'about_us_sldr_down_script_done');
	(function () {
		var elem_gismeteoInformerContainer = document.querySelector('.gismeteo_informer_ajax_fl');
		if (elem_gismeteoInformerContainer) {
			elem_gismeteoInformerContainer.className = elem_gismeteoInformerContainer.className.replace('gismeteo_informer_ajax_fl', '');
			objCommon.ajax('partials/gismeteo_informer.html', 'get', '', function (res) {
				elem_gismeteoInformerContainer.innerHTML = res;
				res = res.replace(/\s+/g, ' ');
				var regexp_1 = new RegExp("<script .*?(?=>)", "g");
				var regexp_2 = new RegExp('src=".*?"|' + "src='.*?'", "g");
				var arrStr = res.match(regexp_1);
				if (!arrStr) {
					return;
				}
				var arrScriptUrl = [];
				for (var i = 0; i < arrStr.length; i++) {
					var arrUrlStr = arrStr[i].replace(/\s+/g, '').match(regexp_2);
					if (arrUrlStr.length) {
						arrScriptUrl.push(arrUrlStr[0].slice(5, -1));
					}
				}
				for (var i = 0; i < arrScriptUrl.length; i++) {
					var elemScript = document.createElement('script');
					elem_gismeteoInformerContainer.appendChild(elemScript);
					elemScript.src = arrScriptUrl[i];
				}
			});
		}
	}
		());
	(function () {
		objCommon.addPressedState('big_star', 'big_star_down');
		var arrEl_starBox = document.getElementsByClassName('star_box');
		for (var i = 0; i < arrEl_starBox.length; i++) {
			(function () {
				if (scriptDoneCheck(arrEl_starBox[i]))
					return;
				var elHiddenInput = arrEl_starBox[i].querySelector('input');
				if (!elHiddenInput) {
					return;
				}
				var arrEl_bigStar = arrEl_starBox[i].getElementsByClassName('big_star');
				for (var j = 0; j < arrEl_bigStar.length; j++) {
					(function (j) {
						objCommon.addEvent(arrEl_bigStar[j], 'click', function () {
							for (var i1 = 0; i1 < arrEl_bigStar.length; i1++) {
								arrEl_bigStar[i1].className = arrEl_bigStar[i1].className.replace('big_star0', '');
								if (i1 > j) {
									arrEl_bigStar[i1].className = 'big_star0' + ' ' + arrEl_bigStar[i1].className;
								}
							}
							elHiddenInput.value = j + 1;
						});
					}
						(j));
				}
			}
				());
		}
	}
		());
}
	(function () {
		var objCommon = {};
		objCommon.addEvent = function (obj, e, h) {
			if (obj.addEventListener) {
				obj.addEventListener(e, h, false);
			} else if (obj.attachEvent) {
				obj.attachEvent('on' + e, h);
			} else {
				obj['on' + e] = function () {
					h();
				};
			}
		};
		objCommon.delEvent = function (obj, e, h) {
			if (obj.removeEventListener) {
				obj.removeEventListener(e, h, false);
			} else if (obj.detachEvent) {
				obj.detachEvent('on' + e, h);
			} else {
				obj['on' + e] = null;
			}
		};
		objCommon.addPressedState = function (strCurrentClass, strClassToAdd, strScriptDoneClass) {
			var arrEl = document.getElementsByClassName(strCurrentClass);
			if (typeof strScriptDoneClass == 'undefined') {
				var strScriptDoneClass = 'down_script_done';
			}
			for (var i = 0; i < arrEl.length; i++) {
				(function (elem) {
					var rScriptDone = new RegExp('\\b' + strScriptDoneClass + '\\b', 'g');
					if (rScriptDone.test(elem.className)) {
						return;
					}
					elem.className = strScriptDoneClass + ' ' + elem.className;
					objCommon.addEvent(elem, 'mousedown', function () {
						elem.className = strClassToAdd + ' ' + elem.className;
					});
					objCommon.addEvent(elem, 'mouseup', function () {
						elem.className = elem.className.replace(strClassToAdd, '');
					});
					objCommon.addEvent(elem, 'mouseout', function () {
						elem.className = elem.className.replace(strClassToAdd, '');
					});
				}
					(arrEl[i]));
			}
		};
		objCommon.fun_animation = function (xStart, xEnd, timeOfAnimation, fun_period, fun_callBack) {
			var i = 0,
			period_miliSec = 16,
			x_current = xStart,
			i_end = timeOfAnimation / period_miliSec,
			d_x = (xStart - xEnd) / i_end,
			f_animationElem = function () {
				x_current -= d_x;
				i++;
				if (i > i_end) {
					clearInterval(timerId);
					fun_period(xEnd);
					if (typeof(fun_callBack) != "undefined") {
						fun_callBack();
					}
				} else {
					fun_period(x_current);
				}
			},
			timerId = setInterval(f_animationElem, period_miliSec);
		};
		objCommon.updateInfo = function (event) {
			if (event.pageX === undefined) {
				var pageX = event.clientX + document.documentElement.scrollLeft;
				var pageY = event.clientY + document.documentElement.scrollTop;
			} else {
				var pageX = event.pageX;
				var pageY = event.pageY;
			}
			return {
				"x" : pageX,
				"y" : pageY
			};
		};
		objCommon.removeSelection = function () {
			if (window.getSelection) {
				window.getSelection().removeAllRanges();
			} else if (document.selection && document.selection.empty)
				document.selection.empty();
		};
		objCommon.disableSelection = function () {
			objCommon.addEvent(document, 'mousemove', objCommon.removeSelection);
		};
		objCommon.enableSelection = function () {
			objCommon.delEvent(document, 'mousemove', objCommon.removeSelection);
		};
		objCommon.getElementPosition = function (elem) {
			var w = elem.offsetWidth;
			var h = elem.offsetHeight;
			var l = 0;
			var t = 0;
			while (elem) {
				l += elem.offsetLeft;
				t += elem.offsetTop;
				elem = elem.offsetParent;
			}
			return {
				"left" : l,
				"top" : t,
				"width" : w,
				"height" : h
			};
		};
		objCommon.funRound = function (x, n) {
			return Math.round(x / n) * n;
		};
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
		return objCommon;
	}
		()));
