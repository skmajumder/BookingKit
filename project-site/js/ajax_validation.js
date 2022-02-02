$(document).ready(function () {
    $('#email').keyup(function () {
        let email_id = $(this).val();
        $('#message').html('');
        $.post("functions/checkdata.php", {email_id: email_id}, function (data) {
            if (data.status == true) {
                $('#message').attr('class', 'success');

            } else {
                $('#message').attr('class', 'error');
            }
            $('#message').html(data.message);
        }, 'json');
    });
});

$(document).ready(function () {
    $('#industry_email').keyup(function () {
        var email_id_2 = $(this).val();
        $('#message_2').html('');
        $.post("functions/checkdata_2.php", {email_id: email_id_2}, function (data) {
            if (data.status == true) {
                $('#message_2').attr('class', 'success');

            } else {
                $('#message_2').attr('class', 'error');
            }
            $('#message_2').html(data.message);
        }, 'json');
    });
});