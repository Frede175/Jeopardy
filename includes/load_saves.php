<?php
	include_once 'db_connect.php';


	$user_id = $_SESSION['user_id'];

	if($stmtsave = $mysqli->query("SELECT name, width, height FROM save WHERE user_id='$user_id' LIMIT 3")) {
		$savedb = array();
		$i = 0;
		while($row = mysqli_fetch_assoc($stmtsave)) {
			$savedb[$i]['name'] = $row['name'];
			$savedb[$i]['width'] = $row['width'];
			$savedb[$i]['height'] = $row['height'];
			$i++;

		}

		print_r(error_get_last());

		if($savedb != '') {
			//Code for table on page!
			foreach ($savedb as $key => $x) {
				echo '<tbody>';
				echo '<tr class="saves">';
				echo '<td>' . $x['name'] . '</td>';
				echo '<td>' . $x['width'] . '</td>';
				echo '<td>' . $x['height'] . '</td>';
				echo "</tr>";
				echo '</tbody>';
			}
		}
		else
		{
			echo '<p>if savedb failed</p>';
			print_r(error_get_last());
		}

	}
	else
	{
		echo '<p>if stmtsave failed</p>';
		print_r(error_get_last());
	}

	if($stmttemp = $mysqli->query("SELECT name, width, height FROM template WHERE user_id='$user_id' LIMIT 3")) {
		$tempdb = array(
			'name'=>array(),
			'width'=>array(),
			'height'=>array()
		);
		while($row = mysqli_fetch_assoc($stmttemp)) {
			$tempdb['name'][] = $row['name'];
			$tempdb['width'][] = $row['width'];
			$tempdb['height'][] = $row['height'];
		}

		if($tempdb != '') {

		}
		else
		{
			echo '<p>If tempdb failed</p>';
			print_r(error_get_last());
		}
	}
	else
	{
		echo '<p>$stmttemp failed</p>';
		print_r(error_get_last());
	}
?>