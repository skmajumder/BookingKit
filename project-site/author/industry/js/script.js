$(document).ready(function () {
    $(document).on("change", "#user_img", function (e) {
        var image_name = e.target.files[0].name;
        $("#user_img_label").html(image_name);
    })

    var strength = {
        0: "Worst ☹",
        1: "Bad ☹",
        2: "Weak ☹",
        3: "Good ☺",
        4: "Strong ☻"
    }

    var password = document.getElementById('update_industry_password');
    var meter = document.getElementById('update_password_strength_meter');
    var text = document.getElementById('update_password_strength_text');

    password.addEventListener('input', function () {
        var val = password.value;
        var result = zxcvbn(val);

        // Update the password strength meter
        meter.value = result.score;

        // Update the text indicator
        if (val !== "") {
            text.innerHTML = "Password Strength: " + "<strong>" + strength[result.score] + "</strong>" + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span";
        } else {
            text.innerHTML = "";
        }
    });
});