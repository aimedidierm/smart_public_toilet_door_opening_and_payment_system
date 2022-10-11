<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require '../php-includes/connect.php';
require 'php-includes/check-login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Smart toilette - withdraw</title>
  <!-- loader-->
  <link href="../assets/css/pace.min.css" rel="stylesheet"/>
  <script src="../assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="../assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="../assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="../assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">
 <?php require_once 'php-includes/nav.php'; ?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sellers withdraw requests</h5>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                    <th>N</th>
                    <th>Names</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>Balance</th>
                    <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT p.id,p.seller,p.amount,p.time,s.id AS s_id,s.phone,s.names FROM pending_withdraw AS p JOIN seller AS s ON p.seller=s.id";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $count = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                    <tr>
                        <td><?php print $count?></td>
                        <td><?php print $row['names']?></td>
                        <td><?php print $row['amount']?></td>
                        <td><?php print $row['phone']?></td>
                        <td><?php print $row['time']?></td>
                        <td><form method="post"><button type="submit" class="btn btn-success" id="<?php echo $row["id"];$sid=$row["id"];$seller=$row["seller"];$namount=$row['amount']; ?>" name="com"><span class="glyphicon glyphicon-trash"></span> Comfirm</button></form></td>
                    </tr>
                    <?php
                    $count++;
                    }
                }
                if(isset($_POST['com'])){

                    $query = "SELECT * FROM seller WHERE id= ? limit 1";
                    $stmt = $db->prepare($query);
                    $stmt->execute(array($seller));
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($stmt->rowCount()>0) {
                        $balance=$rows['balance'];
                    }
                    $newbalance=$balance-$namount;
                    $sql ="UPDATE seller SET balance = ? WHERE id = ? limit 1";
                    $stm = $db->prepare($sql);
                    if ($stm->execute(array($newbalance,$seller))) {
                        $sql ="DELETE FROM pending_withdraw WHERE id = ?";
                        $stm = $db->prepare($sql);
                        if ($stm->execute(array($sid))) {
                            $sql ="INSERT INTO transactions (credit,seller) VALUES (?,?)";
                            $stm = $db->prepare($sql);
                            if ($stm->execute(array($namount,$seller))) {
                                print "<script>alert('Comfirmed');window.location.assign('withdraw.php')</script>";
                    
                            } else {
                                print "<script>alert('Fail');window.location.assign('withdraw.php')</script>";
                            }
                        } else {
                            print "<script>alert('Fail');window.location.assign('withdraw.php')</script>";
                        }
                    } else {
                        print "<script>alert('Fail');window.location.assign('withdraw.php')</script>";
                    }
                }
                ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div><!--End Row-->
	  
	  <!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
  <?php require '../php-includes/footer.php'; ?>
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="../assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="../assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="../assets/js/app-script.js"></script>
	
</body>
</html>