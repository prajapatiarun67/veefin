$('#user-frm').on('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();
    
    var formObj = $(this);
    var formUrl = formObj.attr('action');
    var formData = new FormData(formObj[0]); 

    $.each(formObj.find('input, select, textarea, file'), function (i, field) {
        var elem = $('[name="' + field.name + '"]'); 
            elem.removeClass('error').next('label.error').remove(); 
    });

    $.ajax({ 
        type: 'POST',
        url: formUrl,
        data: formData,
        dataType: 'JSON',
        mimeType: 'multipart/form-data',
        processData: false,
        contentType: false,
        success: function (data) {
        if(data.success == true)
        {
            if(data.type === 'alert')
            {
                alert(data.message);
            }
            window.location.href = data.redirect;
        }  
    },
    error: function (err) {  
        if(err.responseJSON)
        {
            $.each(err.responseJSON.errors, function (key, val) { 
                    if(key.indexOf('.') !== -1) {
                        var keys = key.split('.');
                        key = keys[0]+'['+keys[1]+']';
                    }
                    var elem = $('[name="' + key + '"]', formObj);
                  
                        elem.removeClass('error')
                            .next('label.error').remove()
                            .end()
                            .addClass('label.error').after('<label class="error">'+val+'</label>');
                });
                $('.form-group.error').eq(0).addClass('focused');
            }
        }

});


});