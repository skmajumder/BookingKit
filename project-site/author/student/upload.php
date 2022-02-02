<?php include 'includes/header.php'; ?>

<?php
$user_id = $_SESSION['logged_id'];
$user_email = $_SESSION['email'];

$sql = "SELECT f.uv_id_photo,
       f.cv_file,
       f.verify,
       ss.id,
       ss.session_year
FROM student_file_upload f
         INNER JOIN users_student us on f.student_id = us.id
         INNER JOIN student_session ss on us.student_session = ss.id
WHERE student_id = '" . get_escape_sql($user_id) . "'";
$result = get_query($sql);
if (get_row_count($result) > 0) {
    $row = get_fetch_array($result);
    $image_url = $row['uv_id_photo'];
    $cv_file_url = $row['cv_file'];
    $verify = $row['verify'];
    $student_session_year_id = $row['id'];
    $student_session_year = $row['session_year'];
} else {
    $verify = null;
    $image_url = 'uploads/upload-image.png';
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
                    <h2><i class="fa fa-user-circle"></i>Student Profile Verification</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <?php
                            get_student_id_photo_upload();
                            the_session_display_message();
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-3 text-center">
                        <div class="form-group">
                            <label>ID Photo</label>
                            <img src="<?php echo $image_url; ?>" class="img-fluid img-thumbnail" id="blah">
                            <form method="post" role="form" enctype="multipart/form-data">
                                <label for="student_id_img" id="student_id_img_label">Upload Image</label>
                                <input type="file" name="student_id_img_file" id="student_id_img"
                                       accept="image/.png, .jpg, .jpeg"
                                       onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                                       required>
                                <input type="submit" class="btn_1 medium" value="Update Picture"
                                       name="student_img_upload">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">

                    </div>
                </div>
            </div>
            <!-- /box_general-->
            <hr>
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-user-circle"></i>CV/Resume</h2>
                </div>
                <div class="row">
                    <?php if ($verify == 1): ?>
                    <?php if ($student_session_year_id <= 11): ?>
                    <div class="col-md-12">
                        <div class="text-center">
                            <?php
                            get_student_file_upload();
                            the_session_display_message();
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-3 text-center">
                        <div class="form-group">
                            <label>Upload CV/Resume</label>
                            <form method="post" role="form" enctype="multipart/form-data">
                                <label for="student_cv" id="student_cv_label">Upload</label>
                                <input type="file" name="student_cv_file" id="student_cv"
                                       accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                       required>
                                <input type="submit" class="btn_1 medium" value="Upload File" name="file_upload">
                            </form>
                        </div>
                        <?php if (!empty($cv_file_url)): ?>
                            <div class="form-group">
                                <label for="">Your File</label>
                                <br>
                                <a href="<?php echo $cv_file_url; ?>" class="btn btn-success" download>
                                    <i class="fa fa-download"></i> Download
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 add_top_30">
                        <span class="small-warning-text">
                            <strong>Note*: </strong>A resume is a one page summary of your work experience and background
                                relevant to the job you are applying to. A CV is a longer academic diary that includes all your
                                experience, certificates, and publications.
                        </span>
                    </div>
                </div>
                <?php else: ?>
                    <div class="col-md-12">
                        <div class="text-center">
                            <h4 class="text-danger text-capitalize">Sorry! Now you are not able For This Section.</h4>
                        </div>
                    </div>
                <?php endif; ?>
                <?php else: ?>
                    <?php if (!empty($image_url)): ?>
                        <div class="col-md-12">
                            <div class="text-center">
                                <h4 class="text-danger">Please Wait For verification</h4>
                                <h6>After Verify Your Account By Admin, You Can Add Your CV/Resume.</h6>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php if ($verify === null): ?>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h4 class="text-danger">Please Verify Your Account For This Section.</h4>
                                    <h6>Upload Your University ID Photo For verification.</h6>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->

<?php include 'includes/footer.php'; ?>