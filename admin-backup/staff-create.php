<?php
/**
 * Created by PhpStorm.
 * User: Kio
 * Date: 6/15/2018
 * Time: 3:09 AM
 */ ?>


<?php
require_once '../controller/action.php';

if(isset($_POST['register'])){
    if(isExists('tbl_users', $where = array("username"=>$_POST['username'])) == 1){
        $error[] = 'The username is already exists in the database';
    } else{
        $data = array(
            "username"=>$_POST['username'],
            "password"=>password_hash($_POST['username'], PASSWORD_DEFAULT),
            "firstname"=>$_POST['firstname'],
            "lastname"=>$_POST['lastname'],
            "middlename"=>$_POST['middlename'],
            "contact"=>$_POST['contact'],
            "role"=>"Staff");
        $create = db_insert('tbl_users', $data);
        if(isset($create)){
            $_SESSION['toastr'] = array(
                'type'=>'success',
                'message'=>'Staff Created Successfully',
                'title'=>'Created'
            );
            redirect('staff-create.php');
            exit();

        }
        else{
          $error[] = 'There was an error with the server. Please try again later';
        }
    }

}


?>

<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from xvelopers.com/demos/html/paper-panel-1.0.1/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jun 2018 06:07:21 GMT -->
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
                            Staff
                        </h4>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                        <li>
                            <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                               role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>Create Staff</a>
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
                                    <div class="card-title">Create Users</div>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" required />
                                        </div>
<!--                                        <span class="text-sm-center">DEFAULT PASSWORD: Welcome123</span>-->
                                        <hr />
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" class="form-control" name="firstname" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" class="form-control" name="middlename" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input type="text" class="form-control" name="lastname" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Contact No</label>
                                            <input type="number" class="form-control" name="contact" required />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block" name="register">Save Staff Info</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

