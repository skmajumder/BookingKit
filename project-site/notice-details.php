<!-- ::: header.php ::: -->
<?php include("includes/header.php"); ?>
<?php
get_login_redirect();

if ($_SESSION['user_cat'] !== 3) {
    get_redirect('index.php');
} else {
    if (isset($_GET['n_query'], $_GET['b_query'])) {
        $notice_id = $_GET['n_query'];
        $booking_id = $_GET['b_query'];
        $user_id = $_SESSION['logged_id'];

        $sql = "SELECT n.notice_title,
               n.notice_content,
               n.notice_date,
               n.batch,
               p.program_name,
               b.booking_date,
               b.booking_time,
               ui.industry_name,
               ui.industry_address
        FROM notice n
                 INNER JOIN booking b ON n.booking_id = b.id
                 INNER JOIN users_industry ui on b.industry_id = ui.id
                 INNER JOIN programs p on n.program_id = p.program_id
        WHERE n.notice_id = '" . get_escape_sql($notice_id) . "'";
        $result = get_query($sql);

        $row = get_fetch_array($result);
        $notice_title = $row['notice_title'];
        $notice_content = $row['notice_content'];
        $notice_date = $row['notice_date'];
        $batch = $row['batch'];
        $program_name = $row['program_name'];
        $booking_date = $row['booking_date'];
        $booking_time = $row['booking_time'];
        $industry_name = $row['industry_name'];
        $industry_address = $row['industry_address'];
    } else {
        get_redirect('notice.php');
    }
}
?>

<main>
    <div id="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="list.php">Notice</a></li>
                <li>Notice Details</li>
                <li>
                    <?php
                    if (empty($notice_title)) {
                        echo "Untitled Notice";
                    } else {
                        echo $notice_title;
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="container margin_60">
        <div class="row">
            <div class="col-lg-9">
                <div class="bloglist singlepost">
                    <div class="notice-title">
                        <h1 class="text-left">
                            <?php
                            if (empty($notice_title)) {
                                echo "Untitled Notice";
                            } else {
                                echo $notice_title;
                            }
                            ?>
                        </h1>
                        <h6 class="text-right">
                            <i class="icon-calendar-8"></i> Notice Date: <?php echo $notice_date; ?>
                        </h6>
                    </div>
                    <h6>Tour Details</h6>
                    <div class="postmeta">
                        <ul>
                            <li><a href="#"><i class="icon-industrial-building"></i> Tour: <?php echo $industry_name; ?>
                                </a></li>
                            <li><a href="#"><i class="icon-address-1"></i> Address: <?php echo $industry_address; ?></a>
                            </li>
                            <li><a href="#"><i class="icon-calendar"></i> Tour Date: <?php echo $booking_date; ?></a>
                            </li>
                            <li><a href="#"><i class="icon-back-in-time"></i> Tour Time: <?php echo $booking_time; ?>
                                </a></li>
                        </ul>
                    </div>
                    <h6>Notice Details</h6>
                    <div class="postmeta">
                        <ul>
                            <li><a href="#"><i class="icon-book"></i> Program: <?php echo $program_name; ?></a></li>
                            <li><a href="#"><i class="icon-users-2"></i> Batch: <?php echo $batch; ?></a></li>
                        </ul>
                    </div>
                    <!-- /post meta -->
                    <div class="post-content">
                        <div class="dropcaps">
                            <p><?php echo $notice_content; ?></p>
                        </div>
                    </div>
                    <!-- /post -->
                </div>
                <!-- /single-post -->
            </div>
            <aside class="col-lg-3">
                <div class="widget">
                    <div class="widget-title">
                        <h4>Recent Notice</h4>
                    </div>
                    <ul class="comments-list">
                        <?php
                        $sql = "SELECT n.notice_id,
                               n.notice_title,
                               n.notice_content,
                               n.notice_date,
                               b.id booking_id
                        FROM notice n
                                 INNER JOIN users_student us ON (n.batch = us.batch AND n.program_id = us.program)
                                 INNER JOIN booking b ON n.booking_id = b.id
                        WHERE us.id = '" . get_escape_sql($user_id) . "' AND n.notice_id != '" . get_escape_sql($notice_id) . "'";
                        $result = get_query($sql);
                        ?>
                        <?php if (get_row_count($result) > 0) : ?>
                            <?php while ($row = get_fetch_array($result)) : ?>
                                <li>
                                    <small><?php echo $row['notice_date']; ?></small>
                                    <h3>
                                        <a href="notice-details.php?n_query=<?php echo $row['notice_id']; ?>&b_query=<?php echo $row['booking_id']; ?>">
                                            <?php echo $row['notice_title']; ?>
                                        </a>
                                    </h3>
                                    <p><?php echo mb_strimwidth($row['notice_content'], 0, 40, "..."); ?></p>
                                </li>
                            <?php
                            endwhile;
                        else:
                            echo "<li><h3>No Recent Notice Fount</h3></li>";
                        endif; ?>
                    </ul>
                </div>
                <!-- /widget -->
            </aside>
            <!-- /aside -->
        </div>
    </div>
    <!-- /container -->

    <!-- /container -->
</main>
<!-- /main -->

<?php include("includes/footer.php"); ?>