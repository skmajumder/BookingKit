<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];
$user_email = $_SESSION['email'];

$sql = "SELECT ul.university_name university,
       ua.university_address address,
       fa.faculty_name faculty,
       d.department_name department,
       ua.university_department_chairman chairman,
       ua.university_department_chairman_email chairman_email,
       ua.university_department_chairman_number chairman_number,
       ua.university_office_phone phone,
       ua.university_email email
FROM users_academy ua
         INNER JOIN university_list ul ON ua.university_name = ul.id
         INNER JOIN faculty fa ON ua.faculty_category = fa.faculty_id
         INNER JOIN department d ON ua.department_category = d.department_id
WHERE ua.id = '" . get_escape_sql($user_id) . "'";
$result = get_query($sql);
if (get_row_count($result) > 0) {
    $row = get_fetch_array($result);
    $university = $row['university'];
    $address = $row['address'];
    $faculty = $row['faculty'];
    $department = $row['department'];
    $chairman = $row['chairman'];
    $chairman_email = $row['chairman_email'];
    $chairman_number = $row['chairman_number'];
    $phone = $row['phone'];
    $email = $row['email'];
}
//$sql_2 = "SELECT * FROM university_list";
//$result_2 = get_query($sql_2);
//
//$sql_3 = "SELECT * FROM faculty";
//$result_3 = get_query($sql_3);
//
//$sql_4 = "SELECT * FROM department";
//$result_4 = get_query($sql_4);

?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Academy Profile Update</li>
            </ol>
            <!-- /box_general-->
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-pencil"></i>Academy Profile Update</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="update-message">
                            <h4>
                                <?php
                                get_validate_update_academy();
                                the_session_display_message();
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <form method="post" id="academy_profile_update" role="form">
                    <div class="row profile-update-section">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="university_name">University Name</label>
                                <input type="text" class="form-control" id="university_name"
                                       name="university_name" value="<?php echo $university; ?>" readonly>
                                <span class="small-warning-text"> * This field is not editable</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_academy_faculty">Faculty</label>
                                <input type="text" class="form-control" id="update_academy_faculty"
                                       name="update_academy_faculty" value="<?php echo $faculty; ?>" readonly>
                                <span class="small-warning-text"> * This field is not editable</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_academy_department">Department</label>
                                <input type="text" class="form-control" id="update_academy_department"
                                       name="update_academy_department" value="<?php echo $department; ?>" readonly>
                                <span class="small-warning-text"> * This field is not editable</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_academy_address">Address</label>
                                <input type="text" class="form-control" id="update_academy_address"
                                       name="update_academy_address" value="<?php echo $address; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_department_chairman">Department Chairman</label>
                                <input type="text" class="form-control" id="update_department_chairman"
                                       name="update_department_chairman" value="<?php echo $chairman; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_chairman_email">Chairman Email</label>
                                <input type="email" class="form-control" id="update_chairman_email"
                                       name="update_chairman_email" value="<?php echo $chairman_email; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_chairman_number">Chairman Number</label>
                                <input type="text" class="form-control" id="update_chairman_number"
                                       name="update_chairman_number" value="<?php echo $chairman_number; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_office_phone">University Official Number</label>
                                <input type="text" class="form-control" id="update_office_phone"
                                       name="update_office_phone" value="<?php echo $phone; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_academy_email">University Email Address</label>
                                <input type="email" class="form-control" id="update_academy_email"
                                       name="update_academy_email" value="<?php echo $email; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="submit_industry_update" class="btn_1" value="Update"
                                       id="submit_industry_update">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /row-->
        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->

<?php include 'includes/footer.php'; ?>