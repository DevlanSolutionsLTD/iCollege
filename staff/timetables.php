<?php
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
admin_check_login();
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
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Time Tables</span></li>
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
        <?php require_once '../partials/staff_sidebar.php'; ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <?php
                                    $number =$_SESSION['number'];
                                    $ret = 'SELECT * FROM `iCollege_units_allocation` WHERE lec_number=?';
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->bind_param('s', $number); //bind fetched parameters
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($al = $res->fetch_object()) { 
                                      
                                       $lec_name =$al->lec_name;
                                        
                                        ?>
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">

                            <div class="table-responsive mb-4 mt-4">
                                
                                <table id="export" class="table" style="width:100%">
                                <h2> Time table </h2>
                                    <thead>
                                        <tr>
                                         <th>Course name</th>
								       <th>Unit code</th>
								<th>Monday</th>
								<th>Tuesday</th>
								<th>Wednesday</th>
								<th>Thursday</th>
								<th>Friday</th>
								<th>Saturday</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ret = 'SELECT * FROM iCollege_timetable WHERE lec_name= ?';
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->bind_param('s',  $lec_name); //bind fetched parameters
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($tt = $res->fetch_object()) { ?>
                                    <tr>
									<td><?php echo $tt->course_name; ?></td>
									<td><?php echo $tt->unit_code; ?></td>
                                    <?php if ($tt->day == 'Monday') {
                                        echo "
											<td class='table-primary' ><b>$tt->unit_name</b><br>At: Room $tt->room</td>
											<td class='table-primary' >--</td>
											<td class='table-primary'>--</td>
											<td class='table-primary'>--</td>
											<td class='table-primary'>--</td>
											<td class='table-primary'>--</td>
										";
                                    } elseif ($tt->day == 'Tuesday') {
                                        echo "
												<td class='table-success'>--</td>
												<td class='table-success'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
												<td class='table-success'>--</td>
												<td class='table-success'>--</td>
												<td class='table-success'>--</td>
                                                <td class='table-success'>--</td>
                                                
											";
                                    } elseif ($tt->day == 'Wednesday') {
                                        echo "
												<td class='table-secondary'>--</td>
												<td class='table-secondary'>--</td>
												<td class='table-secondary'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
												<td class='table-secondary'>--</td>
												<td class='table-secondary'>--</td>
												<td class='table-secondary'>--</td>
											";
                                    } elseif ($tt->day == 'Thursday') {
                                        echo "
												<td class='bg-info'>--</td>
												<td class='bg-info'>--</td>
												<td class='bg-info'>--</td>
												<td class='bg-info'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
												<td class='bg-info'>--</td>
												<td class='bg-info'>--</td>
											";
                                    } elseif ($tt->day == 'Friday') {
                                        echo "
                                                 
												<td class='table-warning'>--</td>
												<td class='table-warning'>--</td>
												<td class='table-warning'>--</td>
												<td class='table-warning'>--</td>
												<td class='table-warning'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
												<td class='table-warning'>--</td>
											";
                                    } else {
                                        echo "
											<td class='table-danger'>--</td>
											<td class='table-danger'>--</td>
											<td class='table-danger'>--</td>
											<td class='table-danger'>--</td>
											<td class='table-danger'>--</td>
											<td class='table-danger'><b>$tt->unit_name</b><br>At: Room $tt->room</td>
										";
                                    }}
                                    ?>

								</tr>
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
        <?php } ?>
    </div>
    <!-- END MAIN CONTAINER -->
    <?php require_once '../partials/scripts.php'; ?>
</body>

</html>