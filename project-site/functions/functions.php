<?php

/*  ::::: helper functions :::::    */

/*
 * This function used to transform all characters which are applicable to HTML entities.
 * This function converts all characters that are applicable to HTML entity.
*/
function get_clean($string)
{
    return htmlentities($string);
}

/*
 * This function is used to send a raw HTTP header.
 * The HTTP functions are those functions which manipulate information sent to the client or browser by the Web server, before any other output has been sent.
 */
function get_redirect($location)
{
    return header("Location: {$location}");
}

/*
 * This function is used to set a session message.
 */
function set_message($message)
{
    if (!empty($message))
        $_SESSION['message'] = $message;
    else
        $_SESSION = "";
}

/*
 * This function is used to display session message.
 */
function the_session_display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

/*
 * This function is used to generating a random token.
 */
function get_token_generator()
{
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    return $token = $_SESSION['token'];
}

/*
 * This function is used to get the validation error.
 */
function get_validation_errors($error_message)
{
    $error_message = <<<DELIMITER
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> $error_message
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
DELIMITER;
    return $error_message;
}

/*
 * This function is used to get the Confirm Message
 */
function get_validation_message($the_message)
{
    $the_message = <<<DELIMITER
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Message</strong> $the_message
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
DELIMITER;
    return $the_message;
}

/*
 * This function is used to get the Valid Email for User Registration.
 */
function get_email_exists($email)
{
    $sql = "SELECT id FROM login WHERE email = '$email'";
    $result = get_query($sql);
    if (get_row_count($result) == 1) return true;
    else return false;
}

function get_email_exists_update($email)
{
    $sql = "SELECT id FROM login WHERE email = '$email' AND id <> '" . get_escape_sql($_SESSION['login_id_check']) . "'";
    $result = get_query($sql);
    if (get_row_count($result) == 1) {
        return true;
    } else {
        return false;
    }
}

/*
 * This function is used to get the Valid Email for User Registration.
 */
function get_email_exists_student($email)
{
    $sql = "SELECT id FROM users_student WHERE email = '$email'";
    $result = get_query($sql);
    if (get_row_count($result) == 1) return true;
    else return false;
}

/*
 * This function is used to get the Valid Email for Industry Registration.
 */
function get_email_exists_industry($email)
{
    $sql = "SELECT id FROM users_industry WHERE industry_email = '$email'";
    $result = get_query($sql);
    if (get_row_count($result) == 1) return true;
    else return false;
}

/*
 * This function is used to get the Valid Email for Industry Registration.
 */
function get_email_exists_academy($email)
{
    $sql = "SELECT id FROM users_academy WHERE university_email = '$email'";
    $result = get_query($sql);
    if (get_row_count($result) == 1) return true;
    else return false;
}

/*
 * This function is used to Send Activation Email.
 */
function get_send_email($email, $subject, $message, $headers)
{
    return mail($email, $subject, $message, $headers);
}

/*  ::::: validation functions :::::    */

/*
 * This function is used to Valid the user register data.
 */
function get_validate_registration_user()
{
    $errors = [];
    $min = 3;
    $max = 20;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        /*  ::::: Store form Value in variable :::::    */
        $first_name = get_clean($_POST['first_name']);
        $last_name = get_clean($_POST['last_name']);
        $email = get_clean($_POST['email']);
        $university_name = get_clean($_POST['university_name']);
        $student_university_session = get_clean($_POST['student_university_session']);
        $student_university_id = get_clean($_POST['student_university_id']);
        $student_university_program = get_clean($_POST['student_university_program']);
        $student_university_batch = get_clean($_POST['student_university_batch']);
        $password = get_clean($_POST['password']);
        $confirm_password = get_clean($_POST['confirm_password']);

        if (strlen($first_name) < $min) $errors[] = "<span class='server_error_message'>Your First Name must consist of at least {$min} characters.</span>";
        if (strlen($last_name) < $min) $errors[] = "<span class='server_error_message'>Your Last Name must consist of at least {$min} characters.</span>";
        if (get_email_exists($email)) $errors[] = "<span class='server_error_message'>Sorry {$email} already registered.</span>";
        if (empty($student_university_program)) $errors[] = "<span class='server_error_message'>Sorry Program Can't Empty</span>";
        if (empty($student_university_batch)) $errors[] = "<span class='server_error_message'>Sorry Batch Can't Empty</span>";
        if ($confirm_password !== $password) $errors[] = "<span class='server_error_message'>Passwords do not match.</span>";
        if (!empty($errors)) foreach ($errors as $error) echo get_validation_errors($error);
        else {
            if (get_register_user($first_name, $last_name, $email, $university_name, $student_university_session, $student_university_id, $student_university_program, $student_university_batch, $password)) {
                set_message("Please Check Your Email for Activation");
                get_redirect("confirm-user.php");
            } else {
                set_message("Sorry! User Registration is Failed.");
                get_redirect("failed-user.php");
            }
        }
    }
}

/*  ::::: Register User functions :::::    */

/*
 * This function is used to user registration.
 */
function get_register_user($first_name, $last_name, $email, $university_name, $student_university_session, $student_university_id, $student_university_program, $student_university_batch, $password)
{
    $first_name = get_escape_sql($first_name);
    $last_name = get_escape_sql($last_name);
    $email = get_escape_sql($email);
    $university_name = get_escape_sql($university_name);
    $student_university_session = get_escape_sql($student_university_session);
    $student_university_id = get_escape_sql($student_university_id);
    $student_university_program = get_escape_sql($student_university_program);
    $student_batch_validation = get_escape_sql($student_university_batch);
    $student_university_batch = strtolower(str_replace('-', '', $student_batch_validation));
    $password = get_escape_sql($password);


    if (get_email_exists($email)) return false;
    else {
        $password = md5($password);
        $validation_code = md5($email . microtime());
        $sql = "INSERT INTO users_student(first_name, last_name, email, university_name, student_session, university_id, program, batch, password, validation_code, active, user_type)";
        $sql .= " VALUES('$first_name','$last_name','$email','$university_name','$student_university_session','$student_university_id', '$student_university_program', '$student_university_batch', '$password', '$validation_code',0,3)";
        $result = get_query($sql);

        $sql_2 = "INSERT INTO login(email, password, user_type, active)";
        $sql_2 .= " VALUES('$email','$password',3,0)";
        $result_2 = get_query($sql_2);

        $subject = "Activate Account.";
        $message = "
            Hi,
            - Your Registration has been complete.
            - Go to http://localhost/project-site/activate.php?email=$email&code=$validation_code
        ";
        $headers = "From: noreply@yourwebsite.com";
        get_send_email($email, $subject, $message, $headers);
        return true;
    }
}

/*  ::::: Activation User functions :::::    */

/*
 * This function is used to Activate user account.
 */
