<?php include 'includes/header.php'; ?>
<?php
$sql = "SELECT ui.id,
       ui.industry_name,
       it.industry_category_name,
       ui.industry_address,
       ui.industry_email,
       ui.industry_city,
       (SELECT COUNT(booking.id) FROM booking WHERE booking.industry_id = ui.id) AS total_booking,
       CONCAT_WS(', ', ui.industry_contact_number, ui.industry_office_phone) AS number
FROM users_industry ui
         INNER JOIN industry_type it ON ui.industry_category = it.industry_id";
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
                    <i class="fa fa-industry"></i> Data Table For Industry
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Booking</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Booking</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            if (get_row_count($result) > 0) {
                                while ($row = get_fetch_array($result)) {
                                    echo "<tr>
                                                <td>{$row['industry_name']}</td>
                                                <td>{$row['industry_category_name']}</td>
                                                <td>{$row['industry_address']}</td>
                                                <td>{$row['industry_city']}</td>
                                                <td>{$row['number']}</td>
                                                <td>{$row['industry_email']}</td>
                                                <td>{$row['total_booking']}</td>
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