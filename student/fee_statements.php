<?php
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
student();
require_once '../config/codeGen.php';
require_once '../partials/head.php';
?>

<body>

    <!--  BEGIN NAVBAR  -->
    <?php require_once '../partials/admin_nav.php'; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Finances</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Fee Payments</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php require_once '../partials/student_sidebar.php'; ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">

                            <div class="table-responsive mb-4 mt-4">
                                <table id="export" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Student Admission Number</th>
                                            <th>Student Name</th>
                                            <th>Ref Code</th>
                                            <th>Debit Amount</th>
                                            <th>Credit Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $admno = $_SESSION['admno'];
                                        $ret = "SELECT * FROM `iCollege_fees_payments` WHERE std_regno = '$admno'";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($payments = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $payments->std_regno; ?></td>
                                                <td><?php echo $payments->std_name; ?></td>
                                                <td><?php echo $payments->payment_code; ?></td>
                                                <td>Ksh <?php echo $payments->amt_billed; ?></td>
                                                <td>Ksh <?php echo $payments->amt_paid; ?></td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once '../partials/footer.php'; ?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <?php require_once '../partials/scripts.php'; ?>
</body>

</html>