<?php
	include_once 'db_connect.php';


	$user_id = $_SESSION['user_id'];

	if($stmtsave = $mysqli->query("SELECT name, width, height, date FROM save WHERE user_id='$user_id' LIMIT 3")) {
		$savedb = array();
		$i = 0;
		while($row = mysqli_fetch_assoc($stmtsave)) {
			$savedb[$i]['name'] = $row['name'];
			$savedb[$i]['width'] = $row['width'];
			$savedb[$i]['height'] = $row['height'];
			$savedb[$i]['date'] = $row['date'];
			$i++;

		}

		print_r(error_get_last());

		echo '<thead>'. 
					'<tr class="theader" >' .
						'<th colspan="10">Savefiles</th>' .
					'</tr>' .
				'</thead>';

		if(!empty($savedb)) {
			//Code for table on page!

			echo '<thead>'. 
					'<tr class="theadline">' .
						'<th>Name</th>' .
						'<th>Width</th>' .
						'<th>Height</th>' .
						'<th>Date</th>' .
						'<th>Action</th>' .
					'</tr>' .
				'</thead>';

			foreach ($savedb as $key => $x) {
				echo '<tbody>';
				echo '<tr class="saves">';
				echo '<td>' . $x['name'] . '</td>';
				echo '<td>' . $x['width'] . '</td>';
				echo '<td>' . $x['height'] . '</td>';
				echo '<td>' . $x['date'] . '</td>';
				echo '<td><a href="includes/process_play.php?name=' . htmlentities($x['name']) . '&type=save"><img src="images/play-button.png" class="play-button"/></a><a href="includes/delete-save.php?name=' . htmlentities($x['name']) . '&type=save"><img src="images/delete-button.png" class="delete-button"/></a></td>';
				echo "</tr>";
				echo '</tbody>';
			}
		}
		else
		{
			echo '<tbody>'. 
					'<tr class="nofiles">' .
						'<td colspan="10">You dont have any saved games</td>' .
					'</tr>' .
				'</tbody>';
		}

	}
	else
	{
		echo '<p>if stmtsave failed</p>';
		print_r(error_get_last());
	}

	if($stmttemp = $mysqli->query("SELECT name, width, height, date FROM template WHERE user_id='$user_id' LIMIT 3")) {
		$tempdb = array();
		$i = 0;
		while($row = mysqli_fetch_assoc($stmttemp)) {
			$tempdb[$i]['name'] = $row['name'];
			$tempdb[$i]['width'] = $row['width'];
			$tempdb[$i]['height'] = $row['height'];
			$tempdb[$i]['date'] = $row['date'];
			$i++;
		}

		echo '<thead>'. 
					'<tr class="theader">' .
						'<th colspan="10">Templates</th>' .
					'</tr>' .
				'</thead>';

		if(!empty($tempdb)) {

			echo '<thead>'. 
					'<tr class="theadline">' .
						'<th>Name</th>' .
						'<th>Width</th>' .
						'<th>Height</th>' .
						'<th>Date</th>' .
						'<th>Action</th>' .
					'</tr>' .
				'</thead>';

			foreach ($tempdb as $key => $x) {
				echo '<tbody>';
				echo '<tr class="saves">';
				echo '<td>' . $x['name'] . '</td>';
				echo '<td>' . $x['width'] . '</td>';
				echo '<td>' . $x['height'] . '</td>';
				echo '<td>' . $x['date'] . '</td>';
				echo '<td><a href="includes/process_play.php?name=' . htmlentities($x['name']) . '&type=template"><img src="images/play-button.png" class="play-button"/></a><a href="includes/delete-save.php?name=' . htmlentities($x['name']) . '&type=template"><img src="images/delete-button.png" class="delete-button"/></a></td>';
				echo "</tr>";
				echo '</tbody>';
			}
		}
		else
		{
			echo '<tbody>'. 
					'<tr class="nofiles">' .
						'<td colspan="10">You dont have any templates</td>' .
					'</tr>' .
				'</tbody>';
		}
	}
	else
	{
		echo '<p>$stmttemp failed</p>';
		print_r(error_get_last());
	}
?>