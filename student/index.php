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

session_start();
include('../config/config.php');

if (isset($_POST['login'])) {

    $admno = $_POST['admno'];
    $password = sha1(md5($_POST['password'])); //double encrypt to increase security
    $stmt = $mysqli->prepare("SELECT admno, password, id  FROM iCollege_students  WHERE admno =? AND password =?");
    $stmt->bind_param('ss', $admno, $password); //bind fetched parameters
    $stmt->execute(); //execute bind 
    $stmt->bind_result($admno, $password, $id); //bind result
    $rs = $stmt->fetch();
    $_SESSION['id'] = $id;
    $_SESSION['admno'] = $admno;
    if ($rs) {
        header("location:dashboard.php");
    } else {
        $err = "Access Denied Please Check Your Credentials";
    }
}
require_once('../partials/head.php');
/* Load System Settings */
$ret = 'SELECT * FROM `iCollege_Settings`';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>

    <body class="form">


        <div class="form-container">
            <div class="form-form">
                <div class="form-form-wrap">
                    <div class="form-container">
                        <div class="form-content">

                            <h1 class="">Log in to <a href="index.php"><span class="brand-name"><?php echo $sys->sys_name; ?></span></a></h1>
                            <form class="text-left" method="POST">
                                <div class="form">
                                    <div id="username-field" class="field-wrapper input">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <input id="username" name="admno" type="text" class="form-control" placeholder="Admission Number">
                                    </div>

                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                        <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper toggle-pass">
                                            <p class="d-inline-block">Show Password</p>
                                            <label class="switch s-primary">
                                                <input type="checkbox" id="toggle-password" class="d-none">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="field-wrapper">
                                            <button type="submit" name="login" class="btn btn-primary" value="">Log In</button>
                                        </div>

                                    </div>

                                    <div class="field-wrapper text-center keep-logged-in">
                                        <div class="n-chk new-checkbox checkbox-outline-primary">
                                            <label class="new-control new-checkbox checkbox-outline-primary">
                                                <input type="checkbox" class="new-control-input">
                                                <span class="new-control-indicator"></span>Keep me logged in
                                            </label>
                                        </div>
                                    </div>

                                    <div class="field-wrapper">
                                        <a href="reset_password.php" class="forgot-pass-link">Forgot Password?</a>
                                    </div>

                                </div>
                            </form>
                            <p class="terms-conditions">© 2021 - <?php echo date('Y'); ?> <?php echo $sys->sys_name; ?> All Rights Reserved. A <a href="https://devlan.martdev.info">Devlan Inc</a> Production.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-image">
                <div class="">
                    <img src="../public/uploads/sys_logo/<?php echo $sys->sys_logo; ?>" alt="System Logo" height="500" width="600">
                </div>
            </div>
        </div>

        <?php require_once('../partials/scripts.php'); ?>
    </body>


    </html>
<?php
} ?>