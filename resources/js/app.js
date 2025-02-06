import jQuery from 'jquery';

window.$ = jQuery;

import 'bootstrap';

$(document).ready(function () {
    $('form.ajax').on('submit', function (e) {
        e.preventDefault();
        $('#response-data').html('');
        $('#response-errors').addClass('visually-hidden').html('');
        $.ajax({
            url: $(this).attr('action') + '?' + $(this).find('input[name!=_token]').serialize(),
            method: 'get',
            dataType: 'json',
            success: function (data) {
                $('#response-data').html(data.data.replace(/\r\n/g, "<br>"));
            },
            error: function (e) {
            },
            statusCode: {
                400: function (data) {
                    $('#response-errors').removeClass('visually-hidden').html(Object.values(data.responseJSON.messages)[0][0]);
                }
            }
        });
    })
});
