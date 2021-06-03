$(function () {
    $('.form-prevent').on('submit', function () {
        $('.button-prevent').attr('disabled', 'true');
        $('#icon-simpan').hide();
        $('#icon-spinner').show();
    });
});