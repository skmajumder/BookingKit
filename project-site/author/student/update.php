<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];
$user_email = $_SESSION['email'];

$sql = "SELECT ul.university_name,
       us.first_name,
       us.last_name,
       us.email,
       us.student_session,
       us.university_id,
       us.program,
       us.image_name,
       us.image,
       ss.session_year
FROM users_student us
         INNER JOIN university_list ul on us.university_name = ul.id
         INNER JOIN student_session ss on us.student_session = ss.id
WHERE us.id = '" . get_escape_sql($user_id) . "'";

$result = get_query($sql);
if (get_row_count($result) > 0) {
    $row = get_fetch_array($result);
    $uv_name = $row['university_name'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $student_session = $row['session_year'];
    $uv_id = $row['university_id'];
    $program = $row['program'];
    $image_name = $row['image_name'];
    $image = $row['image'];
}

?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Student Profile Update</li>
            </ol>
            <!-- /box_general-->
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-pencil"></i>Student Profile Update</h2>
                </div>
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                        <div class="update-message">
                            <?php
                            get_validate_update_student_profile();
                            the_session_display_message();
                            ?>
                        </div>
                    </div>
                </div>
                <form method="post" id="academy_profile_update" role="form">
                    <div class="row profile-update-section">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_university_name">University Name</label>
                                <input type="text" class="form-control" value="<?php echo $uv_name; ?>" readonly>
                                <span class="small-warning-text"> * This field is not editable</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_university_name">Session</label>
                                <input type="text" class="form-control" value="<?php echo $student_session; ?>"
                                       readonly>
                                <span class="small-warning-text"> * This field is not editable</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_first_name">First Name</label>
                                <input type="text" class="form-control" id="student_first_name"
                                       name="student_first_name" value="<?php echo $first_name; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_last_name">Last Name</label>
                                <input type="text" class="form-control" id="student_last_name"
                                       name="student_last_name" value="<?php echo $last_name; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_email">Email</label>
                                <input type="email" class="form-control" id="student_email"
                                       name="student_email" value="<?php echo $email; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_uv_program">Program</label>
                                <input type="text" class="form-control" id="student_uv_program"
                                       name="student_uv_program" value="<?php echo $program; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="student_id">Student University ID</label>
                                <input type="text" class="form-control" id="student_id"
                                       name="student_id" value="<?php echo $uv_id; ?>" required>
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