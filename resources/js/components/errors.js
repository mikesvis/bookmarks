window.processErrors = function (errors, form) {
    $('*', form).removeClass('is-invalid');
    $('.invalid-feedback', form).remove();
    for(i in errors){
        if($("input[name='"+i+"']", form).length > 0){
            element = $("input[name='"+i+"']", form);
            element.addClass('is-invalid');
            if (typeof element.data('insert-error-after') !== 'undefined' && $(element.data('insert-error-after')).length > 0) {
                $(element.data('insert-error-after')).addClass('is-invalid');
                $('<span class="invalid-feedback d-block" role="alert">' + errors[i][0] + '</span>').insertAfter($(element.data('insert-error-after')));
            } else {
                $('<span class="invalid-feedback d-block" role="alert">' + errors[i][0] + '</span>').insertAfter(element);
            }
        }
        if($("textarea[name='"+i+"']", form).length > 0){
            $("textarea[name='"+i+"']", form).addClass('is-invalid');
            $('<span class="invalid-feedback d-block" role="alert">' + errors[i][0] + '</span>').insertAfter($("textarea[name='"+i+"']", form));
        }
    }
}
