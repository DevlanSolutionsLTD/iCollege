<?php
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

            $number = '';
            if (isset($spreadSheetAry[$i][1])) {
                $number = mysqli_real_escape_string(
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

            $email = '';
            if (isset($spreadSheetAry[$i][5])) {
                $email = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][5]
                );
            }

            /* Get Password as plain text but import as a bunch of mumble jumble */
            $password = '';
            if (isset($spreadSheetAry[$i][6])) {
                $password = sha1(
                    md5(
                        mysqli_real_escape_string($conn, $spreadSheetAry[$i][6])
                    )
                );
            }

            if (
                !empty($id) ||
                !empty($number) ||
                !empty($name) ||
                !empty($idno) ||
                !empty($email)
            ) {
                $query =
                    'INSERT INTO iCollege_lecturers (id, number, name, phone, idno, email, password) VALUES(?,?,?,?,?,?,?)';
                $paramType = 'sssssss';
                $paramArray = [
                    $id,
                    $number,
                    $name,
                    $phone,
                    $idno,
                    $email,
                    $password,
                ];
                $insertId = $db->insert($query, $paramType, $paramArray);
                if (!empty($insertId)) {
                    $err = 'Error Occured While Importing Data';
                } else {
                    $success = 'Lecturer Data Imported';
                }
            }
        }
    } else {
        $info = 'Invalid File Type. Upload Excel File.';
    }
}

