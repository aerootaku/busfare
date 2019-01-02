<?php require_once 'controller/action.php'; ?>

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
if(isset($_POST['travel'])){

    $from = $_POST['loc_from'];
    $to = $_POST['loc_to'];
    $card_no = $_POST['card_no'];

    //select fee from the location

    $value = custom_query("SELECT * FROM tbl_location WHERE loc_from = '$from' and loc_to='$to' ORDER by id DESC");
    if($value->rowCount()>0) {
        while ($row = $value->fetch(PDO::FETCH_ASSOC)) {
            $fee = $row['fee'];
        }
    }

    //select the card holder and check the balance
    $value = custom_query("SELECT * FROM tbl_client WHERE card_no = '$card_no' ORDER by id DESC");
    if($value->rowCount()>0) {
        while ($row = $value->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $load = $row['card_load'];
            $type = $row['type'];
        }
    }
    //do the math here
    if($fee > $load){
        $_SESSION['toastr'] = array(
            'type'=>'error',
            'message'=>'Balance is not enough',
            'title'=>'Error'
        );
        redirect('travel.php');
        exit();
    }
    else{
        $new_balance = $load - $fee;
        if($type != 'Regular'){
            $discount = $fee * .20;
            $fee = $fee - $discount;
        }
        db_update('tbl_client', $data = array("card_load"=>$new_balance), $where = array("card_no"=>$card_no));
        $d = array(
            "user_id"=>$id,
            "full_name"=>$_POST['full_name'],
            "card_no"=>$_POST['card_no'],
            "card_load"=>$_POST['card_load'],
            "fare_fee"=>$fee,
            "loc_from"=>$_POST['loc_from'],
            "loc_to"=>$_POST['loc_to']
        );
        db_insert('tbl_travel', $d);
        $_SESSION['toastr'] = array(
            'type'=>'success',
            'message'=>'Thanks! Enjoy the ride :)',
            'title'=>'Success'
        );

        redirect('travel.php');
        exit();
    }
//    exit();
    //do the math here
}
?>
<!DOCTYPE html>
<html lang="zxx">

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
                    <div class="col-lg-6 mx-md-auto">
                        <div class="text-center">
                            <!--                            <img src="assets/img/dummy/u5.png" alt="">-->
                            <!--                            <h3 class="mt-2">Welcome Back</h3>-->
                            <p class="p-t-b-20">Hey, Please enter your location and tap your card to begin your journey</p>
                        </div>
                        <div class="card">
                            <div class="card-header bg-blue-grey">
                                <h3 style="text-align: center; color: white">Set your Destination!</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="form-group">
										<p>FROM: </p>
                                        <select name="loc_from" class="form-control" id="frm">
                                            <option value="" selected>Select Location</option>
                                            <?php

                                            $value = custom_query("SELECT DISTINCT(loc_from) FROM tbl_location ORDER by id DESC");
                                            if($value->rowCount()>0)
                                            {
                                                while($row=$value->fetch(PDO::FETCH_ASSOC))
                                                {

                                                    ?>
                                                    <option value="<?= $row['loc_from']; ?>"><?= $row['loc_from']; ?></option>
                                                <?php }} ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
										<p>TO: </p>
                                        <select name="loc_to" class="form-control" id="lto">
                                            <option value="" selected>Select Location</option>
                                            <?php

                                            $value = custom_query("SELECT DISTINCT(loc_to) FROM tbl_location ORDER by id DESC");
                                            if($value->rowCount()>0)
                                            {
                                                while($row=$value->fetch(PDO::FETCH_ASSOC))
                                                {

                                                    ?>
                                                    <option value="<?= $row['loc_to']; ?>"><?= $row['loc_to']; ?></option>
                                                <?php }} ?>
                                        </select>
                                    </div>
                                    <input type="button" class="btn btn-success btn-lg btn-block" value="Tap to Scan Card" name="scan" id="scan">
                                    <br />
                                    <div class="form-group">
                                        <label>Card Number</label>
                                        <input type="text" class="form-control" name="card_no" id="card_no" readonly required />
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="full_name" id="full_name" readonly required />
                                    </div>
                                    <div class="form-group">
                                        <label>Load Balance</label>
                                        <input type="text" class="form-control" name="card_load" id="card_load" readonly required />
                                    </div>
                                    <div class="form-group">
                                        <label>Fare Fee</label>
                                        <input type="text" class="form-control" name="fare_fee" id="fare_fee" readonly required />
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="type" id="type" readonly required />
                                    </div>
                                    <div id="discount"></div>
                                    
                                    <br />
                                    <div id="sub"></div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #primary -->
    </main>
</div>
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
<script src="assets/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#frm').on('change', function () {
            console.log("Sample");
            var lto = $("#frm").val();

            $("#lto").on("change", function () {
                var frm = $("#lto").val();
                console.log(lto);
                console.log(frm);
//                $.get('api.php', {loc_to: lto, loc_from: frm}, function(result) {
//                   console.log(result);
//                });
            });
        });

        $("#scan").click(function(){
            $.ajax({
                type: 'POST',
                url: 'inquiry_py.php',
                success: function(data) {
                    console.log(data);
//                    var d = JSON.parse(data);
//                    console.log(d);
                    if(data.title == "Error"){
                        console.log(data.Message);
                        alert(data.Message);
                    }
                    else{
                        $("#card_no").val(data.card_no);
                        $("#full_name").val(data.full_name);
                        $("#card_load").val(data.card_load);
                        $("#type").val(data.type);
                        if(data.type != 'Regular'){
                            $("#discount").html("<span style='text-align: center;'><strong>20% Discounted Fare</strong></span><br />");
                        }
                        $("#sub").html("<button type='submit' class='btn btn-danger btn-block' name='travel'>Navigate</button>");
                        $.get('api.php', {loc_to: $("#lto").val(), loc_from: $("#frm").val()}, function(result) {
                            console.log(result);
                            $("#fare_fee").val(result.fee);
                        });
                    }

                }
            });
        });
    });
</script>
</body>

</html>
