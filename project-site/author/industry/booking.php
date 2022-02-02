<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];
$sql = "SELECT ul.university_name         name,
       ul.website,
       ua.image_name,
       ua.image,
       ua.university_office_phone phone,
       ua.university_email        email,
       b.id,
       b.academy_id,
       b.booking_date,
       b.booking_time,
       b.created_date,
       b.total_teacher,
       b.total_male_student,
       b.total_female_student,
       b.total_stuff,
       b.active,
       b.tour_end,
       b.review,
       f.faculty_name,
       d.department_name
FROM booking b
         INNER JOIN users_academy ua ON b.academy_id = ua.id
         INNER JOIN university_list ul ON ua.university_name = ul.id
         INNER JOIN faculty f on ua.faculty_category = f.faculty_id
         INNER JOIN department d on ua.department_category = d.department_id
WHERE b.industry_id = '" . get_escape_sql($user_id) . "'";
$result = get_query($sql);
?>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Bookings</li>
            </ol>
            <div class="message">
                <?php
                get_booking_confirm_validation();
                echo "<br/>";
                echo the_session_display_message();
                ?>
            </div>
            <div class="box_general">
                <div class="list_general">
                    <ul>
                        <?php
                        if (get_row_count($result) > 0):
                            while ($row = get_fetch_array($result)): ?>
                                <li>
                                    <figure>
                                        <img src="../academy/<?php echo $row['image']; ?>"
                                             alt="<?php echo $row['image_name']; ?>">
                                    </figure>
                                    <h4>
                                        <?php
                                        echo $row['name'];
                                        if ($row['active'] == 0) {
                                            echo "<i class='pending'>Pending</i>";
                                        } elseif ($row['active'] == 1) {
                                            echo "<i class='approved'>Approved</i>";
                                        } elseif ($row['active'] == 2) {
                                            echo "<i class='cancel'>Cancel</i>";
                                        }
                                        ?>
                                    </h4>
                                    <ul class="booking_details">
                                        <?php if ($row['active'] == 1) : ?>
                                            <?php if ($row['tour_end'] == 1) : ?>
                                                <li><strong>Tour:</strong> <i class='approved'>Complete</i></li>
                                            <?php
                                            else:
                                                echo "<li><strong>Status:</strong> <i class='pending'>Not Complete</i></li>";
                                            endif;
                                            ?>
                                        <?php endif; ?>
                                        <?php if ($row['active'] == 1) : ?>
                                            <?php if ($row['review'] == 1): ?>
                                                <li><strong>Review:</strong>
                                                    <a href="review.php?query_id=<?php echo $row['id']; ?>"
                                                       class="approved">See Review</a>
                                                </li>
                                            <?php else: ?>
                                                <li><strong>Review:</strong> <i class='pending'>Not Complete</i></li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <li><strong>Faculty</strong> <?php echo $row['faculty_name']; ?></li>
                                        <li><strong>Department</strong> <?php echo $row['department_name']; ?></li>
                                        <li><strong>Booking date</strong> <?php echo $row['booking_date']; ?></li>
                                        <li><strong>Booking time</strong> <?php echo $row['booking_time']; ?></li>
                                        <li><strong>Created Date</strong> <?php echo $row['created_date']; ?></li>
                                        <li><strong>Contact Number</strong> <?php echo $row['phone']; ?></li>
                                        <li><strong>Email</strong> <?php echo $row['email']; ?></li>
                                        <li><strong>Teacher</strong> <?php echo $row['total_teacher']; ?></li>
                                        <li>
                                            <strong>Student</strong>
                                            <?php
                                            echo $row['total_male_student'] + $row['total_female_student'];
                                            echo " (Male: {$row['total_male_student']}, Female: {$row['total_female_student']})";
                                            ?>
                                        </li>
                                        <li><strong>Staff</strong> <?php echo $row['total_stuff']; ?></li>
                                        <li><strong>Website</strong><?php echo $row['website']; ?></li>
                                    </ul>
                                    <?php if ($row['active'] == 0): ?>
                                        <form method="post" role="form">
                                            <ul class="buttons">
                                                <li>
                                                    <input type="hidden" name="booking_id" id="booking_id"
                                                           value="<?php echo $row['id']; ?>">
                                                </li>
                                                <li>
                                                    <input type="hidden" name="academy_id" id="academy_id"
                                                           value="<?php echo $row['academy_id']; ?>">
                                                </li>
                                                <li>
                                                    <button type="submit" class="btn_1 gray approve" name="approve">
                                                        <i class="fa fa-fw fa-check-circle-o"></i>
                                                        Approve
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="submit" class="btn_1 gray delete" name="cancel">
                                                        <i class="fa fa-fw fa-times-circle-o"></i>
                                                        Cancel
                                                    </button>
                                                </li>
                                            </ul>
                                        </form>
                                    <?php endif; ?>
                                </li>
                            <?php
                            endwhile;
                        else:
                            echo "<h4>No Booking Found.</h4>";
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
            <!-- /box_general-->
        </div>
        <!-- /container-fluid-->
    </div>
    <!-- /container-wrapper-->

<?php include 'includes/footer.php'; ?>