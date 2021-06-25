<?php

require_once('../helper/conn.php');
require_once('../components/header.php');
require_once('../helper/user.php');


if(isset($_POST['submit'])) {
  require_once('../helper/login_mail.php');

  if(!empty($_POST['otp'])) {
    $otp = htmlspecialchars($_POST['otp']);
    $uid = $_SESSION['temp_user']['uid'];
    $otp_sql = "SELECT otp FROM auth WHERE auth.uid='$uid'";
    $otp_query = mysqli_query($conn, $otp_sql);
    if($otp_query) {
      $otp_arr = mysqli_fetch_assoc($otp_query);
      if($otp == $otp_arr['otp']) {
        $user = $_SESSION['temp_user'];
        $_SESSION['user'] = $user;
        $subject = "Login Notification";
        send_mail($user['email'], $message, $subject);
        header('Location: ../dashboard');
      } else {
        echo "<script>alert('incorrect otp try again')</script>";
      }
    } 
  } else {
    echo "<script>alert('please enter the otp sent to your email')</script>";
  }
 
}
?>
	<title>Signup to Zillion trust</title>
</head>
<body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="../assets/images/login/2.jpg" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card">
            <div>
              <div><a class="logo text-start" href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/login.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
              <div class="login-main"> 
                <form class="theme-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                  <h4>Sign in to account</h4>
                  <p>Enter your email & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">OTP</label>
                    <input class="form-control" type="text" name="otp" placeholder="48573839.fjfh">
                  </div>
                  <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block w-100" name="submit" type="submit">Continue To Dashboard</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require_once('../components/footer.php') ?>