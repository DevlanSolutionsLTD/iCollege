<!-- Auth Js -->
<script src="../public/js/authentication/form-1.js"></script>
<!-- Custom Js -->
<script src="../public/js/custom.js"></script>
<!-- Jquerry -->
<script src="../public/js/libs/jquery-3.1.1.min.js"></script>
<!-- Bootstrap -->
<script src="../public/plugins/bootstrap/js/popper.min.js"></script>
<script src="../public/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Perfect Scroll Bars -->
<script src="../public/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!-- App Js -->
<script src="../public/js/app.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<!-- Apex Charts -->
<script src="../public/plugins/apex/apexcharts.min.js"></script>
<!-- DashboarD Js -->
<script src="../public/js/dashboard/dash_2.js"></script>
<!-- User Accounts  -->
<script src="../public/js/users/account-settings.js"></script>
<!-- Bloc UI Jquerry Plug In -->
<script src="../public/plugins/blockui/jquery.blockUI.min.js"></script>
<!-- Data Tables -->
<script src="../public/plugins/table/datatable/datatables.js"></script>
<script>
    $('#default-ordering').DataTable({
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "order": [
            [3, "desc"]
        ],
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7,
        drawCallback: function() {
            $('.dataTables_paginate > .pagination').addClass(' pagination-style-13 pagination-bordered mb-5');
        }
    });
</script>
<!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
<script src="../public/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
<script src="../public/plugins/table/datatable/button-ext/jszip.min.js"></script>
<script src="../public/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
<script src="../public/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
<script>
    $('#html5-extension').DataTable({
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [{
                    extend: 'copy',
                    className: 'btn'
                },
                {
                    extend: 'csv',
                    className: 'btn'
                },
                {
                    extend: 'excel',
                    className: 'btn'
                },
                {
                    extend: 'print',
                    className: 'btn'
                }
            ]
        },
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7
    });
</script>
<!-- Scroll Spy -->
<script src="../public/js/scrollspyNav.js"></script>
<!-- Highlight -->
<script src="../public/plugins/highlight/highlight.pack.js"></script>
<!-- Custom File Uploads -->
<script src="../public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
<!-- Select -->
<script src="../public/plugins/select2/select2.min.js"></script>
<script>
    var ss = $(".basic").select2({
        tags: true,
    });
</script>
<!-- Sweet Alerts -->
<script src="../public/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="../public/plugins/sweetalerts/custom-sweetalert.js"></script>
<!-- Ajax -->
<script>
    /* Room Details Asyc */
    function getStudentDetails(val) {
        $.ajax({

            type: "POST",
            url: "../partials/ajax.php",
            data: 'AdmissionNumber=' + val,
            success: function(data) {
                //alert(data);
                $('#StudentName').val(data);
            }
        });

        $.ajax({

            type: "POST",
            url: "../partials/ajax.php",
            data: 'StudentName=' + val,
            success: function(data) {
                //alert(data);
                $('#StudentCourse').val(data);
            }
        });
    }

    function getUnitDetails(val) {
        $.ajax({

            type: "POST",
            url: "../partials/ajax.php",
            data: 'UnitCode=' + val,
            success: function(data) {
                //alert(data);
                $('#UnitName').val(data);
            }
        });
    }

    function getLecDetails(val) {
        $.ajax({

            type: "POST",
            url: "../partials/ajax.php",
            data: 'LecNumber=' + val,
            success: function(data) {
                //alert(data);
                $('#LecName').val(data);
            }
        });
    }
</script>
<!-- Print Contents Inside A Div -->
<script>
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>