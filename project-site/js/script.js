$(document).ready(function () {
    $('.list-block').slice(0, 8).show();
    $("#seeMore").click(function (e) {
        e.preventDefault();
        $(".list-block:hidden").slice(0, 4).slideDown();

        if ($(".list-block:hidden").length == 0) {
            $("#seeMore").fadeOut("slow");
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1000);
    });

    $('select[name="faculty_category"]').on('change', function () {
        var facultyID = $(this).val();
        if (facultyID) {
            $.ajax({
                url: 'functions/ajaxpro.php',
                type: "GET",
                dataType: 'json',
                data: {'id': facultyID},
                success: function (data) {
                    $('select[name="department_category"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="department_category"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('select[name="department_category"]');
        }
    });


})
