<?php require_once '../controller/action.php'; ?>
<?php

if(isset($_POST['register'])){
    if(isExists('tbl_client', $where = array("card_no"=>$_POST['card_no']))== 1){
        $error[] = 'This card number is already registered';
    }
    else{
        $data = array(
            "card_no"=>$_POST['card_no'],
            "firstname"=>$_POST['firstname'],
            "middlename"=>$_POST['middlename'],
            "lastname"=>$_POST['lastname'],
            "contact"=>$_POST['contact'],
            "gender"=>$_POST['gender'],
            "type"=>$_POST['type'],
            "card_load"=>100
        );
        $insert = db_insert('tbl_client', $data);
        $updateLocker = db_update('tbl_locker', $datas = array("Status"=>"Occupied"), $where = array("locker_no"=>$_POST['locker']));
        if(isset($insert)){
            $_SESSION['toastr'] = array(
                'type'=>'success',
                'message'=>'Client Created Successfully',
                'title'=>'Created'
            );
            redirect('clients-create.php');
            exit();
        }
        else{
            $error[] = '';

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
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(document).ready(function(){
            setInterval(function() {
                $("#refreshs").load("clients-create.php #refreshs");
            }, 1000);
        });
    </script>
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
                        <div class="col-md-7  offset-md-2">
                            
                                <div class="card no-b  no-r">
                                    <div class="card-body">
                                        <h5 class="card-title">About User</h5>
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <form action="" method="POST">
                                                <div class="form-row">
                                                    <div class="form-group col-4 m-0">
                                                        <label for="name" class="col-form-label s-12">FIRST NAME</label>
                                                        <input id="name" placeholder="Enter First Name" class="form-control r-0 light s-12 " type="text" name="firstname" required>
                                                    </div>
                                                    <div class="form-group col-4 m-0">
                                                        <label for="name" class="col-form-label s-12">MIDDLE NAME</label>
                                                        <input id="name" placeholder="Enter Last Name" class="form-control r-0 light s-12 " type="text" name="middlename" required>
                                                    </div>
                                                    <div class="form-group col-4 m-0">
                                                        <label for="name" class="col-form-label s-12">LAST NAME</label>
                                                        <input id="name" placeholder="Enter Last Name" class="form-control r-0 light s-12 " type="text" name="lastname" required>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12 m-0">
                                                        <label for="mobile" class="col-form-label s-12"><i class="icon-mobile-phone mr-2"></i>Mobile</label>
                                                        <input id="mobile" placeholder="eg: 3334709643" class="form-control r-0 light s-12 " type="text" name="contact" required>
                                                    </div>
                                                </div>
                                                <div class="form-group m-0">
                                                    <label for="dob" class="col-form-label s-12">GENDER</label>
                                                    <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="inlineFormCustomSelectPref" name="gender" required>
                                                        <option selected>Choose...</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                    <div class="form-group m-0">
                                                        <label for="dob" class="col-form-label s-12">Type</label>
                                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="inlineFormCustomSelectPref" name="type" required>
                                                            <option selected>Choose...</option>
                                                            <option value="Regular">Regular</option>
                                                            <option value="Student">Student</option>
                                                            <option value="Senior">Senior</option>
                                                            <option value="PWD">PWD</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="col-md-3 offset-md-1">
                                                <label class="col-form-label s-12">CARD NO.</label>
                                                <textarea class="form-control" name="card_no" rows="5" required placeholder=""></textarea>
                                  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="register"><i class="icon-save mr-2"></i>Save Data</button>
                                    </div>
                                     </form>
                                </div>
                        </div>
                    </div>
                </div>
                <!--Today Tab End-->
            </div>
        </div>
    </div>
            <div id="scanFingerprint" class="modal fade" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Let's Start Scanning your fingerprint</h6>
                            </div>
                            <div class="modal-body">
                                <fieldset>
                                    <div class="form-group">
                                        <p><strong>Place your finger in the fingerprint scanner and click the button to start the scanning</strong></p>
                                    </div>
                                    <div class="form-group" align="center">
                                        <button type="button" id="regFingerprint" class="btn btn-secondary">Begin Scanning</button>
                                    </div>
                                    <div class="form-group">
                                        <h6 id="t1"><!-- tutorial function--></h6>
                                    </div>
                                    <div class="form-group">
                                        <p id="result"><!-- python output will be displayed here--></p>
                                    </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $("#regFingerprint").click(function(){
                                            console.log("hello");
                                            setTimeout(6000);
                                            $.ajax({
                                                type: 'POST',
                                                url: 'py.php',
                                                success: function(data) {
                                                    $("#result").html(data);
                                                    console.log("success");

                                                }
                                            });
                                   });
                                });
                                </script>
                                </fieldset>

                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->

                        </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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
