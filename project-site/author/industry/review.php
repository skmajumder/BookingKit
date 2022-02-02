<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];

if (isset($_GET['query_id'])) {
    $booking_id = $_GET['query_id'];
    $sql = "SELECT r.review_title,
       r.review_comment,
       r.rating_star,
       b.booking_date,
       b.tour_end,
       b.review,
       ul.university_name,
       ua.image
FROM review r
         INNER JOIN booking b on r.booking_id = b.id
         INNER JOIN users_academy ua on b.academy_id = ua.id
         INNER JOIN university_list ul on ua.university_name = ul.id
WHERE b.id = '" . get_escape_sql($booking_id) . "'";
} else {
    $sql = "SELECT r.review_title,
       r.review_comment,
       r.rating_star,
       b.booking_date,
       b.tour_end,
       b.review,
       ul.university_name,
       ua.image
FROM review r
         INNER JOIN booking b on r.booking_id = b.id
         INNER JOIN users_academy ua on b.academy_id = ua.id
         INNER JOIN university_list ul on ua.university_name = ul.id
WHERE b.industry_id = '" . get_escape_sql($user_id) . "'";
}

$result = get_query($sql);
?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Reviews</li>
            </ol>
            <div class="box_general">
                <div class="header_box">
                </div>
                <div class="list_general reviews">
                    <ul>
                        <?php if (get_row_count($result) > 0) : ?>
                            <?php while ($row = get_fetch_array($result)): ?>
                                <li>
                                    <span><?php echo $row['booking_date']; ?></span>
                                    <span class="rating">
                                        <?php
                                        if ($row['rating_star'] == 1) {
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                        } elseif ($row['rating_star'] == 2) {
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                        } elseif ($row['rating_star'] == 3) {
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                        } elseif ($row['rating_star'] == 4) {
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                        } elseif ($row['rating_star'] == 5) {
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                            echo "<i class='fa fa-fw fa-star yellow'></i>";
                                        }
                                        ?>
                                    </span>
                                    <figure>
                                        <img src="../academy/<?php echo $row['image']; ?>"
                                             alt="<?php echo $row['university_name']; ?>">
                                    </figure>
                                    <h4><?php echo $row['university_name']; ?></h4>
                                    <?php
                                    if (!empty($row['review_title'])) {
                                        echo "<h6>{$row['review_title']}</h6>";
                                    }
                                    ?>
                                    <p><?php echo $row['review_comment']; ?></p>
                                </li>
                            <?php endwhile; ?>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /container-fluid-->
    </div>
    <!-- /container-wrapper-->

<?php include 'includes/footer.php'; ?>