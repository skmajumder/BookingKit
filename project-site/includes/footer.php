<footer>
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <p>
                    <a href="index.php" title="Findoctor">
                        <img src="img/logo.png" data-retina="true" alt="" width="163" height="36" class="img-fluid">
                    </a>
                </p>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>Menu</h5>
                <ul class="links">
                    <li><a href="index.php">Home</a></li>
                    <?php if (!get_logged_in()) : ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>Useful links</h5>
                <ul class="links">
                    <li><a href="list.php">Listings</a></li>
                    <li><a href="students.php">Student List</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4">
                <h5>Contact</h5>
                <ul class="contacts">
                    <li><a href="tel://61280932400"><i class="icon_mobile"></i> 01634699871</a></li>
                </ul>
            </div>
        </div>
        <!--/row-->
        <hr>
        <div class="row">
            <div class="col-md-8">
                <ul id="additional_links">

                </ul>
            </div>
            <div class="col-md-4">
                <div id="copy">© 2020 Booking</div>
            </div>
        </div>
    </div>
</footer>
<!--/footer-->
<!--/footer-->

<div id="toTop"></div>
<!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/common_scripts.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/zxcvbn.js"></script>
<script src="js/functions.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script src="js/markerclusterer.js"></script>
<script src="js/map_listing.js"></script>
<script src="js/infobox.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
    $('#calendar').datepicker({
        todayHighlight: true,
        daysOfWeekDisabled: [5],
        weekStart: 6,
        format: "yyyy-mm-dd",
        datesDisabled: ["2017/10/20", "2017/11/21", "2017/12/21", "2018/01/21", "2018/02/21", "2018/03/21"],
    });

</script>
<!-- SPECIFIC SCRIPTS -->
<script src="js/video_header.js"></script>
<script>
    'use strict';
    HeaderVideo.init({
        container: $('.header-video'),
        header: $('.header-video--media'),
        videoTrigger: $("#video-trigger"),
        autoPlayVideo: true
    });
</script>

<script src="js/script.js"></script>

</body>

</html>
