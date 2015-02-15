<?php

	function check($email, $key, $mysqli){
		$prep_verify_email = "SELECT * FROM members WHERE email = '$email' and isactive = 1";
		$result_verify_email = mysqli_query($mysqli, $prep_verify_email);

		if(mysqli_num_rows($result_verify_email) == 1){
			return false;
		}
		else
		{
			if(isset($email) && isset($key)) {
				mysqli_query($mysqli, "UPDATE members SET isactive=1 WHERE email='$email' AND hash='$key'") or die(mysqli_error());
				if(mysqli_affected_rows($mysqli) == 1) {
					return true;
				}
				else
				{
					return false;
				}
			
			}
			else
			{
				return false;
			}
		}

		mysqli_close($mysqli);
	}
?>