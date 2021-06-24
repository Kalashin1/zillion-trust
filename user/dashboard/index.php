<?php 
session_start();
if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
  $name = $user['first_name'] ." ". $user['middle_name']. " ". $user['last_name']; 
}
require_once('../../helper/conn.php');
require_once('../../components/header.php');
?>

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


<?php require_once('../../components/footer.php') ?>