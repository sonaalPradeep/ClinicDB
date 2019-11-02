<?php
	session_start()
?>

<!DOCTYPE HTML>

<html>
<head>
	<title>Patient Page</title>
	<link rel = "stylesheet" type = "text/css" href = "patient_page.css">
</head>

<?php
	$patient;
	if(isset($_POST['patient_scan'])) {
		$id = $_POST['patient_id'];

		$servername = 'localhost';
		$dbname = 'hospitalManagement';
		$username = 'root';
		$password = 'root';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if(!$conn) {
			die("Connection failed : ". mysqli_connect_error());
		}

		$sql = "SELECT * FROM patient WHERE patientID = $id";
		$result = mysqli_query($conn, $sql);
		$patient = array();

		if(mysqli_num_rows($result) > 0) {
			$_SESSION['patient_ID'] = $id;

			while($row = mysqli_fetch_assoc($result)) {
				$patient = $row;
			}

		}

		// Need to try to include ISNULL function to show if no medicines were given ISNULL(vpm.medicineName, 'N/A')
		$sql2 = "SELECT V.DandT, D.firstName, dn.DocNotes, vpm.medicineName FROM (((visit V INNER JOIN doctor D ON V.docID = D.doctorID) INNER JOIN diagnosis dn ON V.visitID = dn.visID) LEFT JOIN view_presc_med vpm ON vpm.visitID = V.visitID) WHERE V.pID = $id ORDER BY DandT DESC";
		$result2 = mysqli_query($conn, $sql2);
		$past_visits = array();

		if(mysqli_num_rows($result2) > 0) {
			while($row = mysqli_fetch_assoc($result2)) {
				array_push($past_visits, $row);
			}
		}

		$sql3 = "SELECT V.DandT, t.testName FROM ((VISIT V INNER JOIN visitAndTest vat ON V.visitID = vat.visID) INNER JOIN test t ON t.testID = vat.testID)) WHERE V.pID = $id ORDER BY DandT DESC";
		$result3 = mysqli_query($conn, $sql3);
		$tests_cond = array();

		if(mysqli_num_rows($result3) > 0) {
			while($row = mysqli_fetch_assoc($result3)) {
				array_push($tests_cond, $row);
			}
		}



		$conn->close();
	}
?>

<body>
	<div class = "main">
		<h1><u> Welcome to the Health Centre </u></h1>

		<div class = "patient_listing">
			<h3><u> List of all diagnosis in descending order of visit </u></h3>

			<?php
				echo '<table border="1" align = "center">';
				echo '<tr><th>Visiting date and Time</th>
				<th>Doctor name</th>
				<th>Diagnosis</th>
				<th>Medicine Name</th></tr>';

				foreach( $past_visits as $past_visit)
				{
					echo '<tr>';
					foreach( $past_visit as $val )
					{
						echo '<td>'.$val.'</td>';
					}
					echo '</tr>';
				}
				echo '</table>';
			?>
			<br>
			<h3><u> List of all tests conducted in descending order of visit </u></h3>

			<?php
				echo '<table border="1" align = "center">';
				echo '<tr><th>Visiting date and Time</th>
				<th>Test Name</th></tr>';

				foreach( $tests_cond as $test_cond)
				{
					echo '<tr>';
					foreach( $test_cond as $val )
					{
						echo '<td>'.$val.'</td>';
					}
					echo '</tr>';
				}
				echo '</table>';
			?>


		</div>

	</div>

	<div class = 'user_block'>
		<div class = 'user_scan'>
			<form action="#" method="POST">
				<label for="patient_id">Enter the Patient ID</label>
				<input type="text" placeholder="patient ID" name="patient_id" required>

				<button type="submit" name="patient_scan">Submit</button>
			</form>
			<a href = "register_patient.php"><button name="patient_logout">Logout</button></a>
		</div>

        <?php 
            if(isset($patient)):
            
        ?>
        <div class="user_info">
            
            <img id='image' src='user2.png' alt='user'>
            <p>
            <?=
                "ID :  ".$patient['patientID'];
            ?>
            </p>
            <h3>
            <?=
               $patient['firstName']."   ".$patient['lastName'];
            ?>
            </h3>
            <p>
            <?=
                $patient['email'];
            ?>
            </p>
            <p>
            <?=
                $patient['contactNo'];
            ?>
            </p>
            <p>
            <?php
                $from = $patient['dob'];
                $to = new DateTime('today');

                echo $patient['dob']." (".date_diff(date_create($patient['dob']), date_create('today'))->y.") ";
            ?>
            </p>
        </div>
        
        <?php
            endif;
        ?>

	</div>
</body>

</html>
