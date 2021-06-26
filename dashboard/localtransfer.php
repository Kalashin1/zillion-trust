<?php 
require_once('../helper/conn.php');
require('../helper/user.php');
if(isset($_SESSION['user'])){
  $user = getUser($_SESSION['user']['uid'], $conn);
  $uid = $user['uid'];
  $acct_type = $user['acct_type'];
  $profile_pic = $user['profile_pic'];
  $acct_no = $user['acct_no'];
  $book = $user['book'];
  $available = $user['available'];
  $loan = $user['loan'];
  $fixed = $user['fixed_deposit'];
  $limit = $user['limit'];
  $uncleared = $user['uncleared'];
  $status = $user['status'];
  $name = $user['first_name'] ." ". $user['middle_name']. " ". $user['last_name']; 
  $firt_name = $user['first_name'];
  $middle_name = $user['middle_name'];
  $last_name = $user['last_name'];
  $userame = $user['username'];
  $email = $user['email'];
  $country = $user['country'];
  $state = $user['state'];
  $city = $user['city'];
  $zip = $user['zip_code'];
  $phone = $user['phone'];
  $street = $user['street'];
  $dob = $user['dob'];
  $reg_date = $user['reg_date'];

  if(isset($_POST['submit'])) {
    $errors = [];
    if(!empty($_POST['bef_name'])) {
      $bef_name = htmlspecialchars($_POST['bef_name']);
    } else {
      $errors['bef_name'] = "Please provide the name of your beneficiary";
    }

    if(!empty($_POST['bef_email'])) {
      $bef_email = htmlspecialchars($_POST['bef_email']);
    } else {
      $errors['bef_email'] = "Please provide the email of your beneficiary";
    }

    if(!empty($_POST['bef_acct_no'])) {
      $bef_acct_no = htmlspecialchars($_POST['bef_acct_no']);
    } else {
      $errors['bef_acct_no'] = "Please provide the account number of your beneficiary";
    }

    if(!empty($_POST['bef_acct_type'])) {
      $bef_acct_type = htmlspecialchars($_POST['bef_acct_type']);
    } else {
      $errors['bef_acct_type'] = "Please select the account type for your beneficiary";
    }

    if(!empty($_POST['bef_phone'])) {
      $bef_phone = htmlspecialchars($_POST['bef_phone']);
    } else {
      $errors['bef_phone'] = "Please provide the phone number of your beneficiary";
    }

    if(!empty($_POST['amount'])) {
      $amount = htmlspecialchars($_POST['amount']);
    } else {
      $errors['amount'] = "Please provide the amount for your transaction";
    }

    if(!empty($_POST['bef_bank'])) {
      $bank = htmlspecialchars($_POST['bef_bank']);
    } else {
      $errors['bank'] = "Please provide the bank of your transaction";
    }


    if(!empty($_POST['remark'])) {
      $remark = htmlspecialchars($_POST['remark']);
    } else {
      $remark = "";
    }

    if(empty($errors)) {
      // echo "$bef_name, $bank, $bef_phone, $bef_email, $bef_acct_type, $bef_acct_no, $amount, $remark, $book, $available, $limit";
      $record = transfer($uid, $bef_acct_no, $bef_acct_type, $bef_name, $bef_email, $bef_phone, $amount, $remark, $conn, $available, $limit, $bank);
      // print_r($record);
      echo "<script>alert('transaction successful!')</script>";
    } else {
      print_r($errors);
    } 
  }

} else {
  header('Location: ../user/login.php');
}
require_once('../helper/conn.php');
require_once('../components/header.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-picker.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
    <title>Local Transfer</title>
  </head>
<body onload="startTime()">
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
		<!-- Page Header Start-->
		
		 <?php include '../components/navbar.php';?> 
<!---->
      <!-- Page Header Ends -->
		
		
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
		  
		  
        <!-- Page Sidebar Start-->
       <?php include '../components/sidebar.php';?>
		  
        <!-- Page Sidebar Ends-->
		  
		  
		  
		  
        <div class="page-body">
          <div class="container-fluid">  
		  
            <div class="page-title">
				
				
              <?php include('../components/trading_view.php') ?>
				
				
              <div class="row">
                <div class="col-6">
                  <h3>SAME BANK TRANSFER</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Local Transfer</li>
                   
                  </ol>
                </div>
              </div>
            </div>
          </div>
         <!-- Container-fluid starts-->
          
      <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
               
          
          
          
                <div class="col-xl-8">
                  <form class="card" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Provide Details of Beneficiary Below</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="mb-8">
                            <label class="form-label">Beneficiary Bank</label>
                            <input class="form-control" required name="bef_bank" type="text" placeholder="bank">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-7">
                          <div class="mb-3">
                            <label class="form-label">Beneficiary Acct Number</label>
                            <input class="form-control" required name="bef_acct_no" type="text" placeholder="00044">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Beneficiary Name</label>
                            <input class="form-control" required name="bef_name" type="text" placeholder="Beneficiary Name">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Enter Amount</label>
                            <input class="form-control" required name="amount" type="number" placeholder="000">
                          </div>
                        </div>
            
                        <div class="col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Account Type</label>
                            <select class="form-control  requiredbtn-square" name="bef_acct_type">
                              <option value="savings">Savings</option>
                              <option value="current">Current</option>
                              <option value="fixed_deposit">fixed_deposit</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Enter Beneficiary Email</label>
                            <input class="form-control" required name="bef_email" type="email" placeholder="email@gmail.com">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Beneficiary Phone</label>
                            <input class="form-control" required required name="bef_phone" type="text" placeholder="Beneficiary Phone number">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div>
                            <label class="form-label">Remark</label>
                            <textarea class="form-control" required name="remark" rows="5" placeholder="Enter About your description"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                   
           <div class="card-footer text-end">
                      <button class="btn btn-primary" name="submit" type="submit">Transfer</button>
                    </div>
            
                  </form>
                </div>
              </div>
            </div>
          </div>
      
      
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <?php include '../components/dashboard-footer.php';?>
		  <!-- footer start-->
      </div>
    </div>


<script src="../assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="../assets/js/scrollbar/simplebar.js"></script>
    <script src="../assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="../assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/sidebar-menu.js"></script>
    <script src="../assets/js/chart/chartist/chartist.js"></script>
    <script src="../assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="../assets/js/chart/knob/knob.min.js"></script>
    <script src="../assets/js/chart/knob/knob-chart.js"></script>
    <script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="../assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="../assets/js/dashboard/default.js"></script>
    <script src="../assets/js/notify/index.js"></script>
<!--
    <script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
-->
    <script src="../assets/js/typeahead/handlebars.js"></script>
    <script src="../assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="../assets/js/typeahead/typeahead.custom.js"></script>
    <script src="../assets/js/typeahead-search/handlebars.js"></script>
    <script src="../assets/js/typeahead-search/typeahead-custom.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
<!--    <script src="../assets/js/theme-customizer/customizer.js"></script>-->
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>