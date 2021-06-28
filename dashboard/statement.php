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


  $records = getUserTransfers($uid, $conn);

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
    <title><?php echo($name) ?> - Dashboard</title>
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
                  <h3>BANK STATEMENT</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Bank Records</li>
                   
                  </ol>
                </div>
              </div>
            </div>
          </div>
         <!-- Container-fluid starts-->
          
      <div class="container-fluid">
            
        
        <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Transaction history & Statement</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="table-responsive add-project">
                      <table class="table card-table table-vcenter text-nowrap">
                        <thead>
                          <tr>
                            <th>DATE</th>
                            <th>DESCRIPTION</th>
                            <th>DEBITS</th>
                            <th>CREDIT</th>
                            <th>BALANCE</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($records as $record) { ?>
                            <tr>
                              <td><a class="text-inherit" href="#"><?php $date = $record['date'];
                              echo $date;
                               ?></a></td>
                              <td><?php $remark = $record['remark'];echo $remark."\n".$record['bank']. " Bank ".$record['account_number']." ".$record['bef_name']; ?></td>
                              <td><?php if($record['type']=='debit'){$amount = $record['amount']; echo $amount;} ?></td>
                              <td><?php if($record['type']=='credit'){echo 0.0; } ?></td>
                              <td><?php echo $record['bal']; ?></td>
                            </tr>
                          <?php } ?>
                          
             <!--  <tr>
                            <td><a class="text-inherit" href="#">Untrammelled prevents </a></td>
                            <td>28 May 2018</td>
                            <td><span class="status-icon bg-success"></span> $0</td>
                            <td>$56,908</td>
              <td>$56,908</td>  
                           
                          </tr> -->
              
                          
              
                         
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
        
        
        
        
        
        
          </div>
      
      
          <!-- Container-fluid Ends-->
      
      
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