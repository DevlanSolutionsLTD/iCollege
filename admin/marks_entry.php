<?php
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
admin_check_login();
require_once '../config/codeGen.php';

/* Marks Entry */
if (isset($_POST['add_marks'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'ID Cannot Be Empty';
    }

    if (isset($_POST['course_id']) && !empty($_POST['course_id'])) {
        $course_id = mysqli_real_escape_string($mysqli, trim($_POST['course_id']));
    } else {
        $error = 1;
        $err = 'Course ID Cannot Be Empty';
    }

    if (isset($_POST['course_name']) && !empty($_POST['course_name'])) {
        $course_name = mysqli_real_escape_string($mysqli, trim($_POST['course_name']));
    } else {
        $error = 1;
        $err = 'Course Name Cannot Be Empty';
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

    if (isset($_POST['std_regno']) && !empty($_POST['std_regno'])) {
        $std_regno = mysqli_real_escape_string($mysqli, trim($_POST['std_regno']));
    } else {
        $error = 1;
        $err = 'Student Registration Number Cannot Be Empty';
    }

    if (isset($_POST['std_name']) && !empty($_POST['std_name'])) {
        $std_name = mysqli_real_escape_string($mysqli, trim($_POST['std_name']));
    } else {
        $error = 1;
        $err = 'Student Name Cannot Be Empty';
    }

    if (isset($_POST['semester_enrolled']) && !empty($_POST['semester_enrolled'])) {
        $semester_enrolled = mysqli_real_escape_string($mysqli, trim($_POST['semester_enrolled']));
    } else {
        $error = 1;
        $err = 'Semester Enrolled Cannot Be Empty';
    }

    if (isset($_POST['academic_year']) && !empty($_POST['academic_year'])) {
        $academic_year = mysqli_real_escape_string($mysqli, trim($_POST['academic_year']));
    } else {
        $error = 1;
        $err = 'Academic Year Enrolled Cannot Be Empty';
    }

    if (isset($_POST['marks']) && !empty($_POST['marks'])) {
        $marks = mysqli_real_escape_string($mysqli, trim($_POST['marks']));
    } else {
        $error = 1;
        $err = 'Marks Cannot Be Empty';
    }


    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  iCollege_exammarks WHERE  std_regno='$std_regno' AND unit_code = '$unit_code' AND semester_enrolled = '$semester_enrolled' AND academic_year = '$academic_year' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $std_regno = $row['std_regno'] &&
                $unit_code = $row['unit_code'] &&
                $semester_enrolled = $row['semester_enrolled'] &&
                $academic_year = $row['academic_year']

            ) {
                $err =  "$std_name  Marks For  $unit_name Already Added  ";
            } else {
            }
        } else {

            $query = 'INSERT INTO iCollege_exammarks (id, course_id, course_name, unit_code, unit_name, std_regno, std_name, semester_enrolled, academic_year, marks) VALUES(?,?,?,?,?,?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'ssssssssss',
                $id,
                $course_id,
                $course_name,
                $unit_code,
                $unit_name,
                $std_regno,
                $std_name,
                $semester_enrolled,
                $academic_year,
                $marks
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Student Marks' && header('refresh:1; url=marks_entry.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}

/* Update Marks Entry */

/* Delete Marks Entry */


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
                                <li class="breadcrumb-item"><a href="dashboard.php">Exams</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Marks Entry</span></li>
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
                            <div class="text-right">
                                <button data-toggle="modal" data-target="#add_modal" class="btn btn-outline-secondary mb-2">Add Marks</button>
                            </div>
                            <hr>

                            <!-- Add  Modal -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="add_modal" role="dialog">
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
                                                        <div class="form-group col-md-6">
                                                            <label for="">Course Name</label>
                                                            <!-- Ajax To Get Course Details -->
                                                            <select onchange="getCourseDetails(this.value)" id="CourseName" name="course_name" class="form-control">
                                                                <option> Select Course</option>
                                                                <?php
                                                                $ret = 'SELECT * FROM `iCollege_courses`';
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($courses = $res->fetch_object()) { ?>
                                                                    <option><?php echo $courses->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <!-- Course ID -->
                                                        <input type="hidden" required name="course_id" id="CourseId" class="form-control">

                                                        <div class="form-group col-md-6">
                                                            <label for="">Student Admission Number</label>
                                                            <!-- Ajax To Get Student Details -->
                                                            <select onchange="getStudentDetails(this.value)" id="AdmissionNumber" name="std_regno" class="form-control">
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
                                                        <div class="form-group col-md-6">
                                                            <label for="">Student Name</label>
                                                            <input type="text" readonly id="StudentName" required name="std_name" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Unit Code</label>
                                                            <select name="unit_code" onchange="getUnitDetails(this.value)" id="UnitCode" class="form-control">
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
                                                        <div class="form-group col-md-6">
                                                            <label for=""> Unit Name</label>
                                                            <input type="text" required name="unit_name" id="UnitName" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Semester Enrolled</label>
                                                            <select name="semester_enrolled" class="form-control">
                                                                <option>Select Semester Enrolled</option>
                                                                <?php
                                                                $ret = "SELECT * FROM `iCollege_enrollments` ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($sem = $res->fetch_object()) { ?>
                                                                    <option><?php echo $sem->semester_enrolled; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Academic Year</label>
                                                            <select name="academic_year" class=" form-control">
                                                                <option>Select Academic Year</option>
                                                                <?php
                                                                $ret = "SELECT * FROM `iCollege_enrollments` ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($year = $res->fetch_object()) { ?>
                                                                    <option><?php echo $year->academic_year_enrolled; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Marks</label>
                                                            <input type="text" required name="marks" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" name="add_marks" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End  Modal -->

                            <div class="table-responsive mb-4 mt-4">
                                <table id="default-ordering" class="table" style="width:100%">
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
                                            <th>Manage Marks</th>
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
                                                    <!-- Actions
                                                 Ie Delete And Update Only Update Semester Enrolled, Academic Year Enrolled, Unit Name, Unit Code and Marks
                                                  -->
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