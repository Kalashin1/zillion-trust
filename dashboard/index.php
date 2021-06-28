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
  $login_date = $_SESSION['user']['login_date'];
  $date = date('Y-m-d: H:i:s');

  $update_date_sql = "UPDATE auth SET last_login_date='$date' WHERE uid='$uid'";

  $update_date_query = mysqli_query($conn, $update_date_sql);
  if($update_date_query) {
    echo "<script>alert('last login date updated successfully $date, previous login date was $login_date')</script>";
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
			  
			  
			  
			  
            <div class="row second-chart-list third-news-update">
             
				 <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
                <div class="card o-hidden profile-greeting">
                  <div class="card-body">
                    <div class="media">
                      <div class="badge-groups w-100 mr-2">
                        <div class="badge f-12"><i class="me-1" data-feather="clock"></i><span id="txt"></span></div>
                        <div style="position: relative; left: -2rem" class="badge f-12"><?php echo date('D d M') ?></div>
                      </div>
                    </div>
                    <div class="greeting-user text-center">
                      <div class="profile-vector"><img class="img-fluid" src="../user/upload/<?php echo $profile_pic ?>" style="height: 110px; border-raduis: 50% !important; width: 200px; object-fit: contain;" alt=""></div>
                      <h4 class="f-w-600"><span id="greeting">Good Morning</span> <span class="right-circle"><i class="fa fa-check-circle f-14 middle"></i></span></h4>
                      <p><span id="location"></span></p>
                      <div class="whatsnew-btn"><a class="btn btn-primary"><?php echo "Your last login date was $login_date"; ?></a></div>
                      <div class="left-icon"><i class="fa fa-bell"> </i></div>
                    </div>
                  </div>
                </div>
              </div>
				

              <div class="col-sm-3 sm-50 chart_data_right box-col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="media align-items-center">
                      <div class="media-body right-chart-content">
                        <h4><?php echo $book ?></h4>
                        <br /><div class="new-box bg-primary p-1"><?php echo $status ?></div>
                        <span>Book Balance</span>
                      </div>
                    </div>
                  </div>
                </div>
				  
				  
				   <div class="card">
                  <div class="card-body">
                    <div class="media align-items-center">
                      <div class="media-body right-chart-content">
                        <h4><?php echo $loan ?></h4>
                        <br /><div class="new-box bg-primary p-1"><?php echo $status ?></div>
                        <span>Loan Balance</span>
                      </div>
                    </div>
                  </div>
                </div>
				  
				   <div class="card">
                  <div class="card-body">
                    <div class="media align-items-center">
                      <div class="media-body right-chart-content">
                        <h4><?php echo $fixed ?></h4>
                        <br /><div class="new-box bg-primary p-1"><?php echo $status ?></div>
                        <span>Fixed Deposit</span>
                      </div>
                    </div>
                  </div>
                </div>
				  
				  
				  
              </div>
				
				 <div class="col-sm-3 sm-50 chart_data_right box-col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="media align-items-center">
                      <div class="media-body right-chart-content">
                        <h4><?php echo $available ?></h4>
                        <br /><div class="new-box bg-primary p-1"><?php echo $status ?></div>
                        <span>Available Balance</span>
                      </div>
                    </div>
                  </div>
                </div>
					 
			 <div class="card">
                  <div class="card-body">
                    <div class="media align-items-center">
                      <div class="media-body right-chart-content">
                        <h4><?php echo $uncleared ?></h4>
                        <br /><div class="new-box bg-primary p-1"><?php echo $status ?></div>
                        <span>Uncleared Balance</span>
                      </div>
                    </div>
                  </div>
                </div>
					 
				 <div class="card">
                  <div class="card-body">
                    <div class="media align-items-center">
                      <div class="media-body right-chart-content">
                        <h4><?php echo $limit ?></h4>
                        <br /><div class="new-box bg-primary p-1"><?php echo $status ?></div>
                        <span>Limits</span>
                      </div>
                    </div>
                  </div>
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
    <script>
      var x = document.getElementById("location");
      function getLocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(successfulLookup);
        } else {
          x.innerHTML = "Geolocation is not supported by this browser.";
        }
      }

  const successfulLookup = async (position) => {
    const { latitude, longitude } = position.coords;
    const res = await fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=adbf51e9bcbc4d2d8b73c3668fecabed`)
    const data = await res.json();
    console.log(data);
    data.results.forEach(obj => {
        x.innerHTML = `Your current location is ${obj.components.state}, ${obj.components.country}`
      })
    } // Or do whatever you want with the result

      getLocation()
    </script>
<!--    <script src="../assets/js/theme-customizer/customizer.js"></script>-->
    <!-- login js-->
    <!-- Plugin used-->
  </body>
</html>