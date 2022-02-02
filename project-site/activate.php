<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->
<?php get_login_redirect(); ?>
    <main>
        <div id="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li>Activate Page</li>
                </ul>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="container margin_120">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div id="confirm">
                        <div class="icon icon--order-success svg add_bottom_15">
                            <svg width="72" height="72">
                                <g fill="none" stroke="#8EC343" stroke-width="2">
                                    <circle cx="36" cy="36" r="35"
                                            style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                    <path d="M17.417,37.778l9.93,9.909l25.444-25.393"
                                          style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                </g>
                            </svg>
                        </div>
                        <h2><?php get_activate_user(); ?></h2>
                        <h2><?php get_activate_industry(); ?></h2>
                        <h2><?php get_activate_academy(); ?></h2>
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