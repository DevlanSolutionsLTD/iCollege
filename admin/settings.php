<?php
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
admin_check_login();
require_once '../config/codeGen.php';
/* Inject System Settings BackEnd Logic */


if (isset($_POST['Save_System_Details'])) {

    /* System Settings */
    $error = 0;
    if (isset($_POST['sys_name']) && !empty($_POST['sys_name'])) {
        $sys_name = mysqli_real_escape_string($mysqli, trim($_POST['sys_name']));
    } else {
        $error = 1;
        $err = 'System Name Cannot Be  Empty';
    }

    if (isset($_POST['sys_tagline']) && !empty($_POST['sys_tagline'])) {
        $sys_tagline = mysqli_real_escape_string($mysqli, trim($_POST['sys_tagline']));
    } else {
        $error = 1;
        $err = 'System Tagline Cannot  Be Empty';
    }

    if (isset($_POST['sys_about']) && !empty($_POST['sys_about'])) {
        $sys_about = mysqli_real_escape_string($mysqli, trim($_POST['sys_about']));
    } else {
        $error = 1;
        $err = 'System About Cannot Be Empty';
    }

    if (isset($_POST['sys_id']) && !empty($_POST['sys_id'])) {
        $sys_id = mysqli_real_escape_string($mysqli, trim($_POST['sys_id']));
    } else {
        $error = 1;
        $err = 'System ID Cannot Be Empty';
    }


    /* Load System Logo */
    $sys_logo = $_FILES['sys_logo']['name'];
    move_uploaded_file($_FILES["sys_logo"]["tmp_name"], "../public/uploads/sys_logo/" . $_FILES["sys_logo"]["name"]);
    $query = 'UPDATE iCollege_Settings  SET  sys_name =? ,sys_logo =? ,sys_tagline =?, sys_about =?  WHERE sys_id =?';
    $stmt = $conn->prepare($query);
    $rc = $stmt->bind_param('sssss', $sys_name, $sys_logo, $sys_tagline, $sys_about, $sys_id);
    $stmt->execute();
    if ($stmt) {
        $success = 'System Settings Updated' && header('refresh:1; url=settings.php');
    } else {
        //inject alert that task failed
        $info = 'Please Try Again Or Try Later';
    }
}


if (isset($_POST['Save_Contact_Details'])) {

    /* System Contact Details */
    $error = 0;
    if (isset($_POST['sys_mail']) && !empty($_POST['sys_mail'])) {
        $sys_mail = mysqli_real_escape_string($mysqli, trim($_POST['sys_mail']));
    } else {
        $error = 1;
        $err = 'System Mail Cannot Be  Empty';
    }

    if (isset($_POST['sys_phone_contact']) && !empty($_POST['sys_phone_contact'])) {
        $sys_phone_contact = mysqli_real_escape_string($mysqli, trim($_POST['sys_phone_contact']));
    } else {
        $error = 1;
        $err = 'System Phone Number Cannot  Be Empty';
    }

    if (isset($_POST['sys_fb']) && !empty($_POST['sys_fb'])) {
        $sys_fb = mysqli_real_escape_string($mysqli, trim($_POST['sys_fb']));
    } else {
        $error = 1;
        $err = 'System Facebook Page Url Cannot Be Empty';
    }

    if (isset($_POST['sys_ig']) && !empty($_POST['sys_ig'])) {
        $sys_ig = mysqli_real_escape_string($mysqli, trim($_POST['sys_ig']));
    } else {
        $error = 1;
        $err = 'System Instagram Page Url Cannot Be Empty';
    }

    if (isset($_POST['sys_twitter']) && !empty($_POST['sys_twitter'])) {
        $sys_twitter = mysqli_real_escape_string($mysqli, trim($_POST['sys_twitter']));
    } else {
        $error = 1;
        $err = 'System Twitter Username Cannot Be Empty';
    }

    if (isset($_POST['sys_googlemap']) && !empty($_POST['sys_googlemap'])) {
        $sys_googlemap = mysqli_real_escape_string($mysqli, trim($_POST['sys_googlemap']));
    } else {
        $error = 1;
        $err = 'System Google Map Embed URL Cannot Be Empty';
    }

    if (isset($_POST['sys_id']) && !empty($_POST['sys_id'])) {
        $sys_id = mysqli_real_escape_string($mysqli, trim($_POST['sys_id']));
    } else {
        $error = 1;
        $err = 'System ID Cannot Be Empty';
    }

    $query = 'UPDATE iCollege_Settings  SET  sys_mail =?, sys_phone_contact =?, sys_fb =?, sys_ig =?, sys_twitter =?, sys_googlemap =?  WHERE sys_id =?';
    $stmt = $conn->prepare($query);
    $rc = $stmt->bind_param('sssssss', $sys_mail, $sys_phone_contact, $sys_fb, $sys_ig, $sys_twitter, $sys_googlemap, $sys_id);
    $stmt->execute();
    if ($stmt) {
        $success = 'System Settings Updated' && header('refresh:1; url=settings.php');
    } else {
        //inject alert that task failed
        $info = 'Please Try Again Or Try Later';
    }
}
require_once '../partials/head.php';
?>

