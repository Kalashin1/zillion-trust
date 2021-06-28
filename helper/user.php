<?php
	

session_start();

function signup($uid, $first_name, $last_name, $middle_name, $email, $password, $phone, $username, $acct_no, $acct_type, $sex, $dob, $reg_date, $marital_status, $acct_status, $currency, $profile_pic, $country, $state, $city, $zip, $street, $book, $avail, $loan, $uncleared, $fixed, $limit, $cot, $tax, $imf, $pin_auth, $pin, $img, $conn){
		require_once('create_acct_mail_temp.php');
		$date = date('Y-m-d: H:i:s');

		$auth_sql = "INSERT INTO auth(uid, phone, username, password ,email, profile_pic, last_login_date) VALUES('$uid', '$phone', '$username', '$password', '$email', '$img', '$date')";

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

		if($auth_query && $account_query && $bal_query && $address_query && $codes_query ) {
			if($get_user_query) {
				$user = mysqli_fetch_assoc($get_user_query);
				$_SESSION['user'] = $user;
				verifyEmail($email);
				$subject = "Account opening";
				// inform the user that their account has been created
				send_mail($email, $message, $subject);
				// redirect them to the dashboard
				header('Location: dashboard/');
				// print_r($user);
			} else {
				echo mysqli_error($conn);
			}
		} else {
			echo mysqli_error($conn);
		}

	
	 
}


	function login($acct_no, $password, $conn) {
		require_once('otp_mail.php');
		$sql = "SELECT * from account WHERE account.acct_no='$acct_no'";

		$query = mysqli_query($conn, $sql);

		if($query){
			$account = mysqli_fetch_assoc($query);
			$uid = $account['uid'];
			$password_sql = "SELECT password from auth WHERE auth.password='$password'";
			$rand = rand(1123, 9999);
			$otp_sql = "UPDATE auth SET otp='$rand' WHERE auth.uid='$uid'";
			$password_query = mysqli_query($conn, $password_sql);
			if($password_query) {
				$otp_query = mysqli_query($conn, $otp_sql);
				if($otp_query) {
					$subject = "OTP";
					$user = getUser($uid, $conn);
					send_mail($user['email'], $message, $subject);
					return $user;
				} else {
					echo mysqli_error($conn);
				}				
			} else {
				echo "<scritp>alert('incorrect password')</script>";
			}
		} else {
			echo "<scritp>alert('incorrect account number')</script>";
		}
	}

	function logout() {
		session_destroy();
		$_SESSION['user'] = false;
	}

	function send_mail($email, $message, $subject) {
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
		$mail->MsgHTML($message);
		// $mail->AddEmbeddedImage(dirname(__FILE__). '/blue.png', 'logo');
		$mail->Send();
	}

	function getUser ($uid, $conn) {
		$get_user_sql = "SELECT auth.uid, auth.phone, auth.email, auth.username, auth.profile_pic, auth.last_login_date AS login_date, account.first_name, account.last_name, account.middle_name, account.sex, account.dob, account.reg_date, account.marital_status, account.status, account.acct_type, account.acct_no, address.country, address.state, address.city, address.zip_code, address.street, balance.book, balance.available, balance.loan, balance.uncleared, balance.fixed_deposit, balance.limit, codes.cot, codes.tax, codes.imf, codes.pin_auth, codes.pin FROM auth INNER JOIN account ON auth.uid=account.uid INNER JOIN address ON auth.uid=address.uid INNER JOIN balance ON auth.uid=balance.uid INNER JOIN codes ON auth.uid=codes.uid WHERE auth.uid='$uid'";

		$get_user_query = mysqli_query($conn, $get_user_sql);

		if($get_user_query) {
			$user = mysqli_fetch_assoc($get_user_query);
			return $user;
			// print_r($user);
			} else {
				echo mysqli_error($conn);
		}
	}

	function addNextOfKin($uid, $name, $addr, $email, $phone, $relationship, $dob, $conn) {
		require('next_of_kin_mail.php');
		$create_kin_sql = "INSERT INTO next_of_kin(uid, name, address, email, kin_phone, relationship, kin_dob) VALUES('$uid', '$name', '$addr', '$email', '$phone', '$relationship', '$dob')";

		$create_kin_query = mysqli_query($conn, $create_kin_sql);

		// $get_kin_sql = "SELECT * FROM next_of_kin WHERE uid='$uid'";

		if($create_kin_query){
			$user = getUser($uid, $conn);
			$subject = "New Next Of Kin Added";
			send_mail($user['email'], $message, $subject);
			$kin = getNextOfKin($uid, $conn);
			return $kin;
		} else {
			echo mysqli_error($conn);
		}
	}

	function getNextOfKin($uid, $conn) {
		$get_kin_sql = "SELECT * FROM next_of_kin WHERE uid='$uid'";
		$get_kin_query = mysqli_query($conn, $get_kin_sql);

		if($get_kin_query){
			$kin = mysqli_fetch_assoc($get_kin_query);
			return $kin;
		} else {
			echo mysqli_error($conn);
		}
	}


	function transfer ($uid, $acct_no, $acct_type, $bef_name, $bef_email, $bef_phone, $amount, $remark, $conn, $available, $limit, $bank=null) {
		if($bank===null)$bank="zilliontrustcapital";
		$id = uniqid();
		$date = date('Y-m-d');
		// calculate the new balance from available balance
		$new_balance = $available - $amount;
		// prepare the transfer sql
		$transfer_sql = "INSERT INTO transfer(id, uid, bank, account_number, account_type, bef_name, bef_email, bef_phone, amount, type, remark, `date`, bal) VALUES ('$id', '$uid', '$bank', '$acct_no', '$acct_type', '$bef_name', '$bef_email', '$bef_phone', '$amount', 'debit', '$remark', '$date', '$new_balance')";
		// prepare the update sql 
		$update_acct_sql = "UPDATE balance SET available='$new_balance', book='$new_balance' WHERE uid='$uid'";
		// prerare ger record sql
		$get_transfer_sql = "SELECT * FROM transfer WHERE uid='$uid'";
		// if the amount is more than the avialable balance alert the user of insufficient funds
		if($available < $amount) {
			echo "<script>alert('insufficient funds!')</script>";
		} else {
			// if the amount is more than the transaction limit alert the user;
			if($limit < $amount) {
				echo "<script>alert('amount exceeds transaction limit')</script>";
			} else {
				// if everything is ok proceed with transfer query
				$transfer_query = mysqli_query($conn, $transfer_sql);
				// if the query is successfull
				if($transfer_query){
					// proceed with the update query
					$update_acct_query = mysqli_query($conn, $update_acct_sql);
					// if the update query is successful procced to get record query
					if($update_acct_query) {
						// proceed with get record query
						$get_transfer_query = mysqli_query($conn, $get_transfer_sql);
						if($get_transfer_query){
							require('transfer_mail.php');
							// if the record query is successful, fetch and return the record
							// also send the user a mail
							$user = getUser($uid, $conn);
							$subject = "Debit Alert";
							send_mail($user['email'], $message, $subject);
							$record = mysqli_fetch_all($get_transfer_query, MYSQLI_ASSOC);
							return $record;
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
		}
	}

	function getTransferRecord($uid, $transfer_id, $conn){
		$sql = "SELECT * FROM transfer WHERE uid='$uid' AND id='$id'";
		$query = mysqli_query($conn, $sql);

		if($query) {
			$record = mysqli_fetch_assoc($query);
			return $record;
		} else {
			echo mysqli_error($conn);
		}
	}


	function requestLoan($uid, $type, $amount, $duration, $remark, $conn) {
		require('loan_mail.php');
		$id = uniqid();
		$sql = "INSERT INTO loan (id, uid, amount, duration, type, remark, status) VALUES ('$id', '$uid', '$amount', '$duration', '$type', '$remark', 'pending')";
		$query = mysqli_query($conn, $sql);

		if($query) {
			$user = getUser($uid, $conn);
			$subject = "Loan Request";
			send_mail($user['email'], $message, $subject);
			echo "<script>alert('Loan request successful')</script>";
		} else {
			echo mysqli_error($conn);
		}
	}


	function requestCard($uid, $type, $name, $remark, $conn) {
		$id = uniqid();
		$sql = "INSERT INTO card (id, uid, type, card_name, remark, status) VALUES ('$id', '$uid', '$type', '$name', '$remark', 'pending')";
		$query = mysqli_query($conn, $sql);
		$user = getUser($uid, $conn);
		// send_mail($user['email'], $message, 'CARD REQUEST');
		if($query){
			echo "<script>alert('Loan request successful')</script>";
		} else {
			echo mysqli_error($conn);
		}
	}

	function getUserTransfers($uid, $conn){
		$sql = "SELECT transfer.type, transfer.remark, transfer.bef_name, transfer.account_number, transfer.bank, transfer.amount, transfer.date, transfer.bal FROM transfer WHERE transfer.uid='$uid'";
		$query = mysqli_query($conn, $sql);

		if($query){
			$records = mysqli_fetch_all($query, MYSQLI_ASSOC);
			return $records;
		} else {
			echo mysqli_error($conn);
		}
	}

	function verifyEmail($email){
		require_once('email_verification_temp.php');
		$subject = "EMAIL VERIFICATION";
		send_mail($email, $message, $subject);
	}

 ?>