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

            $course_name = '';
            if (isset($spreadSheetAry[$i][1])) {
                $course_name = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][1]
                );
            }

            $code = '';
            if (isset($spreadSheetAry[$i][2])) {
                $code = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][2]
                );
            }

            $name = '';
            if (isset($spreadSheetAry[$i][3])) {
                $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
            }

            if (
                !empty($id) ||
                !empty($code) ||
                !empty($name) ||
                !empty($course_name)
            ) {
                $query =
                    'INSERT INTO iCollege_units (id, code, name, course_name) VALUES(?,?,?,?)';
                $paramType = 'ssss';
                $paramArray = [$id, $code, $name, $course_name];
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

if (isset($_POST['add_unit'])) {
    /*
        Error handling and add unit logic 
     */
    $error = 0;
    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = 'Couse  Code Cannot Be Empty';
    }
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = 'Course Name Cannot Be Empty';
    }

    if (isset($_POST['course_name']) && !empty($_POST['course_name'])) {
        $course_name = mysqli_real_escape_string($mysqli, trim($_POST['course_name']));
    } else {
        $error = 1;
        $err = 'Course Name  Cannot Be Empty';
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'Unit ID  Cannot Be Empty';
    }

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  iCollege_units WHERE  code='$code' || name ='$name' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($code == $row['code']) {
                $err = 'Unit With This Code Already Exists';
            } else {
                $err = 'Unit With That Name Already Exists';
            }
        } else {
            $query = 'INSERT INTO iCollege_units (id, code, name, course_name) VALUES(?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('ssss', $id, $code, $name, $course_name);
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Unit Added' && header('refresh:1; url=units.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}
//Update unit
if (isset($_POST['update'])) {

    //Error Handling and prevention of posting double entries
    $error = 0;
    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = 'Unit code Missing';
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = 'Unit Name Cannot Be Empty';
    }
    if (isset($_POST['course_name']) && !empty($_POST['course_name'])) {
        $course_name = mysqli_real_escape_string($mysqli, trim($_POST['course_name']));
    } else {
        $error = 1;
        $err = 'Course Name Cannot Be Empty';
    }

    $query = 'UPDATE iCollege_units  SET  name =? ,course_name =?  WHERE code =?';
    $stmt = $conn->prepare($query);
    $rc = $stmt->bind_param('sss', $name, $course_name, $code);
    $stmt->execute();
    if ($stmt) {
        $success = 'Unit Updated' && header('refresh:1; url=units.php');
    } else {
        //inject alert that task failed
        $info = 'Please Try Again Or Try Later';
    }
}

//delete unit
if (isset($_GET['delete'])) {
    $code = $_GET['delete'];
    $adn = 'DELETE FROM iCollege_units WHERE code=?';
    $stmt = $conn->prepare($adn);
    $stmt->bind_param('s', $code);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Removed permantly' && header('refresh:1; url=units.php');
    } else {
        //inject alert that task failed
        $info = 'Please Try Again Or Try Later';
    }
}
require_once '../partials/head.php'; ?>

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Units</span></li>
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
                                <h1 class="text-bold">Academic Units</h1>
                                <button data-toggle="modal" data-target="#import_units" class="btn btn-outline-primary mb-2">Import Units </button>
                                <button data-toggle="modal" data-target="#add_units" class="btn btn-outline-secondary mb-2">Add Units</button>
                            </div>
                            <hr>
                            <!-- Import Modals -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="import_units" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center">
                                                Allowed file types: XLS, XLSX.
                                                <a class="text-primary" target="_blank" href="../public/templates/UnitTemplate.xlsx">Download</a> A Sample File.
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

                            <!-- Add Course Modal -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="add_units" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
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
                                                            <input type="text" required name="code" value="<?php echo $a; ?>-<?php echo $b; ?>" class="form-control">
                                                            <!-- Hide This -->
                                                            <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Unit Name</label>
                                                            <input type="text" required name="name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Course Name</label>
                                                            <select type="text" required name="course_name" style="width: 100%" class="form-control basic">
                                                                <option>Select Course Name</option>
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

                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name=add_unit class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Unit Modal -->

                            <div class="table-responsive mb-4 mt-4">
                                <table id="default-ordering" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Unit Code</th>
                                            <th>Unit Name</th>
                                            <th>Course Name</th>
                                            <th>Manage Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = 'SELECT * FROM `iCollege_units`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($units = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $units->code; ?></td>
                                                <td><?php echo $units->name; ?></td>
                                                <td><?php echo $units->course_name; ?></td>
                                                <td>
                                                    <a href="#view-<?php echo $units->code; ?>" data-toggle="modal" class="badge outline-badge-success">View</a>
                                                    <!-- View Course Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="view-<?php echo $units->code; ?>" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="text-center">
                                                                        <?php echo $units->code ?> <?php echo $units->name; ?>
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" enctype="multipart/form-data">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="">Unit Code</label>
                                                                                    <input type="text" readoly required name="code" value="<?php echo $units->code; ?>" class="form-control">

                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="">Unit Name</label>
                                                                                    <input type="text" readolyrequired name="name" value="<?php echo $units->name; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="">Course Name</label>
                                                                                    <input type="text" readoly required name="name" value="<?php echo $units->course_name; ?>" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#update-<?php echo $units->code; ?>" data-toggle="modal" class="badge outline-badge-warning">Update</a>
                                                    <!-- Button trigger modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="update-<?php echo $units->code; ?>" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="text-center">
                                                                        <?php echo $units->code ?> <?php echo $units->name; ?>
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" enctype="multipart/form-data">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="">Unit Code</label>
                                                                                    <input type="text" readoly required name="code" value="<?php echo $units->code; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="">Unit Name</label>
                                                                                    <input type="text" required name="name" value="<?php echo $units->name; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="">Course Name</label>
                                                                                    <input type="text" required name="course_name" value="<?php echo $units->course_name; ?>" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <a href="#delete-<?php echo $units->code; ?>" data-toggle="modal" class="badge outline-badge-danger">Delete</a>
                                                    <!-- Delete Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="delete-<?php echo $units->code; ?>" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Delete <?php echo $units->name; ?>?</h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <a href="units.php?delete=<?php echo $units->code; ?>" class="text-center btn btn-danger"> Delete </a>
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