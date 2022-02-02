(function ($) {

    "use strict";

    // Preload
    $(window).on("load", function () {  // makes sure the whole site is loaded
        'use strict';
        $('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({
            'overflow': 'visible'
        });
        var $hero = $('.hero_home .content');
        var $hero_v = $('#hero_video .content ');
        $hero.find('h3, p, form').addClass('fadeInUp animated');
        $hero.find('.btn_1').addClass('fadeIn animated');
        $hero_v.find('.h3, p, form').addClass('fadeInUp animated');
        $(window).scroll();
    })

    // Sticky nav + scroll to top
    var $headerStick = $('.header_sticky');
    var $toTop = $('#toTop');
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 1) {
            $headerStick.addClass("sticky");
        } else {
            $headerStick.removeClass("sticky");
        }
        ;
        if ($(this).scrollTop() != 0) {
            $toTop.fadeIn();
        } else {
            $toTop.fadeOut();
        }
    });
    $toTop.on("click", function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
    });

    // Menu
    $('a.open_close').on("click", function () {
        $('.main-menu').toggleClass('show');
        $('.layer').toggleClass('layer-is-visible');
        $('header.static').toggleClass('header_sticky sticky');
        $('body').toggleClass('body_freeze');
    });
    $('a.show-submenu').on("click", function () {
        $(this).next().toggleClass("show_normal");
    });

    // Hamburger icon
    var toggles = document.querySelectorAll(".cmn-toggle-switch");
    for (var i = toggles.length - 1; i >= 0; i--) {
        var toggle = toggles[i];
        toggleHandler(toggle);
    }
    ;

    function toggleHandler(toggle) {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
        });
    };

    // WoW - animation on scroll
    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: true, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        callback: function (box) {
            // the callback is fired every time an animation is started
            // the argument that is passed in is the DOM node being animated
        },
        scrollContainer: null // optional scroll container selector, otherwise use window
    });
    wow.init();

    // Carousel
    $('#reccomended, #staff').owlCarousel({
        center: true,
        items: 2,
        loop: true,
        margin: 10,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });

    // Selectbox
    $(".selectbox").selectbox();

    // Sticky horizontal results list page
    $("#results").stick_in_parent({
        offset_top: 0
    });

    // Sticky sidebar
    $('#sidebar').theiaStickySidebar({
        additionalMarginTop: 95
    });

    // Tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Detail page func
    $('#booking_date').dateDropper();
    $('#booking_time').timeDropper({
        setCurrentTime: false,
        meridians: true,
        primaryColor: "#e74e84",
        borderColor: "#e74e84",
        minutesInterval: '60'
    });

    var $sticky_nav = $('#secondary_nav');
    $sticky_nav.stick_in_parent();
    $sticky_nav.find('ul li a').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        $('html, body').animate({
            'scrollTop': $target.offset().top - 95
        }, 800, 'swing');
    });
    $sticky_nav.find('ul li a').on('click', function () {
        $sticky_nav.find('.active').removeClass('active');
        $(this).addClass('active');
    });

    // Faq section
    $('#faq_box a[href^="#"]').on('click', function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            || location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 185
                }, 800);
                return false;
            }
        }
    });
    $('ul#cat_nav li a').on('click', function () {
        $('ul#cat_nav li a.active').removeClass('active');
        $(this).addClass('active');
    });

    // Accordion
    function toggleChevron(e) {
        $(e.target)
            .prev('.card-header')
            .find("i.indicator")
            .toggleClass('icon_minus_alt2 icon_plus_alt2');
    }

    $('.accordion').on('hidden.bs.collapse shown.bs.collapse', toggleChevron);

    function toggleIcon(e) {
        $(e.target)
            .prev('.panel-heading')
            .find(".indicator")
            .toggleClass('icon_minus_alt2 icon_plus_alt2');
    }

    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

    // Show Password
    $('#password, #password1, #password2').hidePassword('focus', {
        toggle: {
            className: 'my-toggle'
        }
    });

    // Show Password
    $('#confirm_password').hidePassword('focus', {
        toggle: {
            className: 'my-toggle'
        }
    });

    var strength = {
        0: "Worst ☹",
        1: "Bad ☹",
        2: "Weak ☹",
        3: "Good ☺",
        4: "Strong ☻"
    }

    var password = document.getElementById('password');
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');

    password.addEventListener('input', function () {
        var val = password.value;
        var result = zxcvbn(val);

        // Update the password strength meter
        meter.value = result.score;

        // Update the text indicator
        if (val !== "") {
            text.innerHTML = "Strength: " + "<strong>" + strength[result.score] + "</strong>" + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span";
        } else {
            text.innerHTML = "";
        }
    });


})(window.jQuery);

