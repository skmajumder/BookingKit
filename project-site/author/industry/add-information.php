<?php include 'includes/header.php'; ?>
<?php
$user_id = $_SESSION['logged_id'];
?>

    <div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Add Information</li>
        </ol>

        <div class="box_general padding_bottom">
            <div class="header_box version_2">
                <h2><i class="fa fa-info-circle"></i>General Information</h2>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="action-information">
                        <?php
                        get_validate_industry_information();
                        the_session_display_message();
                        ?>
                    </div>
                </div>
            </div>
            <form method="post" id="industry_information_details" role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="industry_slogan">Slogan/Motto *</label>
                            <input type="text" class="form-control" id="industry_slogan" name="industry_slogan"
                                   placeholder="Industry Slogan/Motto" required>
                        </div>
                    </div>
                </div>
                <!-- /row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="industry_details">Industry Details *</label>
                            <textarea name="industry_details" id="industry_details" class="form-control"
                                      placeholder="Company Details Information"
                                      required></textarea>
                        </div>
                    </div>
                </div>
                <!-- /row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="industry_mission">Mission</label>
                            <textarea name="industry_mission" id="industry_mission" class="form-control"
                                      placeholder="Mission"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="industry_vision">Vision</label>
                            <textarea name="industry_vision" id="industry_vision" class="form-control"
                                      placeholder="Vision"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="industry_environment">Commitment to the Environment:</label>
                            <textarea name="industry_environment" id="industry_environment" class="form-control"
                                      placeholder="Commitment to the Environment:"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" name="industry_information_details_btn"
                                   id="industry_information_details_btn" class="btn_1 medium"
                                   value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /box_general-->

        <div class="box_general padding_bottom">
            <!--                <div class="header_box version_2">-->
            <!--                    <h2><i class="fa fa-file-text"></i>Curriculum</h2>-->
            <!--                </div>-->
            <!--                <div class="row">-->
            <!--                    <div class="col-md-12">-->
            <!--                        <div class="form-group">-->
            <!--                            <label>Professional statement</label>-->
            <!--                            <div class="editor"></div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!-- /row-->
            <!-- /box_general-->
        </div>
        <!-- /.container-fluid-->
    </div>
    <!-- /.container-wrapper-->

<?php include 'includes/footer.php'; ?>