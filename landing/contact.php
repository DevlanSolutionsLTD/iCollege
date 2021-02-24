<?php require_once('../partials/landing_head.php'); ?>

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
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
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
        <div id="map"><iframe src="https://snazzymaps.com/embed/21734" style="border:none;"></iframe></div>
        <div class="container">
            <div class="contact-detail">
                <div class="address">
                    <div class="inner">
                        <h3>Edumart</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has...</p>
                    </div>
                    <div class="inner">
                        <h3>000 0000 000</h3>
                    </div>
                    <div class="inner"> <a href="mailto:info@edumart.com">info@edumart.com</a> </div>
                </div>
                <div class="contact-bottom">
                    <ul class="follow-us clearfix">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
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
                    <div class="inner"> <img src="images/help-center-ico.jpg" alt="Malleable Study Time">
                        <h3>Help Center</h3>
                        <p>Study material available online 24/7. Study in your free time, no time management issues, perfect balance between work and study time.</p>
                    </div>
                </li>
                <li class="col-sm-4 equal-hight">
                    <div class="inner"> <img src="images/faq-ico.jpg" alt="Placement Assistance">
                        <h3>Faq’s</h3>
                        <p>Edumart University Online has access to all of Edumart Group’s placement resources and alumni network, through which thousands of job opportunities are generated.</p>
                    </div>
                </li>
                <li class="col-sm-4 equal-hight">
                    <div class="inner"> <img src="images/document-ico.jpg" alt="Easy To Access">
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