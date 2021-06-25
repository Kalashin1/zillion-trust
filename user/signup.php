<?php
  require_once('../helper/conn.php');
 require_once('../components/header.php');
 require_once('../helper/user.php');
  // Create an empty errors array to store errors for each form field
 $errors = [];

 if(isset($_POST['submit'])) {
  // print_r($_FILES);
  // print_r($_POST);
  $file_name=$_FILES["img"]["name"];
  $tmp_name=$_FILES["img"]["tmp_name"];
  move_uploaded_file($tmp_name, "upload/".$file_name);

  if(!empty($_POST['first_name'])) {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
  } else {
    $errors['first_name'] = 'Please enter your first name field cannot be blank';
  }

  if (!empty($_POST['middle_name'])) {
    $middle_name = htmlspecialchars(trim($_POST['middle_name']));
  } else {
    $errors['middle_name'] = 'Please enter your middle name, field cannot be blank';
  }
   
  if (!empty($_POST['last_name'])) {
    $last_name = htmlspecialchars(trim($_POST['last_name']));
  } else {
    $errors['last_name'] = 'Please enter your last name, field cannot be blank';
  }

   if(!empty($_POST['email'])) {
    $email = htmlspecialchars(trim($_POST['email']));
  } else {
    $errors['mail'] = 'Please enter your last name, field cannot be blank';
  }

  if(!empty($_POST['password'])) {
    // check if the password and password2 matches then use a regex to test the password strength
    $password = $_POST['password'];
    $password_2 = $_POST['password_2'];
    if($password === $password_2) {
      $password = htmlspecialchars(trim($password));
    } else {
      $errors['password'] = 'Passwords do not match, enter matching password';
    }
  } else {
     $errors['password'] = 'Please enter password and confirm password, fields cannot be blank';
  }

  if (!empty($_POST['phone'])) {
    $phone = htmlspecialchars(trim($_POST['phone']));
  } else {
     $errors['phone'] = 'Please enter phone number, field cannot be blank';
  }

  if (!empty($_POST['username'])) {
    // query the database for a username
    $username = htmlspecialchars(trim($_POST['phone']));
  } else {
     $errors['username'] = 'Please enter your username, field cannot be blank';
  }

  // Generating a random uid for the user
  $uid = uniqid('', true);
  // Generate an account number for them
  $acct_no = uniqid('');

  if (!empty($_POST['acct_type'])) {
    $acct_type = htmlspecialchars(trim($_POST['acct_type']));
  } else {
     $errors['acct_type'] = 'Please select your account type, field cannot be blank';
  }

  if (!empty($_POST['sex'])) {
    // query the database for a username
    $sex = htmlspecialchars(trim($_POST['sex']));
  } else {
     $errors['sex'] = 'Please enter your sex, field cannot be blank';
  }

  if (!empty($_POST['dob'])) {
    $dob = htmlspecialchars(trim($_POST['dob']));
  } else {
     $errors['dob'] = 'Please enter your date of birth, field cannot be blank';
  }

   if (!empty($_POST['marital_status'])) {
    $marital_status = htmlspecialchars(trim($_POST['marital_status']));
  } else {
     $errors['marital_status'] = 'Please select your marital status, field cannot be blank';
  }

   if (!empty($_POST['currency'])) {
    $currency = htmlspecialchars(trim($_POST['currency']));
  } else {
     $errors['currency'] = 'Please select your currency, field cannot be blank';
  }

  $acct_status = 'INACTIVE/DORMANT';
  $reg_date = date("Y-m-d");

  if (!empty($_POST['cot'])) {
    $cot = htmlspecialchars(trim($_POST['cot']));
  } else {
     $errors['cot'] = 'Please enter your cot, field cannot be blank';
  }

  if (!empty($_POST['tax'])) {
    $tax = htmlspecialchars(trim($_POST['tax']));
  } else {
     $errors['tax'] = 'Please enter your tax, field cannot be blank';
  }

  if (!empty($_POST['imf'])) {
    $imf = htmlspecialchars(trim($_POST['imf']));
  } else {
     $errors['imf'] = 'Please your imf, field cannot be blank';
  }

  if (!empty($_POST['pin_auth'])) {
    $pin_auth = htmlspecialchars(trim($_POST['pin_auth']));
  } else {
     $errors['pin_auth'] = 'Please enter your pin_auth, field cannot be blank';
  }

  if (!empty($_POST['pin'])) {
    $pin = htmlspecialchars(trim($_POST['pin']));
  } else {
     $errors['pin'] = 'Please enter your pin, field cannot be blank';
  }

  if (!empty($_POST['currency'])) {
    $currency = htmlspecialchars(trim($_POST['currency']));
  } else {
     $errors['currency'] = 'Please select your currency, field cannot be blank';
  }

  if (!empty($_POST['country'])) {
    $country = htmlspecialchars(trim($_POST['country']));
  } else {
     $errors['country'] = 'Please select your country, field cannot be blank';
  }

  if (!empty($_POST['state'])) {
    $state = htmlspecialchars(trim($_POST['state']));
  } else {
     $errors['state'] = 'Please enter your state, field cannot be blank';
  }

  if (!empty($_POST['city'])) {
    $city = htmlspecialchars(trim($_POST['city']));
  } else {
     $errors['city'] = 'Please enter your city, field cannot be blank';
  }

  
  if (!empty($_POST['zip'])) {
    $zip = htmlspecialchars(trim($_POST['zip']));
  } else {
     $errors['zip'] = 'Please select your zip, field cannot be blank';
  }

  
  if (!empty($_POST['street'])) {
    $street = htmlspecialchars(trim($_POST['street']));
  } else {
     $errors['street'] = 'Please select your street, field cannot be blank';
  }
  // setting the balances
  $book = $avail = $loan = $fixed = $uncleared = 0;

  $limit = 10000;

  $profile_pic = 'dummy';

  if ($errors) {
    print_r($errors);
  } else {
    // the values used to create this user is provided by the creatUser function
    signup($uid, $first_name, $last_name, $middle_name, $email, $password, $phone, $username, $acct_no, $acct_type, $sex, $dob, $reg_date, $marital_status, $acct_status, $currency, $profile_pic, $country, $state, $city, $zip, $street, $book, $avail, $loan, $uncleared, $fixed, $limit, $cot, $tax, $imf, $pin_auth, $pin, $file_name, $conn);
  }

}
?>


	<title>Signup to Zillion trust</title>
