<?php
require_once('../helper/conn.php');
require('../helper/user.php');
if(isset($_SESSION['user'])){
  $user = getUser($_SESSION['user']['uid'], $conn);
  $acct_type = $user['acct_type'];
  $uid = $user['uid'];
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
  $first_name = $user['first_name'];
  $middle_name = $user['middle_name'];
  $last_name = $user['last_name'];
  $username = $user['username'];
  $email = $user['email'];
  $country = $user['country'];
  $state = $user['state'];
  $city = $user['city'];
  $zip = $user['zip_code'];
  $phone = $user['phone'];
  $street = $user['street'];
  $phone = $user['phone'];
  $dob = $user['dob'];
  $reg_date = $user['reg_date'];

  if(isset($_POST['kin_submit'])){
    $errors = [];
    if(!empty($_POST['kin_name'])){
      $name = htmlspecialchars($_POST['kin_name']);
    } else {
      $errors['name'] = "Please enter a name";
    }

    if(!empty($_POST['kin_email'])){
      $email = htmlspecialchars($_POST['kin_email']);
    } else {
      $errors['email'] = "Please enter an email";
    }

    if(!empty($_POST['kin_address'])) {
      $address = htmlspecialchars($_POST['kin_address']);
    } else {
      $errors['address'] = "Please enter an address";
    }

    if(!empty($_POST['kin_phone'])) {
      $phone = htmlspecialchars($_POST['kin_phone']);
    } else {
      $errors['phone'] = "Please enter a phone number";
    }

    if(!empty($_POST['relationship'])) {
      $relationship = htmlspecialchars($_POST['relationship']);
    } else {
      $errors['relationship'] = "Please enter your relationship with next of kin";
    }

    if(!empty($_POST['kin_dob'])) {
      $dob = htmlspecialchars($_POST['kin_dob']);
    } else {
      $errors['kin_dob'] = "Please enter the date of birth of next of kin";
    }

    if(empty($errors)) {
      // echo "$name $email $address $phone $relationship $dob $uid";
      $kin = addNextOfKin($uid, $name, $address, $email, $phone, $relationship, $dob, $conn);
      print_r($kin);
      $kin_name = $kin['name'];
      $kin_email = $kin['email'];
      $kin_addr = $kin['address'];
      $kin_phone = $kin['kin_phone'];
      $kin_relationship = $kin['relationship'];
      $kin_dob = $kin['kin_dob'];
    } else {
      echo $errors;
    }
  }

  $kin = getNextOfKin($uid, $conn);
  $kin_name = $kin['name'];
  $kin_email = $kin['email'];
  $kin_addr = $kin['address'];
  $kin_phone = $kin['kin_phone'];
  $kin_relationship = $kin['relationship'];
  $kin_dob = $kin['kin_dob'];


} else {
  header('Location: ../user/login.php');
}

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
                  <h3>Dashboard</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                   
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          
			<div class="container-fluid">
            <div class="edit-profile">
              <div class="row">
                <div class="col-xl-4">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">UPDATE PROFILE</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                     
						<form>
                        <div class="row mb-2">
                          <div class="profile-title">
                            <div class="media">                        <img class="rounded-circle" alt="" style="object-fit: cover; width: 80px;" src="../user/upload/<?php echo $profile_pic ?>">
                              <div class="media-body">
                                <h5 class="mb-1"><?php echo $name ?></h5>
                                <p><?php echo $acct_no ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Email Address</label>
                          <input class="form-control" readonly value="<?php echo $email ?>">
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Phone Number</label>
                          <input class="form-control" type="text" readonly value="<?php echo $phone ?>">
                        </div>
                       
                        <!-- <div class="form-footer">
                          <button class="btn btn-primary btn-block">Save</button>
                        </div> -->
						  
                      </form>
						
						<hr>
						
						<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">							
							<br>
							
						 <h4 class="card-title mb-0">NEXT OF KIN</h4>	
                       <p> 
          							<div class="mb-3">
                          <label class="form-label">Full Name</label>
                          <input class="form-control" name="kin_name" type="text" placeholder="Enter name of next of kin" value="<?php echo $kin_name ?>">
                        </div>
                        
            						<div class="mb-3">
                          <label class="form-label">Address</label>
                          <input class="form-control" name="kin_address" type="text" placeholder="Enter address of next of kin" value="<?php echo $kin_addr ?>">
                        </div>
							
            						<div class="mb-3">
                          <label class="form-label">Email</label>
                          <input class="form-control" type="email" name="kin_email" placeholder="Enter next of kin Email" value="<?php echo $kin_email ?>">
                        </div>
							
            						<div class="mb-3">
                          <label class="form-label">Phone</label>
                          <input class="form-control" name="kin_phone" type="text" placeholder="Enter phone number of next of kin" value="<?php echo $kin_phone ?>">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Relationship with next of kin</label>
                          <input class="form-control" name="relationship" type="text" placeholder="Enter relationship with next of kin" value="<?php echo $kin_relationship ?>">
                        </div>

                        <div class="mb-3">
                          <label class="col-form-label" cursorshover="true">Dob</label>
                          <div class="col-sm-12">
                            <input class="form-control digits" name="kin_dob" type="date" data-bs-original-title="" title="" cursorshover="true" placeholder="Enter date of birth of next of kin" value="<?php echo $kin_dob ?>">
                          </div>
                        </div>
                       
                        <div class="form-footer">
                          <?php if(!isset($kin_name)) { ?>
                            <button  class="btn btn-primary btn-block" type="submit" name="kin_submit">
                              Save
                            </button>
                          <?php }?>
                        </div>
						  </p>
                      </form>
						
						
						
						
						
                    </div>
                  </div>
                </div>
				  
				  
                <div class="col-xl-8">
                  <form class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Personal Details</h4>
                      <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input class="form-control" type="text" readonly value="<?php echo $first_name ?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Middle Name</label>
                            <input class="form-control" type="text" readonly value="<?php echo $middle_name ?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input class="form-control" type="text" readonly value="<?php echo $last_name ?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input class="form-control" type="email" readonly value="<?php echo $email ?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input class="form-control" type="text" readonly value="<?php echo $username ?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">DOB</label>
                            <input class="form-control" type="text" readonly value="<?php echo $dob ?>">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input class="form-control" type="text" readonly value="<?php echo $street ?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="mb-3">
                            <label class="form-label">City</label>
                            <input class="form-control" type="text" readonly value="<?php echo $city ?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                          <div class="mb-3">
                            <label class="form-label">Postal Code</label>
                            <input class="form-control" type="text" readonly value="<?php echo $zip ?>">
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="mb-3">
                            <label class="form-label">Country</label>
                            <input class="form-control" type="text" readonly value="<?php echo $country ?>">
                          </div>
                        </div>
                        <!-- <div class="col-md-12">
                          <div>
                            <label class="form-label">About Me</label>
                            <textarea class="form-control" rows="5" placeholder="Enter About your description"></textarea>
                          </div>
                        </div> -->
                      </div>
                    </div>
<!--
                    <div class="card-footer text-end">
                      <button class="btn btn-primary" type="submit">Update Profile</button>
                    </div>
-->
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