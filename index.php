<?php require 'controller/action.php'; ?>

<?php

//if($action->is_loggedin() !=''){
//    if($_SESSION['role']==''){
//        redirect('superadmin/dashboard.php');
//    }
//    else if($_SESSION['role']=='Admin')
//    {
//        redirect('admin/dashboard.php');
//    }
//
//}
if(isset($_POST['login'])){
   $username = $_POST['username'];
   $password = $_POST['password'];

    if($action->login($username, $password)){

    }
    else{
//        redirect('index.php?Error');
    }

}
?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from xvelopers.com/demos/html/paper-panel-1.0.1/login-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Jun 2018 06:12:53 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title><?php echo $APP_NAME; ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
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
    <main>
        <div id="primary" class="p-t-b-100 height-full ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mx-md-auto">
                        <div class="text-center">
                            <img src="assets/img/dummy/u5.png" alt="">
                            <h3 class="mt-2">Welcome Back</h3>
                            <p class="p-t-b-20">Hey admin, Welcome back. We're glad to see you here again</p>
                        </div>
                        <form action="" method="POST">
                            <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                                <input type="text" class="form-control form-control-lg"
                                       placeholder="Username" name="username">
                            </div>
                            <div class="form-group has-icon"><i class="icon-user-secret"></i>
                                <input type="password" class="form-control form-control-lg"
                                       placeholder="Password" name="password">
                            </div>
                            <input type="submit" class="btn btn-success btn-lg btn-block" value="Log In" name="login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #primary -->
    </main>
</div>
<!--/#app -->
<script src="assets/js/app.js"></script>
</body>

</html>
