$(document).ready(function () {
    $("#searchForm").change(function (e) {
	$("#upMoreInput").val(0);
	getListItemSearch(this, 0);
    });

    $('li.sort-list').click(function () {
	$("#upMoreInput").val(0);
	getListItemSearch("#searchForm", 0);
    });

    $("li.orders-list").click(function () {
	$("#upMoreInput").val(0);
	getListItemSearch("#searchForm", 0);
    });

    $("#upMore").click(function () {
	page = parseInt($("#upMoreInput").val());
	$("#upMoreInput").val(page + 1);
	getListItemSearch("#searchForm", 1);
    });

    function getListItemSearch(node, type) {
	$.ajax({
	    url: "/items/searchfield",
	    type: "POST",
	    data: $(node).serialize(),
	    success: function (data) {
		if (type == 1) {
		    $("#search_object").append(data.data);
		} else if (type == 0) {
		    $('#search_object').html(data.data);
		}
		$(".count_list").text(data.count);
		//alert(data.mess);
	    },
	    dataType: 'json'
	});
    }
    
    $('#resetSearch').on('click', function() {
	event.preventDefault();
	$('.filter-details input[type=text]').val(0);
	$('.advanced-field input[type=checkbox]').attr({'checked':false}).closest('label').removeClass('checked');
	$('.filter-details-extra li').remove();
	getListItemSearch("#searchForm", 0);
    });

    $("#viewListItems").click(function () {
	$.ajax({
	    url: "/items/viewsearchlist",
	    type: "POST",
	    data: $("#searchForm").serialize(),
	    success: function (data) {
		$('#search_object').html(data.data);
		//alert(data.mess);
	    },
	    dataType: 'json'
	});
    });

    $(".advanced-field.wide input[type=checkbox]").click(function () {
	data = $(this).attr("id").split("-");
	var list = $(".filter-details-extra");
	if ($(this).is(':checked')) {
	    list.append('<li id="advv-' + data[1] + '"><a href="#" class="del-field"><i class="icon-6"></i></a>' + $(this).val() + '</li>');
	} else {
	    $("#advv-" + data[1]).remove();
	}
    });

    $(document).on('click', 'a.del-field', function () {
	data = $(this).parent().attr("id").split("-");
	$(this).parent().remove();
	$("#adv-" + data[1]).attr('checked', false).parent().removeClass('checked');
	getListItemSearch("#searchForm", 0);
    });

    $("#saveSearching").click(function () {
	$.ajax({
	    url: "/items/savesearchlist",
	    type: "POST",
	    data: $("#searchForm").serialize(),
	    success: function (data) {
		$('#search_object').html(data.data);
		$("#saveSearching").css({'background-color': '#f00', 'color': '#fff'});
		setTimeout(function () {
		    $("#saveSearching").removeAttr('style');
		}, 1000);
		//alert(data.mess);
	    },
	    dataType: 'json'
	});
    });
});