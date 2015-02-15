<?php
	include_once 'db_connect.php';
	include_once 'psl-config.php';
	require_once 'Mail/Mail.php';

	$error_msg = "";

	if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.

    

    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    
    $stmt = $mysqli->prepare($prep_stmt);
    //$mysqli->prepare("SELECT id FROM members WHERE email = ? LIMIT 1");
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
            $stmt->close();
        }

        $stmt->close();
    } else {
    	printf("Error: %d.\n", mysqli_stmt_error($stmt));
        $error_msg .= '<p class="error">Database error Line 39</p>';
        $stmt->close();
    }
 
    // check existing username

    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare("SELECT id FROM members WHERE username = ? LIMIT 1");
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
                        // A user with this username already exists
            $error_msg .= '<p class="error">A user with this username already exists</p>';
            $stmt->close();
        }
        $stmt->close();
    }
    else 
    {
    	$error_msg .= '<p class="error">Database error line 55</p>';
    	$stmt->close();
    }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
 		$hash = md5(uniqid(rand(), true));
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt, hash) VALUES (?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('sssss', $username, $email, $password, $random_salt, $hash);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
            else
            {

	        	$subject = "Activate your email";

	        	$to = '<' . $email . '>';

	        	$from = "<jeopardywebs@gmail.com>";
	        	$contenttype =  "text/html; charset=ISO-8859-1\r\n\r\n";

	        	$headers = array(
	    			'From' => $from,
	    			'To' => $to,
	    			'Subject' => $subject,
  					'MIME-Version' => "1.0",
	    			'Content-Type' => $contenttype
				);

	        	$url = BASE_PATH . '/verify.php?email=' . urlencode($email) . "&key=$hash";

	        	$message ='<p>To activate your account please click on Activate buttton</p>';
				$message.='<table cellspacing="0" cellpadding="0"> <tr>';
				$message .= '<td align="center" width="300" height="40" bgcolor="#000091" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">';
				$message .= '<a href="'.$url.'" style="color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">Click to Activate</a>';

				$message .= '</td> </tr> </table>';

				$smtp = Mail::factory('smtp', array(
	        		'host' => 'smtp.gmail.com',
	        		'port' => '587',
	        		'auth' => true,
	        		'username' => 'jeopardywebs@gmail.com',
	        		'password' => EMAILPASS
	    		));

				$mail = $smtp->send($to, $headers, $message);

				if(PEAR::isError($mail)) {
					    echo('<p>' . $mail->getMessage() . '</p>');
				} else {
	   				header('Location: ./register_success.php');
				}
        	}
        }
    }
}
?>