<body>

    <!--  BEGIN NAVBAR  -->
    <?php require_once '../partials/admin_nav.php'; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>System Settings</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php require_once '../partials/admin_sidebar.php'; ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                        <div id="tabsWithIcons" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>System Settings And Landing Pages Customization</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area rounded-pills-icon">

                                    <ul class="nav nav-pills mb-4 mt-3  justify-content-center" id="rounded-pills-icon-tab" role="tablist">

                                        <li class="nav-item ml-2 mr-2">
                                            <a class="nav-link mb-2 active text-center" id="rounded-pills-icon-settings-tab" data-toggle="pill" href="#rounded-pills-icon-settings" role="tab" aria-controls="rounded-pills-icon-settings" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                                </svg> System </a>
                                        </li>

                                        <li class="nav-item ml-2 mr-2">
                                            <a class="nav-link mb-2 text-center" id="rounded-pills-icon-contact-tab" data-toggle="pill" href="#rounded-pills-icon-contact" role="tab" aria-controls="rounded-pills-icon-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                </svg> Contact</a>
                                        </li>

                                    </ul>
                                    <?php
                                    /* Load System Settings */
                                    $ret = 'SELECT * FROM `iCollege_Settings`';
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($sys = $res->fetch_object()) {
                                    ?>
                                        <div class="tab-content" id="rounded-pills-icon-tabContent">
                                            <div class="tab-pane fade show active" id="rounded-pills-icon-settings" role="tabpanel" aria-labelledby="rounded-pills-icon-home-tab">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="">System Name</label>
                                                                <input type="text" required name="sys_name" value="<?php echo $sys->sys_name; ?>" class="form-control">
                                                                <!-- Hide This -->
                                                                <input type="hidden" required name="id" value="<?php echo $sys->sys_id; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputFile">System Logo</label>
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input required name="file" accept=".png, .svg, .jpeg, .jpg" type="sys_logo" class="custom-file-input" id="exampleInputFile">
                                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="">System Tagline</label>
                                                                <input type="text" required name="sys_tagline" value="<?php echo $sys->sys_tagline; ?>" class="form-control">
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="exampleInputPassword1">System About</label>
                                                                <textarea required name="sys_about" rows="7" class="form-control"><?php echo $sys->sys_about; ?></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" name="Save_System_Details" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="tab-pane fade" id="rounded-pills-icon-contact" role="tabpanel" aria-labelledby="rounded-pills-icon-contact-tab">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="">Email Address</label>
                                                                <input type="text" required name="sys_mail" value="<?php echo $sys->sys_mail; ?>" class="form-control">
                                                                <!-- Hide This -->
                                                                <input type="hidden" required name="sys_id" value="<?php echo $sys->sys_id; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="">Mobile Phone Number</label>
                                                                <input type="text" required name="sys_phone_contact" value="<?php echo $sys->sys_phone_contact; ?>" class="form-control">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="">Facebook Page Url / Username</label>
                                                                <input type="text" required name="sys_fb" value="<?php echo $sys->sys_fb; ?>" class="form-control">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="">Instagram Page Url / Username</label>
                                                                <input type="text" required name="sys_ig" value="<?php echo $sys->sys_ig; ?>" class="form-control">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="">Twitter Username</label>
                                                                <input type="text" required name="sys_twitter" value="<?php echo $sys->sys_twitter; ?>" class="form-control">
                                                            </div>

                                                            <div class="form-group col-md-12">
                                                                <label for="exampleInputPassword1">Google Maps Embed Map Url</label>
                                                                <textarea required name="sys_googlemap" rows="4" class="form-control"></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" name="Save_Contact_Details" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once '../partials/footer.php'; ?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <?php require_once '../partials/scripts.php'; ?>
</body>

</html>