<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
require '../php-includes/connect.php';
require 'php-includes/check-login.php';
if(isset($_POST['save'])){
    $names=$_POST['names'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $card=$_POST['card'];
    $sql ="INSERT INTO user (names, card, email, phone, balance) VALUES (?,?,?,?,'0')";
    $stm = $db->prepare($sql);
    if ($stm->execute(array($names,$card,$email,$phone))) {
        print "<script>alert('User added');window.location.assign('users.php')</script>";

    } else{
        echo "<script>alert('Error! try again');window.location.assign('users.php')</script>";
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
  <title>Smart toilette - users management</title>
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
              <h5 class="card-title">Users management</h5>
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
                    $sql = "SELECT * FROM user";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $count = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                    <tr>
                        <td><?php print $count?></td>
                        <td><?php print $row['names']?></td>
                        <td><?php print $row['email']?></td>
                        <td><?php print $row['phone']?></td>
                        <td><?php print $row['balance']?></td>
                        <td><form method="post"><button type="submit" class="btn btn-danger" id="<?php echo $row["id"];$sid=$row["id"]; ?>" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete</button></form></td>
                    </tr>
                    <?php
                        $count++;
                        }
                    }
                    if(isset($_POST['delete'])){
                        $sql ="DELETE FROM user WHERE id = ?";
                        $stm = $db->prepare($sql);
                        if ($stm->execute(array($sid))) {
                            print "<script>alert('User deleted');window.location.assign('users.php')</script>";
                
                        } else {
                            print "<script>alert('Delete fail');window.location.assign('users.php')</script>";
                        }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="row">
                <div class="col-lg-6">
                    <form method="post">
                        <div class="form-group">
                            <label>Names</label>
                            <input class="form-control" type="text" name="names" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="number" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Card number</label>
                            <input class="form-control" type="text" name="card" required>
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-success" name="save"><span class="glyphicon glyphicon-check"></span> Save</button>
                        </div>
                    </form>
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