function get_activate_user()
{
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['email'])) {
            $email = get_clean($_GET['email']);
            $validation_code = get_clean($_GET['code']);
            $sql = "SELECT id FROM users_student WHERE email = '" . get_escape_sql($_GET['email']) . "' AND validation_code = '" . get_escape_sql($_GET['code']) . "'";
            $result = get_query($sql);
            if (get_row_count($result) == 1) {
                $sql_2 = "UPDATE users_student SET active = 1, validation_code = 0 WHERE email = '" . get_escape_sql($email) . "' AND validation_code = '" . get_escape_sql($validation_code) . "'";
                $result_2 = get_query($sql_2);

                $sql_3 = "UPDATE login SET active = 1 WHERE email = '" . get_escape_sql($email) . "'";
                $result_3 = get_query($sql_3);

                set_message("<h3>Account has been activated.</h3>");
                get_redirect("login.php");
            }
        } else {
            set_message("<h3>Error! No code found.</h3>");
            get_redirect("register.php");
        }
    }
}

function get_student_account_verify_validation()
{
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $student_id = get_clean($_POST['student_id']);

        if (empty($student_id)) {
            $errors[] = "<span class='server_error_message'>Student ID Can't be Empty.</span>";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_student_account_verify($student_id)) {
                set_message("<h6>Account Verify</h6>");
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                set_message("<h6>Error! Account Verify Failed</h6>");
            }
        }
    }
}

function get_student_account_verify($student_id)
{
    $student_id = get_escape_sql($student_id);
    if (empty($student_id)) {
        return false;
    } else {
        $sql = "UPDATE student_file_upload SET verify = 1 WHERE student_id = '$student_id'";
        $result = get_query($sql);
        return true;
    }
}

/*  ::::: Academy Account Image :::::    */
function get_student_account_image_upload()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get image name
        $image = $_FILES['student_img_file']['name'];
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
            // image file directory
            $target = 'uploads/' . basename($image);

            $sql = "UPDATE users_student SET image_name = '" . get_escape_sql($image) . "', image = '" . get_escape_sql($target) . "' WHERE id = '" . get_escape_sql($_SESSION['logged_id']) . "'";
            $result = get_query($sql);

            if (move_uploaded_file($_FILES['student_img_file']['tmp_name'], $target)) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo $msg = "Failed to upload image";
            }
        } else {
            echo "File is not image";
        }
    }
}

/*  ::::: Academy Account Image :::::    */
function get_student_id_photo_upload()
{
    if (isset($_POST['student_img_upload'])) {
        // Get image name
        $user_id = get_escape_sql($_SESSION['logged_id']);
        $image = $_FILES['student_id_img_file']['name'];
        if (!empty($image)) {
            $extension = pathinfo($image, PATHINFO_EXTENSION);

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                // image file directory
                $target = 'uploads/' . basename($image);
                if (move_uploaded_file($_FILES['student_id_img_file']['tmp_name'], $target)) {
                    $sql = "INSERT INTO student_file_upload(student_id, uv_id_photo, verify)";
                    $sql .= " VALUES('$user_id','$target', 0)";
                    $result = get_query($sql);
                    set_message("<h6>Image Upload Successfully</h6>");
                    echo "<meta http-equiv='refresh' content='1'>";
                } else {
                    echo $msg = "Failed to upload image";
                }
            } else {
                echo "File is not image";
            }
        } else {
            set_message("<h6>Image Field Can't be Empty.</h6>");
        }
    }
}

function get_student_file_upload()
{
    if (isset($_POST['file_upload'])) {
        // Get file name
        $file = $_FILES['student_cv_file']['name'];
        $size = get_escape_sql($_FILES['student_cv_file']['size']);
        $user_id = get_escape_sql($_SESSION['logged_id']);

        if (!empty($file)) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if ($extension == 'pdf' || $extension == 'doc' || $extension == 'docx') {
                if ($size > 1000) {
                    $target = 'uploads/' . basename($file);
                    if (move_uploaded_file($_FILES['student_cv_file']['tmp_name'], $target)) {
                        $sql = "UPDATE student_file_upload SET cv_file = '" . get_escape_sql($target) . "' WHERE student_id = '$user_id'";
                        $result = get_query($sql);
                        set_message("File Upload Successfully.");
                        echo "<meta http-equiv='refresh' content='1'>";
                    } else {
                        set_message("Error! File Upload Failed.");
                    }
                } else {
                    set_message("File too large! File shouldn't be larger than 1 MB");
                }
            } else {
                set_message("Please Upload Only .pdf, .doc, .docx File");
            }
        }
    }
}

function get_validate_update_student_profile()
{
    $errors_update = [];
    $min = 2;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $student_first_name = get_clean($_POST['student_first_name']);
        $student_last_name = get_clean($_POST['student_last_name']);
        $student_email = get_clean($_POST['student_email']);
        $student_uv_program = get_clean($_POST['student_uv_program']);
        $student_id = get_clean($_POST['student_id']);

        if (strlen($student_first_name) < $min) {
            $errors_update[] = "<span class='server_error_message'>First Name must consist of at least {$min} characters.</span>";
        }

        if (strlen($student_last_name) < $min) {
            $errors_update[] = "<span class='server_error_message'>Last Name must consist of at least {$min} characters.</span>";
        }

        if (get_email_exists_update($student_email)) {
            $errors_update[] = "<span class='server_error_message'>Sorry {$student_email} already registered. Use Another Email Address.</span>";
        }

        if (empty($student_uv_program)) {
            $errors_update[] = "<span class='server_error_message'>Sorry Program Can't be Empty</span>";
        }

        if (empty($student_id)) {
            $errors_update[] = "<span class='server_error_message'>Sorry University ID Can't be Empty</span>";
        }

        if (!empty($errors_update)) {
            foreach ($errors_update as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_update_student_profile($student_first_name, $student_last_name, $student_email, $student_uv_program, $student_id)) {
                set_message("<h6>Update Successfully.<br/> This Page Will Refresh in a Second.</h6>");
                echo "<meta http-equiv='refresh' content='1'>";
            } else {
                set_message("<h6>Update Failed. Try Again.</h6>");
            }
        }
    }
}

function get_update_student_profile($student_first_name, $student_last_name, $student_email, $student_uv_program, $student_id)
{
    $student_first_name = get_escape_sql($student_first_name);
    $student_last_name = get_escape_sql($student_last_name);
    $student_email = get_escape_sql($student_email);
    $student_uv_program = get_escape_sql($student_uv_program);
    $student_id = get_escape_sql($student_id);
    $user_id = get_escape_sql($_SESSION['logged_id']);

    if (get_email_exists_update($student_email)) {
        return false;
    } else {
        $sql = "UPDATE users_student
            SET first_name    = '$student_first_name',
                last_name     = '$student_last_name',
                email         = '$student_email',
                program       = '$student_uv_program',
                university_id = '$student_id'
            WHERE id = '" . $user_id . "'";
        $result = get_query($sql);

        $sql_2 = "UPDATE login SET email = '$student_email' WHERE id = '" . get_escape_sql($_SESSION['login_id_check']) . "'";
        $result = get_query($sql_2);
        return true;
    }
}


