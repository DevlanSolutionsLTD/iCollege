<header>

    <!-- Start Header Middle -->
    <div class="container header-middle">
        <div class="row"> <span class="col-xs-6 col-sm-3"><a href="index.php"><img src="../public/uploads/sys_logo/<?php echo $sys->sys_logo; ?>" class="img-responsive" alt=""></a></span>
            <div class="col-xs-6 col-sm-3"></div>
            <div class="col-xs-6 col-sm-9">
                <div class="contact clearfix">
                    <ul class="hidden-xs">
                        <li> <span>Email</span> <a href="mailto:<?php echo $sys->sys_mail;?>"><?php echo $sys->sys_mail;?></a> </li>
                        <li> <span>Toll Free</span> <?php echo $sys->sys_phone_contact;?> </li>
                    </ul>
                    <a href="../staff/" target="_blank" class="login">Staff Portal <span class="icon-more-icon"></span></a>
                    <a href="../student/" target="_blank" class="login">Student Portal <span class="icon-more-icon"></span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Middle -->
    <!-- Start Navigation -->
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                
                <ul class="nav navbar-nav">
                    <li> <a href="index.php">Home</a></li>
                    <li> <a href="about.php">About</a></li>
                    <li> <a href="contact.php">Contact Us</a></li>
                    <li> <a href="../admin/" target="_blank">Admin Portal</a></li>
                    <li> <a href="../staff/" target="_blank">Staff Portal</a></li>
                    <li> <a href="../student/" target="_blank">Student Portal</a></li>
                    <li> <a href="../webmail/" target="_blank">WebMail</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->
</header>