$(document).ready(function () {

    // add the rule here
    $.validator.addMethod("valueNotEquals", function (value, element, arg) {
        return arg !== value;
    }, "Value must not equal arg.");

    // validate signup form on keyup and submit
    $("#register_form_user").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            university_name: {
                required: true,
                valueNotEquals: ""
            },
            student_university_session: {
                required: true,
                valueNotEquals: ""
            },
            student_university_id: {
                required: true,
            },
            student_university_program: {
                required: true,
            },
            password: {
                required: true,
                minlength: 5
            },
            confirm_password: {
                required: true,
                minlength: 5,
                equalTo: "#password"
            },
            industry_name: {
                required: true,
                minlength: 2
            },
            industry_city: {
                required: true,
                minlength: 2
            },
            industry_category: {
                valueNotEquals: ""
            },
            industry_address: {
                required: true,
            },
            industry_contact_number: {
                required: true,
            },
            industry_office_phone: {
                required: true,
            },
            industry_email: {
                required: true,
                email: true
            },
            university_address: {
                required: true,
            },
            faculty_category: {
                valueNotEquals: ""
            },
            department_category: {
                valueNotEquals: ""
            },
            university_department_chairman: {
                required: true,
                minlength: 2
            },
            university_department_chairman_email: {
                required: true,
                email: true
            },
            university_department_chairman_number: {
                required: true
            },
            university_office_phone: {
                required: true
            },
            university_email: {
                required: true,
                email: true
            },
            check_2: "required"
        },
        messages: {
            first_name: {
                required: "Please enter First Name",
                minlength: "Your First Name must consist of at least 2 characters"
            },
            last_name: {
                required: "Please enter a Last Name",
                minlength: "Your First Name must consist of at least 2 characters"
            },
            email: {
                required: "Please enter a valid email address",
            },
            university_name: {
                required: "Please Select University Name",
            },
            student_university_session: {
                required: "Please Select Session",
            },
            student_university_id: {
                required: "Please enter Your University ID",
            },
            student_university_program: {
                required: "Please enter Your University Program",
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            confirm_password: {
                required: "Please provide Confirm password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            industry_name: {
                required: "Please enter Industry Name",
                minlength: "Industry Name must consist of at least 2 characters"
            },
            industry_city: {
                required: "Please enter City",
                minlength: "City Name must consist of at least 2 characters"
            },
            industry_category: {
                valueNotEquals: "Please select Category"
            },
            industry_address: {
                required: "Please Enter Address",
            },
            industry_contact_number: {
                required: "Please Enter Contact Number",
            },
            industry_office_phone: {
                required: "Please Enter Office Phone Number",
            },
            industry_email: {
                required: "Please enter a valid email address",
            },
            university_address: {
                required: "Please Enter Address",
            },
            faculty_category: {
                valueNotEquals: "Please select Category"
            },
            department_category: {
                valueNotEquals: "Please select Category"
            },
            university_department_chairman: {
                required: "Please enter Department Chairman Name",
                minlength: "Name must consist of at least 2 characters"
            },
            university_department_chairman_email: {
                required: "Please enter a valid email address",
            },
            university_department_chairman_number: {
                required: "Please enter Department Chairman Number",
            },
            university_office_phone: {
                required: "Please Enter Phone Number",
            },
            university_email: {
                required: "Please enter a valid email address",
            },
        }
    });

    // validate login form on keyup and submit
    $("#login_form_user").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            email: {
                required: "Please enter Login email address",
                minlength: "Email Name must consist of at least 2 characters"
            },
            password: {
                required: "Please provide Login password",
                minlength: "Login password must be at least 5 characters long"
            },
        }
    });
});


