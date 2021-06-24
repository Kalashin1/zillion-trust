<?php
function createUser($post) {
  if(isset($post['first_name'])) {
    $first_name = htmlspecialchars(trim($post['first_name']));
  } else {
    $errors['first_name'] = 'Please enter your first name field cannot be blank';
  }

  if (isset($post['middle_name'])) {
    $middle_name = htmlspecialchars(trim($post['middle_name']));
  } else {
    $errors['middle_name'] = 'Please enter your middle name, field cannot be blank';
  }
   
  if (isset($post['last_name'])) {
    $last_name = htmlspecialchars(trim($post['last_name']));
  } else {
    $errors['last_name'] = 'Please enter your last name, field cannot be blank';
  }

   if(isset($post['email'])) {
    $email = htmlspecialchars(trim($post['email']));
  } else {
    $errors['mail'] = 'Please enter your last name, field cannot be blank';
  }

  if(isset($post['password'])) {
    // check if the password and password2 matches then use a regex to test the password strength
    $password = $post['password'];
    $password_2 = $post['password_2'];
    if($password === $password_2) {
      $password = htmlspecialchars(trim($password));
    } else {
      $errors['password'] = 'Passwords do not match, enter matching password';
    }
  } else {
     $errors['password'] = 'Please enter password and confirm password, fields cannot be blank';
  }

  if (isset($post['phone'])) {
    $phone = htmlspecialchars(trim($post['phone']));
  } else {
     $errors['phone'] = 'Please enter phone number, field cannot be blank';
  }

  if (isset($post['username'])) {
    // query the database for a username
    $phone = htmlspecialchars(trim($post['phone']));
  } else {
     $errors['username'] = 'Please enter your username, field cannot be blank';
  }

  // Generating a random uid for the user
  $uid = uniqid('', true);
  // Generate an account number for them
  $accound_no = uniqid('');

  if (isset($post['acct_type'])) {
    $acct_type = htmlspecialchars(trim($post['acct_type']));
  } else {
     $errors['acct_type'] = 'Please select your account type, field cannot be blank';
  }

  if (isset($post['sex'])) {
    // query the database for a username
    $sex = htmlspecialchars(trim($post['sex']));
  } else {
     $errors['sex'] = 'Please enter your sex, field cannot be blank';
  }

  if (isset($post['dob'])) {
    $dob = htmlspecialchars(trim($post['dob']));
  } else {
     $errors['dob'] = 'Please enter your date of birth, field cannot be blank';
  }

   if (isset($post['marital_status'])) {
    $marital_status = htmlspecialchars(trim($post['marital_status']));
  } else {
     $errors['marital_status'] = 'Please select your marital status, field cannot be blank';
  }

   if (isset($post['currency'])) {
    $currency = htmlspecialchars(trim($post['currency']));
  } else {
     $errors['currency'] = 'Please select your currency, field cannot be blank';
  }

  $acct_status = 'INACTIVE/DORMANT';
  $reg_date = date("Y/m/d");

  if (isset($post['cot'])) {
    $cot = htmlspecialchars(trim($post['cot']));
  } else {
     $errors['cot'] = 'Please enter your cot, field cannot be blank';
  }

  if (isset($post['tax'])) {
    $tax = htmlspecialchars(trim($post['tax']));
  } else {
     $errors['tax'] = 'Please enter your tax, field cannot be blank';
  }

  if (isset($post['imf'])) {
    $imf = htmlspecialchars(trim($post['imf']));
  } else {
     $errors['imf'] = 'Please your imf, field cannot be blank';
  }

  if (isset($post['pin_auth'])) {
    $pin_auth = htmlspecialchars(trim($post['pin_auth']));
  } else {
     $errors['pin_auth'] = 'Please enter your pin_auth, field cannot be blank';
  }

  if (isset($post['currency'])) {
    $currency = htmlspecialchars(trim($post['currency']));
  } else {
     $errors['currency'] = 'Please select your currency, field cannot be blank';
  }

  if (isset($post['country'])) {
    $country = htmlspecialchars(trim($post['country']));
  } else {
     $errors['country'] = 'Please select your country, field cannot be blank';
  }

  if (isset($post['state'])) {
    $state = htmlspecialchars(trim($post['state']));
  } else {
     $errors['state'] = 'Please enter your state, field cannot be blank';
  }

  if (isset($post['city'])) {
    $city = htmlspecialchars(trim($post['city']));
  } else {
     $errors['city'] = 'Please enter your city, field cannot be blank';
  }

  
  if (isset($post['zip'])) {
    $zip = htmlspecialchars(trim($post['zip']));
  } else {
     $errors['zip'] = 'Please select your zip, field cannot be blank';
  }

  
  if (isset($post['street'])) {
    $street = htmlspecialchars(trim($post['street']));
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
    $new_user = new User();
    // the values used to create this user is provided by the creatUser function
    $user = $new_user->signup($uid, $first_name, $last_name, $middle_name, $email, $password, $phone, $username, $acct_no, $acct_type, $sex, $dob, $reg_date, $marital_status, $acct_status, $currency, $profile_pic, $country, $state, $city, $zip, $street, $book, $avail, $loan, $uncleared, $fixed, $limit, $cot, $tax, $imf, $pin_auth, $pin);

    print_r($user);
  }

}
 ?>