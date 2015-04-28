function stringcut (field, outText) {
    var maxLength = $(field).attr('maxlength');
    $(field).keyup(function() {
        var curLength = $(field).val().length;
        $(this).val($(this).val().substr(0, maxLength));
        var remaning = maxLength - curLength;
        if (remaning < 0) remaning = 0;
        $(outText).html(remaning + ' осталось символов');
        if (remaning < 10) {
            $(outText).addClass('warning')
        }
        else {
            $(outText).removeClass('warning')
        }
    })
}