if (isset($_POST['add_lec'])) {
    /* Add Course */
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'Lec ID Cannot Be Empty';
    }

    if (isset($_POST['number']) && !empty($_POST['number'])) {
        $number = mysqli_real_escape_string($mysqli, trim($_POST['number']));
    } else {
        $error = 1;
        $err = 'Lec Number Cannot Be Empty';
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = 'Lec Name Cannot Be Empty';
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
    } else {
        $error = 1;
        $err = 'Lec Phone Number Cannot Be Empty';
    }

    if (isset($_POST['idno']) && !empty($_POST['idno'])) {
        $idno = mysqli_real_escape_string($mysqli, trim($_POST['idno']));
    } else {
        $error = 1;
        $err = 'Lec National ID Number Cannot Be Empty';
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = 'Lec Email Number Cannot Be Empty';
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = mysqli_real_escape_string(
            $mysqli,
            trim(sha1(md5($_POST['password'])))
        );
    } else {
        $error = 1;
        $err = 'Lec Password  Cannot Be Empty';
    }

    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  iCollege_lecturers WHERE  number='$number' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($number == $row['number']) {
                $err = 'Lecturer With That Number Already Exists';
            } else {
            }
        } else {
            $dpic = $_FILES['dpic']['name'];
            move_uploaded_file(
                $_FILES['dpic']['tmp_name'],
                '../public/uploads/staff_img/' . $_FILES['dpic']['name']
            );
            $query =
                'INSERT INTO iCollege_lecturers (id, number, name, phone, idno, email, password, dpic) VALUES(?,?,?,?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'ssssssss',
                $id,
                $number,
                $name,
                $phone,
                $idno,
                $email,
                $password,
                $dpic
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Lec Added' && header('refresh:1; url=lecturers.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}
//update
if (isset($_POST['update'])) {
    /* Add Course */
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'Lec ID Cannot Be Empty';
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = 'Lec Name Cannot Be Empty';
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
    } else {
        $error = 1;
        $err = 'Lec Phone Number Cannot Be Empty';
    }

    if (isset($_POST['idno']) && !empty($_POST['idno'])) {
        $idno = mysqli_real_escape_string($mysqli, trim($_POST['idno']));
    } else {
        $error = 1;
        $err = 'Lec National ID Number Cannot Be Empty';
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = 'Lec Email Number Cannot Be Empty';
    }

    $query =
        'UPDATE iCollege_lecturers  SET  name =? , phone =? ,idno =? ,email =? WHERE id =?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'sssss',

        $name,
        $phone,
        $idno,
        $email,
        $id
    );
    $stmt->execute();
    if ($stmt) {
        $success = 'Lec Updated' && header('refresh:1; url=lecturers.php');
    } else {
        $info = 'Please Try Again Or Try Later';
    }
}
//delete lec
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iCollege_lecturers WHERE id=?';
    $stmt = $conn->prepare($adn);
    $stmt->bind_param(
        's', 
        $id
    );
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Removed permantly' && header('refresh:1; url=lecturers.php');
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
                                <li class="breadcrumb-item active" aria-current="page"><span>Lecturers</span></li>
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
                                <button data-toggle="modal" data-target="#import_lec" class="btn btn-outline-primary mb-2">Import Lecturers </button>
                                <button data-toggle="modal" data-target="#add_lec" class="btn btn-outline-secondary mb-2">Add Lecturer</button>
                            </div>
                            <hr>
                            <!-- Import Modals -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="import_lec" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center">
                                                Allowed file types: XLS, XLSX.
                                                <a class="text-primary" target="_blank" href="../public/templates/Lecturers.xlsx">Download</a> A Sample File.
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

                            <!-- Add Course Modal -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="add_lec" role="dialog">
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
                                                            <label for="">Lecturer Number</label>
                                                            <input type="text" required name="number" value="<?php echo $a; ?>-<?php echo $b; ?>" class="form-control">
                                                            <!-- Hide This -->
                                                            <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Name</label>
                                                            <input type="text" required name="name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer National ID Number</label>
                                                            <input type="text" required name="idno" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Phone Number</label>
                                                            <input type="text" required name="phone" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Email Address</label>
                                                            <input type="text" required name="email" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Password</label>
                                                            <input type="text" required name="password" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputFile">Lecturer Passport</label>
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
                                                    <button type="submit" name="add_lec" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Course Modal -->

                            <!-- End Course Modal -->

                            <div class="table-responsive mb-4 mt-4">
                                <table id="default-ordering" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Manage Lec</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret =
                                            'SELECT * FROM `iCollege_lecturers`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($lec = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $lec->number; ?></td>
                                                <td><?php echo $lec->name; ?></td>
                                                <td><?php echo $lec->idno; ?></td>
                                                <td><?php echo $lec->phone; ?></td>
                                                <td><?php echo $lec->email; ?></td>
                                                <td>
                                                    <a href="#view-<?php echo $lec->id; ?>" data-toggle="modal" class="badge outline-badge-success">View</a>
                                                    <!-- View Course Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="view-<?php echo $lec->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="text-center">
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
                                                            <label for="">Lecturer Number</label>
                                                            <input type="text" readonly required name="number" value="<?php echo $lec->number; ?>" class="form-control">
                                                           
                                                        </div>
                                                       
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Name</label>
                                                            <input type="text" readonly required name="name" readonly value="<?php echo $lec->name; ?>"class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer National ID Number</label>
                                                            <input type="text" required name="idno" readonly value="<?php echo $lec->idno; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Phone Number</label>
                                                            <input type="text" required name="phone" readonly value="<?php echo $lec->phone; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Email Address</label>
                                                            <input type="text" required name="email" readonly value="<?php echo $lec->email; ?>"class="form-control">
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
                                                    <a href="#update-<?php echo $lec->id; ?>" data-toggle="modal" class="badge outline-badge-warning">Update</a>
                                                    <!-- Button trigger modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="update-<?php echo $lec->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="text-center">
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
                                                   
                                                    
                                                           
                                                        <input type="text" hidden required name="id" value="<?php echo $lec->id; ?>" class="form-control">
                                                       
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Name</label>
                                                            <input type="text" required name="name" value="<?php echo $lec->name; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer National ID Number</label>
                                                            <input type="text" required name="idno" value="<?php echo $lec->idno; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Phone Number</label>
                                                            <input type="text" required name="phone" value="<?php echo $lec->phone; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Email Address</label>
                                                            <input type="text" required name="email" value="<?php echo $lec->email; ?>" class="form-control">
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



                                                    <a href="#delete-<?php echo $lec->id; ?>" data-toggle="modal" class="badge outline-badge-danger">Delete</a>
                                                    <!-- Delete Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="delete-<?php echo $lec->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Delete <?php echo $lec->name; ?>?</h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <a href="lecturers.php?delete=<?php echo $lec->id; ?>" class="text-center btn btn-danger"> Delete </a>
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