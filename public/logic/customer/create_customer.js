$(function() {
    $("form[name='create_form']").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true,
            },
            phone_number: {
                required: false,
                minlength: 10
            },
            phone_number: {
                required: false,
                minlength: 10
            },
            whatsapp_number: {
                required: false,
                minlength: 10
            },
            postal_code: "number",
            status: "required",
            customer_type: "required",
            data_source: "required"
        },
        messages: {
            name: "Silahkan masukan nama anda",
            email: {
                required: "Silahkan isi dengan Email anda",
                email: "Silahkan isi dengan email yang valid"
            },
            phone_number: {
                // required: "Telepon wajib diisi",
                minlength: "Telepon minimal 10 digit"
            },
            whatsapp_number: {
                // required: "Telepon wajib diisi",
                minlength: "Whatsapp minimal 10 digit"
            },
            postal_code: "Kode Pos harus berisi angka",
            status: "Silahkan pilih Status Pelanggan",
            customer_type: "Silahkan pilih tipe Pelanggan",
            data_source: "Silahkan pilih sumber data Pelanggan"
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
