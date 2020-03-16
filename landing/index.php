<?php
require_once('../config/config.php');
/* Load System Settings */
$ret = 'SELECT * FROM `iCollege_Settings`';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require_once('../partials/landing_head.php');
?>

    <body>

        <!-- ==============================================
    ** Header **
    =================================================== -->
        <?php
        require_once('../partials/landing_header.php');

        ?>

        <!-- ==============================================
    ** Banner Carousel **
    =================================================== -->
        <div class="banner-outer">
            <div class="banner-slider">
                <div class="slide1">
                    <div class="container">
                        <div class="content animated fadeInRight">
                            <div class="fl-right">
                                <h1 class="animated fadeInRight"><?php echo $sys->sys_tagline; ?></h1>
                                <p class="animated fadeInRight"><?php echo $sys->sys_name; ?></p>
                                <a href="about.php" class="btn animated fadeInRight">Know More <span class="icon-more-icon"></span></a>
                            </div>
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