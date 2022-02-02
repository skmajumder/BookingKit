<?php
include_once 'db.php';
$sql = "SELECT * FROM department WHERE faculty_id LIKE '%" . get_escape_sql($_GET['id']) . "%'";
$result = get_query($sql);
$json = [];

while ($row = get_fetch_array($result)) {
    $json[$row['department_id']] = $row['department_name'];
}
echo json_encode($json);