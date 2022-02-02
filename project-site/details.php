<!-- ::: header.php ::: -->
<?php include("includes/header.php"); ?>
<?php get_login_redirect(); ?>
<?php
if (isset($_GET['id'])) {
    $query_id = $_GET['id'];
    $sql = "SELECT industry_information.industry_slogan      slogan,
       industry_information.industry_details     detail,
       industry_information.industry_mission     mission,
       industry_information.industry_vision      vision,
       industry_information.industry_environment environment,
       users_industry.image_name                 image_name,
       users_industry.industry_name              name,
       users_industry.industry_address           address,
       users_industry.industry_contact_number    contact,
       users_industry.industry_office_phone      phone,
       users_industry.image                      image,
       industry_type.industry_category_name      category
FROM industry_information
         INNER JOIN users_industry ON industry_information.industry_id = users_industry.id
         INNER JOIN industry_type ON users_industry.industry_category = industry_type.industry_id
WHERE users_industry.id = '" . get_escape_sql($query_id) . "'";

    $result = get_query($sql);
    if (get_row_count($result) > 0) {
        $row = get_fetch_array($result);
        $slogan = $row['slogan'];
        $detail = $row['detail'];
        $mission = $row['mission'];
        $vision = $row['vision'];
        $environment = $row['environment'];
        $name = $row['name'];
        $address = $row['address'];
        $contact = $row['contact'];
        $phone = $row['phone'];
        $image = $row['image'];
        $image_name = $row['image_name'];
        $category = $row['category'];
    }
} else {
    get_redirect('list.php');
}
?>
<main>
    <div id="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="list.php">List</a></li>
                <li><?php echo $name; ?></li>
            </ul>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="row">
        <div class="col-lg-6 offset-md-3 text-center">
            <div class="validation-message">
                <?php get_booking_validation(); ?>
            </div>
        </div>
    </div>

    <div class="container margin_60">
        <div class="row">
            <?php
            if ($_SESSION['user_cat'] !== 2) {
                $class = "col-xl-10 col-lg-10";
            } else {
                $class = "col-xl-8 col-lg-8";
            }
            ?>
            <div class="<?php echo $class; ?>">
                <nav id="secondary_nav">
                    <div class="container">
                        <ul class="clearfix">
                            <li><a href="#section_1" class="active">General info</a></li>
                            <li><a href="#section_2">Reviews</a></li>
                            <li><a href="#sidebar">Booking</a></li>
                        </ul>
                    </div>
                </nav>
                <div id="section_1">
                    <div class="box_general_3">
                        <div class="profile">
                            <div class="row">
                                <div class="col-lg-5 col-md-4">
                                    <figure>
                                        <img src="author/industry/<?php echo $image; ?>"
                                             alt="<?php echo $image_name; ?>" class="img-fluid">
                                    </figure>
                                </div>
                                <div class="col-lg-7 col-md-8">
                                    <small><?php echo $category; ?></small>
                                    <h1><?php echo $name; ?></h1>
                                    <ul class="contacts">
                                        <li>
                                            <h6>Address</h6>
                                            <?php echo $address; ?>
                                        </li>
                                        <li>
                                            <h6>Phone</h6>
                                            <a href="tel://<?php echo $phone; ?>"><?php echo $phone; ?></a> <br>
                                            <a href="tel://<?php echo $contact; ?>"><?php echo $contact; ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- /profile -->
                        <div class="indent_title_in">
                            <i class="pe-7s-helm"></i>
                            <h3>Slogan/Motto</h3>
                            <p>A small group of words in a special way to identify a product or company</p>
                        </div>
                        <div class="wrapper_indent">
                            <p class="lead add_bottom_30 font-italic">"<?php echo $slogan; ?>"</p>
                        </div>

                        <hr>

                        <div class="indent_title_in">
                            <i class="pe-7s-notebook"></i>
                            <h3>Details</h3>
                            <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                        </div>
                        <div class="wrapper_indent">
                            <p><?php echo $detail; ?></p>
                            <!-- /row-->
                        </div>
                        <!-- /wrapper indent -->

                        <hr>

                        <div class="indent_title_in">
                            <i class="pe-7s-settings"></i>
                            <h3>Mission</h3>
                            <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                        </div>
                        <div class="wrapper_indent">
                            <p><?php echo $mission; ?></p>
                        </div>
                        <!--  End wrapper indent -->

                        <hr>

                        <div class="indent_title_in">
                            <i class="pe-7s-way"></i>
                            <h3>Vision</h3>
                            <p>Mussum ipsum cacilds, vidis litro abertis.</p>
                        </div>
                        <div class="wrapper_indent">
                            <p><?php echo $vision; ?></p>
                        </div>
                        <!--  /wrapper_indent -->
                    </div>
                    <!-- /section_1 -->
                </div>
                <!-- /box_general -->

                <div id="section_2">
                    <div class="box_general_3">
                        <div class="reviews-container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        $industry_id = $_GET['id'];
                                        $sql = "SELECT AVG(rating_star) AS average, COUNT(id) AS total FROM review WHERE industry_id = '" . get_escape_sql($industry_id) . "'";
                                        $result = get_query($sql);
                                        if (get_row_count($result) > 0) {
                                            $row = get_fetch_array($result);
                                            $average_rating = $row['average'];
                                            $total = $row['total'];
                                        }
                                    }
                                    $rating = number_format($average_rating, 1);
                                    ?>
                                    <div id="review_summary">
                                        <strong><?php echo $rating; ?></strong>
                                        <div class="rating">
                                            <?php
                                            if ($rating <= 0) {
                                                echo "<i class='icon_star'></i>";
                                            } elseif ($rating <= 1.9) {
                                                echo "<i class='icon_star voted'></i>";
                                                if ($rating >= 1.1 && $rating <= 1.9) {
                                                    echo "<i class='icon_star-half_alt voted'></i>";
                                                }
                                            } elseif ($rating <= 2.9) {
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                if ($rating >= 2.1 && $rating <= 2.9) {
                                                    echo "<i class='icon_star-half_alt voted'></i>";
                                                }
                                            } elseif ($rating <= 3.9) {
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                if ($rating >= 3.1 && $rating <= 3.9) {
                                                    echo "<i class='icon_star-half_alt voted'></i>";
                                                }
                                            } elseif ($rating <= 4.9) {
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                if ($rating > 4.1 && $rating <= 4.9) {
                                                    echo "<i class='icon_star-half_alt voted'></i>";
                                                }
                                            } elseif ($rating == 5) {
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                                echo "<i class='icon_star voted'></i>";
                                            }
                                            ?>
                                        </div>
                                        <small class="d-block">Based on <?php echo $total; ?> reviews</small>
                                    </div>
                                </div>
                                <?php if ($total != 0): ?>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <?php
                                            if (isset($_GET['id'])) {
                                                $industry_id = $_GET['id'];
                                                $sql = "SELECT COUNT(id) AS rating FROM review WHERE industry_id = '$industry_id' AND rating_star = '5'";
                                                $result = get_query($sql);
                                                if (get_row_count($result) > 0) {
                                                    $row = get_fetch_array($result);
                                                    $count = $row['rating'];
                                                    $width = ($count / $total) * 100;
                                                }
                                            }
                                            ?>
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $width; ?>%"
                                                         aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>5
                                                        stars <?php echo "({$count})"; ?></strong></small></div>
                                        </div>
                                        <!-- /row -->
                                        <div class="row">
                                            <?php
                                            if (isset($_GET['id'])) {
                                                $industry_id = $_GET['id'];
                                                $sql = "SELECT COUNT(id) AS rating FROM review WHERE industry_id = '$industry_id' AND rating_star = '4'";
                                                $result = get_query($sql);
                                                if (get_row_count($result) > 0) {
                                                    $row = get_fetch_array($result);
                                                    $count = $row['rating'];
                                                }
                                                $width = ($count / $total) * 100;
                                            }
                                            ?>
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $width; ?>%"
                                                         aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>4
                                                        stars <?php echo "({$count})"; ?></strong></small></div>
                                        </div>
                                        <!-- /row -->
                                        <div class="row">
                                            <?php
                                            if (isset($_GET['id'])) {
                                                $industry_id = $_GET['id'];
                                                $sql = "SELECT COUNT(id) AS rating FROM review WHERE industry_id = '$industry_id' AND rating_star = '3'";
                                                $result = get_query($sql);
                                                if (get_row_count($result) > 0) {
                                                    $row = get_fetch_array($result);
                                                    $count = $row['rating'];
                                                }
                                                $width = ($count / $total) * 100;
                                            }
                                            ?>
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $width; ?>%"
                                                         aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>3
                                                        stars <?php echo "({$count})"; ?></strong></small></div>
                                        </div>
                                        <!-- /row -->
                                        <div class="row">
                                            <?php
                                            if (isset($_GET['id'])) {
                                                $industry_id = $_GET['id'];
                                                $sql = "SELECT COUNT(id) AS rating FROM review WHERE industry_id = '$industry_id' AND rating_star = '2'";
                                                $result = get_query($sql);
                                                if (get_row_count($result) > 0) {
                                                    $row = get_fetch_array($result);
                                                    $count = $row['rating'];
                                                }
                                                $width = ($count / $total) * 100;
                                            }
                                            ?>
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $width; ?>%"
                                                         aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>2
                                                        stars <?php echo "({$count})"; ?></strong></small></div>
                                        </div>
                                        <!-- /row -->
                                        <div class="row">
                                            <?php
                                            if (isset($_GET['id'])) {
                                                $industry_id = $_GET['id'];
                                                $sql = "SELECT COUNT(id) AS rating FROM review WHERE industry_id = '$industry_id' AND rating_star = '1'";
                                                $result = get_query($sql);
                                                if (get_row_count($result) > 0) {
                                                    $row = get_fetch_array($result);
                                                    $count = $row['rating'];
                                                }
                                                $width = ($count / $total) * 100;
                                            }
                                            ?>
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: <?php echo $width; ?>%"
                                                         aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>1
                                                        stars <?php echo "({$count})"; ?></strong></small></div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: 0%"
                                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>5 stars (0) </strong></small>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                        <div class="row">
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: 0%"
                                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>4 stars (0) </strong></small>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                        <div class="row">
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: 0%"
                                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>3 stars (0) </strong></small>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                        <div class="row">
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: 0%"
                                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>2 stars (0) </strong></small>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                        <div class="row">
                                            <div class="col-lg-10 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: 0%"
                                                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-3"><small><strong>1 stars (0) </strong></small>
                                            </div>
                                        </div>
                                        <!-- /row -->
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- /row -->
                            <hr>
                            <?php
                            if (isset($_GET['id'])) {
                                $industry_id = get_escape_sql($_GET['id']);
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
                            WHERE r.industry_id = '" . $industry_id . "'";
                                $result = get_query($sql);
                            }
                            ?>
                            <?php if (get_row_count($result) > 0): ?>
                                <?php while ($row = get_fetch_array($result)): ?>
                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb">
                                            <img src="author/academy/<?php echo $row['image']; ?>"
                                                 alt="<?php echo $row['university_name']; ?>">
                                        </figure>
                                        <div class="rev-content">
                                            <div class="rating">
                                                <?php
                                                if ($row['rating_star'] == 1) {
                                                    echo "<i class='icon_star voted'></i>";
                                                } elseif ($row['rating_star'] == 2) {
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                } elseif ($row['rating_star'] == 3) {
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                } elseif ($row['rating_star'] == 4) {
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                } elseif ($row['rating_star'] == 5) {
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                    echo "<i class='icon_star voted'></i>";
                                                }
                                                ?>
                                            </div>
                                            <div class="rev-info">
                                                <?php echo $row['university_name']; ?>
                                                – <?php echo $row['booking_date']; ?>
                                            </div>
                                            <div class="rev-text">
                                                <?php
                                                if (!empty($row['review_title'])) {
                                                    echo "<h6>{$row['review_title']}</h6>";
                                                }
                                                ?>
                                                <p><?php echo $row['review_comment']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End review-box -->
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <!-- End review-container -->
                        <hr>
                    </div>
                </div>
                <!-- /section_2 -->
            </div>
            <!-- /col -->
            <?php if ($_SESSION['user_cat'] === 2): ?>
                <aside class="col-xl-4 col-lg-4" id="sidebar">
                    <div class="box_general_3 booking">
                        <form method="post" id="booking_form" role="form">
                            <div class="title">
                                <h3>Book a Tour</h3>
                                <small>Saturday to Thursday 09.00am-06.00pm</small>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" id="booking_date" name="booking_date"
                                               data-lang="en"
                                               data-min-year="2020" data-max-year="2021" data-disabled-days=""
                                               data-format="m/d/Y">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" id="booking_time" name="booking_time"
                                               value="9:00 am">
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <ul class="treatments clearfix">
                                <li>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="total_teacher">Total Teacher</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" id="total_teacher"
                                                       name="total_teacher" min="2" value="0" required>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="total_male_student">Total Male Student</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" id="total_male_student"
                                                       name="total_male_student" min="0" value="0" required>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="total_female_student">Total Female Student</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" id="total_female_student"
                                                       name="total_female_student" min="0" value="0" required>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="total_stuff">Total Stuff</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control" id="total_stuff"
                                                       name="total_stuff" min="0" value="0" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="industry_id"
                                               value="<?php echo $query_id; ?>">
                                        <input type="hidden" class="form-control" name="academy_id"
                                               value="<?php echo $_SESSION['logged_id']; ?>">
                                    </div>
                                </li>
                            </ul>
                            <hr>
                            <input type="submit" class="btn_1 full-width" id="booking_btn" name="booking_btn"
                                   value="Book Now">
                        </form>
                    </div>
                    <!-- /box_general -->
                </aside>
                <!-- /asdide -->
            <?php endif; ?>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <!-- /container -->
</main>
<!-- /main -->

<?php include("includes/footer.php"); ?>