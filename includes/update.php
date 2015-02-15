<?php
	include_once 'db_connect.php';
	include_once 'functions.php';

	sec_session_start();
	
	$error_msg = "";


	//For password!
	if(isset($_POST['p_old'], $_POST['p_new'])) {
		$password_old = filter_input(INPUT_POST, 'p_old', FILTER_SANITIZE_STRING);
		$password_new = filter_input(INPUT_POST, 'p_new', FILTER_SANITIZE_STRING);
		
		if(strlen($password_new) != 128 || strlen($password_old) != 128) {
			$error_msg .= '<p class="error">Invalid password configuration.</p>';
		}

		if(!isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
			$error_msg .= '<p class="error">Somthing is wrong with the session.</p>';
		}

		$user_id = $_SESSION['user_id'];


		if($stmt = $mysqli->prepare("SELECT salt, password FROM members WHERE id = ? LIMIT 1")) {
			$stmt->bind_param('i', $user_id);
			$stmt->execute();
			$stmt->store_result();

			if($stmt->num_rows == 1) {
				$stmt->bind_result($salt, $password_db);
				$stmt->fetch();

				$user_browser = $_SERVER['HTTP_USER_AGENT'];

				$password_db_check = hash('sha512', $password_db . $user_browser);

				$password_check = hash('sha512', hash('sha512', $password_old . $salt) . $user_browser);

				if($password_check == $password_db_check) {

					if(empty($error_msg)) {
						$stmt->close();

						$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

						$password = hash('sha512', $password_new . $random_salt);

						if($update_stmt = $mysqli->query("UPDATE members SET password='$password', salt='$random_salt' WHERE id='$user_id'")) {

							if($mysqli->affected_rows == 1) {
								$login_string = hash('sha512', $password . $user_browser);
								$_SESSION['login_string'] = $login_string;
								header('Location: ../account-settings');
							}
							else
							{
								
								echo "<p>mysqli->affected_rows != 1</p>";
							}
						}
						else
						{
							
							echo "<p>mysqli->query failed</p>";
						}
					}
					else
					{
						
						echo $error_msg;
					}
				}
				else
				{
					
					echo "<p>The password does not match</p>";
				}
			}
			else
			{
				
				echo "<p>num_rows != 1</p>";
			}
		}
		else
		{
			
			echo '<p>mysqli->prepare failed</p>';
		}
		
	}

	

	//For Email!
	if(isset($_POST['email'])) {

		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

		if(!$email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error_msg .= '<p class="error">The email address you entered is not valid</p>';
		}

		if(!isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
			$error_msg .= '<p class="error">Somthing is wrong with the session.</p>';
		}

		$prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    	$stmt = $mysqli->prepare($prep_stmt);

    	if ($stmt) {
        	$stmt->bind_param('s', $email);
        	$stmt->execute();
        	$stmt->store_result();

        	if ($stmt->num_rows == 1) {
           		$error_msg .= '<p class="error">A user with this email address already exists.</p>';
           		$stmt->close();
       		}

        	$stmt->close();
        }
        else
        {
        	$error_msg .= '<p class="error">Datebase error: 1</p>';
        }

        if(empty($error_msg)) {
			$user_id = $_SESSION['user_id'];

			if($update_stmt = $mysqli->query("UPDATE members SET eamil='$email' WHERE id='$user_id'")) {

				if($mysqli->affected_rows == 1) {
					$_SESSION['email'] = $email;
					header('Location: ../account-settings');
				}
				else
				{
					echo "<p>mysqli->affected_rows != 1</p>";
				}
			}
			else 
			{
				echo '<p>update failed!</p>';
			}
		}
		else
		{
			echo $error_msg;
		}
	}
?>