/*  ::::: validation functions Industry :::::    */

/*
 * This function is used to Valid the industry register data.
 */
function get_validate_registration_industry()
{
    $errors = [];
    $min = 3;
    $max = 20;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        /*  ::::: Store form Value in variable :::::    */
        $industry_name = get_clean($_POST['industry_name']);
        $industry_city = get_clean($_POST['industry_city']);
        $industry_category = get_clean($_POST['industry_category']);
        $industry_address = get_clean($_POST['industry_address']);
        $industry_contact_number = get_clean($_POST['industry_contact_number']);
        $industry_office_phone = get_clean($_POST['industry_office_phone']);
        $industry_email = get_clean($_POST['industry_email']);
        $password = get_clean($_POST['password']);
        $confirm_password = get_clean($_POST['confirm_password']);

        if (strlen($industry_name) < $min) $errors[] = "<span class='server_error_message'>Industry Name must consist of at least {$min} characters.</span>";
        if (strlen($industry_city) < $min) $errors[] = "<span class='server_error_message'>City Name must consist of at least {$min} characters.</span>";
        if (get_email_exists($industry_email)) $errors[] = "<span class='server_error_message'>Sorry {$industry_email} already registered. Use Another Email Address.</span>";
        if ($confirm_password !== $password) $errors[] = "<span class='server_error_message'>Passwords do not match.</span>";
        if (!empty($errors)) foreach ($errors as $error) echo get_validation_errors($error);
        else {
            if (get_register_industry($industry_name, $industry_city, $industry_category, $industry_address, $industry_contact_number, $industry_office_phone, $industry_email, $password)) {
                set_message('Please Check Your Email for Activation');
                get_redirect('confirm-user.php');
            } else {
                set_message('Sorry! User Registration is Failed.');
                get_redirect('failed-user.php');
            }
        }
    }
}

/*  ::::: Register Industry functions :::::    */

/*
 * This function is used to industry registration.
 */
function get_register_industry($industry_name, $industry_city, $industry_category, $industry_address, $industry_contact_number, $industry_office_phone, $industry_email, $password)
{
    $industry_name = get_escape_sql($industry_name);
    $industry_city = get_escape_sql($industry_city);
    $industry_category = get_escape_sql($industry_category);
    $industry_address = get_escape_sql($industry_address);
    $industry_contact_number = get_escape_sql($industry_contact_number);
    $industry_office_phone = get_escape_sql($industry_office_phone);
    $industry_email = get_escape_sql($industry_email);
    $password = get_escape_sql($password);

    if (get_email_exists($industry_email)) return false;
    else {
        $password = md5($password);
        $validation_code = md5($industry_email . microtime());
        $sql = "INSERT INTO users_industry(industry_name, industry_city, industry_category, industry_address, industry_contact_number, industry_office_phone, industry_email, password, validation_code, active, user_type)";
        $sql .= " VALUES('$industry_name','$industry_city','$industry_category','$industry_address','$industry_contact_number','$industry_office_phone','$industry_email','$password','$validation_code',0,1)";
        $result = get_query($sql);

        $sql_2 = "INSERT INTO login(email, password, user_type, active)";
        $sql_2 .= " VALUES('$industry_email','$password',1,0)";
        $result_2 = get_query($sql_2);

        $subject = "Activate Account.";
        $message = "
                Hi,
                - Your Registration has been complete.
                - Go to page For http://localhost/project-site/activate.php?email=$industry_email&code=$validation_code
            ";
        $headers = "From: noreply@yourwebsite.com";
        get_send_email($industry_email, $subject, $message, $headers);
        return true;
    }
}

/*  ::::: Activation User functions :::::    */

/*
 * This function is used to Activate user account.
 */
function get_activate_industry()
{
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['email'])) {
            $email = get_clean($_GET['email']);
            $validation_code = get_clean($_GET['code']);
            $sql = "SELECT id FROM users_industry WHERE industry_email = '" . get_escape_sql($_GET['email']) . "' AND validation_code = '" . get_escape_sql($_GET['code']) . "'";
            $result = get_query($sql);

            if (get_row_count($result) == 1) {
                $sql_2 = "UPDATE users_industry SET active = 1, validation_code = 0 WHERE industry_email = '" . get_escape_sql($email) . "' AND validation_code = '" . get_escape_sql($validation_code) . "'";
                $result_2 = get_query($sql_2);

                $sql_3 = "UPDATE login SET active = 1 WHERE email = '" . get_escape_sql($email) . "'";
                $result_3 = get_query($sql_3);

                set_message("<h3>Account has been activated.</h3>");
                get_redirect("login.php");
            }
        } else {
            set_message("<h3>Error! No code found.</h3>");
            get_redirect("register.php");
        }
    }
}

/*  ::::: Industry Account Image :::::    */
function get_industry_account_image_upload()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get image name
        $image = $_FILES['user_img_file']['name'];
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
            // image file directory
            $target = 'uploads/' . basename($image);

            $sql = "UPDATE users_industry SET image = '" . get_escape_sql($target) . "', image_name = '" . get_escape_sql($image) . "' WHERE id = '" . get_escape_sql($_SESSION['logged_id']) . "' AND industry_email = '" . get_escape_sql($_SESSION['email']) . "'";
            $result = get_query($sql);

            if (move_uploaded_file($_FILES['user_img_file']['tmp_name'], $target)) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo $msg = "Failed to upload image";
            }
        } else {
            echo "File is not image";
        }
    }
}

/*  ::::: validation functions for update Industry Profile :::::    */

/*
 * This function is used to Valid the industry profile update.
*/

function get_validate_update_industry()
{
    $errors_update = [];
    $min = 2;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $update_industry_name = get_clean($_POST['update_industry_name']);
        $update_industry_city = get_clean($_POST['update_industry_city']);
        $update_industry_category = get_clean($_POST['update_industry_category']);
        $update_industry_address = get_clean($_POST['update_industry_address']);
        $update_industry_contact_number = get_clean($_POST['update_industry_contact_number']);
        $update_industry_office_number = get_clean($_POST['update_industry_office_number']);
        $update_industry_email = get_clean($_POST['update_industry_email']);

        if (strlen($update_industry_name) < $min) {
            $errors_update[] = "<span class='server_error_message'>Industry Name must consist of at least {$min} characters.</span>";
        }
        if (strlen($update_industry_city) < $min) {
            $errors_update[] = "<span class='server_error_message'>City Name must consist of at least {$min} characters.</span>";
        }
        if (get_email_exists_update($update_industry_email)) {
            $errors_update[] = "<span class='server_error_message'>Sorry {$update_industry_email} already registered. Use Another Email Address.</span>";
        }

        if (!empty($errors_update)) {
            foreach ($errors_update as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_update_industry($update_industry_name, $update_industry_city, $update_industry_category, $update_industry_address, $update_industry_contact_number, $update_industry_office_number, $update_industry_email)) {
                set_message('Update Successfully');
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                set_message('Sorry! Update is Failed.');
            }
        }
    }
}

