<?php include 'includes/header.php'; ?>

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card dashboard text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-calendar-check-o"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $user_id = $_SESSION['logged_id'];
                                $sql = "SELECT COUNT(industry_id) AS total_booking FROM booking WHERE industry_id = '" . get_escape_sql($user_id) . "'";
                                $result = get_query($sql);
                                if (get_row_count($result) > 0) {
                                    $row = get_fetch_array($result);
                                    $booking_number = $row['total_booking'];
                                    echo "<h5>{$booking_number} Booking!</h5>";
                                } else {
                                    echo "<h5>0 Booking</h5>";
                                }
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="booking.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /cards -->
            <h2></h2>
        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->
<?php include 'includes/footer.php'; ?>