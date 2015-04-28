$(".profile").ready(function() {
    $("#addPhone").click(function() {
	html = $(".phoneList").html();
	$('.phoneList').html(html + '<p class="phone"><label><input type="text" name="profile[phone][]" value="" class="mask-input" /></label><a class="delete"><i class="icon-30"></i></a></p>');
    });
    
    $("#addCont").click(function() {
	html = $('.contactList').html();
	$('.contactList').html(html + '<div class="more-contacts"><div class="select-wrap"><input type="hidden" name="profile[contactType][]" value="ICQ" /><div class="select"><span class="title">ICQ</span><a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a></div><ul class="option-list"><li data-value="ICQ">ICQ</li><li data-value="Skype">Skype</li><li data-value="E-mail">E-mail</li></ul></div><label><input type="text" name="profile[contactVal][]" value=""/></label><div class="clear"></div><a class="delete"><i class="icon-30"></i></a></div>');
    });

    if($.cookie('tarif')) {
	setTimeout(function(){
	    $(".tariff-version").hide("slow", function() {
		$(this).remove();
	    });
	}, 1000);
    }
    
    $('.tariff-version .tariff-short a.close').click(function() {
	$.cookie('tarif', 1);
	$(".tariff-version").hide("slow", function() {
	    $(this).remove();
	});
    });
});

$(function() {
    $(document).on('click', 'a.delete', function() {
	$(this).parent().remove();
    });
    
    //$("")
});

function ajaxFileUploadInit(node, outField) {
    var name = $(node).find(".file-input").attr("name");
    $(node).find(".file-input").attr("name", "");
    $(node).find(".file-input").attr("_name", name);

    uploader = new AjaxUpload($(node).find(".file-input"), {
        action: "/items/upload?type=user",
        name: "upload",
        data: {
            settings: $(node).find(".file-settings").attr("value")
        },
        autoSubmit: true,
        responseType: "json",
        onSubmit: function() {
            $(node).find(".file-loading").show();
        },
        onComplete: function(fileNode, r) {
            $(node).find(".file-loading").hide();
            //alert(r); return;
            if (r.error) {
                alert(r.error + "\n\nКод ошибки: " + r.error_code);
                return;
            }
            ajaxFileUploadListAdd(node, r, outField);
            $(fileNode).attr("value", "");
        }
    });
}

function ajaxFileUploadListAdd(node, file, outField) {
    //alert(outField);
    var div = $(node);
    var name = div.find(".file-input").attr("_name");
    var html;
    var thumb = file;

    if (file.image) {
                //alert('dgsdfgdf');
        var defaultKey = div.find(".file-default-key").attr("value");

        if (file.resizes) {
            var thumb_found = false;

            for (var i = 0; i < file.resizes.length; i++) {
                var resize = file.resizes[i];
                if (resize.key == defaultKey) {
                    thumb_found = true;
                    thumb = resize;
                    break;
                }
            }

            if (!thumb_found && file.resizes.length) {
                thumb = file.resizes[0];
            }
        }

        html = '<img src="' + thumb.url + '" />';
    } else {
        html = "<a target=\"_blank\" href=\"" + thumb.url + "\">" + thumb.filename + "</a>";
    }
    //alert(html);
    $(outField).html(html);
    
    //ajaxFileUploadInit("#ajax-file-upload");
}