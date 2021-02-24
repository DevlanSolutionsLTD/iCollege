<?php
session_start();
require_once("../config/config.php");

if (isset($_POST['ChangePassword'])) {
    /* Confirm Password */
    $error = 0;
    if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
        $new_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['new_password']))));
    } else {
        $error = 1;
        $err = "New Password Cannot Be Empty";
    }
    if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
        $confirm_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['confirm_password']))));
    } else {
        $error = 1;
        $err = "Confirmation Password Cannot Be Empty";
    }

    if (!$error) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM  iCollege_admin  WHERE email = '$email'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($new_password != $confirm_password) {
                $err = "Password Does Not Match";
            } else {
                $email = $_SESSION['email'];
                $query = "UPDATE iCollege_admin SET  password =? WHERE email =?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ss', $new_password, $email);
                $stmt->execute();
                if ($stmt) {
                    $success = "Password Changed" && header("refresh:1; url=index.php");
                } else {
                    $err = "Please Try Again Or Try Later";
                }
            }
        }
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
                            <?php
                            $email  = $_SESSION['email'];
                            $ret = "SELECT * FROM  iCollege_admin  WHERE email = '$email'";
                            $stmt = $mysqli->prepare($ret);
                            $stmt->execute(); //ok
                            $res = $stmt->get_result();
                            while ($row = $res->fetch_object()) {
                            ?>
                                <h5 class=""><?php echo $row->email; ?> Please Reset Your <a href=""><span class="brand-name"><?php echo $sys->sys_name; ?></span></a> Password</h5>
                            <?php
                            } ?>
                            <form class="text-left" method="POST">
                                <div class="form">
                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                        <input name="new_password" type="password" class="form-control" placeholder="New Password">
                                    </div>

                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                        <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
                                    </div>

                                    <div class="field-wrapper">
                                        <button type="submit" name="ChangePassword" class="btn btn-primary" value="">Confirm Password</button>
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
                    <img src="../public/uploads/sys_logo/<?php echo $sys->sys_logo; ?>" alt="System Logo" height="700" width="700">
                </div>
            </div>
        </div>

        <?php require_once('../partials/scripts.php'); ?>
    </body>


    </html>
<?php
} ?>