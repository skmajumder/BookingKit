<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->

    <main>
        <div class="bg_color_2">
            <div class="container margin_60_35">
                <div id="login">
                    <h1>
                        <?php the_session_display_message(); ?>
                        <?php get_validate_user_login(); ?>
                    </h1>
                    <h1>Register</h1>
                    <div class="box_form">
                        <div class="register-category">
                            <a href="register-user.php" class="social_bt">Register as Student</a>
                            <a href="register-industry.php" class="social_bt red">Register as Industry</a>
                            <a href="register-academy.php" class="social_bt">Register as Academy</a>
                        </div>
                    </div>
                    <?php if (!get_logged_in()) : ?>
                        <p class="text-center link_bright">Already Registered! <a href="login.php"><strong>Log In
                                    Now!</strong></a></p>
                    <?php endif; ?>
                </div>
                <!-- /login -->
            </div>
        </div>
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include("includes/footer.php"); ?>