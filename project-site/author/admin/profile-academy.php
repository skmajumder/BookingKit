<?php include 'includes/header.php'; ?>

<?php
$user_id = $_SESSION['logged_id'];
if (isset($_GET['query_id'], $_GET['name'])) {
    $profile_view = 1;
    $uv_id = $_GET['query_id'];
    $sql = "SELECT ul.university_name university,
       ua.id,
       ua.university_address address,
       ua.university_department_chairman chairman,
       ua.university_department_chairman_email chairman_email,
       ua.university_department_chairman_number chairman_number,
       ua.image,
       ua.verify,
       fa.faculty_name faculty,
       d.department_name department,
       ua.university_office_phone phone,
       ua.university_email email,
       (SELECT COUNT(booking.id) FROM booking WHERE booking.academy_id = ua.id) AS total_booking
FROM users_academy ua
         INNER JOIN university_list ul ON ua.university_name = ul.id
         INNER JOIN faculty fa ON ua.faculty_category = fa.faculty_id
         INNER JOIN department d ON ua.department_category = d.department_id 
WHERE ua.id = '" . get_escape_sql($uv_id) . "'";
    $result = get_query($sql);

    if (get_row_count($result) === 1) {
        $row = get_fetch_array($result);
        $university = $row['university'];
        $id = $row['id'];
        $address = $row['address'];
        $chairman = $row['chairman'];
        $chairman_email = $row['chairman_email'];
        $chairman_number = $row['chairman_number'];
        $image = $row['image'];
        $verify = $row['verify'];
        $faculty = $row['faculty'];
        $department = $row['department'];
        $chairman_email = $row['chairman_email'];
        $phone = $row['phone'];
        $email = $row['email'];
    }
} else {
    $profile_view = 0;
}
?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Academy Profile</li>
            </ol>

            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-university"></i>Academy details</h2>
                </div>
                <?php if ($profile_view == 1): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center">
                                <?php
                                get_validate_academy_profile();
                                get_verify_academy_account();
                                the_session_display_message();
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Photo</label>
                                <img src="../academy/<?php echo $image; ?>" class="img-fluid img-thumbnail"
                                     alt="<?php echo $university; ?>">
                            </div>
                        </div>
                        <div class="col-md-8 add_top_30">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>University</label>
                                        <input type="text" class="form-control" value="<?php echo $university; ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" value="<?php echo $address; ?>"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>University Phone Number</label>
                                        <input type="text" class="form-control" value="<?php echo $phone; ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>University Email Address</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Faculty</label>
                                        <input type="text" class="form-control" value="<?php echo $faculty; ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input type="text" class="form-control" value="<?php echo $department; ?>"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department Chairman</label>
                                        <input type="text" class="form-control" value="<?php echo $chairman; ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chairman Phone</label>
                                        <input type="text" class="form-control" value="<?php echo $chairman_number; ?>"
                                               readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chairman Email</label>
                                        <input type="email" class="form-control" value="<?php echo $chairman_email; ?>"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /row-->
                        </div>
                    </div>
                    <div class="header_box version_2">
                        <h2><i class="fa fa-envelope-open"></i>Academy Account Verify Section</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6 add_top_30">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Verify</label>
                                        <?php
                                        if ($verify == 0) {
                                            echo "<input type='text' class='form-control' value='Not Verified' readonly>";
                                            echo "
                                                <div class='form-group'>
                                                    <small class='error_message'>For Verify Account To Send a Mail According to
                                                        Chairman</small>
                                                </div>
                                            ";
                                        } else {
                                            echo "<input type='text' class='form-control' value='Verified' readonly>";
                                        }
                                        ?>

                                    </div>
                                </div>
                                <?php if ($verify == 0): ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <form method="post" role="form">
                                                <input type="hidden" class="form-control" name="chairman_name"
                                                       value="<?php echo $chairman; ?>"
                                                       required readonly>
                                                <input type="hidden" class="form-control" name="chairman_email"
                                                       value="<?php echo $chairman_email; ?>"
                                                       required readonly>
                                                <input type="hidden" class="form-control" name="university"
                                                       value="<?php echo $university; ?>"
                                                       readonly>
                                                <input type="hidden" class="form-control" name="faculty"
                                                       value="<?php echo $faculty; ?>"
                                                       readonly>
                                                <input type="hidden" class="form-control" name="department"
                                                       value="<?php echo $department; ?>"
                                                       readonly>
                                                <input type="submit" class="btn_1 small" value="Send Mail"
                                                       name="send_mail_academy_account">
                                            </form>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($verify == 0): ?>
                            <div class="col-md-6 add_top_30">
                                <form method="post" role="form">
                                    <div class="form-group">
                                        <h6>Verify <?php echo $university; ?></h6>
                                        <small class="error_message">Receive A Confirm Message? If ok Then
                                            Verify</small>
                                        <br>
                                        <input type="hidden" class="form-control" name="university_id"
                                               value="<?php echo $id; ?>"
                                               required readonly>
                                        <input type="submit" class="btn_1 small" value="Verify"
                                               name="verify_academy_account">
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>Please Select Academy Profile.</h4>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->

<?php include 'includes/footer.php'; ?>