</head>
<body>
<!-- login page start-->
<div class="container-fluid p-0"> 
  <div class="row m-0">
    <div class="col-12 p-0">    
      <div class="login-card">
        <div>
          <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/login.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
          <div class="login-main"> 
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
              <h4>Create your account</h4>
              <p>Enter your personal details to create account</p>
              <div class="form-group">
                <label class="col-form-label pt-0">Your Name</label>
                <div class="row g-2">
                  <div class="col-12">
                  	<input class="form-control" name="first_name" type="text" required placeholder="First name">
                  </div>
                  <div class="col-6">
                    <input class="form-control" name="middle_name" type="text" required placeholder="Middle name">
                  </div>
                  <div class="col-6">
                    <input class="form-control" name="last_name" type="text" required placeholder="Last name">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <input class="form-control" name="email" type="email" required placeholder="Test@gmail.com">
              </div>
              <div class="form-group">
                <label class="col-form-label">Phone Number</label>
                <input class="form-control" name="phone" type="text" required placeholder="your phone number">
              </div>
              <div class="form-group">
                <label class="col-form-label">Username</label>
                <input class="form-control" name="username" type="text" required placeholder="your username">
              </div>
              <div class="form-group">
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                  <input class="form-control" type="password" name="password" required placeholder="*********">
                  <div class="show-hide"><span class="show"></span></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-form-label">Confirm Password</label>
                <div class="form-input position-relative">
                  <input class="form-control" type="password" name="password_2" required placeholder="*********">
                  <div class="show-hide"><span class="show"></span></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-12 form-label text-lg-start" for="selectbasic">
                  Sex
                </label>
                <div class="col-lg-12">
                  <select id="selectbasic" name="sex" class="form-control btn-square">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
               <div class="form-group">
                <div class="mb-3 row">
                  <label class="col-form-label" cursorshover="true">Dob</label>
                  <div class="col-sm-12">
                    <input class="form-control digits" name="dob" type="date" value="2018-01-01" data-bs-original-title="" title="" cursorshover="true">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-12 form-label text-lg-start" for="marital-staus">
                  Marital Status-
                </label>
                <div class="col-lg-12">
                  <select id="marital-staus" name="marital_status" class="form-control btn-square">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-12 form-label text-lg-start" for="currency">
                  Currency
                </label>
                <div class="col-lg-12">
                  <select id="currency" name="currency" class="form-control btn-square">
                    <option value="$">$</option>
                    <option value="&pound;">&pound;</option>
                    <option value="&euro;">&euro;</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-12 form-label text-lg-start" for="acct_type">
                  Account Type
                </label>
                <div class="col-lg-12">
                  <select id="acct_type" name="acct_type" class="form-control btn-square">
                    <option value="savings">Saving</option>
                    <option value="current">Current</option>
                    <option value="fixed deposit">Fixed Deposit</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-12 form-label text-lg-start" for="country">
                  Country
                </label>
                <div class="col-lg-12">
                  <select id="country" name="country" class="form-control btn-square">
                    <option value="united states">United States</option>
                    <option value="nigeria">Nigeria</option>
                    <option value="united kingdom">United Kingdom</option>
                    <option value="australia">Australia</option>
                    <option value="south africa">South Africa</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="japan">Japan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-form-label">State/Region</label>
                <input class="form-control" name="state" type="text" required placeholder="your state/region">
              </div>
               <div class="form-group">
                <label class="col-form-label">Town/City</label>
                <input class="form-control" name="city" type="text" required placeholder="enter your town/city">
              </div>
               <div class="form-group">
                <label class="col-form-label">Zip code</label>
                <input class="form-control" name="zip" type="text" required placeholder="Enter your zip code">
              </div>
               <div class="form-group">
                <label class="col-form-label">Street Address</label>
                <input class="form-control" name="street" type="text" required placeholder="Enter your zip code">
              </div>
              <div class="form-group">
                <label class="col-form-label pt-0">Your Codes</label>
                <div class="row g-2">
                  <div class="col-6">
                  	<input class="form-control" name="cot" type="text" required="" placeholder="enter your cot code">
                  </div>
                  <div class="col-6">
                    <input class="form-control" name="tax" type="text" required="" placeholder="Enter your tax code" />
                  </div>
                  <div class="col-6">
                    <input class="form-control" name="imf" type="text" required="" placeholder="Enter your imf code" />
                  </div>
                  <div class="col-6">
                    <input class="form-control" name="pin_auth" type="text" required="" placeholder="Enter your pin auth" />
                  </div>
                  <div class="col-6">
                    <input class="form-control" name="pin" type="text" required="" placeholder="pin">
                  </div>
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="col-form-label" cursorshover="true">Upload Profile Pic</label>
                  <input class="form-control" type="file"
                  name="img" 
                 cursorshover="true" />
              </div> -->
              <div">
							<div class="form-group">
								 <label >Select Passport Picture:</label>
								<input type="file" name="img">
							</div>
						</div>
              <div class="form-group mb-0">
                <div class="checkbox p-0">
                  <input id="checkbox1" type="checkbox">
                  <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
                </div>
                <button class="btn btn-primary btn-block w-100" name="submit" type="submit">Create Account</button>
              </div>
              <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="login">Sign in</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

<?php require_once('../components/footer.php') ?>