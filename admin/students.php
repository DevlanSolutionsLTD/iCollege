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

/* Bulk Import */

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

            $admno = '';
            if (isset($spreadSheetAry[$i][1])) {
                $admno = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][1]
                );
            }

            $name = '';
            if (isset($spreadSheetAry[$i][2])) {
                $name = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][2]
                );
            }

            $phone = '';
            if (isset($spreadSheetAry[$i][3])) {
                $phone = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][3]
                );
            }

            $idno = '';
            if (isset($spreadSheetAry[$i][4])) {
                $idno = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][4]
                );
            }

            $adr = '';
            if (isset($spreadSheetAry[$i][5])) {
                $adr = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
            }

            $sex = '';
            if (isset($spreadSheetAry[$i][6])) {
                $sex = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
            }

            $email = '';
            if (isset($spreadSheetAry[$i][7])) {
                $email = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][7]
                );
            }

            /* Get Password as plain text but import as a bunch of mumble jumble */
            $password = '';
            if (isset($spreadSheetAry[$i][8])) {
                $password = sha1(
                    md5(
                        mysqli_real_escape_string($conn, $spreadSheetAry[$i][8])
                    )
                );
            }

            $course_name = '';
            if (isset($spreadSheetAry[$i][9])) {
                $course_name = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][9]
                );
            }

            if (
                !empty($id) ||
                !empty($admno) ||
                !empty($name) ||
                !empty($course_name) ||
                !empty($email)
            ) {
                $query =
                    'INSERT INTO iCollege_students (id, admno, name, phone, idno, adr, sex, email, password, course_name) VALUES(?,?,?,?,?,?,?,?,?,?)';
                $paramType = 'ssssssssss';
                $paramArray = [
                    $id,
                    $admno,
                    $name,
                    $phone,
                    $idno,
                    $adr,
                    $sex,
                    $email,
                    $password,
                    $course_name,
                ];
                $insertId = $db->insert($query, $paramType, $paramArray);
                if (!empty($insertId)) {
                    $err = 'Error Occured While Importing Data';
                } else {
                    $success = 'Student Data Imported';
                }
            }
        }
    } else {
        $info = 'Invalid File Type. Upload Excel File.';
    }
}

