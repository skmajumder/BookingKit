<?php include("includes/header.php"); ?>
    <!-- ::: header.php ::: -->
<?php get_login_redirect(); ?>

<?php
$sql = "SELECT us.id,
       CONCAT_WS(' ', us.first_name, us.last_name) AS 'name',
       us.program,
       us.email,
       us.image,
       ss.session_year,
       ul.university_name,
       sfu.cv_file
FROM users_student us
         INNER JOIN student_file_upload sfu on us.id = sfu.student_id
         INNER JOIN university_list ul on us.university_name = ul.id
         INNER JOIN student_session ss on us.student_session = ss.id";
$result = get_query($sql);
?>
    <main>
        <div id="results">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo "<h4><strong>Showing </strong> of results</h4>";
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
                            <input type="radio" id="all" name="all" value="All" checked>
                            <label for="all">All Student</label>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /container -->
        </div>
        <!-- /filters -->

        <div class="container margin_60_35">
            <div class="row">
                <?php if (get_row_count($result) > 0): ?>
                    <?php while ($row = get_fetch_array($result)): ?>
                        <div class="col-lg-4 col-md-4">
                            <div class="student-profile">
                                <div class="card">
                                    <img class="card-img-top img-fluid"
                                         src="author/student/<?php echo $row['image']; ?>"
                                         alt="<?php echo $row['name']; ?>">
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo $row['name']; ?></h6>
                                        <span><?php echo $row['university_name']; ?></span> <br>
                                        <span><strong>Program:</strong> <?php echo $row['program']; ?></span> <br>
                                        <span><strong>Session:</strong> <?php echo $row['session_year']; ?></span> <br>
                                        <span><strong>Email:</strong> <?php echo $row['email']; ?></span> <br>
                                        <?php
                                        if (!empty($row['cv_file'])) {
                                            echo "<a href='author/student/{$row['cv_file']}' class='btn btn-primary' download>CV</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /col -->
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!-- /main -->

    <!-- ::: footer.php ::: -->
<?php include("includes/footer.php"); ?>