<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->

    <main>
        <div id="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li>Confirm Page</li>
                </ul>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="container margin_120">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div id="confirm">
                        <div class="icon icon--order-success svg add_bottom_15 user-failed-icon">
                            <img src="img/sad_face.svg" alt="">
                        </div>
                        <h2><?php the_session_display_message(); ?></h2>
                        <p><a href="index.php" class="btn_1 medium">Home</a></p>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include("includes/footer.php"); ?>