function get_update_industry($update_industry_name, $update_industry_city, $update_industry_category, $update_industry_address, $update_industry_contact_number, $update_industry_office_number, $update_industry_email)
{
    $update_industry_name = get_escape_sql($update_industry_name);
    $update_industry_city = get_escape_sql($update_industry_city);
    $update_industry_category = get_escape_sql($update_industry_category);
    $update_industry_address = get_escape_sql($update_industry_address);
    $update_industry_contact_number = get_escape_sql($update_industry_contact_number);
    $update_industry_office_number = get_escape_sql($update_industry_office_number);
    $update_industry_email = get_escape_sql($update_industry_email);

    if (get_email_exists_update($update_industry_email)) {
        return false;
    } else {
        $sql = "UPDATE users_industry SET industry_name = '$update_industry_name', industry_city = '$update_industry_city',
        industry_category = '$update_industry_category', industry_address = '$update_industry_address', 
        industry_contact_number = '$update_industry_contact_number', industry_office_phone = '$update_industry_office_number', 
        industry_email = '$update_industry_email' WHERE id = '" . get_escape_sql($_SESSION['logged_id']) . "'";
        $result = get_query($sql);

        $sql_2 = "UPDATE login SET email = '$update_industry_email' WHERE id = '" . get_escape_sql($_SESSION['login_id_check']) . "'";
        $result = get_query($sql_2);
        return true;
    }
}


/*  ::::: validation functions Academy :::::    */

function get_validate_registration_academy()
{
    $errors = [];
    $min = 2;
    $max = 20;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        /*  ::::: Store form Value in variable :::::    */
        $university_name = get_clean($_POST['university_name']);
        $university_address = get_clean($_POST['university_address']);
        $faculty_category = get_clean($_POST['faculty_category']);
        $department_category = get_clean($_POST['department_category']);
        $university_department_chairman = get_clean($_POST['university_department_chairman']);
        $university_department_chairman_email = get_clean($_POST['university_department_chairman_email']);
        $university_department_chairman_number = get_clean($_POST['university_department_chairman_number']);
        $university_office_phone = get_clean($_POST['university_office_phone']);
        $university_email = get_clean($_POST['university_email']);
        $password = get_clean($_POST['password']);
        $confirm_password = get_clean($_POST['confirm_password']);

        if (strlen($university_name) < $min) $errors[] = "<span class='server_error_message'>University Name must consist of at least {$min} characters.</span>";
        if (strlen($university_department_chairman) < $min) $errors[] = "<span class='server_error_message'>Name must consist of at least {$min} characters.</span>";
        if (get_email_exists($university_email)) $errors[] = "<span class='server_error_message'>Sorry {$university_email} already registered. Use Another Email Address.</span>";
        if ($confirm_password !== $password) $errors[] = "<span class='server_error_message'>Passwords do not match.</span>";
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_register_academy($university_name, $university_address, $faculty_category, $department_category, $university_department_chairman, $university_department_chairman_email, $university_department_chairman_number, $university_office_phone, $university_email, $password)) {
                set_message("Please Check Your Email for Activation");
                get_redirect("confirm-user.php");
            } else {
                set_message("Sorry! User Registration is Failed.");
                get_redirect("failed-user.php");
            }
        }
    }
}

function get_register_academy($university_name, $university_address, $faculty_category, $department_category, $university_department_chairman, $university_department_chairman_email, $university_department_chairman_number, $university_office_phone, $university_email, $password)
{
    $university_name = get_escape_sql($university_name);
    $university_address = get_escape_sql($university_address);
    $faculty_category = get_escape_sql($faculty_category);
    $department_category = get_escape_sql($department_category);
    $university_department_chairman = get_escape_sql($university_department_chairman);
    $university_department_chairman_email = get_escape_sql($university_department_chairman_email);
    $university_department_chairman_number = get_escape_sql($university_department_chairman_number);
    $university_office_phone = get_escape_sql($university_office_phone);
    $university_email = get_escape_sql($university_email);
    $password = get_escape_sql($password);

    if (get_email_exists($university_email))
        return false;
    else {
        $password = md5($password);
        $validation_code = md5($university_email . microtime());
        $sql = "INSERT INTO users_academy(university_name, university_address, faculty_category, department_category, university_department_chairman, university_department_chairman_email, university_department_chairman_number, university_office_phone, university_email, password, validation_code, active, user_type)";
        $sql .= " VALUES('$university_name','$university_address','$faculty_category','$department_category','$university_department_chairman','$university_department_chairman_email','$university_department_chairman_number','$university_office_phone','$university_email','$password','$validation_code',0,2)";
        $result = get_query($sql);

        $sql_2 = "INSERT INTO login(email, password, user_type, active)";
        $sql_2 .= " VALUES('$university_email','$password',2,0)";
        $result_2 = get_query($sql_2);

        $subject = "Activate Account.";
        $message = "
                Hi,
                - Your Registration has been complete.
                - Go to page For http://localhost/project-site/activate.php?email=$university_email&code=$validation_code
            ";
        $headers = "From: noreply@yourwebsite.com";
        get_send_email($university_email, $subject, $message, $headers);
        return true;
    }
}

/*  ::::: Activation Academy functions :::::    */

function get_activate_academy()
{
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['email'])) {
            $email = get_clean($_GET['email']);
            $validation_code = get_clean($_GET['code']);
            $sql = "SELECT id FROM users_academy WHERE university_email = '" . get_escape_sql($_GET['email']) . "' AND validation_code = '" . get_escape_sql($_GET['code']) . "'";
            $result = get_query($sql);
            if (get_row_count($result) == 1) {
                $sql_2 = "UPDATE users_academy SET active = 1, validation_code = 0 WHERE university_email = '" . get_escape_sql($email) . "' AND validation_code = '" . get_escape_sql($validation_code) . "'";
                $result_2 = get_query($sql_2);

                $sql_3 = "UPDATE login SET active = 1 WHERE email = '" . get_escape_sql($email) . "'";
                $result_3 = get_query($sql_3);

                set_message("<h3>Account has been activated.</h3>");
                get_redirect("login.php");
            }
        } else {
            set_message("<h3>Error! No code found.</h3>");
            get_redirect("register.php");
        }
    }
}

