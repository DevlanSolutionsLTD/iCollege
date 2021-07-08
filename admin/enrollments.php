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
require_once '../config/config.php';
require_once '../config/checklogin.php';
admin_check_login();
require_once '../config/codeGen.php';

/* Add Student Enrollment */
if (isset($_POST['add_enrollment'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'Enrollment ID Cannot Be Empty';
    }

    if (isset($_POST['std_regno']) && !empty($_POST['std_regno'])) {
        $std_regno = mysqli_real_escape_string($mysqli, trim($_POST['std_regno']));
    } else {
        $error = 1;
        $err = 'Student Admission Number Cannot Be Empty';
    }

    if (isset($_POST['std_name']) && !empty($_POST['std_name'])) {
        $std_name = mysqli_real_escape_string($mysqli, trim($_POST['std_name']));
    } else {
        $error = 1;
        $err = 'Student Name Cannot Be Empty';
    }

    if (isset($_POST['unit_code']) && !empty($_POST['unit_code'])) {
        $unit_code = mysqli_real_escape_string($mysqli, trim($_POST['unit_code']));
    } else {
        $error = 1;
        $err = 'Enrolled Unit Code Cannot Be Empty';
    }

    if (isset($_POST['unit_name']) && !empty($_POST['unit_name'])) {
        $unit_name = mysqli_real_escape_string($mysqli, trim($_POST['unit_name']));
    } else {
        $error = 1;
        $err = 'Enrolled Unit Name Cannot Be Empty';
    }

    if (isset($_POST['semester_enrolled']) && !empty($_POST['semester_enrolled'])) {
        $semester_enrolled = mysqli_real_escape_string($mysqli, trim($_POST['semester_enrolled']));
    } else {
        $error = 1;
        $err = 'Semester Enrolled Cannot Be Empty';
    }

    if (isset($_POST['academic_year_enrolled']) && !empty($_POST['academic_year_enrolled'])) {
        $academic_year_enrolled = mysqli_real_escape_string($mysqli, trim($_POST['academic_year_enrolled']));
    } else {
        $error = 1;
        $err = 'Academic Year Enrolled Cannot Be Empty';
    }


    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  iCollege_enrollments WHERE  std_regno='$std_regno' AND unit_code = '$unit_code' AND semester_enrolled = '$semester_enrolled' AND academic_year_enrolled = '$academic_year_enrolled' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $std_regno = $row['std_regno'] &&
                $unit_code = $row['unit_code'] &&
                $semester_enrolled = $row['semester_enrolled'] &&
                $academic_year_enrolled = $row['academic_year_enrolled']

            ) {
                $err =  "$std_name Already Enrolled To $unit_name  ";
            } else {
            }
        } else {

            $query = 'INSERT INTO iCollege_enrollments (id, std_name, std_regno, unit_code, unit_name, semester_enrolled, academic_year_enrolled) VALUES(?,?,?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'sssssss',
                $id,
                $std_name,
                $std_regno,
                $unit_code,
                $unit_name,
                $semester_enrolled,
                $academic_year_enrolled
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Student Enrollment Added' && header('refresh:1; url=enrollments.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}

/* Update Enrollment Will Bring Inconsistency In The Database  */

/* Delete Enrollment */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iCollege_enrollments WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Removed permantly' && header('refresh:1; url=enrollments.php');
    } else {
        //inject alert that task failed
        $info = 'Please Try Again Or Try Later';
    }
}


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
                                <li class="breadcrumb-item active" aria-current="page"><span>Enrollments</span></li>
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
                            <div class="text-center">
                                <br>
                                <h1 class="text-center">Student Enrollments</h1>
                                <button data-toggle="modal" data-target="#add_enrollment" class="btn btn-outline-secondary mb-2">Add Enrollment</button>
                            </div>
                            <hr>

                            <!-- Add  Modal -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="add_enrollment" role="dialog">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center">
                                                Fill All Required Fields
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form -->
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Student Admission Number</label>
                                                            <!-- Ajax To Get Student Details -->
                                                            <select onchange="getStudentDetails(this.value)" id="AdmissionNumber" name="std_regno" style="width: 100%;" class="form-control basic">
                                                                <option> Select Student Admission Number</option>
                                                                <?php
                                                                $ret = 'SELECT * FROM `iCollege_students`';
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($std = $res->fetch_object()) { ?>
                                                                    <option><?php echo $std->admno; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <!-- Hide This -->
                                                        <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                        <div class="form-group col-md-12">
                                                            <label for="">Student Name</label>
                                                            <input type="text" readonly id="StudentName" required name="std_name" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="">Unit Code</label>
                                                            <select name="unit_code" onchange="getUnitDetails(this.value)" id="UnitCode" style="width: 100%" class="form-control basic">
                                                                <option>Select Unit Code</option>
                                                                <?php
                                                                $ret = "SELECT * FROM `iCollege_units` ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($units = $res->fetch_object()) { ?>
                                                                    <option><?php echo $units->code; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Unit Name</label>
                                                            <input type="text" readonly required id="UnitName" name="unit_name" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Semester / Term Enrolled</label>
                                                            <input type="text" required name="semester_enrolled" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for=""> Academic Year Enrolled</label>
                                                            <input type="text" required name="academic_year_enrolled" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" name="add_enrollment" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End  Modal -->

                            <div class="table-responsive mb-4 mt-4">
                                <table id="default-ordering" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Admn No</th>
                                            <th>Name</th>
                                            <th>Unit Code</th>
                                            <th>Unit Name</th>
                                            <th>Semester Enrolled</th>
                                            <th>Academic Yr Enrolled</th>
                                            <th>Manage Enrollments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = 'SELECT * FROM `iCollege_enrollments`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($enrollments = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $enrollments->std_regno; ?></td>
                                                <td><?php echo $enrollments->std_name; ?></td>
                                                <td><?php echo $enrollments->unit_code; ?></td>
                                                <td><?php echo $enrollments->unit_name; ?></td>
                                                <td><?php echo $enrollments->semester_enrolled; ?></td>
                                                <td><?php echo $enrollments->academic_year_enrolled; ?></td>
                                                <td>
                                                    <a href="#delete-<?php echo $enrollments->id; ?>" data-toggle="modal" class="badge outline-badge-danger">Delete</a>
                                                    <!-- Delete Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="delete-<?php echo $enrollments->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Delete <?php echo $enrollments->std_name; ?>'s enrollment ? </h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <a href="enrollments.php?delete=<?php echo $enrollments->id; ?>" class="text-center btn btn-danger"> Delete </a>
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