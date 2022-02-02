<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->
    <main>
        <div class="bg_color_2">
            <div class="container margin_60_35">
                <div id="login">
                    <h5><?php get_password_reset(); ?></h5>
                    <h1>Reset Password</h1>
                    <div class="box_form">
                        <form id="register_form_student" method="post" role="form">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="Your password" minlength="5" required>
                                <meter max="4" id="password-strength-meter"></meter>
                                <p id="password-strength-text"></p>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm password</label>
                                <input type="password" class="form-control" name="confirm_password"
                                       id="confirm_password" placeholder="Confirm password" minlength="5" required>
                            </div>
                            <div class="form-group text-center add_top_20">
                                <input class="btn_1 medium" type="submit" value="Reset Password">
                            </div>
                            <input type="hidden" class="hide" name="token" id="token"
                                   value="<?php echo get_token_generator(); ?>">
                        </form>
                    </div>
                </div>
                <!-- /login -->
            </div>
        </div>
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include("includes/footer.php"); ?>