<?php
	

session_start();

function signup($uid, $first_name, $last_name, $middle_name, $email, $password, $phone, $username, $acct_no, $acct_type, $sex, $dob, $reg_date, $marital_status, $acct_status, $currency, $profile_pic, $country, $state, $city, $zip, $street, $book, $avail, $loan, $uncleared, $fixed, $limit, $cot, $tax, $imf, $pin_auth, $pin, $conn){
		require_once('create_acct_mail_temp.php');

		$auth_sql = "INSERT INTO auth(uid, phone, username, password ,email) VALUES('$uid', '$phone', '$username', '$password', '$email')";

		$account_sql = "INSERT INTO account(uid, acct_no, acct_type, first_name, last_name, middle_name, sex, dob, reg_date, marital_status, currency, status) VALUES('$uid', '$acct_no', '$acct_type', '$first_name', '$last_name', '$middle_name', '$sex', '$dob', '$reg_date', '$marital_status', '$currency', '$acct_status')";

		$bal_sql = "INSERT INTO balance(uid, book, available, loan, uncleared, fixed_deposit, `limit`) VALUES('$uid', '$book', '$avail', '$loan', '$uncleared', '$fixed', '$limit')";

		$address_sql = "INSERT INTO address(uid, country, state, city, zip_code, street) VALUES ('$uid', '$country', '$state', '$city', '$zip', '$street')";

		$codes_sql = "INSERT INTO codes(uid, cot, tax, imf, pin_auth, pin) VALUES ('$uid', '$cot', '$tax', '$imf', '$pin_auth', '$pin')";

		$auth_query = mysqli_query($conn, $auth_sql);

		$account_query = mysqli_query($conn, $account_sql);

		$bal_query = mysqli_query($conn, $bal_sql);

		$address_query = mysqli_query($conn, $address_sql);

		$codes_query = mysqli_query($conn, $codes_sql);

		$get_user = "SELECT auth.uid, auth.phone, auth.email, auth.username, account.first_name, account.last_name, account.middle_name, account.sex, account.dob, account.reg_date, account.marital_status, account.status, address.country, address.state, address.city, address.zip_code, address.street, balance.book, balance.available, balance.loan, balance.uncleared, balance.fixed_deposit, balance.limit, codes.cot, codes.tax, codes.imf, codes.pin_auth, codes.pin FROM auth INNER JOIN account ON auth.uid=account.uid INNER JOIN address ON auth.uid=address.uid INNER JOIN balance ON auth.uid=balance.uid INNER JOIN codes ON auth.uid=codes.uid WHERE auth.uid='$uid'";

		$get_user_query = mysqli_query($conn, $get_user);

		if($auth_query ) {
			if($account_query) {
				if($bal_query) {
					if($address_query) {
						if($codes_query) {
							if($get_user_query) {
								$user = mysqli_fetch_assoc($get_user_query);
								$_SESSION['user'] = $user;
								$subject = "account opening";
								// inform the user that their account has been created
								// send_mail($email, $message, $subject);
								// redirect them to the dashboard
								header('Location: dashboard/');
								// print_r($user);
							} else {
								echo mysqli_error($conn);
							}
						} else {
							echo mysqli_error($conn);
						}
					} else {
						echo mysqli_error($conn);
					}
				} else {
					echo mysqli_error($conn);
				}
			} else {
				echo mysqli_error($conn);
			}
		} else {
			echo mysqli_error($conn);
		}

	
	 
}

	function logout() {
		session_destroy();
		$_SESSION['user'] = false;
	}

	function send_mail($email, $messag, $subject) {
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "mail.zilliontrustcapital.com";
		$mail->Port = 465;
		$mail->AddAddress($email);
		$mail->Username = "support@zilliontrustcapital.com";
		$mail->Password = "zilliontrustmail";
		$mail->SetFrom('support@zilliontrustcapital.com', 'ZILLION TRUST CAPITAL');
		$mail->AddReplyTo("support@zilliontrustcapital.com", "ZILLION TRUST CAPITAL");
		$mail->Subject = $subject;
		$mail->MsgHTML($messag);
		$mail->AddEmbeddedImage(dirname(__FILE__). '/blue.png', 'logo');
		$mail->Send();
	}



 ?>