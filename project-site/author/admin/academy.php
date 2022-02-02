<?php include 'includes/header.php'; ?>
<?php
$sql = "SELECT ua.id,
       ul.university_name university,
       ua.university_address address,
       fa.faculty_name faculty,
       d.department_name department,
       CONCAT_WS(', ', ua.university_department_chairman, ua.university_department_chairman_email,
                 ua.university_department_chairman_number) AS chairman,
       ua.university_office_phone phone,
       ua.university_email email,
       (SELECT COUNT(booking.id) FROM booking WHERE booking.academy_id = ua.id) AS total_booking
FROM users_academy ua
         INNER JOIN university_list ul ON ua.university_name = ul.id
         INNER JOIN faculty fa ON ua.faculty_category = fa.faculty_id
         INNER JOIN department d ON ua.department_category = d.department_id";
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
                    <i class="fa fa-university"></i> Data Table For Academy
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>University</th>
                                <th>Address</th>
                                <th>Information</th>
                                <th>Chairman</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Booking</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>University</th>
                                <th>Address</th>
                                <th>Information</th>
                                <th>Chairman</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Booking</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            if (get_row_count($result) > 0) {
                                while ($row = get_fetch_array($result)) {
                                    echo "<tr>
                                                <td>{$row['university']}</td>
                                                <td>{$row['address']}</td>
                                                <td>
                                                <b>Faculty</b>: {$row['faculty']} 
                                                <br>
                                                <b>Department</b>: {$row['department']}
                                                </td>
                                                <td>{$row['chairman']}</td>
                                                <td>{$row['phone']}</td>
                                                <td>{$row['email']}</td>
                                                <td>{$row['total_booking']}</td>
                                                <td><a href='profile-academy.php?query_id={$row["id"]}&name={$row["university"]}' class='btn btn-outline-dark btn-sm'>Details</a></td>
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