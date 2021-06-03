$(function() {
    $("form[name='create_form']").validate({
        rules: {
            name: "required",
            email: {
                required: false,
                email: true,
            },
            address: {
                required: false,
                maxlength: 100
            },
            phone_number: {
                required: false,
                minlength: 10
            },
            is_active: "required"
        },
        messages: {
            name: "Silahkan masukan Nama anda",
            email: {
                // required: "Silahkan isi dengan Email anda",
                email: "Silahkan isi dengan Email    yang valid"
            },
            phone_number: {
                // required: "Telepon wajib diisi",
                minlength: "Telepon minimal 10 digit"
            },
            address: {
                // required: "Telepon wajib diisi",
                maxlength: "Alamat max 100 karakter"
            },
            is_active: "Silahkan pilih Status Supplier",
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
