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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="dashboard.php">Reports</a></li>
                                <li class="breadcrumb-item"><a href="academic_reports.php">Academic Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Student  Performance Report</span></li>
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
        <?php require_once '../partials/admin_sidebar.php'; ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            
                            <hr>

                           

                            <div class="table-responsive mb-4 mt-4">
                            <table id="export" class="table" style="width:100%">
                                
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Unit Code</th>
                                            <th>Unit Name</th>
                                            <th>Admno</th>
                                            <th>Name</th>
                                            <th>Semester</th>
                                            <th>Academic Year</th>
                                            <th>Marks Scored</th>
                                            <th>Grades</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = 'SELECT * FROM `iCollege_exammarks`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($marks = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $marks->course_name; ?></td>
                                                <td><?php echo $marks->unit_code; ?></td>
                                                <td><?php echo $marks->unit_name; ?></td>
                                                <td><?php echo $marks->std_regno; ?></td>
                                                <td><?php echo $marks->std_name; ?></td>
                                                <td><?php echo $marks->semester_enrolled; ?></td>
                                                <td><?php echo $marks->academic_year; ?></td>
                                                <td><?php echo $marks->marks; ?></td>
                                                <td>
                                                <?php
                                                                                            $workScore = $marks->marks;

                                                                                            switch ($workScore) {
                                                                                                case $workScore >= 70 and $workScore <= 100:
                                                                                                    echo 'A';
                                                                                                    break;
                                                                                                case $workScore >= 60 and $workScore <= 69:
                                                                                                    echo 'B';
                                                                                                    break;
                                                                                                case $workScore >= 50 and $workScore <= 59:
                                                                                                    echo 'C';
                                                                                                    break;
                                                                                                case $workScore >= 40 and $workScore <= 49:
                                                                                                    echo 'D';
                                                                                                    break;
                                                                                                case $workScore >= 0 and $workScore <= 39:
                                                                                                    echo 'E';
                                                                                                    break;
                                                                                                default:
                                                                                                    echo 'N/A';
                                                                                            }
                                                                                            ?>
                                                                                        </td>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                              
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->
                                                </td>
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