<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];

if (isset($_GET['query_id'])) {
    $student_id = $_GET['query_id'];
    $sql = "SELECT ul.university_name,
       CONCAT_WS(' ', us.first_name, us.last_name) AS name,
       us.email,
       us.university_id,
       p.program_name,
       us.image,
       ss.session_year,
       sfu.uv_id_photo,
       sfu.cv_file,
       sfu.verify
FROM users_student us
         INNER JOIN university_list ul on us.university_name = ul.id
         INNER JOIN student_session ss on us.student_session = ss.id
         INNER JOIN student_file_upload sfu on us.id = sfu.student_id
         INNER JOIN programs p on us.program = p.program_id
WHERE us.id = '" . get_escape_sql($student_id) . "'";

    $result = get_query($sql);

    if (get_row_count($result) > 0) {
        $row = get_fetch_array($result);
        $university = $row['university_name'];
        $name = $row['name'];
        $email = $row['email'];
        $university_id = $row['university_id'];
        $program = $row['program_name'];
        $image = $row['image'];
        $session_year = $row['session_year'];
        $uv_id_photo = $row['uv_id_photo'];
        $cv_file = $row['cv_file'];
        $verify = $row['verify'];
    }
} else {
    $student_id = false;
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
                    <h2><i class="fa fa-user"></i>Student Profile details</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <?php
                            get_student_account_verify_validation();
                            the_session_display_message();
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Photo</label>
                            <img src="../student/<?php echo $image; ?>" class="img-fluid img-thumbnail"
                                 alt="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>University Name</label>
                                    <input type="text" class="form-control" value="<?php echo $university; ?>"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="<?php echo $name; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
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
                                    <input type="text" class="form-control" value="<?php echo $session_year; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>University ID</label>
                                    <input type="text" class="form-control" value="<?php echo $university_id; ?>"
                                           readonly>
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

            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-user-circle"></i>Student Account Verify Section</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>University ID Photo</label>
                            <img src="../student/<?php echo $uv_id_photo; ?>" class="img-fluid img-thumbnail"
                                 alt="<?php echo $name; ?>">
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Verify</label>
                                    <input type="text" class="form-control" value="<?php
                                    if ($verify == 0) {
                                        echo "Not Verified";
                                    } else {
                                        echo "Verified";
                                    }
                                    ?>" readonly>
                                </div>
                            </div>
                            <?php if ($verify == 1): ?>
                                <?php if (!empty($cv_file)): ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>CV File</label> <br>
                                            <a href="../student/<?php echo $cv_file; ?>" class="btn btn-info" download>Download</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($verify == 0): ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <form method="post" role="form">
                                            <input type="hidden" name="student_id" id="student_id"
                                                   value="<?php echo $student_id; ?>">
                                            <input type="submit" value="Verify" class="btn_1 medium">
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->

<?php include 'includes/footer.php'; ?>