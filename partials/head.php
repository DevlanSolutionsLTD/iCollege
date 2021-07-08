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

/* Load System Settings */
$ret = 'SELECT * FROM `iCollege_Settings`';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <title><?php echo $sys->sys_name; ?> - <?php echo $sys->sys_tagline; ?></title>
        <link rel="icon" type="image/x-icon" href="../public/img/favicon.ico" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="../public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Plugis -->
        <link href="../public/css/plugins.css" rel="stylesheet" type="text/css" />
        <!-- Auth Forms -->
        <link href="../public/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../public/css/forms/theme-checkbox-radio.css">
        <link rel="stylesheet" type="text/css" href="../public/css/forms/switches.css">
        <!-- Dashboard  -->
        <link href="../public/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
        <!-- Loaders -->
        <link href="../public/css/loader.css" rel="stylesheet" type="text/css" />
        <script src="../public/js/loader.js"></script>
        <!-- Apex Charts -->
        <link href="../public/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
        <!-- Account Settings -->
        <link href="../public/css/users/account-setting.css" rel="stylesheet" type="text/css" />
        <!-- Data Tables -->
        <link rel="stylesheet" type="text/css" href="../public/plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="../public/plugins/table/datatable/dt-global_style.css">
        <link rel="stylesheet" type="text/css" href="../public/plugins/datatable/custom_dt_html5.css">
        <link rel="stylesheet" type="text/css" href="../public/plugins/table/datatable/datatables.css">
        <link rel="stylesheet" type="text/css" href="../public/plugins/table/datatable/custom_dt_html5.css">
        <link rel="stylesheet" type="text/css" href="../public/plugins/table/datatable/dt-global_style.css">
        <!-- Animate -->
        <link href="../public/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
        <!-- Tabs -->
        <link href="../public/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
        <!-- CustomModals -->
        <link href="../public/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
        <link href="../public/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
        <!-- Select -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Sweet Alerts -->
        <script src="../public/plugins/sweetalerts/promise-polyfill.js"></script>
        <link href="../public/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <link href="../public/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="../public/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />

        <!-- Init Swal -->
        <?php if (isset($success)) { ?>
            <!--This code for injecting success alert-->
            <script>
                setTimeout(function() {
                        swal(
                            "Success", "<?php echo $success; ?>", "success",
                        );
                    },
                    100);
            </script>

        <?php } ?>

        <?php if (isset($err)) { ?>
            <!--This code for injecting error alert-->
            <script>
                setTimeout(function() {
                        swal("Failed", "<?php echo $err; ?>", "error", );
                    },
                    100);
            </script>

        <?php } ?>
        <?php if (isset($info)) { ?>
            <!--This code for injecting info alert-->
            <script>
                setTimeout(function() {
                        swal("Success", "<?php echo $info; ?>", "warning");
                    },
                    100);
            </script>

        <?php } ?>
    </head>
<?php
} ?>