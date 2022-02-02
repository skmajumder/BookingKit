<?php include 'includes/header.php'; ?>
<!-- ::: header.php ::: -->
<?php
$sql = "SELECT * FROM industry_type";
$result = get_query($sql);
?>
<main>
    <div class="header-video">
        <div id="hero_video">
            <div class="content">
                <h3>Book a industry tour</h3>
                <p>Find a Booking Place</p>
            </div>
        </div>
        <img src="img/video_fix.png" alt="" class="header-video--media" data-video-src="video/intro"
             data-teaser-source="video/intro" data-provider="" data-video-width="1920" data-video-height="750">
    </div>
    <!-- /Header video -->

    <div class="container margin_120_95">
        <div class="main_title">
            <h2>Find by Category</h2>
            <p>Easiest way to get which category you want</p>
        </div>
        <div class="row">
            <?php if (get_row_count($result) > 0) : ?>
                <?php while ($row = get_fetch_array($result)) : ?>
                    <?php
                    $string = $row['industry_category_name'];
                    $name = str_replace(' ', '-', $string);
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="list-block">
                            <a href="list.php?query_id=<?php echo $row['industry_id']; ?>&name=<?php echo strtolower($name); ?>"
                               class="box_cat_home">
                                <i class="icon-info-4"></i>
                                <img src="img/industry.svg" width="60" height="60" alt="">
                                <h3><?php echo $row['industry_category_name']; ?></h3>
                                <span class="text"></span>
                                <ul class="clearfix">
                                    <?php
                                    $sql_2 = "SELECT COUNT(id) number
                                    FROM users_industry
                                    WHERE industry_category = '" . get_escape_sql($row['industry_id']) . "'";
                                    $result_2 = get_query($sql_2);
                                    $row = get_fetch_array($result_2);
                                    echo "<li><strong>{$row['number']}</strong> Industry</li>";
                                    ?>
                                </ul>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <!-- /row -->
        <div class="row text-center">
            <div class="col-lg-8 col-md-12 offset-lg-2">
                <a href="#" class="btn_1 medium" id="seeMore">Load More</a>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="container margin_120_95">
        <div class="main_title">
            <h2>Discover the <strong>online</strong> Booking!</h2>
        </div>
        <div class="row add_bottom_30">
            <div class="col-lg-4">
                <div class="box_feat" id="icon_1">
                    <span></span>
                    <h3>Find a Place</h3>
                    <p>Pick the profile which you are looking for</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_feat" id="icon_2">
                    <span></span>
                    <h3>View profile</h3>
                    <p>Visit their profile, and see their details which you are looking for</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_feat" id="icon_3">
                    <h3>Book a visit</h3>
                    <p>Pick your convenient date and time. Book a schedule by their rating.</p>
                </div>
            </div>
        </div>
        <!-- /row -->
        <p class="text-center"><a href="list.php" class="btn_1 medium">Find</a></p>
    </div>
    <!-- /container -->

</main>
<!-- /main content -->

<?php include("includes/footer.php"); ?>
<!-- ::: footer.php ::: -->
