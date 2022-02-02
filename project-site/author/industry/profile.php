<?php include 'includes/header.php'; ?>

<?php
$user_id = $_SESSION['logged_id'];
$user_email = $_SESSION['email'];

$sql = "SELECT ui.industry_name,
       ui.industry_email,
       ui.industry_city,
       it.industry_category_name,
       ui.industry_address,
       ui.industry_contact_number,
       ui.industry_office_phone,
       ui.image,
       ui.image_name
FROM users_industry ui
         INNER JOIN industry_type it on ui.industry_category = it.industry_id
WHERE ui.id = '" . get_escape_sql($user_id) . "'";
$result = get_query($sql);

if (get_row_count($result) === 1) {
    $row = get_fetch_array($result);
    $industry_name = $row['industry_name'];
    $industry_city = $row['industry_city'];
    $industry_email = $row['industry_email'];
    $industry_category = $row['industry_category_name'];
    $industry_address = $row['industry_address'];
    $industry_contact_number = $row['industry_contact_number'];
    $industry_office_phone = $row['industry_office_phone'];
    $image = $row['image'];
} else {
    echo "Login First";
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
                    <h2><i class="fa fa-user"></i>Profile details</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <?php echo get_industry_account_image_upload(); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Photo</label>
                            <img src="<?php echo $image; ?>" class="img-fluid img-thumbnail" id="blah" alt="">
                            <form method="post" role="form" enctype="multipart/form-data">
                                <label for="user_img" id="user_img_label">Upload Image</label>
                                <input type="file" name="user_img_file" id="user_img" accept="image/.png, .jpg, .jpeg"
                                       onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                <input type="submit" class="btn_1 medium" value="Update Picture" name="img_upload">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Industry Name</label>
                                    <input type="text" class="form-control" value="<?php echo $industry_name; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" value="<?php echo $industry_email; ?>"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" value="<?php echo $industry_city; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" class="form-control" value="<?php echo $industry_category; ?>"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="<?php echo $industry_address; ?>"
                                           readonly>
                                </div>
                            </div>
                        </div>
                        <!-- /row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control"
                                           value="<?php echo $industry_contact_number; ?>"
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Office Phone</label>
                                    <input type="text" class="form-control"
                                           value="<?php echo $industry_office_phone; ?>"
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