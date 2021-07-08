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

/* Add Event */
if (isset($_POST['Add_event'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;


    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['date'])
        );
    } else {
        $error = 1;
        $err = 'Date Cannot Be Empty';
    }

    if (isset($_POST['details']) && !empty($_POST['details'])) {
        $details = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['details'])
        );
    } else {
        $error = 1;
        $err = 'Details Cannot Be Empty';
    }

    if (!$error) {
        $query =
            'INSERT INTO iCollege_termdates  (date, details) VALUES(?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'ss',
            $date,
            $details
        );
        $stmt->execute();
        if ($stmt) {
            $success = 'Term Important Date Added' && header('refresh:1; url=calendar.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}

/* Update Term Dates */
if (isset($_POST['Update_event'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['date'])
        );
    } else {
        $error = 1;
        $err = 'Date Cannot Be Empty';
    }

    if (isset($_POST['details']) && !empty($_POST['details'])) {
        $details = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['details'])
        );
    } else {
        $error = 1;
        $err = 'Details Cannot Be Empty';
    }

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string(
            $mysqli,
            trim($_POST['id'])
        );
    } else {
        $error = 1;
        $err = 'Id Cannot Be Empty';
    }

    if (!$error) {
        $query =
            'UPDATE iCollege_termdates SET  date =?, details =? WHERE id = ?';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sss',
            $date,
            $details,
            $id
        );
        $stmt->execute();
        if ($stmt) {
            $success = 'Term Important Date Updated' && header('refresh:1; url=calendar.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}

/* Delete Term Dates */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM iCollege_termdates WHERE id=?';
    $stmt = $conn->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success =
            'Deleted' && header('refresh:1; url=calendar.php');
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
                                <li class="breadcrumb-item active" aria-current="page"><span>Term Dates</span></li>
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
                                <h1 class="text-bold">Overall School Term Dates</h1>
                                <button data-toggle="modal" data-target="#add" class="btn btn-outline-secondary mb-2">Add Term Date</button>
                            </div>
                            <hr>

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
                                                        <div class="form-group col-md-12">
                                                            <label for="">Date</label>
                                                            <input type="date" required name="date" class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="">Term Date Details</label>
                                                            <textarea type="text" required name="details" class="form-control"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" name="Add_event" class="btn btn-primary">Submit</button>
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
                                            <th>Date</th>
                                            <th>Details</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ret = 'SELECT * FROM `iCollege_termdates`';
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        while ($dates = $res->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo date('d-M-Y', strtotime($dates->date)); ?></td>
                                                <td><?php echo $dates->details; ?></td>
                                                <td>
                                                    <a href="#update-<?php echo $dates->id; ?>" data-toggle="modal" class="badge outline-badge-success">Update</a>
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="update-<?php echo $dates->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="text-center">
                                                                        Update Term Date
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" enctype="multipart/form-data">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="">Date</label>
                                                                                    <input type="date" required value="<?php echo $dates->date;?>" name="date" class="form-control">
                                                                                    <input type="hidden" required value="<?php echo $dates->id;?>" name="id" class="form-control">
                                                                                </div>

                                                                                <div class="form-group col-md-12">
                                                                                    <label for="">Term Date Details</label>
                                                                                    <textarea type="text" required name="details" class="form-control"><?php echo $dates->details;?></textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="text-right">
                                                                                <button type="submit" name="Update_event" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="#delete-<?php echo $dates->id; ?>" data-toggle="modal" class="badge outline-badge-danger">Remove</a>
                                                    <div class="modal animated zoomInUp custo-zoomInUp" id="delete-<?php echo $dates->id; ?>" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center text-danger">
                                                                    <h4>Delete term date ?</h4>
                                                                    <br>
                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                    <a href="calendar.php?delete=<?php echo $dates->id; ?>" class="text-center btn btn-danger">Remove</a>
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