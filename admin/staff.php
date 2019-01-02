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
    $delete = db_delete('tbl_users', $data = array("id"=>$_GET['id']));
    if(isset($delete)){
        $_SESSION['toastr'] = array(
            'type'=>'warning',
            'message'=>'Staff Deleted Successfully',
            'title'=>'Removed'
        );
    }
    else{
       $error[] = 'There was an error with the server';
    }
}
if(isset($_POST['edit'])){
    $data = array(
            "username"=>$_POST['username'],
        "firstname"=>$_POST['firstname'],
        "lastname"=>$_POST['lastname'],
        "middlename"=>$_POST['middlename'],
        "contact"=>$_POST['contact']);
    $edit = db_update('tbl_users', $data , $where = array("id"=>$_GET['id']));
    if(isset($edit)){
        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Staff Edited Successfully',
            'title'=>'Edited'
        );
    }
    else{
        $error[] = 'There was an error with the server';
    }

}
if(isset($_POST['reset'])){
    $reset = db_update('tbl_users', $data = array("password"=>password_hash($_POST['new_pass'], PASSWORD_DEFAULT)), $where = array("id"=>$_GET['id']));
    if(isset($reset)){
        $_SESSION['toastr'] = array(
            'type'=>'info',
            'message'=>'Staff Password Successfully Reset',
            'title'=>'Password Reset'
        );
    }
    else{
        $error[] = 'There was an error with the server';
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
                            Users
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                        <li>
                            <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                               role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Users</a>
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
                                    <div class="card-title">Simple usage</div>
                                    <table class="table table-bordered table-hover data-tables"
                                           data-options='{ "paging": true; "searching":true}'>
                                        <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Contact Number</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $xid = $_SESSION['id'];
                                        $value = custom_query("SELECT * FROM tbl_users WHERE id!='$xid' and role != 'Admin' ORDER by id DESC");
                                        if($value->rowCount()>0)
                                        {
                                        while($row=$value->fetch(PDO::FETCH_ASSOC))
                                        {
                                        $id = $row['id'];
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                    <?php $str = $row['firstname'];
                                                    echo $str[0];
                                                    ?>
                                                    <span class="avatar-letter avatar-letter-<?php echo strtolower($str[0]); ?>  avatar-md circle"></span>
                                                </div>
                                                <div>
                                                    <div>
                                                        <strong><?php echo $row['firstname'] . " ". $row['lastname']; ?></strong>
                                                    </div>
                                                </div>
                                            </td>

                                            <td><?= $row['username']; ?></td>
                                            <td><?= $row['contact']; ?></td>

                                            <td>
                                                <a href="" data-toggle="modal" data-target="#edit<?= $id; ?>"><i class="icon-pencil mr-3"></i></a>
                                                <a href="" data-toggle="modal" data-target="#delete<?= $id; ?>"><i class="icon-trash mr-3"></i></a>
                                                <a href="" data-toggle="modal" data-target="#reset<?= $id; ?>"><i class="icon-cogs"></i></a>
                                            </td>
                                        </tr>
                                        <?php }} ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Contact Number</th>
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
        <a href="staff-create.php" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
                class="icon-add"></i></a>
    </div>
    <?php
    $xid = $_SESSION['id'];
    $value = custom_query("SELECT * FROM tbl_users");
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
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $row['username']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="firstname" value="<?= $row['firstname']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="form-control" name="middlename" value="<?= $row['middlename']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lastname" value="<?= $row['lastname']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Contact No</label>
                            <input type="number" class="form-control" name="contact" value="<?= $row['contact']; ?>" />
                        </div>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit">Save Changes</button>
                </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php }} ?> <!--DONE -->
    <?php
    $xid = $_SESSION['id'];
    $value = custom_query("SELECT * FROM tbl_users");
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
    $value = custom_query("SELECT * FROM tbl_users");
    if($value->rowCount()>0)
    {
    while($row=$value->fetch(PDO::FETCH_ASSOC))
    {
    $id = $row['id'];
    ?>
    <div id="reset<?= $id; ?>" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="?id=<?= $id; ?>" method="POST">
                <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Reset Password</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset>
                        <div class="form-group">
                           <h4>Resetting the password will change the password to: <strong> <?php echo $rand = rand_string(8); ?></strong></h4>
                            <input type="hidden" name="new_pass" value="<?php echo $rand; ?>" />
                        </div>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="reset">Reset</button>
                </div>
            </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php }} ?>

</div>
<?php if(isset($_SESSION['toastr'])){ ?>
    <div class="toast"
         data-title="<?php echo $_SESSION['toastr']['title']; ?>"
         data-message="<?php echo $_SESSION['toastr']['message']; ?>"
         data-type="<?php echo $_SESSION['toastr']['type']; ?>">
    </div>
<?php } unset($_SESSION['toastr']); ?>
<?php
if(isset($error))
{
    foreach($error as $error)
    {
        ?>
        <div class="toast"
             data-title="Error"
             data-message="<?php echo $error; ?>"
             data-type="error">
        </div>
    <?php } }?>
<!--/#app -->
<script src="../assets/js/app.js"></script>
</body>

</html>
