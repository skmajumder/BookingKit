<?php
include_once 'db.php';

$data = [];
$emailId = htmlspecialchars($_POST['email_id']);
try {
    $data['status'] = false;

    if (!filter_var($emailId, FILTER_VALIDATE_EMAIL)) {
        $data['message'] = "Invalid email format";
    } else {
        $stmt = $db_connection->prepare('SELECT email FROM users_student WHERE email = ?');
        $stmt->bind_param('s', $emailId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows < 1) {
            $data['message'] = 'Email id is available!';
            $data['status'] = true;
        } else {
            $data['message'] = 'Email already registered!';
        }
    }

} catch (\Exception $exception) {
    $data['message'] = $exception->getMessage();
}
echo json_encode($data);