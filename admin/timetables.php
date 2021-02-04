<?php
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
admin_check_login();
require_once '../config/codeGen.php';

/* Add Time Table */
if (isset($_POST['Add_TimeTable'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'ID Cannot Be Empty';
    }

    if (isset($_POST['course_name']) && !empty($_POST['course_name'])) {
        $course_name = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['course_name'])
        );
    } else {
        $error = 1;
        $err = 'Course Name Cannot Be Empty';
    }

    if (isset($_POST['unit_code']) && !empty($_POST['unit_code'])) {
        $unit_code = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['unit_code'])
        );
    } else {
        $error = 1;
        $err = 'Unit Code Cannot Be Empty';
    }

    if (isset($_POST['unit_name']) && !empty($_POST['unit_name'])) {
        $unit_name = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['unit_name'])
        );
    } else {
        $error = 1;
        $err = 'Unit Name Cannot Be Empty';
    }

    if (isset($_POST['lec_name']) && !empty($_POST['lec_name'])) {
        $lec_name = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['lec_name'])
        );
    } else {
        $error = 1;
        $err = 'Lecturer Name Cannot Be Empty';
    }

    if (isset($_POST['day']) && !empty($_POST['day'])) {
        $day = mysqli_real_escape_string($mysqli, trim($_POST['day']));
    } else {
        $error = 1;
        $err = 'Day Cannot Be Empty';
    }

    if (isset($_POST['time']) && !empty($_POST['time'])) {
        $time = mysqli_real_escape_string($mysqli, trim($_POST['time']));
    } else {
        $error = 1;
        $err = 'Time Cannot Be Empty';
    }

    if (isset($_POST['room']) && !empty($_POST['room'])) {
        $room = mysqli_real_escape_string($mysqli, trim($_POST['room']));
    } else {
        $error = 1;
        $err = 'Room Cannot Be Empty';
    }

    if (!$error) {
        $query =
            'INSERT INTO iCollege_timetable (id, course_name, unit_code, unit_name, lec_name, day, time, room ) VALUES(?,?,?,?,?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'ssssssss',
            $id,
            $course_name,
            $unit_code,
            $unit_name,
            $lec_name,
            $day,
            $time,
            $room
        );
        $stmt->execute();
        if ($stmt) {
            $success = 'Class Added' && header('refresh:1; url=timetables.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}

/* Bulk Import On Time Tables */

use DevLanDataAPI\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once '../config/DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
require_once '../vendor/autoload.php';

if (isset($_POST['upload'])) {
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    if (in_array($_FILES['file']['type'], $allowedFileType)) {
        $targetPath =
            '../public/uploads/sys_data/xls/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 1; $i <= $sheetCount; $i++) {
            $id = '';
            if (isset($spreadSheetAry[$i][0])) {
                $id = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }

            $course_name = '';
            if (isset($spreadSheetAry[$i][1])) {
                $course_name = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][1]
                );
            }

            $unit_code = '';
            if (isset($spreadSheetAry[$i][2])) {
                $unit_code = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][2]
                );
            }

            $unit_name = '';
            if (isset($spreadSheetAry[$i][3])) {
                $unit_name = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][3]
                );
            }

            $lec_name = '';
            if (isset($spreadSheetAry[$i][4])) {
                $lec_name = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][4]
                );
            }

            $day = '';
            if (isset($spreadSheetAry[$i][5])) {
                $day = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }

            $time = '';
            if (isset($spreadSheetAry[$i][6])) {
                $time = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][6]
                );
            }

            $room = '';
            if (isset($spreadSheetAry[$i][7])) {
                $room = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][7]
                );
            }

            if (
                !empty($id) ||
                !empty($course_name) ||
                !empty($unit_code) ||
                !empty($unit_name) ||
                !empty($lec_name) ||
                !empty($day) ||
                !empty($time) ||
                !empty($room)
            ) {
                $query =
                    'INSERT INTO iCollege_timetable (id, course_name, unit_code, unit_name, lec_name, day, time, room) VALUES(?,?,?,?,?,?,?,?)';
                $paramType = 'ssssssss';
                $paramArray = [
                    $id,
                    $course_name,
                    $unit_code,
                    $unit_name,
                    $lec_name,
                    $day,
                    $time,
                    $room,
                ];
                $insertId = $db->insert($query, $paramType, $paramArray);
                if (!empty($insertId)) {
                    $err = 'Error Occured While Importing Data';
                } else {
                    $success = 'Data Imported';
                }
            }
        }
    } else {
        $info = 'Invalid File Type. Upload Excel File.';
    }
}

