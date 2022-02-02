<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->

    <main>
        <div class="bg_color_2">
            <div class="container margin_60_35">
                <div id="login">
                    <h5><?php the_session_display_message(); ?></h5>
                    <h5><?php get_recover_password_validation_code(); ?></h5>
                    <h1>Enter Password Recover Code</h1>
                    <div class="box_form">
                        <form method="post" id="password_reset_code_form" role="form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Password Recover Code" name="code"
                                       id="code" autocomplete="off" required>
                            </div>
                            <div class="form-group text-center add_top_20">
                                <input class="btn_1 medium" type="submit" value="Continue">
                            </div>
                            <input type="hidden" class="hide" name="token" id="token" value="">
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