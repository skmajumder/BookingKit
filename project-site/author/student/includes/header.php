<?php include '../../functions/init.php'; ?>
<?php
if (!empty($_SESSION['logged_id'])) {
    if ($_SESSION['user_cat'] === 3) {
        $sql = "SELECT CONCAT_WS(' ', first_name, last_name) AS 'full_name'
FROM users_student WHERE id = '" . get_escape_sql($_SESSION['logged_id']) . "'";
        $result = get_query($sql);
        if (get_row_count($result) > 0) {
            $row = get_fetch_array($result);
            $name = $row['full_name'];
        }
    } else {
        get_redirect('../../index.php');
    }
} else {
    get_redirect('../../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="refresh" content="900;url=../../logout.php"/>
    <title>Booking.com - Profile Dashboard</title>

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Plugin styles -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="vendor/dropzone.css" rel="stylesheet">
    <!-- Main styles -->
    <link href="css/admin.css" rel="stylesheet">
    <!-- WYSIWYG Editor -->
    <link rel="stylesheet" href="js/editor/summernote-bs4.css">
    <!-- Your custom styles -->
    <link href="css/custom.css" rel="stylesheet">

</head>

<body class="fixed-nav sticky-footer" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="../../index.php">
        <img src="img/logo.png" data-retina="true" alt="" width="163" height="36">
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <!-- sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- // sidebar -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#0">
                    <i class="fa fa-user-circle-o"></i>
                    <span class="nav-link-text"><?php echo $name; ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>
<!-- /Navigation-->
