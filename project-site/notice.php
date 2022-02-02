<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->
<?php
get_login_redirect();
if ($_SESSION['user_cat'] !== 3) {
    get_redirect('index.php');
} else {
    $user_id = $_SESSION['logged_id'];

    $sql = "SELECT n.notice_id,
           n.notice_title,
           n.notice_content,
           n.notice_date,
           b.id booking_id
    FROM notice n
             INNER JOIN users_student us ON (n.batch = us.batch AND n.program_id = us.program)
             INNER JOIN booking b ON n.booking_id = b.id
    WHERE us.id = '" . get_escape_sql($user_id) . "'";
    $result = get_query($sql);
}
?>
    <main>
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4><strong></strong></h4>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /results -->

        <div class="container margin_60_35">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="main_title">
                        <h1>Notice</h1>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="container">
            <div class="row">
                <?php if (get_row_count($result) > 0) : ?>
                    <?php while ($row = get_fetch_array($result)) : ?>
                        <div class="col-lg-8">
                            <div class="notice-layout">
                                <div class="strip_list wow fadeIn">
                                    <small class="notice-date">
                                        <strong>
                                            Date: <?php echo $row['notice_date']; ?>
                                        </strong>
                                    </small>
                                    <h3>
                                        <?php
                                        if (empty($row['notice_title'])) {
                                            echo "Untitled Notice";
                                        } else {
                                            echo $row['notice_title'];
                                        }
                                        ?>
                                    </h3>
                                    <p><?php echo mb_strimwidth($row['notice_content'], 0, 150, "... more"); ?></p>
                                    <ul>
                                        <li>
                                            <a href="notice-details.php?n_query=<?php echo $row['notice_id']; ?>&b_query=<?php echo $row['booking_id']; ?>">
                                                Details
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                else: ?>
                    <div class="col-lg-8">
                        <div class="notice-layout">
                            <div class="strip_list wow fadeIn">
                                <h3>Sorry! No Record Found</h3>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include("includes/footer.php"); ?>