/* Update Timetable */
if (isset($_POST['update'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'ID Cannot Be Empty';
    }

    if (isset($_POST['course_name']) && !empty($_POST['course_name'])) {
        $course_name = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['course_name'])
        );
    } else {
        $error = 1;
        $err = 'Course Name Cannot Be Empty';
    }

    if (isset($_POST['unit_name']) && !empty($_POST['unit_name'])) {
        $unit_name = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['unit_name'])
        );
    } else {
        $error = 1;
        $err = 'Unit Name Cannot Be Empty';
    }

    if (isset($_POST['lec_name']) && !empty($_POST['lec_name'])) {
        $lec_name = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['lec_name'])
        );
    } else {
        $error = 1;
        $err = 'Lecturer Name Cannot Be Empty';
    }

    if (isset($_POST['day']) && !empty($_POST['day'])) {
        $day = mysqli_real_escape_string($mysqli, trim($_POST['day']));
    } else {
        $error = 1;
        $err = 'Day Cannot Be Empty';
    }

    if (isset($_POST['time']) && !empty($_POST['time'])) {
        $time = mysqli_real_escape_string($mysqli, trim($_POST['time']));
    } else {
        $error = 1;
        $err = 'Time Cannot Be Empty';
    }

    if (isset($_POST['room']) && !empty($_POST['room'])) {
        $room = mysqli_real_escape_string($mysqli, trim($_POST['room']));
    } else {
        $error = 1;
        $err = 'Room Cannot Be Empty';
    }

    if (!$error) {
        $query =
            'UPDATE iCollege_timetable  SET  course_name =? , unit_name =? ,lec_name =? ,day =?,time =?,room =? WHERE id =?';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sssssss',

            $course_name,
            $unit_name,
            $lec_name,
            $day,
            $time,
            $room,
            $id
        );
        $stmt->execute();
        if ($stmt) {
            $success =
                'Change saved' && header('refresh:1; url=timetables.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}

/* Delete Time Tables */

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
        <?php require_once '../partials/admin_sidebar.php'; ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="text-right">
                                <button data-toggle="modal" data-target="#import" class="btn btn-outline-primary mb-2">Import Classes </button>
                                <button data-toggle="modal" data-target="#add" class="btn btn-outline-secondary mb-2">Add Class To TimeTable</button>
                                <button data-toggle="modal" data-target="#timetable" class="btn btn-outline-secondary mb-2">Generate TimeTable</button>
                            </div>
                            <hr>
                            <!-- Import Modals -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="import" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center">
                                                Allowed file types: XLS, XLSX.
                                                <a class="text-primary" target="_blank" href="../public/templates/TimeTable.xlsx">Download</a> A Sample File.
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form -->
                                            <form method="post" enctype="multipart/form-data" role="form">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputFile">Select File</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input required name="file" accept=".xls,.xlsx" type="file" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="upload" class="btn btn-primary">Upload File</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Import Modal -->

                            <!-- Add  Modal -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="add" role="dialog">
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
                                                            <label for="">Unit Code</label>
                                                            <select name="unit_code" onchange="getUnitDetails(this.value);" id="UnitCode" class="form-control">
                                                                <option>Select Unit Code</option>
                                                                <?php
                                                                $ret =
                                                                    'SELECT * FROM `iCollege_units`';
                                                                $stmt = $mysqli->prepare(
                                                                    $ret
                                                                );
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while (
                                                                    $unit = $res->fetch_object()
                                                                ) { ?>
                                                                    <option><?php echo $unit->code; ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <!-- Hide This -->
                                                        <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Unit Name</label>
                                                            <input type="text" required name="unit_name" id="UnitName" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Course Name</label>
                                                            <select name="course_name" class="form-control">
                                                                <option>Select Course</option>
                                                                <?php
                                                                $ret =
                                                                    'SELECT * FROM `iCollege_courses`';
                                                                $stmt = $mysqli->prepare(
                                                                    $ret
                                                                );
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while (
                                                                    $course = $res->fetch_object()
                                                                ) { ?>
                                                                    <option><?php echo $course->name; ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Name</label>
                                                            <select name="lec_name" class="form-control">
                                                                <option>Select Lecturer Name</option>
                                                                <?php
                                                                $ret =
                                                                    'SELECT * FROM `iCollege_lecturers`';
                                                                $stmt = $mysqli->prepare(
                                                                    $ret
                                                                );
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while (
                                                                    $lec = $res->fetch_object()
                                                                ) { ?>
                                                                    <option><?php echo $lec->name; ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="">Day</label>
                                                            <select name="day" class="form-control">
                                                                <option>Monday</option>
                                                                <option>Tuesday</option>
                                                                <option>Wednesday</option>
                                                                <option>Thursday</option>
                                                                <option>Friday</option>
                                                                <option>Saturday</option>
                                                                <option>Sunday</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Time</label>
                                                            <input type="text" required name="time" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="">Room</label>
                                                            <input type="text" required name="room" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" name="Add_TimeTable" class="btn btn-primary">Submit</button>
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
                                            <th>Lecturer</th>
                                            <th>Day</th>
                                            <th>Time</th>
                                            <th>Room</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret =
                                            'SELECT * FROM `iCollege_timetable`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($tt = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $tt->course_name; ?></td>
                                                <td><?php echo $tt->unit_code; ?></td>
                                                <td><?php echo $tt->unit_name; ?></td>
                                                <td><?php echo $tt->lec_name; ?></td>
                                                <td><?php echo $tt->day; ?></td>
                                                <td><?php echo $tt->time; ?></td>
                                                <td><?php echo $tt->room; ?></td>
                                                <td>
                                                    <a href="#update-<?php echo $tt->id; ?>" data-toggle="modal" class="badge outline-badge-success">Update</a>
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="update-<?php echo $tt->id; ?>" role="dialog">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center">
                                                Update <?php echo $tt->unit_name; ?> on timetable
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
                                                        
                                                        <!-- Hide This -->
                                                        <input type="hidden" required name="id" value="<?php echo $tt->id; ?>" class="form-control">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Unit Name</label>
                                                            <input type="text" required name="unit_name" value ="<?php echo $tt->unit_name; ?>" id="UnitName" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="">Course Name</label>
                                                            <input type="text" required name="course_name" value ="<?php echo $tt->course_name; ?>" id="CouseName" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Name</label>
                                                            <input type="text" required name="lec_name" value ="<?php echo $tt->lec_name; ?>" id="CouseName" class="form-control"> 
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="">Day</label>
                                                            <select name="day" class="form-control">
                                                                <option selected><?php echo $tt->day; ?></option>
                                                                <option>Monday</option>
                                                                <option>Tuesday</option>
                                                                <option>Wednesday</option>
                                                                <option>Thursday</option>
                                                                <option>Friday</option>
                                                                <option>Saturday</option>
                                                                <option>Sunday</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Time</label>
                                                            <input type="text" required name="time" value ="<?php echo $tt->time; ?>"  class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="">Room</label>
                                                            <input type="text" required name="room" value ="<?php echo $tt->room; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
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
                                                    <a href="#delete-<?php echo $tt->id; ?>" data-toggle="modal" class="badge outline-badge-danger">Delete</a>
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