/*  ::::: Academy Account Image :::::    */
function get_academy_account_image_upload()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get image name
        $image = $_FILES['academy_img_file']['name'];
        $extension = pathinfo($image, PATHINFO_EXTENSION);
        if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png') {
            // image file directory
            $target = 'uploads/' . basename($image);

            $sql = "UPDATE users_academy SET image_name = '" . get_escape_sql($image) . "', image = '" . get_escape_sql($target) . "' WHERE id = '" . get_escape_sql($_SESSION['logged_id']) . "'";
            $result = get_query($sql);

            if (move_uploaded_file($_FILES['academy_img_file']['tmp_name'], $target)) {
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo $msg = "Failed to upload image";
            }
        } else {
            echo "File is not image";
        }
    }
}

/*  ::::: validation functions for update Academy Profile :::::    */

/*
 * This function is used to Valid the Academy profile update.
*/

function get_validate_update_academy()
{
    $errors_update = [];
    $min = 3;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $update_academy_address = get_clean($_POST['update_academy_address']);
        $update_academy_chairman = get_clean($_POST['update_department_chairman']);
        $update_academy_chairman_email = get_clean($_POST['update_chairman_email']);
        $update_academy_chairman_number = get_clean($_POST['update_chairman_number']);
        $update_academy_phone = get_clean($_POST['update_office_phone']);
        $update_academy_email = get_clean($_POST['update_academy_email']);

        if (strlen($update_academy_chairman) < $min) {
            $errors_update[] = "<span class='server_error_message'>Name must consist of at least {$min} characters.</span>";
        }

        if (get_email_exists_update($update_academy_email)) {
            $errors_update[] = "<span class='server_error_message'>Sorry {$update_academy_email} already registered. Use Another Email Address.</span>";
        }

        if (!empty($errors_update)) {
            foreach ($errors_update as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_update_academy($update_academy_address, $update_academy_chairman, $update_academy_chairman_email, $update_academy_chairman_number, $update_academy_phone, $update_academy_email)) {
                set_message('Update Successfully. Page Will be Refresh in 2s.');
                echo "<meta http-equiv='refresh' content='2'>";
            } else {
                set_message('Sorry! Update is Failed.');
            }
        }
    }
}

function get_update_academy($update_academy_address, $update_academy_chairman, $update_academy_chairman_email, $update_academy_chairman_number, $update_academy_phone, $update_academy_email)
{
    $update_academy_address = get_escape_sql($update_academy_address);
    $update_academy_chairman = get_escape_sql($update_academy_chairman);
    $update_academy_chairman_email = get_escape_sql($update_academy_chairman_email);
    $update_academy_chairman_number = get_escape_sql($update_academy_chairman_number);
    $update_academy_phone = get_escape_sql($update_academy_phone);
    $update_academy_email = get_escape_sql($update_academy_email);

    if (get_email_exists_update($update_academy_email)) {
        return false;
    } else {
        $sql = "UPDATE users_academy
        SET university_address                    = '$update_academy_address',
            university_department_chairman        = '$update_academy_chairman',
            university_department_chairman_email  = '$update_academy_chairman_email',
            university_department_chairman_number = '$update_academy_chairman_number',
            university_office_phone               = '$update_academy_phone',
            university_email                      = '$update_academy_email'
        WHERE id = '" . get_escape_sql($_SESSION['logged_id']) . "'";
        $result = get_query($sql);

        $sql_2 = "UPDATE login SET email = '$update_academy_email' WHERE id = '" . get_escape_sql($_SESSION['login_id_check']) . "'";
        $result = get_query($sql_2);
        return true;
    }
}

function get_validate_academy_profile()
{
    $errors = [];

    if (isset($_POST['send_mail_academy_account'])) {
        $chairman_name = get_clean($_POST['chairman_name']);
        $chairman_email = get_clean($_POST['chairman_email']);
        $university = get_clean($_POST['university']);
        $faculty = get_clean($_POST['faculty']);
        $department = get_clean($_POST['department']);

        if (empty($chairman_name)) {
            $errors[] = "<span class='server_error_message'>Name Filed Can't be Empty</span>";
        }
        if (empty($chairman_email)) {
            $errors[] = "<span class='server_error_message'>Email Filed Can't be Empty</span>";
        }
        if (empty($university)) {
            $errors[] = "<span class='server_error_message'>University Name Can't be Empty</span>";
        }
        if (empty($faculty)) {
            $errors[] = "<span class='server_error_message'>Faculty Filed Can't be Empty</span>";
        }
        if (empty($department)) {
            $errors[] = "<span class='server_error_message'>Department Can't be Empty</span>";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_send_mail_academy($chairman_name, $chairman_email, $university, $faculty, $department)) {
                set_message('Mail Send Successfully');
            } else {
                set_message('Error! Try Again');
            }
        }
    }
}

function get_send_mail_academy($name, $email, $university, $faculty, $department)
{
    $chairman_name = get_escape_sql($name);
    $chairman_email = get_escape_sql($email);
    $university = get_escape_sql($university);
    $faculty = get_escape_sql($faculty);
    $department = get_escape_sql($department);

    if (empty($chairman_email)) {
        return false;
    } else {
        $subject = "Activate Verification.";
        $message = "
            Hi {$chairman_name},
            - Recently, the {$department} department of the {$faculty} Faculty at {$university} created an account on the BookingKit website.
            If the account is correct, confirm it by sending a email to this shuvokumarmajumder@gmail.com account, Thank You.
            - If not Please ignore this email.
        ";
        $headers = "From: shuvokumarmajumder@gmail.com";
        get_send_email($chairman_email, $subject, $message, $headers);
        return true;
    }
}

function get_verify_academy_account()
{
    $errors = [];
    if (isset($_POST['verify_academy_account'])) {
        $university_id = get_clean($_POST['university_id']);

        if (empty($university_id)) {
            $errors[] = "<span class='server_error_message'>ID Can't be Empty</span>";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            $sql = "UPDATE users_academy SET verify = 1 WHERE id = '" . get_escape_sql($university_id) . "'";
            $result = get_query($sql);
            set_message("Verify Successfully.");
            echo "<meta http-equiv='refresh' content='1'>";
        }
    }
}


/*  ::::: Validate User Log In functions :::::    */

/*
 * This function is used to Valid the user Log in data.
 */
function get_validate_user_login()
{
    $errors = [];
    $min = 3;
    $max = 20;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $email = get_clean($_POST['email']);
        $password = get_clean($_POST['password']);
        $remember = isset($_POST['remember']);

        if (empty($email)) {
            $errors[] = "<span class='server_error_message'>Email Field Can&acute;t be Empty.</span>";
        }
        if (empty($password)) {
            $errors[] = "<span class='server_error_message'>Password Field Can&acute;t be Empty.</span>";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) echo get_validation_errors($error);
        } else {
            if (get_login_user($email, $password, $remember)) {
                get_login_user_profile_redirect();
            } else {
                echo get_validation_errors('Login is Failed');
            }
        }
    }
}

