<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];
$user_email = $_SESSION['email'];

$sql = 'SELECT * FROM industry_type';
$result = get_query($sql);

$sql_2 = "SELECT * FROM users_industry WHERE id = '" . get_escape_sql($user_id) . "'";
$result_2 = get_query($sql_2);
if (get_row_count($result) > 0) {
    $row = get_fetch_array($result_2);
    $industry_name = $row['industry_name'];
    $industry_city = $row['industry_city'];
    $industry_email = $row['industry_email'];
    $industry_category = $row['industry_category'];
    $industry_address = $row['industry_address'];
    $industry_contact_number = $row['industry_contact_number'];
    $industry_office_phone = $row['industry_office_phone'];
}
?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Update Profile</li>
            </ol>
            <!-- /box_general-->
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                    <h2><i class="fa fa-pencil-square"></i>Update info</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="update-message">
                            <?php
                            get_validate_update_industry();
                            the_session_display_message();
                            ?>
                        </div>
                    </div>
                </div>
                <form method="post" id="industry_profile_update" role="form">
                    <div class="row profile-update-section">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="update_industry_name">Industry Name</label>
                                <input type="text" class="form-control" id="update_industry_name"
                                       name="update_industry_name" value="<?php echo $industry_name; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_industry_city">City</label>
                                <input type="text" class="form-control" id="update_industry_city"
                                       name="update_industry_city" value="<?php echo $industry_city ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_industry_category">Industry Category</label>
                                <select class="form-control custom-select" id="update_industry_category"
                                        name="update_industry_category" required>
                                    <?php while ($row = get_fetch_array($result)) : ?>
                                        <option value="<?php echo $row['industry_id']; ?>" <?php if ($row['industry_id'] === $industry_category) {
                                            echo 'selected';
                                        } ?>>
                                            <?php echo $row['industry_category_name']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_industry_address">Address</label>
                                <input type="text" class="form-control"
                                       id="update_industry_address"
                                       name="update_industry_address" value="<?php echo $industry_address; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_industry_contact_number">Contact Number</label>
                                <input type="text" class="form-control"
                                       id="update_industry_contact_number"
                                       name="update_industry_contact_number"
                                       value="<?php echo $industry_contact_number; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_industry_office_number">Office Number</label>
                                <input type="text" class="form-control"
                                       id="update_industry_office_number"
                                       name="update_industry_office_number"
                                       value="<?php echo $industry_office_phone; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="update_industry_email">Email</label>
                                <input type="email" class="form-control"
                                       id="update_industry_email"
                                       name="update_industry_email" value="<?php echo $industry_email; ?>" required>
                            </div>
                        </div>
                        <!--                        <div class="col-md-6">-->
                        <!--                            <div class="form-group">-->
                        <!--                                <label for="update_industry_password">New Password</label>-->
                        <!--                                <input type="password" class="form-control" placeholder="Password"-->
                        <!--                                       id="update_industry_password"-->
                        <!--                                       name="update_industry_password">-->
                        <!--                                <meter max="4" id="update_password_strength_meter"></meter>-->
                        <!--                                <p id="update_password_strength_text"></p>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                        <div class="col-md-6">-->
                        <!--                            <div class="form-group">-->
                        <!--                                <label for="update_industry_confirm_password">Confirm Password</label>-->
                        <!--                                <input type="password" class="form-control" placeholder="Password"-->
                        <!--                                       id="update_industry_confirm_password"-->
                        <!--                                       name="update_industry_confirm_password">-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <div class="col-md-6">
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