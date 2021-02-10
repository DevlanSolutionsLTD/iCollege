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
            $query =
                'INSERT INTO iCollege_students (id, admno, name, phone, idno, adr, sex, email, password, dpic, course_name) VALUES(?,?,?,?,?,?,?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'sssssssssss',
                $id,
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
                                <li class="breadcrumb-item"><a href="dashboard.php">Reports</a></li>
                                <li class="breadcrumb-item"><a href="academic_reports.php">Academic Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Student  Report</span></li>
                                </div>
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
                                <button data-toggle="modal" data-target="#import_student" class="btn btn-outline-primary mb-2">Import Students </button>
                                <button data-toggle="modal" data-target="#add_student" class="btn btn-outline-secondary mb-2">Add Student</button>
                            </div>
                            <hr>
                         

                            <div class="table-responsive mb-4 mt-4">
                                <table id="export" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Admn Number</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Phone Number</th>
                                            <th>Gender</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            
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