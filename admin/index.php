<?php require_once '../controller/action.php';

if(isset($_POST['load'])){
    $balance = $_POST['balance'];
    $load = $_POST['load_amount'];
    $id = $_POST['id'];

    $data = array(
            "card_load"=>$balance + $load
    );
    $where = array("id"=>$id);

    $update = db_update('tbl_client', $data, $where);
    if(isset($update)){
        $_SESSION['toastr'] = array(
            'type'=>'success',
            'message'=>'Loaded Successfully',
            'title'=>'Loaded'
        );
        redirect('index.php');
        exit();
    }
    else{
        $error[] = '';

    }
}
if(isset($_POST['deduct'])){
    $balance = $_POST['balance'];
    $load = $_POST['load_amount'];
    $id = $_POST['id'];

    $data = array(
            "card_load"=>$balance - $load
    );
    $where = array("id"=>$id);

    $update = db_update('tbl_client', $data, $where);
    if(isset($update)){
        $_SESSION['toastr'] = array(
            'type'=>'error',
            'message'=>'Deducted Successfully',
            'title'=>'Deduct'
        );
        redirect('index.php');
        exit();
    }
    else{
        $error[] = '';

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

    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            Dashboard
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
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-note-list text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title">Registered Admin</div>
                                    <h5 class="sc-counter mt-3"><?= db_count_where('tbl_users', $data = array("role"=>"Admin")); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-mail-envelope-open s-48"></span>
                                    </div>
                                    <div class="counter-title ">Registered Clients</div>
                                    <h5 class="mt-3"><?= db_count_all('tbl_client'); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-map-pin s-48"></span>
                                    </div>
                                    <div class="counter-title">Registered Location</div>
                                    <h5 class="mt-3"><?=  db_count_all('tbl_location'); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-stop-watch3 s-48"></span>
                                    </div>
                                    <div class="counter-title">Today</div>
                                    <h5 class="mt-3"><?php echo date('Y-m-d H:i:a'); ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card my-3 no-b">
                                <div class="card-body">
                                    <div class="card-title">Load a Card</div>
                                    <table class="table table-bordered table-hover data-tables"
                                           data-options='{ "paging": true; "searching":true}'>
                                        <thead>
                                        <tr>
                                            <th>Card Number</th>
                                            <th>Full Name</th>
                                            <th>Load Amount</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $xid = $_SESSION['id'];
                                        $value = custom_query("SELECT * FROM tbl_client ORDER by id DESC");
                                        if($value->rowCount()>0)
                                        {
                                            while($row=$value->fetch(PDO::FETCH_ASSOC))
                                            {
                                                $id = $row['id'];
                                                ?>
                                                <tr>
                                                    <td><?= $row['card_no']; ?></td>
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

                                                    <td>₱ <?= number_format($row['card_load']); ?></td>
                                                    <td>
                                                        <a href="" data-target="#load<?= $id; ?>" data-toggle="modal" class="btn btn-success mr-3"><i class="icon-money-bag"></i> Load</a>
                                                        <a href="" data-target="#deduct<?= $id; ?>" data-toggle="modal" class="btn btn-danger"><i class="icon-minus-circle"></i> Deduct</a>
                                                    </td>

                                                </tr>
                                            <?php }} ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Card Number</th>
                                            <th>Full Name</th>
                                            <th>Load Amount</th>
                                            <th>Action</th>
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
<?php
$xid = $_SESSION['id'];
$value = custom_query("SELECT * FROM tbl_client");
if($value->rowCount()>0)
{
    while($row=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $row['id'];
        ?>
        <div id="load<?= $id; ?>" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="?id=<?= $id; ?>" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">Load <?= $row['firstname']; ?></h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <input type="hidden" value="<?= $id; ?>" name="id" />
                                <input type="hidden" value="<?= $row['card_load']; ?>" name="balance" />
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="load_amount" />
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="load">Load</button>
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
$value = custom_query("SELECT * FROM tbl_client");
if($value->rowCount()>0)
{
    while($row=$value->fetch(PDO::FETCH_ASSOC))
    {
        $id = $row['id'];
        ?>
        <div id="deduct<?= $id; ?>" class="modal fade" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="?id=<?= $id; ?>" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">Deduct <?= $row['firstname']; ?></h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <fieldset>
                                <input type="hidden" value="<?= $id; ?>" name="id" />
                                <input type="hidden" value="<?= $row['card_load']; ?>" name="balance" />
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="load_amount" />
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="deduct">Deduct</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php }} ?> <!--done -->
<!--/#app -->
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
<script src="../assets/js/app.js"></script>

</body>

</html>
