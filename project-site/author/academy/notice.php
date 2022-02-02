<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];
$uv_id = $_SESSION['uv_id'];
$department = $_SESSION['department'];

if (isset($_GET['query_id'])) {
    $booking_id = $_GET['query_id'];
    $sql_5 = "SELECT ui.industry_name,
           ui.industry_address,
           b.booking_date,
           b.booking_time
    FROM booking b
             INNER JOIN users_industry ui on b.industry_id = ui.id
    WHERE b.id = '" . get_escape_sql($booking_id) . "'";
    $result_5 = get_query($sql_5);
    if (get_row_count($result_5) > 0) {
        $row_5 = get_fetch_array($result_5);
        $industry_name = $row_5['industry_name'];
        $industry_address = $row_5['industry_address'];
        $booking_date = $row_5['booking_date'];
        $booking_time = $row_5['booking_time'];
    }
} else {
    get_redirect('index.php');
}

$sql_2 = "SELECT * FROM programs WHERE department_id = '" . get_escape_sql($department) . "'";
$result_2 = get_query($sql_2);

$sql_3 = "SELECT program_id FROM programs WHERE department_id = '" . get_escape_sql($department) . "'";
$result_3 = get_query($sql_3);
if (get_row_count($result_3) > 0) {
    $row_3 = get_fetch_array($result_3);
    $program_id = $row_3['program_id'];
}

$sql_4 = "SELECT DISTINCT batch
FROM users_student us
         INNER JOIN university_list ul on us.university_name = ul.id
WHERE us.university_name = '" . get_escape_sql($uv_id) . "' AND program = '" . get_escape_sql($program_id) . "'";
$result_4 = get_query($sql_4);

?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Notice</li>
            </ol>
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-md-9 offset-md-1 text-center">
                    <h5>
                        <?php
                        get_valid_tour_notice();
                        the_session_display_message();
                        ?>
                    </h5>
                </div>
            </div>
            <form method="post" id="tour_notice_form" role="form">
                <div class="row">
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <label>Tour</label>
                            <input type="text" class="form-control" value="<?php echo $industry_name; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" value="<?php echo $industry_address; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <label>Tour Date (M/D/YYYY)</label>
                            <input type="text" class="form-control" value="<?php echo $booking_date; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <label>Tour Time</label>
                            <input type="text" class="form-control" value="<?php echo $booking_time; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <label for="program">Program</label>
                            <select class="form-control custom-select" name="program"
                                    id="program" required>
                                <?php if (get_row_count($result_2) > 0) : ?>
                                    <?php while ($row = get_fetch_array($result_2)) : ?>
                                        <option value="<?php echo $row['program_id']; ?>">
                                            <?php echo $row['program_name']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <label for="batch">Batch</label>
                            <select class="form-control custom-select" name="batch"
                                    id="batch" required>
                                <?php if (get_row_count($result_4) > 0) : ?>
                                    <?php while ($row = get_fetch_array($result_4)) : ?>
                                        <option value="<?php echo $row['batch']; ?>">
                                            <?php echo $row['batch']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <label for="notice_title">Title</label>
                            <input type="text" id="notice_title" class="form-control" name="notice_title"
                                   placeholder="Notice Title">
                        </div>
                    </div>
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <label for="notice_content">Notice</label>
                            <textarea name="notice_content" id="notice_content" class="form-control"
                                      placeholder="Notice"
                                      required></textarea>
                            <br>
                            <input type="hidden" class="form-control" name="booking_id" id="booking_id"
                                   value="<?php echo $booking_id; ?>" readonly required>
                        </div>
                    </div>
                    <div class="col-md-9 offset-md-1">
                        <div class="form-group">
                            <input type="submit" value="Send Notice" class="btn_1 medium">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->
<?php include 'includes/footer.php'; ?>