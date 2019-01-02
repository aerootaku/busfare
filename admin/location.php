<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 6/15/2018
 * Time: 2:13 AM
 */ ?>

<?php


require_once '../controller/action.php';

if(isset($_POST['delete'])){
    $delete = db_delete('tbl_location', $data = array("id"=>$_GET['id']));
    if(isset($delete)){
        $_SESSION['success'] = '';
        redirect('location.php?Success');
    }
    else{
        $_SESSION['error'] = '';
        redirect('location.php?Error');
    }
}
if(isset($_POST['create'])){

    $km = $_POST['km'];
    $fee = $_POST['km'] * 12;
    $data = array("loc_from"=>$_POST['loc_from'], "loc_to"=>$_POST['loc_to'], "fee"=>$fee);
    $create = db_insert('tbl_location', $data);
    if(isset($create)){
        $_SESSION['success'] = '';
        redirect('location.php?Success');
    }
    else{
        $_SESSION['error'] = '';
        redirect('location.php?Error');
    }
}

if(isset($_POST['edit'])){
    $data = array("loc_from"=>$_POST['loc_from'], "loc_to"=>$_POST['loc_to'], "fee"=>$_POST['fee']);
    $create = db_update('tbl_location', $data, $where = array("id"=>$_GET['id']));
    if(isset($create)){
        $_SESSION['success'] = '';
        redirect('location.php?Success');
    }
    else{
        $_SESSION['error'] = '';
        redirect('location.php?Error');
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../assets/img/basic/favicon.ico" type="image/x-icon">
    <title><?php echo $APP_NAME; ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/app.css">
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
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    <div class="page  has-sidebar-left height-full">
        <header class="blue accent-3 relative">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-database"></i>
                            Location
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                        <li>
                            <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                               role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Location</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="container-fluid animatedParent animateOnce">
            <div class="tab-content my-3" id="v-pills-tabContent">
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="card my-3 no-b">
                                <div class="card-body">
                                    <div class="card-title">Location Information</div>
                                
                                    <table class="table table-bordered table-hover data-tables"
                                           data-options='{ "paging": true; "searching":true}'>
                                        <thead>
                                        <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Fee</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $xid = $_SESSION['id'];
                                        $value = custom_query("SELECT * FROM tbl_location ORDER by id DESC");
                                        if($value->rowCount()>0)
                                        {
                                        while($row=$value->fetch(PDO::FETCH_ASSOC))
                                        {
                                        $id = $row['id'];
                                        ?>
                                        <tr>
                                            <td><?= $row['loc_from']; ?></td>
                                            <td><?= $row['loc_to']; ?></td>
                                            <td><?= number_format($row['fee']); ?></td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#edit<?= $id; ?>"><i class="icon-edit mr-3"></i></a>
                                                <a href="" data-toggle="modal" data-target="#delete<?= $id; ?>"><i class="icon-trash"></i></a>
                                            </td>

                                        </tr>
                                        <?php }} ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Fee</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Add New Message Fab Button-->
        <a href="#" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary" data-toggle="modal" data-target="#add"><i
                class="icon-add"></i></a>
    </div>
    <div id="add" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST">
                <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add Destination</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            <label>From</label>
                            <input type="text" class="form-control" name="loc_from" />
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <input type="text" class="form-control" name="loc_to" />
                        </div>
                        <div class="form-group">
                            <label>KM</label>
                            <input type="number" class="form-control" name="km" />
                        </div>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    <button type="submit" class="btn btn-primary" name="create">YES</button>
                </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
   
    <?php
    $xid = $_SESSION['id'];
    $value = custom_query("SELECT * FROM tbl_location");
    if($value->rowCount()>0)
    {
    while($row=$value->fetch(PDO::FETCH_ASSOC))
    {
    $id = $row['id'];
    ?>
    <div id="delete<?= $id; ?>" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="?id=<?= $id; ?>" method="POST">
                <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Delete Record</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            <h3>Are you sure you want to delete this record?</h3>
                        </div>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    <button type="submit" class="btn btn-primary" name="delete">YES</button>
                </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php }} ?> <!--done -->
    <?php
    $xid = $_SESSION['id'];
    $value = custom_query("SELECT * FROM tbl_location");
    if($value->rowCount()>0)
    {
    while($row=$value->fetch(PDO::FETCH_ASSOC))
    {
    $id = $row['id'];
    ?>
    <div id="edit<?= $id; ?>" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="?id=<?= $id; ?>" method="POST">
                <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Record</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                            <label>From</label>
                            <input type="text" class="form-control" name="loc_from" value="<?= $row['loc_from']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <input type="text" class="form-control" name="loc_to" value="<?= $row['loc_to']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>KM</label>
                            <input type="number" class="form-control" name="fee" value="<?= $row['fee']; ?>" />
                        </div>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-primary" name="edit">SAVE CHANGES</button>
                </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php }} ?> <!--done -->
</div>
<!--/#app -->
<script src="../assets/js/app.js"></script>
</body>

</html>
