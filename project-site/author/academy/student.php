<?php include 'includes/header.php'; ?>
<?php
$uv_id = $_SESSION['uv_id'];
$department = $_SESSION['department'];

$sql = "SELECT us.id,
       concat_ws(' ', us.first_name, us.last_name) AS name,
       us.university_id,
       p.program_name,
       us.batch,
       us.email,
       ul.university_name,
       ss.session_year
FROM users_student us
         INNER JOIN university_list ul ON us.university_name = ul.id
         INNER JOIN student_session ss ON us.student_session = ss.id
         INNER JOIN programs p on us.program = p.program_id
WHERE us.university_name = '" . get_escape_sql($uv_id) . "' AND p.department_id = '" . get_escape_sql($department) . "'";
$result = get_query($sql);
?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Tables</li>
            </ol>
            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-user-circle"></i> Student List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>University</th>
                                <th>Program</th>
                                <th>ID</th>
                                <th>Batch</th>
                                <th>Session</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>University</th>
                                <th>Program</th>
                                <th>ID</th>
                                <th>Batch</th>
                                <th>Session</th>
                                <th>Email</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            if (get_row_count($result) > 0) {
                                while ($row = get_fetch_array($result)) {
                                    echo "<tr>
                                            <td>{$row['name']}</td>
                                            <td>{$row['university_name']}</td>
                                            <td>{$row['program_name']}</td>
                                            <td>{$row['university_id']}</td>
                                            <td>{$row['batch']}</td>
                                            <td>{$row['session_year']}</td>
                                            <td>{$row['email']}</td>
                                        </tr>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /tables-->
        </div>
        <!-- /container-fluid-->
    </div>
    <!-- /container-wrapper-->
<?php include 'includes/footer.php'; ?>