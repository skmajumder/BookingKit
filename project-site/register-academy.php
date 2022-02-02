<?php include("includes/header.php"); ?>
<!-- ::: header.php ::: -->
<?php
$sql = "SELECT * FROM university_list";
$result = get_query($sql);

$sql_2 = "SELECT * FROM faculty";
$result_2 = get_query($sql_2);
?>
<main>
    <div id="hero_register">
        <div class="container margin_120_95">
            <div class="row">
                <div class="col-lg-6">
                    <h1>It take few minute to complete this Registration.</h1>
                </div>
                <!-- /col -->
                <div class="col-lg-5 ml-auto">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                            <?php echo get_validate_registration_academy(); ?>
                        </div>
                    </div>
                    <div class="box_form">
                        <div id="message-register"></div>
                        <form id="register_form_user" method="post" role="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select class="form-control custom-select" name="university_name"
                                                id="university_name" required>
                                            <option value="">-- Select University --</option>
                                            <?php while ($row = get_fetch_array($result)) : ?>
                                                <option value="<?php echo $row['id']; ?>">
                                                    <?php echo $row['university_name']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Address"
                                               name="university_address" id="university_address" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control custom-select" name="faculty_category"
                                                id="faculty_category" required>
                                            <option value="">-- Select Faculty --</option>
                                            <?php while ($row_2 = get_fetch_array($result_2)) : ?>
                                                <option value="<?php echo $row_2['faculty_id']; ?>">
                                                    <?php echo $row_2['faculty_name']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control custom-select" name="department_category"
                                                id="department_category" required>
                                            <option value="">-- Select Department --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Department Chairman Name"
                                               name="university_department_chairman" id="university_department_chairman"
                                               minlength="2" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Department Chairman Email"
                                               name="university_department_chairman_email"
                                               id="university_department_chairman_email" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Department Chairman Number"
                                               name="university_department_chairman_number"
                                               id="university_department_chairman_number" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Official Phone Number"
                                               name="university_office_phone" id="university_office_phone" required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Official Email Address"
                                               name="university_email" id="university_email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="Password" minlength="5" required>
                                        <meter max="4" id="password-strength-meter"></meter>
                                        <p id="password-strength-text"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm password</label>
                                        <input type="password" class="form-control" name="confirm_password"
                                               id="confirm_password" placeholder="Confirm password" minlength="5"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div><input type="submit" class="btn_1" value="Submit" id="submit-register"></div>
                        </form>
                    </div>
                    <!-- /box_form -->
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /hero_register -->
</main>
<!-- /main -->

<?php include("includes/footer.php"); ?>
<!-- ::: footer.php ::: -->
