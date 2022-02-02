<?php include('includes/header.php'); ?>
    <!-- ::: header.php ::: -->
<?php
if (get_logged_in()) {
    get_redirect('index.php');
}
?>
    <main>
        <div class="bg_color_2">
            <div class="container margin_60_35">
                <div id="login">
                    <?php the_session_display_message(); ?>
                    <?php get_validate_user_login(); ?>
                    <h1>Login</h1>
                    <div class="box_form">
                        <form method="post" id="login_form_user" role="form">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email address" name="email"
                                       id="email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password"
                                       id="password" minlength="5" required>
                            </div>

<!--                            <div class="form-group">-->
<!--                                <div class="checkbox-holder text-left">-->
<!--                                    <div class="checkbox_2">-->
<!--                                        <input type="checkbox" id="remember" name="remember">-->
<!--                                        <label for="remember"><span><strong>Remember Me</strong></span></label>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <a href="forgot-password.php"><small>Forgot password?</small></a>
                            <div class="form-group text-center add_top_20">
                                <input class="btn_1 medium" type="submit" value="Login">
                            </div>
                        </form>
                    </div>
                    <p class="text-center link_bright">Do not have an account yet? <a href="register.php"><strong>Register
                                now!</strong></a></p>
                </div>
                <!-- /login -->
            </div>
        </div>
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include('includes/footer.php'); ?>