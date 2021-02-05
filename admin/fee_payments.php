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

            $std_regno = '';
            if (isset($spreadSheetAry[$i][1])) {
                $std_regno = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][1]
                );
            }

            $std_name = '';
            if (isset($spreadSheetAry[$i][2])) {
                $std_name = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][2]
                );
            }

            $amt_billed = '';
            if (isset($spreadSheetAry[$i][3])) {
                $amt_billed = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][3]
                );
            }

            $amt_paid = '';
            if (isset($spreadSheetAry[$i][4])) {
                $amt_paid = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][4]
                );
            }

            $payment_means = '';
            if (isset($spreadSheetAry[$i][5])) {
                $payment_means = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][5]
                );
            }

            $payment_code = '';
            if (isset($spreadSheetAry[$i][6])) {
                $payment_code = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][6]
                );
            }

            $date_paid = '';
            if (isset($spreadSheetAry[$i][7])) {
                $date_paid = mysqli_real_escape_string(
                    $conn,
                    $spreadSheetAry[$i][7]
                );
            }


            if (
                !empty($id) ||
                !empty($std_regno) ||
                !empty($amt_billed) ||
                !empty($amt_paid) ||
                !empty($payment_code)
            ) {
                $query = 'INSERT INTO iCollege_fees_payments (id, std_regno, std_name, amt_billed, amt_paid, payment_means, payment_code, date_paid) VALUES(?,?,?,?,?,?,?,?)';
                $paramType = 'ssssssss';
                $paramArray = [
                    $id,
                    $std_regno,
                    $std_name,
                    $amt_billed,
                    $amt_paid,
                    $payment_means,
                    $payment_code,
                    $date_paid
                ];
                $insertId = $db->insert($query, $paramType, $paramArray);
                if (!empty($insertId)) {
                    $err = 'Error Occured While Importing Data';
                } else {
                    $success = 'School Fee Payment Data Imported';
                }
            }
        }
    } else {
        $info = 'Invalid File Type. Upload Excel File.';
    }
}

if (isset($_POST['add_payment'])) {

    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'ID Cannot Be Empty';
    }

    if (isset($_POST['std_regno']) && !empty($_POST['std_regno'])) {
        $std_regno = mysqli_real_escape_string($mysqli, trim($_POST['std_regno']));
    } else {
        $error = 1;
        $err = 'Admision Number Cannot Be Empty';
    }

    if (isset($_POST['std_name']) && !empty($_POST['std_name'])) {
        $std_name = mysqli_real_escape_string($mysqli, trim($_POST['std_name']));
    } else {
        $error = 1;
        $err = 'Student Name Cannot Be Empty';
    }

    if (isset($_POST['amt_billed']) && !empty($_POST['amt_billed'])) {
        $amt_billed = mysqli_real_escape_string($mysqli, trim($_POST['amt_billed']));
    } else {
        $error = 1;
        $err = 'Amount Billed Cannot Be Empty';
    }

    if (isset($_POST['amt_paid']) && !empty($_POST['amt_paid'])) {
        $amt_paid = mysqli_real_escape_string($mysqli, trim($_POST['amt_paid']));
    } else {
        $error = 1;
        $err = 'Amount Paid  Cannot Be Empty';
    }

    if (isset($_POST['payment_means']) && !empty($_POST['payment_means'])) {
        $payment_means = mysqli_real_escape_string($mysqli, trim($_POST['payment_means']));
    } else {
        $error = 1;
        $err = 'Payment Means Cannot Be Empty';
    }

    if (isset($_POST['payment_code']) && !empty($_POST['payment_code'])) {
        $payment_code = mysqli_real_escape_string($mysqli, trim($_POST['payment_code']));
    } else {
        $error = 1;
        $err = 'Payment Code Cannot Be Empty';
    }

    if (isset($_POST['date_paid']) && !empty($_POST['date_paid'])) {
        $date_paid = mysqli_real_escape_string($mysqli, trim($_POST['date_paid']));
    } else {
        $error = 1;
        $err = 'Date Paid Cannot Be Empty';
    }

    if (!$error) {
        $query = 'INSERT INTO iCollege_fees_payments (id, std_regno, std_name, amt_billed, amt_paid, payment_means, payment_code, date_paid) VALUES(?,?,?,?,?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'ssssssss',
            $id,
            $std_regno,
            $std_name,
            $amt_billed,
            $amt_paid,
            $payment_means,
            $payment_code,
            $date_paid
        );
        $stmt->execute();
        if ($stmt) {
            $success =
                'Fees Payment Added' && header('refresh:1; url=fee_payments.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
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
        <?php require_once '../partials/admin_sidebar.php'; ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="text-right">
                                <button data-toggle="modal" data-target="#import_modal" class="btn btn-outline-primary mb-2">Import Payment Records </button>
                                <button data-toggle="modal" data-target="#add_modal" class="btn btn-outline-secondary mb-2">Add Fee Payment</button>
                            </div>
                            <hr>
                            <!-- Import Modals -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="import_modal" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center">
                                                Allowed file types: XLS, XLSX.
                                                <a class="text-primary" target="_blank" href="../public/templates/FeePayment.xlsx">Download</a> A Sample File.
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
                                                            <label for="">Amount Billed</label>
                                                            <input type="text" required name="amt_billed" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Amount Paid</label>
                                                            <input type="text" required name="amt_paid" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Payment Means</label>
                                                            <select type="text" required name="payment_means" class="form-control">
                                                                <option>Bank Deposit</option>
                                                                <option>Mpesa</option>
                                                                <option>Cheque</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="">Date Paid </label>
                                                            <input type="date" required name="date_paid" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="">Payment Code <small class="text-danger">Ref Number, Transaction Code, Cheque Number</small></label>
                                                            <input type="text" value="<?php echo $paycode; ?>" required name="payment_code" class="form-control">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="add_payment" class="btn btn-primary">Submit</button>
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
                                            <th>Adm No</th>
                                            <th>Name</th>
                                            <th>Amt Billed</th>
                                            <th>Amt Paid</th>
                                            <th>Payment Means</th>
                                            <th>Payment Code</th>
                                            <th>Date Paid</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = 'SELECT * FROM `iCollege_fees_payments`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($payments = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $payments->std_regno; ?></td>
                                                <td><?php echo $payments->std_name; ?></td>
                                                <td>Ksh <?php echo $payments->amt_billed; ?></td>
                                                <td>Ksh <?php echo $payments->amt_paid; ?></td>
                                                <td><?php echo $payments->payment_means; ?></td>
                                                <td><?php echo $payments->payment_code; ?></td>
                                                <td><?php echo $payments->date_paid; ?></td>
                                                <td>
                                                    <a href="#update-<?php echo $payments->id; ?>" data-toggle="modal" class="badge outline-badge-warning">Update</a>
                                                    <!-- Button trigger modal -->

                                                    <a href="#delete-<?php echo $payments->id; ?>" data-toggle="modal" class="badge outline-badge-danger">Delete</a>
                                                    <!-- Delete Modal -->

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