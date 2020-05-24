$(function(){

    $("#deleteForm").submit(function(e){
        e.preventDefault();
        $("#delete").click();
    });

    $("#delete").click(function(){
        var buttonSubmit = $(this);
        var form = document.querySelector($(this).data('form-id'));
        formData = new FormData(form);

        buttonSubmit.attr("disabled", true);

        axios.post($(form).attr("action"), formData)
            .then(response => {
                window.location.href = response.data.redirect
            })
            .catch(error => {
                if (error.response) {
                    processErrors(error.response.data.errors, form);
                }
            });

        buttonSubmit.attr("disabled", false);
        return false;

    });
});