/* Add Student */
if (isset($_POST['add_student'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'Student ID Cannot Be Empty';
    }

    if (isset($_POST['admno']) && !empty($_POST['admno'])) {
        $admno = mysqli_real_escape_string($mysqli, trim($_POST['admno']));
    } else {
        $error = 1;
        $err = 'Admission Number Cannot Be Empty';
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = 'Student  Name Cannot Be Empty';
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
    } else {
        $error = 1;
        $err = 'Student Phone Number Cannot Be Empty';
    }

    if (isset($_POST['idno']) && !empty($_POST['idno'])) {
        $idno = mysqli_real_escape_string($mysqli, trim($_POST['idno']));
    } else {
        $error = 1;
        $err = 'Student National ID Number Cannot Be Empty';
    }

    if (isset($_POST['adr']) && !empty($_POST['adr'])) {
        $adr = mysqli_real_escape_string($mysqli, trim($_POST['adr']));
    } else {
        $error = 1;
        $err = 'Student Address Number Cannot Be Empty';
    }

    if (isset($_POST['sex']) && !empty($_POST['sex'])) {
        $sex = mysqli_real_escape_string($mysqli, trim($_POST['sex']));
    } else {
        $error = 1;
        $err = 'Gender Number Cannot Be Empty';
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = 'Email Number Cannot Be Empty';
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = mysqli_real_escape_string(
            $mysqli,
            trim(sha1(md5($_POST['password'])))
        );
    } else {
        $error = 1;
        $err = 'Password  Cannot Be Empty';
    }

    if (isset($_POST['course_name']) && !empty($_POST['course_name'])) {
        $course_name = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['course_name'])
        );
    } else {
        $error = 1;
        $err = 'Course  Cannot Be Empty';
    }

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  iCollege_students WHERE  admno='$admno' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($admno == $row['admno']) {
                $err = 'Student With That Admission Number Already Exists';
            } else {
            }
        } else {
            $dpic = $_FILES['dpic']['name'];
            move_uploaded_file(
                $_FILES['dpic']['tmp_name'],
                '../public/uploads/std_img/' . $_FILES['dpic']['name']
            );
            $parent_id = $_POST['parent_id'];
            $query =
                'INSERT INTO iCollege_students (id, parent_id, admno, name, phone, idno, adr, sex, email, password, dpic, course_name) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'ssssssssssss',
                $id,
                $parent_id,
                $admno,
                $name,
                $phone,
                $idno,
                $adr,
                $sex,
                $email,
                $password,
                $dpic,
                $course_name
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Student Added' && header('refresh:1; url=students.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}
/* update student */
if (isset($_POST['update'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['admno']) && !empty($_POST['admno'])) {
        $admno = mysqli_real_escape_string($mysqli, trim($_POST['admno']));
    } else {
        $error = 1;
        $err = 'Admission Number Cannot Be Empty';
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = 'Student  Name Cannot Be Empty';
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
    } else {
        $error = 1;
        $err = 'Student Phone Number Cannot Be Empty';
    }

    if (isset($_POST['idno']) && !empty($_POST['idno'])) {
        $idno = mysqli_real_escape_string($mysqli, trim($_POST['idno']));
    } else {
        $error = 1;
        $err = 'Student National ID Number Cannot Be Empty';
    }

    if (isset($_POST['adr']) && !empty($_POST['adr'])) {
        $adr = mysqli_real_escape_string($mysqli, trim($_POST['adr']));
    } else {
        $error = 1;
        $err = 'Student Address Number Cannot Be Empty';
    }

    if (isset($_POST['sex']) && !empty($_POST['sex'])) {
        $sex = mysqli_real_escape_string($mysqli, trim($_POST['sex']));
    } else {
        $error = 1;
        $err = 'Gender Number Cannot Be Empty';
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = 'Email Number Cannot Be Empty';
    }

    if (isset($_POST['course_name']) && !empty($_POST['course_name'])) {
        $course_name = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['course_name'])
        );
    } else {
        $error = 1;
        $err = 'Course  Cannot Be Empty';
    }
    $query =
        'UPDATE iCollege_students  SET  name =? , phone =? ,idno =?,adr=? ,sex =?,email =?,course_name =? WHERE admno =?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssssssss',

        $name,
        $phone,
        $idno,
        $adr,
        $sex,
        $email,
        $course_name,
        $admno
    );
    $stmt->execute();
    if ($stmt) {
        $success = 'Student Updated' && header('refresh:1; url=students.php');
    } else {
        $info = 'Please Try Again Or Try Later';
    }
}
//delete student
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iCollege_students WHERE id=?';
    $stmt = $conn->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Removed permantly' && header('refresh:1; url=students.php');
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
                                <li class="breadcrumb-item active" aria-current="page"><span>Students</span></li>
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
                                <h1 class="text-bold">Students</h1>
                                <button data-toggle="modal" data-target="#import_student" class="btn btn-outline-primary mb-2">Import Students </button>
                                <button data-toggle="modal" data-target="#add_student" class="btn btn-outline-secondary mb-2">Add Student</button>
                            </div>
                            <hr>
                            <!-- Import Modals -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="import_student" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center">
                                                Allowed file types: XLS, XLSX.
                                                <a class="text-primary" target="_blank" href="../public/templates/Students.xlsx">Download</a> A Sample File.
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
                                    </div>
                                </div>
                            </div>
                            <!-- End Import Modal -->

                            <!-- Add  Modal -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="add_student" role="dialog">
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
                                                            <label for="">Admission Number</label>
                                                            <input type="text" required name="admno" value="<?php echo $a; ?>-<?php echo $b; ?>" class="form-control">
                                                            <!-- Hide This -->
                                                            <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Name</label>
                                                            <input type="text" required name="name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Parent Name</label>
                                                            <select id="ParentName" style="width: 100%;" onchange="GetParentDetails(this.value);" class="form-control basic">
                                                                <option>Select Parent Name</option>
                                                                <?php
                                                                $ret = 'SELECT * FROM `iCollege_parents`';
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($parents = $res->fetch_object()) { ?>
                                                                    <option><?php echo $parents->name; ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                            <input type="hidden" required name="parent_id" id="ParentID" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="">National ID Number</label>
                                                            <input type="text" required name="idno" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Phone Number</label>
                                                            <input type="text" required name="phone" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Sex</label>
                                                            <select name="sex" class="form-control">
                                                                <option>Male</option>
                                                                <option>Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Address</label>
                                                            <input type="text" required name="adr" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for=""> Email Address</label>
                                                            <input type="text" required name="email" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Password</label>
                                                            <input type="text" required name="password" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Course Name</label>
                                                            <select name="course_name" class="form-control basic">
                                                                <?php
                                                                $ret = 'SELECT * FROM `iCollege_courses`';
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($courses = $res->fetch_object()) { ?>
                                                                    <option><?php echo $courses->name; ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputFile">Passport</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input required name="dpic" type="file" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="add_student" class="btn btn-primary">Submit</button>
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
                                            <th>Admn Number</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Phone Number</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Manage Student</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret =
                                            'SELECT * FROM `iCollege_students`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while (
                                            $student = $res->fetch_object()
                                        ) { ?>
                                            <tr>
                                                <td><?php echo $student->admno; ?></td>
                                                <td><?php echo $student->name; ?></td>
                                                <td><?php echo $student->idno; ?></td>
                                                <td><?php echo $student->phone; ?></td>
                                                <td><?php echo $student->sex; ?></td>
                                                <td><?php echo $student->adr; ?></td>
                                                <td><?php echo $student->email; ?></td>
                                                <td>
                                                    <a href="#view-<?php echo $student->id; ?>" data-toggle="modal" class="badge outline-badge-success">View</a>
                                                    <!-- View Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="view-<?php echo $student->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="text-center">
                                                                        Student info
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
                                                                                    <label for="">Admission Number</label>
                                                                                    <input type="text" required name="admno" readonly value="<?php echo $student->admno; ?>" class="form-control">

                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="">Name</label>
                                                                                    <input type="text" required name="name" readonly value="<?php echo $student->name; ?>" class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">National ID Number</label>
                                                                                    <input type="text" required name="idno" readonly value="<?php echo $student->idno; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">Phone Number</label>
                                                                                    <input type="text" required name="phone" readonly value="<?php echo $student->phone; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">Sex</label>
                                                                                    <input type="text" required name="phone" readonly value="<?php echo $student->sex; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">Address</label>
                                                                                    <input type="text" required name="adr" readonly value="<?php echo $student->adr; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for=""> Email Address</label>
                                                                                    <input type="text" required name="email" readonly value="<?php echo $student->email; ?>" class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">Course Name</label>
                                                                                    <input type="text" required name="course_name" readonly value="<?php echo $student->course_name; ?>" class="form-control">
                                                                                </div>

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
                                                    <!-- View Modal -->
                                                    <a href="#update-<?php echo $student->id; ?>" data-toggle="modal" class="badge outline-badge-warning">Update</a>
                                                    <!-- Update Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="update-<?php echo $student->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="text-center">
                                                                        Update <?php echo $student->name; ?> info
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
                                                                                    <label for="">Admission Number</label>
                                                                                    <input type="text" required name="admno" readonly value="<?php echo $student->admno; ?>" class="form-control">

                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="">Name</label>
                                                                                    <input type="text" required name="name" value="<?php echo $student->name; ?>" class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">National ID Number</label>
                                                                                    <input type="text" required name="idno" value="<?php echo $student->idno; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">Phone Number</label>
                                                                                    <input type="text" required name="phone" value="<?php echo $student->phone; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">Sex</label>
                                                                                    <select name="sex" class="form-control">
                                                                                        <option selected><?php echo $student->sex; ?></option>
                                                                                        <option>Male</option>
                                                                                        <option>Female</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">Address</label>
                                                                                    <input type="text" required name="adr" value="<?php echo $student->adr; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for=""> Email Address</label>
                                                                                    <input type="text" required name="email" value="<?php echo $student->email; ?>" class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-4">
                                                                                    <label for="">Course Name</label>
                                                                                    <input type="text" required name="course_name" value="<?php echo $student->course_name; ?>" class="form-control">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Update Modal -->
                                                    <a href="#delete-<?php echo $student->id; ?>" data-toggle="modal" class="badge outline-badge-danger">Delete</a>
                                                    <!-- Delete Modal -->
                                                    <!-- Delete Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="delete-<?php echo $student->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Remove <?php echo $student->name; ?> from Icollege System ?</h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <a href="students.php?delete=<?php echo $student->id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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