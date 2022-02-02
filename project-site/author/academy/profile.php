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
       ua.university_email email,
       ua.image_name,
       ua.image image_path,
       ua.university_name uv_id
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
    $image_name = $row['image_name'];
    $image_path = $row['image_path'];
} else {
    echo "Sorry! No Data Found.";
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
                    <h2><i class="fa fa-university"></i>Academy Profile details</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <?php echo get_academy_account_image_upload(); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Photo</label>
                            <img src="<?php echo $image_path; ?>" class="img-fluid img-thumbnail" id="blah"
                                 alt="<?php echo $image_name; ?>">
                            <form method="post" role="form" enctype="multipart/form-data">
                                <label for="academy_img" id="academy_img_label">Upload Image</label>
                                <input type="file" name="academy_img_file" id="academy_img"
                                       accept="image/.png, .jpg, .jpeg"
                                       onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <input type="submit" class="btn_1 medium" value="Update Picture" name="img_upload">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>University Name</label>
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
                                    <label>Chairman Email</label>
                                    <input type="text" class="form-control" value="<?php echo $chairman_email; ?>"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Chairman Number</label>
                                    <input type="text" class="form-control"
                                           value="<?php echo $chairman_number; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Official Phone Number</label>
                                    <input type="text" class="form-control" value="<?php echo $phone; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Official Email</label>
                                    <input type="email" class="form-control"
                                           value="<?php echo $email; ?>"
                                           readonly>
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