/*  ::::: User Log In functions :::::    */

/*
 * This function is used to user Login
 */
function get_login_user($email, $password, $remember)
{
    $sql = "SELECT id, password FROM login WHERE email = '" . get_escape_sql($email) . "' AND active = 1";
    $result = get_query($sql);
    if (get_row_count($result) === 1) {
        $row = get_fetch_array($result);
        $db_password = $row['password'];
        $_SESSION['login_id_check'] = $row['id'];
        if (md5($password) === $db_password) {
            if ($remember == "on") {
                setcookie('email', $email, time() + 86400 * 30, '/');
            }
            $_SESSION['email'] = $email;
            return true;
        } else {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

/*  ::::: Logged functions :::::    */

/*
 * This function is used to check login data
 */
function get_logged_in()
{
    if (isset($_SESSION['email']) || isset($_COOKIE['email'])) {
        return true;
    } else {
        return false;
    }
}

/*  ::::: Login redirect functions :::::    */

/*
 * This function is used to redirect the user to Login.php file, if don't login.
 */
function get_login_redirect()
{
    if (get_logged_in()) {
        echo "";
    } else {
        get_redirect('login.php');
    }
}

/*  ::::: Login User Profile Redirect :::::    */

/*
 * This function is used to redirect the logged user to their profile page.
 */

function get_login_user_profile_redirect()
{
    if (get_logged_in()) {
        $sql = "SELECT id FROM users_industry WHERE industry_email = '" . get_escape_sql($_SESSION['email']) . "'";
        $result = get_query($sql);

        $sql_2 = "SELECT id FROM users_academy WHERE university_email = '" . get_escape_sql($_SESSION['email']) . "'";
        $result_2 = get_query($sql_2);

        $sql_3 = "SELECT id FROM users_student WHERE email = '" . get_escape_sql($_SESSION['email']) . "'";
        $result_3 = get_query($sql_3);

        $sql_4 = "SELECT id FROM users_admin WHERE email = '" . get_escape_sql($_SESSION['email']) . "'";
        $result_4 = get_query($sql_4);

        if (get_row_count($result) > 0) {
            $row = get_fetch_array($result);
            $_SESSION['logged_id'] = $row['id'];
            $_SESSION['user_cat'] = 1;
            get_redirect('author/industry');
        }
        if (get_row_count($result_2) > 0) {
            $row = get_fetch_array($result_2);
            $_SESSION['logged_id'] = $row['id'];
            $_SESSION['user_cat'] = 2;
            get_redirect('author/academy');
        }
        if (get_row_count($result_3) > 0) {
            $row = get_fetch_array($result_3);
            $_SESSION['logged_id'] = $row['id'];
            $_SESSION['user_cat'] = 3;
            get_redirect('author/student');
        }
        if (get_row_count($result_4) > 0) {
            $row = get_fetch_array($result_4);
            $_SESSION['logged_id'] = $row['id'];
            $_SESSION['user_cat'] = 4;
            get_redirect('author/admin');
        }
    }
}

/*  ::::: Password recover functions :::::    */

function get_recover_password()
{
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {
            $email = get_clean($_POST['email']);
            if (get_email_exists($email)) {
                $validation_code = md5($email . microtime());
                setcookie('temp_access_code', $validation_code, time() + 300);
                $sql = "UPDATE login SET validation_code = '" . get_escape_sql($validation_code) . "' WHERE email = '" . get_escape_sql($email) . "' AND active = 1";
                $result = get_query($sql);

                $subject = "Password Reset/Recover Request";
                $message = "
                Hi,
                    - You are Request to Reset/Recover your Account Password.
                    - Here Your Password Reset/Recover Code: {$validation_code}
                    - Click Here to Reset/Recover your Password: http://localhost/project-site/code.php?email=$email&code=$validation_code
                    - Validation Code Will Expire in 5 minutes.
                ";
                $headers = "From: noreply@yourwebsite.com";
                if (get_send_email($email, $subject, $message, $headers)) {
                    set_message('<p class="bg-success text-center">A Verification code is Send to Your Email Address.</p>');
                    get_redirect("code.php");
                } else {
                    echo get_validation_errors("Email Could Not be Send.");
                }
            } else {
                echo get_validation_errors("Email Does Not Exist.");
            }
        } else {
            echo get_validation_errors("Something Wrong.");
            // get_redirect("index.php");
        }
    }
}

/*  ::::: Password recover Code Validation function :::::    */

function get_recover_password_validation_code()
{
    if (isset($_COOKIE['temp_access_code'])) {
        if (!isset($_GET['email']) && !isset($_GET['code'])) {
            get_redirect("index.php");
        } elseif (empty($_GET['email']) || empty($_GET['code'])) {
            get_redirect("index.php");
        } else {
            if (isset($_POST['code'])) {
                $email = get_clean($_GET['email']);
                $validation_code = get_clean($_POST['code']);
                $sql = "SELECT id FROM login WHERE validation_code = '" . get_escape_sql($validation_code) . "' AND email = '" . get_escape_sql($email) . "'";
                $result = get_query($sql);
                if (get_row_count($result) == 1) {
                    setcookie('temp_access_code', $validation_code, time() + 300);
                    get_redirect("reset.php?email=$email&code=$validation_code");
                } else {
                    echo get_validation_errors("Error! Wrong Validation Code.");
                }
            }
        }
    } else {
        set_message('<p class="bg-danger text-center">Sorry Your Validation Cookie was Expired. &#9200;</p>');
        // if cookie does not set redirect the user to the forgot-password.php page.
        get_redirect("forgot-password.php");
    }
}

/*  ::::: Password Reset functions :::::    */

function get_password_reset()
{
    if (isset($_COOKIE['temp_access_code'])) {
        if (isset($_GET['email']) && isset($_GET['code'])) {
            if (isset($_SESSION['token']) && isset($_POST['token'])) {
                if ($_POST['token'] === $_SESSION['token']) {
                    $password = get_clean($_POST['password']);
                    $confirm_password = get_clean($_POST['confirm_password']);
                    $email = $_GET['email'];
                    if ($password === $confirm_password) {
                        $update_password = md5($password);
                        $sql = "UPDATE login SET password = '" . get_escape_sql($update_password) . "', validation_code = 0 WHERE email = '" . get_escape_sql($email) . "' AND active = 1";
                        $result = get_query($sql);
                        set_message('<p class="bg-success text-center">Your password has been updated. &#9989; Please login.</p>');
                        get_redirect("login.php");
                    }
                }
            }
        }
    } else {
        set_message('<p class="bg-danger text-center">Sorry Your Time has Expired. &#9200;</p>');
        get_redirect("forgot-password.php");
    }
}

/*  ::::: Industry information validate functions :::::    */

function get_validate_industry_information()
{
    $errors = [];
    $min = 50;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $industry_slogan = get_clean($_POST['industry_slogan']);
        $industry_details = get_clean($_POST['industry_details']);
        $industry_mission = get_clean($_POST['industry_mission']);
        $industry_vision = get_clean($_POST['industry_vision']);
        $industry_environment = get_clean($_POST['industry_environment']);

        if (empty($industry_slogan)) {
            $errors[] = "<span class='server_error_message'>Slogan/Motto Field can't be empty.</span>";
        }

        if (strlen($industry_details) < $min || empty($industry_details)) {
            $errors[] = "<span class='server_error_message'>Industry Details must consist of at least {$min} characters.</span>";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_add_industry_information($industry_slogan, $industry_details, $industry_mission, $industry_vision, $industry_environment)) {
                set_message("Information Save Successfully.");
            } else {
                set_message("Sorry! Information Save is Failed.");
            }
        }
    }
}

