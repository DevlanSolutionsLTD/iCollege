<?php require_once('../partials/head.php'); ?>

<body class="form">

    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Reset Your <a href=""><span class="brand-name">iCampus</span></a> Password</h1>
                        <form class="text-left" method="POST">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" name="email" type="text" class="form-control" placeholder="Email">
                                </div>

                                <div class="field-wrapper">
                                    <a href="index.php" class="forgot-pass-link">Remembered Password?</a>
                                </div>

                            </div>
                        </form>
                        <p class="terms-conditions">© 2021 - <?php echo date('Y'); ?> iCampus All Rights Reserved. A <a href="https://devlan.martdev.info">Devlan Inc</a> Production.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>

    <?php require_once('../partials/scripts.php'); ?>
</body>


</html>