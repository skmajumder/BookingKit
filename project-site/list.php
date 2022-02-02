<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->
<?php get_login_redirect(); ?>

<?php
if (isset($_GET['query_id'])) {
    $query_id = get_clean($_GET['query_id']);
    $sql = "SELECT users_industry.industry_name,
       users_industry.industry_category,
       users_industry.id,
       users_industry.image,
       users_industry.image_name,
       industry_information.industry_details,
       industry_type.industry_category_name
FROM users_industry
         INNER JOIN industry_information ON users_industry.id = industry_information.industry_id
         INNER JOIN industry_type ON users_industry.industry_category = industry_type.industry_id
WHERE users_industry.industry_category = '" . get_escape_sql($query_id) . "'";

} else {
    $sql = "SELECT users_industry.industry_name,
       users_industry.industry_category,
       users_industry.id,
       users_industry.image,
       users_industry.image_name,
       industry_information.industry_details,
       industry_type.industry_category_name
FROM users_industry
         INNER JOIN industry_information ON users_industry.id = industry_information.industry_id
         INNER JOIN industry_type ON users_industry.industry_category = industry_type.industry_id";
}
$result = get_query($sql);
$number = get_row_count($result);
?>
    <main>
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo "<h4><strong>Showing {$number}</strong> of {$number} results</h4>";
                        ?>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /results -->

        <div class="filters_listing">
            <div class="container">
                <ul class="clearfix">
                    <li>
                        <h6>Type</h6>
                        <div class="switch-field">
                            <?php
                            if (isset($_GET['name'])) {
                                $string = $_GET['name'];
                                $name = str_replace('-', ' ', $string);
                                echo "<input type=\"radio\" id=\"$string\" name=\"$string\" value=\"$name\" checked>";
                                echo "<label for=\"$string\">$name</label>";
                            } else {
                                echo "<input type=\"radio\" id=\"all\" name=\"all\" value=\"All\" checked>";
                                echo "<label for=\"all\">All</label>";
                            }
                            ?>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /filters -->

        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-7">
                    <?php if ($number > 0) : ?>
                        <?php while ($row = get_fetch_array($result)) : ?>
                            <div class="strip_list wow fadeIn">
                                <figure>
                                    <a href="detail-page.php?id=<?php echo $row['id']; ?>">
                                        <img src="author/industry/<?php echo $row['image']; ?>"
                                             alt="<?php echo $row['image_name']; ?>">
                                    </a>
                                </figure>
                                <small>
                                    <strong>
                                        <?php echo $row['industry_category_name']; ?>
                                    </strong>
                                </small>
                                <h3><?php echo $row['industry_name']; ?></h3>
                                <p><?php echo mb_strimwidth($row['industry_details'], 0, 150, "... more"); ?></p>
                                <ul>
                                    <li><a href="#0"><?php echo $row['industry_category_name']; ?></a></li>
                                    <li><a href="details.php?id=<?php echo $row['id']; ?>">Details</a></li>
                                </ul>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="strip_list wow fadeIn">
                            <h3>Sorry! No Record Found</h3>
                            <h5>All <a href="list.php">List</a></h5>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- /col -->

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include("includes/footer.php"); ?>