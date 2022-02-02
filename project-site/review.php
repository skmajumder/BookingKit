<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->
<?php get_login_redirect(); ?>

<?php
if (isset($_GET['query_id'], $_GET['name']) && $_SESSION['user_cat'] == 2) {
    $booking_id = $_GET['query_id'];
    $user_id = $_SESSION['logged_id'];

    $sql = "SELECT ui.industry_name,
       b.industry_id,
       b.academy_id,
       b.review
FROM booking as b
         INNER JOIN users_industry ui ON b.industry_id = ui.id
WHERE b.id = '" . get_escape_sql($booking_id) . "'";
    $result = get_query($sql);
    if (get_row_count($result) > 0) {
        $row = get_fetch_array($result);
        $name = $row['industry_name'];
        $industry_id = $row['industry_id'];
        $academy_id = $row['academy_id'];
        $review = $row['review'];
    }
    if ($academy_id == $user_id) {
        $valid_user = true;
    } else {
        $valid_user = false;
    }
} else {
    get_redirect('index.php');
}
?>

    <main>
        <div id="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li>Review</li>
                </ul>
            </div>
        </div>
        <!-- /breadcrumb -->


        <div class="container margin_60_35">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <?php
                        get_tour_review_validation();
                        the_session_display_message();
                        ?>
                    </div>
                    <div class="box_general_3 write_review">
                        <?php if ($valid_user == true) : ?>
                            <?php if ($review == 0) : ?>
                                <h1>Write a review for: <br> <?php echo $name; ?></h1>
                                <form method="post" id="review_submit_form" role="form">
                                    <input type="hidden" name="industry_id" value="<?php echo $industry_id; ?>">
                                    <input type="hidden" name="academy_id" value="<?php echo $academy_id; ?>">
                                    <div class="rating_submit">
                                        <div class="form-group">
                                            <label class="d-block">Overall rating</label>
                                            <span class="rating">
                                        <input type="radio" class="rating-input" id="5_star" name="rating_input"
                                               value="5">
                                            <label for="5_star" class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="4_star" name="rating_input"
                                               value="4">
                                            <label for="4_star" class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="3_star" name="rating_input"
                                               value="3">
                                            <label for="3_star" class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="2_star" name="rating_input"
                                               value="2">
                                            <label for="2_star" class="rating-star"></label>
                                        <input type="radio" class="rating-input" id="1_star" name="rating_input"
                                               value="1">
                                            <label for="1_star" class="rating-star"></label>
                                    </span>
                                        </div>
                                    </div>
                                    <!-- /rating_submit -->
                                    <div class="form-group">
                                        <label for="review_title">Review <span>(optional)</span></label>
                                        <input class="form-control" type="text" name="review_title" id="review_title"
                                               placeholder="If you could say it in one sentence, what would you say?">
                                    </div>
                                    <div class="form-group">
                                        <label for="review">Review *</label>
                                        <textarea class="form-control" style="height: 180px;" name="review" id="review"
                                                  placeholder="Write your review here ..." required></textarea>
                                    </div>
                                    <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
                                    <hr>
                                    <input type="submit" class="btn_1" value="Submit Review">
                                </form>
                            <?php else: ?>
                                <h1 class="text-center">Review Complete</h1>
                                <h6 class="text-center">Return <a href="index.php">Home</a></h6>
                            <?php
                            endif;
                        else:
                            echo "<h6 class='text-center'>Invalid User. Return <a href='index.php'>Home</a></h6>";
                        endif;
                        ?>
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