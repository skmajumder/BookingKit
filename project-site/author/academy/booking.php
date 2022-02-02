<?php include 'includes/header.php'; ?>
<?php

$user_id = $_SESSION['logged_id'];

$sql = "SELECT ui.industry_name,
       ui.image,
       ui.image_name,
       ui.industry_address,
       b.id,
       b.academy_id,
       b.industry_id,
       b.booking_date,
       b.booking_time,
       b.created_date,
       b.active,
       b.tour_end,
       b.review,
       b.notice
FROM booking as b
         INNER JOIN users_industry ui ON b.industry_id = ui.id
WHERE b.academy_id = '" . get_escape_sql($user_id) . "'";
$result = get_query($sql);
?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">All Bookings</li>
            </ol>
            <div class="message">
                <?php
                get_confirm_tour_end_validation();
                echo the_session_display_message();
                ?>
            </div>

            <div class="box_general">
                <div class="header_box">
                    <h2 class="d-inline-block">Bookings List</h2>
                </div>
                <div class="list_general">
                    <ul>
                        <?php
                        if (get_row_count($result) > 0):
                            while ($row = get_fetch_array($result)): ?>
                                <li>
                                    <figure><img src="../industry/<?php echo $row['image']; ?>"
                                                 alt="<?php echo $row['image_name']; ?>"></figure>
                                    <h4>
                                        <?php
                                        echo $row['industry_name'];
                                        if ($row['active'] == 0) {
                                            echo "<i class='pending'>Pending</i>";
                                        } elseif ($row['active'] == 1) {
                                            echo "<i class='approved'>Approved</i>";
                                        } elseif ($row['active'] == 2) {
                                            echo "<i class='cancel'>Cancel</i>";
                                        }
                                        ?>
                                    </h4>
                                    <ul class="booking_details">
                                        <?php if ($row['active'] == 1) : ?>
                                            <?php if ($row['tour_end'] == 1) : ?>
                                                <li><strong>Tour:</strong> <i class='approved'>Complete</i></li>
                                            <?php
                                            else:
                                                echo "<li><strong>Status:</strong> <i class='pending'>Not Complete</i></li>";
                                            endif;
                                            ?>
                                        <?php endif; ?>
                                        <?php if ($row['active'] == 1) : ?>
                                            <?php if ($row['review'] == 1): ?>
                                                <li><strong>Review:</strong> <i class='approved'>Complete</i></li>
                                            <?php else: ?>
                                                <li><strong>Review:</strong> <i class='pending'>Not Complete</i></li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <li><strong>Booking Date:</strong> <?php echo $row['booking_date']; ?> (m/d/Y)
                                        </li>
                                        <li><strong>Booking Time:</strong> <?php echo $row['booking_time']; ?></li>
                                        <li><strong>Created Date:</strong> <?php echo $row['created_date']; ?></li>
                                        <li><strong>Address:</strong> <?php echo $row['industry_address']; ?></li>
                                        <?php
                                        $name = strtolower(str_replace(' ', '-', $row['industry_name']));
                                        ?>
                                        <?php
                                        if ($row['active'] == 1) {
                                            if ($row['tour_end'] == 0) {
                                                if ($row['notice'] == 0) { ?>
                                                    <li>
                                                        <strong>Notice:</strong>
                                                        <a href="notice.php?query_id=<?php echo $row['id']; ?>&name=<?php echo $name; ?>">
                                                            Send Notice
                                                        </a>
                                                    </li>
                                                <?php } elseif ($row['notice'] == 1) { ?>
                                                    <li>
                                                        <strong>Notice:</strong>
                                                        <i class='approved'>Sent</i>
                                                        <a href="notice.php?query_id=<?php echo $row['id']; ?>&name=<?php echo $name; ?>">
                                                            Send New Notice
                                                        </a>
                                                    </li>
                                                <?php }
                                            }
                                        }
                                        ?>

                                        <?php if ($row['active'] == 1 && $row['tour_end'] == 1) : ?>
                                            <?php if ($row['review'] == 0) : ?>
                                                <?php
                                                $name = strtolower(str_replace(' ', '-', $row['industry_name']));
                                                ?>
                                                <li>
                                                    <strong>Review:</strong>
                                                    <a href="../../review.php?query_id=<?php echo $row['id']; ?>&name=<?php echo $name; ?>">
                                                        Review This Tour
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <?php if ($row['active'] == 1) : ?>
                                        <?php if ($row['tour_end'] == 0) : ?>
                                            <ul class="buttons">
                                                <li>
                                                    <h6>Tour Complete?</h6>
                                                    <form method="post" role="form">
                                                        <input type="hidden" name="booking_id" id="booking_id"
                                                               value="<?php echo $row['id']; ?>">
                                                        <input type="submit" class="btn_1 gray approve" value="Yes"
                                                               name="tour_end_confirm">
                                                    </form>
                                                </li>
                                            </ul>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </li>
                            <?php
                            endwhile;
                        else:
                            echo "<h4>No Booking Found.</h4>";
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /container-fluid-->
    </div>
    <!-- /container-wrapper-->

<?php include 'includes/footer.php'; ?>