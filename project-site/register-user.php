<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->
<?php
$sql = "SELECT * FROM university_list";
$result = get_query($sql);

$sql_2 = "SELECT * FROM student_session";
$result_2 = get_query($sql_2);

$sql_3 = "SELECT * FROM programs";
$result_3 = get_query($sql_3);
?>
    <main>
        <div class="bg_color_2">
            <div class="container margin_60_35">
                <div id="register">
                    <h1>Register as A Student</h1>
                    <div class="row justify-content-center">
                        <div class="col-md-5 text-center">
                            <?php echo get_validate_registration_user(); ?>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form id="register_form_user" method="post" role="form">
                                <div class="box_form">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                               placeholder="Your First name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                               placeholder="Your last name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                               placeholder="Your email address" required>
                                        <span id="message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="university_name">University</label>
                                        <select class="form-control custom-select" name="university_name"
                                                id="university_name" required>
                                            <option value=""> Select University</option>
                                            <?php while ($row = get_fetch_array($result)) : ?>
                                                <option value="<?php echo $row['id']; ?>">
                                                    <?php echo $row['university_name']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_university_program">Program</label>
                                        <select class="form-control custom-select" name="student_university_program"
                                                id="student_university_program" required>
                                            <option value=""> Select Program</option>
                                            <?php while ($row = get_fetch_array($result_3)) : ?>
                                                <option value="<?php echo $row['program_id']; ?>">
                                                    <?php echo $row['program_name']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_university_session">Session</label>
                                        <select class="form-control custom-select" name="student_university_session"
                                                id="student_university_session" required>
                                            <option value=""> Select Session</option>
                                            <?php while ($row = get_fetch_array($result_2)) : ?>
                                                <option value="<?php echo $row['id']; ?>">
                                                    <?php echo $row['session_year']; ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_university_id">Student ID</label>
                                        <input type="text" class="form-control" name="student_university_id"
                                               id="student_university_id" placeholder="Student University ID" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_university_batch">Batch</label>
                                        <input type="text" class="form-control" name="student_university_batch"
                                               id="student_university_batch" placeholder="Batch Number"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               placeholder="Your password" minlength="5" required>
                                        <meter max="4" id="password-strength-meter"></meter>
                                        <p id="password-strength-text"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm password</label>
                                        <input type="password" class="form-control" name="confirm_password"
                                               id="confirm_password" placeholder="Confirm password" minlength="5"
                                               required>
                                    </div>

                                    <div id="pass-info" class="clearfix"></div>

                                    <div class="form-group text-center add_top_30">
                                        <input class="btn_1 progress-button" type="submit"
                                               id="submit notification-trigger"
                                               value="Submit">
                                    </div>
                                </div>
                                <p class="text-center"><small></small></p>
                            </form>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /register -->
            </div>
        </div>
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include("includes/footer.php"); ?>