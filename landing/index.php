<?php
/*
 * Created on Thu Jul 08 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

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
                                <h1 class="animated fadeInRight"><?php echo $sys->sys_name; ?></h1>
                                <p class="animated fadeInRight"><?php echo $sys->sys_tagline; ?></p>
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