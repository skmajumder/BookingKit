<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->

    <main>
        <div class="bg_color_2">
            <div class="container margin_60_35">
                <div id="login">
                    <h5><?php the_session_display_message(); ?></h5>
                    <h5><?php echo get_recover_password(); ?></h5>
                    <h1>Recover Password</h1>
                    <div class="box_form">
                        <form method="post" id="login_form_user" role="form">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email address" name="email"
                                       id="email" autocomplete="off" required>
                            </div>
                            <div class="form-group text-center add_top_20">
                                <input class="btn_1 medium" type="submit" value="Send Password Reset Link">
                            </div>
                            <input type="hidden" class="hide" name="token" id="token"
                                   value="<?php echo get_token_generator(); ?>">
                        </form>
                    </div>
                    <p class="text-center link_bright">Remember the password! <a href="login.php"><strong>Then
                                login</strong></a></p>
                </div>
                <!-- /login -->
            </div>
        </div>
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include("includes/footer.php"); ?>