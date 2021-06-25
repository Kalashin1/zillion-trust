<?php
require_once('../helper/conn.php');
require_once('../components/header.php');
require_once('../helper/user.php');


if(isset($_POST['submit'])) {
	$acct_no;
	$password;
	$errors = [];
	if(!empty($_POST['acct_no'])) {
		$acct_no = htmlspecialchars($_POST['acct_no']);
	} else {
		$errors['acct_no'] = "Please enter an account number";
	}

	if (!empty($_POST['password'])) {
		$password = htmlspecialchars($password);
	} else {
		$errors['acct_no'] = "Please enter your password";
	}

	if(!$errors) {
		$user = login($acct_no, $password, $conn);
    $_SESSION['temp_user'] = $user;
    header('Location: otp.php');
	} else {
		print_r($errors);
	}

}
?>
	<title>Login to your Zillion trust account</title>
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
                    <label class="col-form-label">Account Number</label>
                    <input class="form-control" type="text" name="acct_no" placeholder="48573839.fjfh">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" placeholder="*********">
                      <div class="show-hide"><span class="show">                         </span></div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block w-100" name="submit" type="submit">Sign in</button>
                  </div>
                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="signup.php">Create Account</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php require_once('../components/footer.php') ?>