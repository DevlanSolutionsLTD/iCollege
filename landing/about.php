<?php
require_once('../config/config.php');

/* Load System Settings */
$ret = 'SELECT * FROM `iCollege_Settings`';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require('../partials/landing_head.php');
?>

    <body>

        <!-- ==============================================
    ** Header **
    =================================================== -->
        <?php require_once('../partials/landing_header.php'); ?>

        <!-- ==============================================
    ** Inner Banner **
    =================================================== -->
        <div class="inner-banner blog">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <h1>About Us</h1>
                            <p>
                                <?php echo $sys->sys_about; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==============================================
    ** Footer **
    =================================================== -->
        <?php require_once('../partials/landing_footer.php'); ?>

        <!-- ==============================================
    ** Scripts **
    =================================================== -->
        <?php require_once('../partials/landing_scripts.php'); ?>
    </body>


    </html>
<?php
} ?>