/*  ::::: Industry information add/insert functions :::::    */

function get_add_industry_information($industry_slogan, $industry_details, $industry_mission, $industry_vision, $industry_environment)
{
    $industry_slogan = get_escape_sql($industry_slogan);
    $industry_details = get_escape_sql($industry_details);
    $industry_mission = get_escape_sql($industry_mission);
    $industry_vision = get_escape_sql($industry_vision);
    $industry_environment = get_escape_sql($industry_environment);
    $industry_id = get_escape_sql($_SESSION['logged_id']);

    if (empty($industry_slogan) && empty($industry_details)) {
        return false;
    } else {
        $sql = "INSERT INTO industry_information(industry_slogan, industry_details, industry_mission, industry_vision, industry_environment, industry_id)";
        $sql .= " VALUES('$industry_slogan', '$industry_details', '$industry_mission', '$industry_vision', '$industry_environment', '$industry_id')";
        $result = get_query($sql);
        return true;
    }
}

/*  ::::: Booking validation functions :::::    */
/*
 * This function is used to Valid the booking information.
*/
function get_booking_validation()
{
    $errors = [];
    $min = 2;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $industry_id = get_clean($_POST['industry_id']);
        $academy_id = get_clean($_POST['academy_id']);
        date_default_timezone_set("Asia/Dhaka");
        $created_date = date("m/d/Y");
        $booking_date = get_clean($_POST['booking_date']);
        $booking_time = get_clean($_POST['booking_time']);
        $total_teacher = get_clean($_POST['total_teacher']);
        $total_male_student = get_clean($_POST['total_male_student']);
        $total_female_student = get_clean($_POST['total_female_student']);
        $total_stuff = get_clean($_POST['total_stuff']);
        $total_student = $total_male_student + $total_female_student;

        $booking_data_validate = str_replace('/', '', $booking_date);
        $today_data_validate = str_replace('/', '', $created_date);
        $time_validate = str_replace(' ', ':', $booking_time);
        $time_array = ["7:00:am", "8:00:am", "9:00:am", "10:00:am", "11:00:am", "12:00:pm", "1:00:pm", "2:00:pm", "3:00:pm", "4:00:pm"];
        $time_find = array_search($time_validate, $time_array, true);
        if ($total_teacher < $min) {
            $errors[] = "<span class='server_error_message'>The total number of teachers cannot be less than {$min}</span>";
        }
        if ($booking_data_validate <= $today_data_validate) {
            $errors[] = "<span class='server_error_message'>Today's and past dates cannot be selected</span>";
        }
        if (!$time_find) {
            $errors[] = "<span class='server_error_message'>Please Select the time from 8.00 am to 4.00 pm</span>";
        }
        if ($total_student < 4) {
            $errors[] = "<span class='server_error_message'>Must have at least 4 students</span>";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_booking($industry_id, $academy_id, $created_date, $booking_date, $booking_time, $total_teacher, $total_male_student, $total_female_student, $total_stuff)) {
                set_message("Thanks for your booking. <br>You'll receive a confirmation Message Soon. Please Check Account");
                get_redirect('confirm.php');
            } else {
                set_message("Sorry! Booking is Failed. Please Try Again.");
                get_redirect('confirm.php');
            }
        }
    }
}

/*  ::::: Booking schedule functions :::::    */
/*
 * This function is used to booking schedule.
*/

function get_booking($industry_id, $academy_id, $created_date, $booking_date, $booking_time, $total_teacher, $total_male_student, $total_female_student, $total_stuff)
{
    $industry_id = get_escape_sql($industry_id);
    $academy_id = get_escape_sql($academy_id);
    $created_date = get_escape_sql($created_date);
    $booking_date = get_escape_sql($booking_date);
    $booking_time = get_escape_sql($booking_time);
    $total_teacher = get_escape_sql($total_teacher);
    $total_male_student = get_escape_sql($total_male_student);
    $total_female_student = get_escape_sql($total_female_student);
    $total_stuff = get_escape_sql($total_stuff);

    $booking_date_validate = str_replace('/', '', $booking_date);
    $today_data_validate = str_replace('/', '', $created_date);
    $time_validate = str_replace(' ', ':', $booking_time);

    if ($booking_date_validate <= $today_data_validate) {
        return false;
    } else {
        $sql = "INSERT INTO booking(industry_id, academy_id, booking_date, booking_time, created_date, total_teacher,
                    total_male_student, total_female_student, total_stuff, active)";
        $sql .= " VALUES('$industry_id','$academy_id','$booking_date','$booking_time','$created_date','$total_teacher','$total_male_student','$total_female_student','$total_stuff', 0)";
        $result = get_query($sql);
        return true;
    }
}

/*  ::::: Booking schedule confirm validation functions :::::    */
/*
 * This function is used to booking schedule confirm validation.
*/

function get_booking_confirm_validation()
{
    $errors = [];

    if (isset($_POST['approve'])) {
        $booking_id = get_clean($_POST['booking_id']);
        $academy_id = get_clean($_POST['academy_id']);
        $booking_confirm = 1;

        if (empty($booking_id)) {
            $errors[] = "<span class='server_error_message'>Booking ID can't be empty</span>";
        }
        if (empty($academy_id)) {
            $errors[] = "<span class='server_error_message'>Booking ID can't be empty</span>";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_booking_confirm($booking_id, $academy_id, $booking_confirm)) {
                echo "<meta http-equiv='refresh' content='1'>";
                set_message("Congratulations Booking Confirm");
            } else {
                echo "<meta http-equiv='refresh' content='1'>";
                set_message("Error! Booking Confirmation Failed");
            }
        }
    } elseif (isset($_POST['cancel'])) {
        $booking_id = get_clean($_POST['booking_id']);
        $academy_id = get_clean($_POST['academy_id']);
        $booking_confirm = 2;

        if (empty($booking_id)) {
            $errors[] = "<span class='server_error_message'>Booking ID can't be empty</span>";
        }
        if (empty($academy_id)) {
            $errors[] = "<span class='server_error_message'>Booking ID can't be empty</span>";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_booking_confirm($booking_id, $academy_id, $booking_confirm)) {
                echo "<meta http-equiv='refresh' content='1'>";
                set_message("Booking Cancel");
            } else {
                echo "<meta http-equiv='refresh' content='1'>";
                set_message("Error! Something Wrong. Please Try Again.");
            }
        }
    }
}

