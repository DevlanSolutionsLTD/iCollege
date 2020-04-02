<?php
require_once('../config/config.php');

/* Load System Settings */
$ret = 'SELECT * FROM `iCollege_Settings`';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    require('../partials/landing_head.php'); ?>

    <body>

        <!-- ==============================================
    ** Header **
    =================================================== -->
        <?php require_once('../partials/landing_header.php'); ?>

        <!-- ==============================================
    ** Inner Banner **
    =================================================== -->
        <div class="inner-banner contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-lg-9">
                        <div class="content">
                            <h1>Contact Us</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ==============================================
    ** Contact Us **
    =================================================== -->
        <section class="form-wrapper padding-lg">
            <div class="container">
                <form name="contact-form" id="ContactForm">
                    <div class="row input-row">
                        <div class="col-sm-6">
                            <input name="first_name" type="text" placeholder="First Name">
                        </div>
                        <div class="col-sm-6">
                            <input name="last_name" type="text" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row input-row">
                        <div class="col-sm-6">
                            <input name="company" type="text" placeholder="Company">
                        </div>
                        <div class="col-sm-6">
                            <input name="phone_number" type="text" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="row input-row">
                        <div class="col-sm-6">
                            <input name="business_email" type="text" placeholder="Business Email">
                        </div>
                        <div class="col-sm-6">
                            <input name="job_title" type="text" placeholder="Job Tittle">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn">Send Message <span class="icon-more-icon"></span></button>
                            <div class="msg"></div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- ==============================================
    ** Google Map **
    =================================================== -->
        <section class="google-map">
            <div id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15953.587227972272!2d37.27467624348614!3d-1.5294998429865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ske!4v1614237873455!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
            <div class="container">
                <div class="contact-detail">
                    <div class="address">
                        <div class="inner">
                            <h3><?php echo $sys->sys_name; ?></h3>
                            <p>
                                <?php echo $sys->sys_tagline; ?>
                            </p>
                        </div>
                        <div class="inner">
                            <h3><?php echo $sys->sys_phone_contact; ?></h3>
                        </div>
                        <div class="inner"> <a href="mailto:<?php echo $sys->sys_mail; ?>"><?php echo $sys->sys_mail; ?></a> </div>
                    </div>
                    <div class="contact-bottom">
                        <ul class="follow-us clearfix">
                            <li><a href="https://facebook.com/<?php echo $sys->sys_fb; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/<?php echo $sys->sys_twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="https://instagram.com/<?php echo $sys->sys_instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==============================================
    ** Have Questions? **
    =================================================== -->
        <section class="our-impotance have-question padding-lg">
            <div class="container">
                <h2>Still have questions?</h2>
                <ul class="row">
                    <li class="col-sm-4 equal-hight">
                        <div class="inner"> <img src="../public/uploads/sys_data/images/help-center-ico.jpg" alt="Malleable Study Time">
                            <h3>Help Center</h3>
                            <p>Study material available online 24/7. Study in your free time, no time management issues, perfect balance between work and study time.</p>
                        </div>
                    </li>
                    <li class="col-sm-4 equal-hight">
                        <div class="inner"> <img src="../public/uploads/sys_data/images/faq-ico.jpg" alt="Placement Assistance">
                            <h3>Faq’s</h3>
                            <p>Edumart University Online has access to all of Edumart Group’s placement resources and alumni network, through which thousands of job opportunities are generated.</p>
                        </div>
                    </li>
                    <li class="col-sm-4 equal-hight">
                        <div class="inner"> <img src="../public/uploads/sys_data/images/document-ico.jpg" alt="Easy To Access">
                            <h3>Technical Documents</h3>
                            <p>There is easy accessibility to online help in terms of online teachers and online forums. Teachers can be contacted with the help of video chats and e-mails.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!-- ==============================================
    ** Footer **
    =================================================== -->
        <?php require_once('../partials/landing_footer.php'); ?>

    </body>
    <!-- ==============================================
    ** Scripts **
    =================================================== -->
    <?php require_once('../partials/landing_scripts.php'); ?>

    </html>
<?php
} ?>