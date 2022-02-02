<?php
include_once 'db.php';

$data_2 = [];
$emailId_2 = htmlspecialchars($_POST['email_id_2']);
try {
    $data_2['status'] = false;

    if (!filter_var($emailId_2, FILTER_VALIDATE_EMAIL)) {
        $data_2['message'] = "Invalid email format";
    } else {
        $stmt_2 = $db_connection->prepare('SELECT industry_email FROM users_industry WHERE industry_email = ?');
        $stmt_2->bind_param('s', $emailId_2);
        $stmt_2->execute();
        $result = $stmt_2->get_result();
        if ($result->num_rows < 1) {
            $data_2['message'] = 'Email id is available!';
            $data_2['status'] = true;
        } else {
            $data_2['message'] = 'Email already registered!';
        }
    }

} catch (\Exception $exception) {
    $data_2['message'] = $exception->getMessage();
}
echo json_encode($data_2);