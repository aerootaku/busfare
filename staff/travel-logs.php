<?php require_once '../controller/action.php'; ?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Bus Fare</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/app.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>

</head>
<body class="light">
<!-- Pre loader -->

<div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
        <?php require_once '_layout/sidebar.php'; ?>
    </aside>
    <!--Sidebar End-->
    <div class="has-sidebar-left">
        <div class="pos-f-t">
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                    <div class="search-bar">
                        <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50" type="text"
                               placeholder="start typing...">
                    </div>
                    <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-expanded="false"
                       aria-label="Toggle navigation" class="paper-nav-toggle paper-nav-white active "><i></i></a>
                </div>
            </div>
        </div>
        <div class="sticky">
            <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
                <div class="relative">
                    <a href="#" data-toggle="offcanvas" class="paper-nav-toggle pp-nav-toggle">
                        <i></i>
                    </a>
                </div>
                <!--Top Menu Start -->
                <div class="navbar-custom-menu p-t-10">

                </div>
            </div>
        </div>
    </div>

    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            Travel Logs
                        </h4>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid relative animatedParent animateOnce">
            <div class="tab-content pb-3" id="v-pills-tabContent">
                <!--Today Tab Start-->
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="card my-3 no-b">
                                <div class="card-body">
                                    <div class="card-title">Travel Logs</div>
                                    <table class="table table-bordered table-hover" id="printTable">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Card Number</th>
                                            <th>Fare Fee</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Date & Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $xid = $_SESSION['id'];
                                        $value = custom_query("SELECT * FROM tbl_travel ORDER by id DESC");
                                        if($value->rowCount()>0)
                                        {
                                            while($row=$value->fetch(PDO::FETCH_ASSOC))
                                            {
                                                $id = $row['id'];
                                                ?>
                                                <tr>
                                                    <td><?= $row['full_name']; ?></td>
                                                    <td><?= $row['card_no']; ?></td>
                                                    <td><?= $row['fare_fee']; ?></td>
                                                    <td><?= $row['loc_from']; ?></td>
                                                    <td><?= $row['loc_to']; ?></td>
                                                    <td><?= $row['dtcreated']; ?></td>
                                                </tr>
                                            <?php }} ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Card Number</th>
                                            <th>Fare Fee</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Date & Time</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Today Tab End-->
            </div>
        </div>
    </div>
</div>
<!--/#app -->

<script src="../assets/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>




<script>
    $(document).ready(function() {
        $('#printTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'print',
                'excelHtml5',
                'pdfHtml5'
            ]
        } );
    } );
</script>
</body>

</html>