function get_booking_confirm($booking_id, $academy_id, $booking_confirm)
{
    $booking_id = get_escape_sql($booking_id);
    $academy_id = get_escape_sql($academy_id);
    $booking_confirm = get_escape_sql($booking_confirm);

    if (empty($booking_id) || empty($academy_id) || empty($booking_confirm)) {
        return false;
    } else {
        $sql = "UPDATE booking SET active = '$booking_confirm' WHERE id ='$booking_id' AND academy_id = '$academy_id'";
        $result = get_query($sql);
        return true;
    }
}

/*  ::::: Tour Complete functions :::::    */
/*
 * This function is used to update tour status.
*/

function get_confirm_tour_end_validation()
{
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $tour_complete = 1;
        $booking_id = get_clean($_POST['booking_id']);

        if (empty($booking_id)) {
            $errors[] = "<span class='server_error_message'>Booking ID can't be empty</span>";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_tour_end($tour_complete, $booking_id)) {
                echo "<meta http-equiv='refresh' content='0.1'>";
            } else {
                set_message("Error! Try Again");
            }
        }
    }
}

function get_tour_end($tour_complete, $booking_id)
{
    $tour_complete = get_escape_sql($tour_complete);
    $booking_id = get_escape_sql($booking_id);

    if (empty($booking_id)) {
        return false;
    } else {
        $sql = "UPDATE booking SET tour_end = '$tour_complete' WHERE id = '$booking_id'";
        $result = get_query($sql);
        return true;
    }
}

function get_tour_review_validation()
{
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $industry_id = get_clean($_POST['industry_id']);
        $academy_id = get_clean($_POST['academy_id']);
        $review_title = get_clean($_POST['review_title']);
        $review = get_clean($_POST['review']);
        date_default_timezone_set("Asia/Dhaka");
        $created_date = date("d/m/Y");
        $booking_id = get_clean($_POST['booking_id']);
        if (isset($_POST['rating_input'])) {
            $rating_input = get_clean($_POST['rating_input']);
        } else {
            $errors[] = "<span class='server_error_message'>Rating Field Can't be empty</span>";
        }
        if (empty($industry_id)) {
            $errors[] = "<span class='server_error_message'>Industry ID can't be empty</span>";
        }
        if (empty($academy_id)) {
            $errors[] = "<span class='server_error_message'>Academy ID can't be empty</span>";
        }
        if (empty($booking_id)) {
            $errors[] = "<span class='server_error_message'>Booking ID can't be empty</span>";
        }
        if (empty($review)) {
            $errors[] = "<span class='server_error_message'>Review Field Can't be Empty</span>";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            if (get_tour_review($industry_id, $academy_id, $rating_input, $review_title, $review, $created_date, $booking_id)) {
                set_message("<h5>Review Complete.</h5>");
                echo "<meta http-equiv='refresh' content='0.1'>";
            } else {
                set_message("<h5>Error! Try Again</h5>");
            }
        }
    }
}

function get_tour_review($industry_id, $academy_id, $rating_input, $review_title, $review, $created_date, $booking_id)
{
    $industry_id = get_escape_sql($industry_id);
    $academy_id = get_escape_sql($academy_id);
    $rating_input = get_escape_sql($rating_input);
    $review_title = get_escape_sql($review_title);
    $review = get_escape_sql($review);
    $created_date = get_escape_sql($created_date);
    $booking_id = get_escape_sql($booking_id);

    if (empty($booking_id) || empty($academy_id) || empty($industry_id)) {
        return false;
    } else {
        $sql = "INSERT INTO review(industry_id, academy_id, rating_star, review_title, review_comment, created_date, booking_id)";
        $sql .= " VALUES('$industry_id', '$academy_id', '$rating_input', '$review_title', '$review', '$created_date', '$booking_id')";
        $result = get_query($sql);

        $sql_2 = "UPDATE booking SET review = '1' WHERE id = '" . $booking_id . "'";
        $result_2 = get_query($sql_2);

        return true;
    }
}

function get_valid_tour_notice()
{
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $booking_id = get_clean($_POST['booking_id']);
        $program_id = get_clean($_POST['program']);
        $batch_number = get_clean($_POST['batch']);
        $notice_title = get_clean($_POST['notice_title']);
        $notice_content = get_clean($_POST['notice_content']);

        if (empty($booking_id)) {
            $errors[] = "<span class='server_error_message'>Booking ID Can't be Empty</span>";
        }
        if (empty($program_id)) {
            $errors[] = "<span class='server_error_message'>Program Field Can't be Empty</span>";
        }
        if (empty($batch_number)) {
            $errors[] = "<span class='server_error_message'>Batch Field Can't be Empty</span>";
        }
        if (empty($notice_content)) {
            $errors[] = "<span class='server_error_message'>Notice Can't be Empty</span>";
        }
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo get_validation_errors($error);
            }
        } else {
            get_tour_notice($booking_id, $program_id, $batch_number, $notice_title, $notice_content);
            set_message("Notice Send Successfully");
        }
    }
}

function get_tour_notice($booking_id, $program_id, $batch_number, $notice_title, $notice_content)
{
    $booking_id = get_escape_sql($booking_id);
    $program_id = get_escape_sql($program_id);
    $batch_number = get_escape_sql($batch_number);
    $notice_title = get_escape_sql($notice_title);
    $notice_content = get_escape_sql($notice_content);
    date_default_timezone_set("Asia/Dhaka");
    $notice_date = date("m/d/Y");

    if (empty($booking_id) || empty($program_id) || empty($batch_number) || empty($notice_title) || empty($notice_content)) {
        return false;
    } else {
        $sql = "INSERT INTO notice(booking_id, program_id, batch, notice_title, notice_content, notice_date)";
        $sql .= " VALUES('$booking_id','$program_id','$batch_number','$notice_title','$notice_content', '$notice_date')";
        $result = get_query($sql);

        $sql_2 = "UPDATE booking SET notice = '1' WHERE id = '" . get_escape_sql($booking_id) . "'";
        $result_2 = get_query($sql_2);

        return true;
    }
}