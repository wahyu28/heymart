$(function() {
    $("form[name='create_form']").validate({
        rules: {
            name: "required",
            username: {
                required: "#access_login:checked",
                minlength: 5,
            },
            email: {
                required: true,
                email: true,
            },
            phone_number: {
                required: false,
                minlength: 10,
            },
            // access_login: "required",
            status: "required",
            position_id: "required",
            password: {
                required: "#access_login:checked",
                minlength: 6
            },
            conf_password: {
                required: "#access_login:checked",
                minlength: 6,
                equalTo: "#password"
            }
        },
        errorPlacement: function(error, element) {
            var name = element.attr("name");
            $("#" + name + "_error").html(error);
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
