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
    if(!empty($_POST['type'])) {
      $type = htmlspecialchars($_POST['type']);
    } else {
      $errors['type'] = "Please select the type of your card";
    }

    if(!empty($_POST['name'])) {
      $name = htmlspecialchars($_POST['name']);
    } else {
      $errors['name'] = "Please provide the name that should be on your card";
    }

    if(!empty($_POST['remark'])) {
      $remark = htmlspecialchars($_POST['remark']);
    } else {
      $remark = "no remark";
    }

    if(empty($errors)) {
      // echo "$type, $remark, $name, $uid";
      requestCard($uid, $type, $name, $remark, $conn);
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
                  <h3>CARD REQUEST</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Request A Card</li>
                   
                  </ol>
                </div>
              </div>
            </div>
          </div>
         <!-- Container-fluid starts-->
          
      <div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
               
          
          
          
                <div class="col-xl-12">
                  <form class="card" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Complete The Form Below To Request A debit/credit card</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                       
              <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label">Select Card Type</label>
                            <select class="form-control btn-square" name="type">
                              <option value="0">--Select--</option>
                              <option value="visa">Visa</option>
                              <option value="master">Master Card</option>
                              <option value="express">American Express</option>
                              <option value="visa prepaid">Visa Prepaid</option>
                            </select>
                          </div>
                        </div>
              
              
               <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Name On Card</label>
                            <input class="form-control" type="text" name="name" placeholder="Specify the name on card">
                          </div>
                        </div>
                       
              
              <div class="col-md-12">
                          <div>
                            <label class="form-label">Remark</label>
                            <textarea class="form-control" name="remark" rows="5" placeholder="Share any special preference with us here"></textarea>
                          </div>
                        </div>
              
              
                       
                       
                       
                      </div>
                    </div>
                   
           <div class="card-footer text-end">
                      <button class="btn btn-primary" name="submit" type="submit">Request</button>
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