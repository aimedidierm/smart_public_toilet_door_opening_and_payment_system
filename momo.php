<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require 'php-includes/connect.php';
function getToken() {
    $curl = curl_init();
  
    curl_setopt_array($curl, array(
      CURLOPT_URL => BASE_URL . '/auth/agents/authorize',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      //CURLOPT_POSTFIELDS => '{"client_id": "89f8e714-0f47-11ed-babe-dead0062f58a","client_secret": "afc73b804eee90103e2c8caad4741393da39a3ee5e6b4b0d3255bfef95601890afd80709"}',
      CURLOPT_POSTFIELDS => '{"client_id": "a5072f6a-7415-11ed-962d-dead64802bd2","client_secret": "85bd49397d2a7ab0bf6e1c9326325ac8da39a3ee5e6b4b0d3255bfef95601890afd80709"}',
      CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
    ));
  
    $response = curl_exec($curl);
  
    curl_close($curl);
  
    return json_decode($response)->access;
}
if(isset($_POST['pay'])){
    $card=$_POST['card'];
    $number=$_POST['number'];
    $amount=$_POST['amount'];
    $query = "SELECT * FROM user WHERE card = ? limit 1";
    $stmt = $db->prepare($query);
    $stmt->execute(array($card));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount()>0) {
        //some codes here
        $myid=$rows['id'];
        $balance=$rows['balance'];
        $req = '{"amount":'.$amount.',"number":"'.$number.'"}';
    define('BASE_URL', 'https://payments.paypack.rw/api');
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => BASE_URL . '/transactions/cashin?Idempotency-Key=OldbBsHAwAdcYalKLXuiMcqRrdEcDGRv',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $req,
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . getToken(),
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    //echo $response;
    //Insert data in database
    $newbalance=$balance+$amount;
    $sql ="UPDATE user SET balance = ? WHERE id = ? limit 1";
    $stm = $db->prepare($sql);
    if ($stm->execute(array($newbalance,$myid))) {
        //continue
        $sql ="INSERT INTO transactions (debit,user) VALUES (?,?)";
        $stm = $db->prepare($sql);
        if ($stm->execute(array($amount,$myid))) {
            print "<script>alert('Money send');window.location.assign('momo.php')</script>";
        } else {
            print "<script>alert('Transaction history add fail');window.location.assign('momo.php')</script>";
        }
    } else{
        print "<script>alert('Balance update fail');window.location.assign('momo.php')</script>";
    }
    } else {
        echo "<script>alert('User not found');window.location.assign('momo.php')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Smart toilette</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		  <div class="card-title text-uppercase text-center py-3">Send money to card</div>
		    <form method="post">
            <div class="form-group">
                <label>Card</label>
                <input name="card" class="form-control" placeholder="Enter card No" type="text">
            </div>
            <div class="form-group">
                <label>Mobile Number:</label>
            <input type="number" class="form-control" placeholder="Enter number" name="number">
            </div>
            <div class="form-group">
                <label>Amount:</label>
                <input type="number" class="form-control" placeholder="Amount" name="amount">
            </div>
			<div class="form-row">
			</div>
			 <button name="pay" type="submit" class="btn btn-light btn-block">Send</button>
			</div>
			 
			 </form>
            <a href="index.php" class="btn btn-light btn-block">Go back</a>
		   </div>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
</body>
</html>
