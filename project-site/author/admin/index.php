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
                                <i class="fa fa-user-circle"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $sql = "SELECT count(id) AS total_student FROM users_student";
                                $result = get_query($sql);
                                if (get_row_count($result) > 0) {
                                    $row = get_fetch_array($result);
                                    $total_student = $row['total_student'];
                                    echo "{$total_student} Students";
                                } else {
                                    echo "0 Student";
                                }
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="student.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card dashboard text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-university"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $sql = "SELECT count(id) AS total_academy FROM users_academy";
                                $result = get_query($sql);
                                if (get_row_count($result) > 0) {
                                    $row = get_fetch_array($result);
                                    $total_academy = $row['total_academy'];
                                    echo "{$total_academy} Academy";
                                } else {
                                    echo "0 Academy";
                                }
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="academy.php">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card dashboard text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-industry"></i>
                            </div>
                            <div class="mr-5">
                                <?php
                                $sql = "SELECT count(id) AS total_industry FROM users_industry";
                                $result = get_query($sql);
                                if (get_row_count($result) > 0) {
                                    $row = get_fetch_array($result);
                                    $total_industry = $row['total_industry'];
                                    echo "{$total_industry} Industry";
                                } else {
                                    echo "0 Industry";
                                }
                                ?>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="industry.php">
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