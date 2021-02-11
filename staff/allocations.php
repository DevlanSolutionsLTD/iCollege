<?php
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
staff();
require_once '../config/codeGen.php';

/* Add Allocations */
if (isset($_POST['add_allocations'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'Allocations ID Cannot Be Empty';
    }

    if (isset($_POST['unit_code']) && !empty($_POST['unit_code'])) {
        $unit_code = mysqli_real_escape_string($mysqli, trim($_POST['unit_code']));
    } else {
        $error = 1;
        $err = 'Allocated Unit Code Cannot Be Empty';
    }

    if (isset($_POST['unit_name']) && !empty($_POST['unit_name'])) {
        $unit_name = mysqli_real_escape_string($mysqli, trim($_POST['unit_name']));
    } else {
        $error = 1;
        $err = 'Allocated Unit Name Cannot Be Empty';
    }

    if (isset($_POST['lec_number']) && !empty($_POST['lec_number'])) {
        $lec_number = mysqli_real_escape_string($mysqli, trim($_POST['lec_number']));
    } else {
        $error = 1;
        $err = 'Allocated Lecturer Number Cannot Be Empty';
    }

    if (isset($_POST['lec_name']) && !empty($_POST['lec_name'])) {
        $lec_name = mysqli_real_escape_string($mysqli, trim($_POST['lec_name']));
    } else {
        $error = 1;
        $err = 'Allocated Lecturer Name Cannot Be Empty';
    }


    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  iCollege_units_allocation WHERE  unit_code='$unit_code' AND lec_number = '$lec_number' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $unit_code = $row['unit_code'] &&
                $lec_number = $row['lec_number']

            ) {
                $err =  "$lec_name Already Assigned To $unit_name  ";
            } else {
            }
        } else {

            $alloacated_at  = date('d M Y');
            $query = 'INSERT INTO iCollege_units_allocation (id, unit_code, unit_name, lec_number, lec_name, date_allocated) VALUES(?,?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'ssssss',
                $id,
                $unit_code,
                $unit_name,
                $lec_number,
                $lec_name,
                $alloacated_at
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Lecturer Allocated Unit' && header('refresh:1; url=allocations.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}

/* Update Allocations Will Bring Inconsistency In The Database  */



/* Delete Enrollment */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iCollege_allocations WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Removed permantly' && header('refresh:1; url=allocations.php');
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
                                <li class="breadcrumb-item active" aria-current="page"><span>Allocations</span></li>
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
                                <button data-toggle="modal" data-target="#add_enrollment" class="btn btn-outline-secondary mb-2">Add Allocations</button>
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
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Number</label>
                                                            <!-- Ajax To Get Lec Details -->
                                                            <select onchange="getLecDetails(this.value)" id="LecNumber" name="lec_number" class="form-control">
                                                                <option> Select Lecturer Number</option>
                                                                <?php
                                                                $ret = 'SELECT * FROM `iCollege_lecturers`';
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($lec = $res->fetch_object()) { ?>
                                                                    <option><?php echo $lec->number; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <!-- Hide This -->
                                                        <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                        <div class="form-group col-md-6">
                                                            <label for="">Lecturer Name</label>
                                                            <input type="text" readonly id="LecName" required name="lec_name" class="form-control">
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
                                                            <label for="">Unit Name</label>
                                                            <input type="text" required id="UnitName" name="unit_name" class="form-control">
                                                        </div>

                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" name="add_allocations" class="btn btn-primary">Submit</button>
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
                                            <th>Unit Code</th>
                                            <th>Unit Name</th>
                                            <th>Lec Number</th>
                                            <th>Lec Name</th>
                                            <th>Allocated On</th>
                                            <th>Manage Allocations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = 'SELECT * FROM `iCollege_units_allocation`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($allocations = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $allocations->unit_code; ?></td>
                                                <td><?php echo $allocations->unit_name; ?></td>
                                                <td><?php echo $allocations->lec_number; ?></td>
                                                <td><?php echo $allocations->lec_name; ?></td>
                                                <td><?php echo $allocations->date_allocated; ?></td>
                                                <td>
                                                    <a href="#delete-<?php echo $allocations->id; ?>" data-toggle="modal" class="badge outline-badge-danger">Delete</a>
                                                    <!-- Delete Modal -->
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="delete-<?php echo $allocations->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Remove <?php echo $allocations->lec_name; ?>'s  allocation ? </h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <a href="enrollments.php?delete=<?php echo $allocations->id; ?>" class="text-center btn btn-danger"> Delete </a>
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