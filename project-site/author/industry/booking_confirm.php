<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];

if (isset($_GET['b_id'], $_GET['a_id'], $_GET['b_id'])) {
    $booking_id = $_GET['b_id'];
    $academy_id = $_GET['a_id'];
    $button_action = $_GET['button_id'];
} else {
    echo "No Value";
}

?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Bookings Confirm</li>
            </ol>
            <div class="box_general">
                <section class="text-center">
                    <div class="container">
                        <h1 class="jumbotron-heading">Headline</h1>
                        <p class="lead text-muted">text</p>
                        <small><i>date</i></small>
                    </div>
                </section>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /container-fluid-->
    </div>
    <!-- /container-wrapper-->

<?php include 'includes/footer.php'; ?>