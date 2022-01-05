jQuery(document).ready(function ($) {
    $('#submit-academy-token').click(function () {
        var karsazcashback_academy_token = $('input#academy-token').val();

        if (karsazcashback_academy_token.length == 0) {
            alert('مقدار توکن نمی‌تواند خالی باشد!');
        } else {
            var data = {
                'action': 'karsazcashback_academy_token_submit_action',
                'academy_token': karsazcashback_academy_token
            };

            ($).post(ajax_object.ajax_url, data, function (response) {
                alert('بروزرسانی توکن با موفقیت انجام شد!');
                console.log(response);
            }).fail(function (error) {
                alert('مشکلی در بروزرسانی توکن به وجود آمده است!');
                console.log(error);
            });
        }
    })
});
