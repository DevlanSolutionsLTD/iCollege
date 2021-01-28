<?php
//create course
if (isset($_POST['add_course'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = "Course code Cannot Be Empty";
    }
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = "Course name Cannot Be Empty";
    }
    if (isset($_POST['hod']) && !empty($_POST['hod'])) {
        $hod = mysqli_real_escape_string($mysqli, trim($_POST['hod']));
    } else {
        $error = 1;
        $err = "HOD Cannot Be Empty";
    }
    if (isset($_POST['details']) && !empty($_POST['details'])) {
        $details = mysqli_real_escape_string($mysqli, trim($_POST['details']));
    } else {
        $error = 1;
        $err = "Course detail Cannot Be Empty";
    }
    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  iCollege_courses WHERE  code ='$code'  ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($code  == $row['code']) {
                $err =  "A Course With code Number Exists";
            }
        } else {
            $id = uniqid ( date(Y), true);//NEW GENERATOR 
            $code = $_POST['code'];
            $name = $_POST['name'];
            $hod = $_POST['hod'];
            $details  = $_POST['details'];
           $query = "INSERT INTO iCollege_courses (id, code, name, hod, details) VALUES(?,?,?,?,?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sssss', $id, $code , $name, $hod, $details);
            $stmt->execute();
            if ($stmt) {
                $success = "Added" && header("refresh:1; url=courses.php");
            } else {
                //inject alert that profile update task failed
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}
//create course

//Update course
//update course

//delete course
//dele course
?>

<?php require_once('../partials/head.php'); ?>

<body>

    <!--  BEGIN NAVBAR  -->
    <?php require_once('../partials/admin_nav.php'); ?>
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
                                <li class="breadcrumb-item active" aria-current="page"><span>Courses</span></li>
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
        <?php require_once('../partials/admin_sidebar.php'); ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="text-right">
                                <button data-toggle="modal" data-target="#import_courses" class="btn btn-outline-primary mb-2">Import Courses </button>
                                <button data-toggle="modal" data-target="#add_course" class="btn btn-outline-secondary mb-2">Add Course</button>
                            </div>
                            <hr>
                            <!-- Import Modals -->
                            <div class="modal animated zoomInUp custo-zoomInUp" id="import_courses" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="text-center">
                                                Allowed file types: XLS, XLSX.
                                                <a class="text-primary" href="public/templates/sample_births.xlsx">Download</a> A Sample File.
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
                            <div class="modal animated zoomInUp custo-zoomInUp" id="add_course" role="dialog">
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
                                                        <div class="form-group col-md-4">
                                                            <label for="">Course Code</label>
                                                            <input type="text" required name="code" value="" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">Course Name</label>
                                                            <input type="text" required name="name" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="">HOD Name</label>
                                                            <select type="text" required name="hod" class="form-control basic">
                                                                <option>Select HOD</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputPassword1">Course Details</label>
                                                            <textarea required name="details" rows="5" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="add_course" class="btn btn-primary">Submit</button>
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
                          
                            <div class="table-responsive mb-4 mt-4">
                                <table id="default-ordering" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Name</th>
                                            <th>Course HOD</th>
                                            <th>Manage Course</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>$320,800</td>
                                            <td>
                                                <a href="#view-" class="badge outline-badge-success">View</a>
                                                <a href="#update-" class="badge outline-badge-warning">Update</a>
                                                <a href="#delete-" class="badge outline-badge-danger">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once('../partials/footer.php'); ?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <?php require_once("../partials/scripts.php"); ?>
</body>

</html>