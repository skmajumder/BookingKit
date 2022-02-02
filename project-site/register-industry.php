<?php include 'includes/header.php'; ?>
    <!-- ::: header.php ::: -->
<?php
$sql = 'SELECT * FROM industry_type';
$result = get_query($sql);
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
                                <?php echo get_validate_registration_industry(); ?>
                            </div>
                        </div>
                        <div class="box_form">
                            <div id="message-register"></div>
                            <form method="post" id="register_form_user" role="form">
                                <!-- /row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Industry Name"
                                                   name="industry_name" id="industry_name" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="City"
                                                   name="industry_city" id="industry_city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control custom-select" name="industry_category"
                                                    id="industry_category" required>
                                                <option value="">-- Category --</option>
                                                <?php while ($row = get_fetch_array($result)) : ?>
                                                    <option value="<?php echo $row['industry_id']; ?>">
                                                        <?php echo $row['industry_category_name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Address"
                                                   name="industry_address" id="industry_address" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Contact Number"
                                                   name="industry_contact_number" id="industry_contact_number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Office Phone"
                                                   name="industry_office_phone" id="industry_office_phone" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email Address"
                                                   name="industry_email" id="industry_email" required>
                                            <span id="message_2"></span>
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
                                <div>
                                    <input type="submit" name="submit-register" class="btn_1" value="Submit"
                                           id="submit-register">
                                </div>
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

    <!-- ::: footer.php ::: -->
<?php include 'includes/footer.php'; ?>