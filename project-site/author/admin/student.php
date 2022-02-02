<?php include 'includes/header.php'; ?>
<?php
$sql = "SELECT us.id,
       concat_ws(' ', us.first_name, us.last_name) AS name,
       us.university_id,
       p.program_name,
       us.email,
       ul.university_name,
       ss.session_year
FROM users_student us
         INNER JOIN university_list ul ON us.university_name = ul.id
         INNER JOIN student_session ss ON us.student_session = ss.id
         INNER JOIN programs p on us.program = p.program_id";
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
                    <i class="fa fa-user-circle"></i> Data Table For Student
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>University</th>
                                <th>Session</th>
                                <th>ID</th>
                                <th>Program</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>University</th>
                                <th>Session</th>
                                <th>ID</th>
                                <th>Program</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            if (get_row_count($result) > 0) {
                                while ($row = get_fetch_array($result)) {
                                    $name = strtolower(str_replace(' ', '-', $row['name']));
                                    echo "<tr>
                                            <td>{$row['name']}</td>
                                            <td>{$row['university_name']}</td>
                                            <td>{$row['session_year']}</td>
                                            <td>{$row['university_id']}</td>
                                            <td>{$row['program_name']}</td>
                                            <td>{$row['email']}</td>
                                            <td><a href='profile-student.php?query_id={$row["id"]}' class='btn btn-outline-dark btn-sm'>Details</a></td>
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