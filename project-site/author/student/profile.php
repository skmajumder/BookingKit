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
       p.program_name,
       us.image_name,
       us.image,
       ss.session_year
FROM users_student us
         INNER JOIN university_list ul on us.university_name = ul.id
         INNER JOIN student_session ss on us.student_session = ss.id
         INNER JOIN programs p on us.program = p.program_id
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
    $program = $row['program_name'];
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
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-user-circle"></i>Student Profile details</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <?php get_student_account_image_upload(); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Photo</label>
                            <img src="<?php echo $image; ?>" class="img-fluid img-thumbnail"
                                 alt="<?php echo $image_name; ?>">
                            <form method="post" role="form" enctype="multipart/form-data">
                                <label for="student_img" id="student_img_label">Upload Image</label>
                                <input type="file" name="student_img_file" id="student_img"
                                       accept="image/.png, .jpg, .jpeg">
                                <input type="submit" class="btn_1 medium" value="Update Picture" name="img_upload">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>University Name</label>
                                    <input type="text" class="form-control" value="<?php echo $uv_name; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" value="<?php echo $first_name; ?>"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" value="<?php echo $last_name; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Session</label>
                                    <input type="text" class="form-control" value="<?php echo $student_session; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>University ID</label>
                                    <input type="text" class="form-control" value="<?php echo $uv_id; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Program</label>
                                    <input type="text" class="form-control" value="<?php echo $program; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                    </div>
                </div>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->

<?php include 'includes/footer.php'; ?>