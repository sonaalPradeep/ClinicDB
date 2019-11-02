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

		$sql2 = "SELECT V.DandT, D.firstName, dn.DocNotes from ((visit V INNER JOIN doctor D ON V.docID = D.doctorID) INNER JOIN diagnosis dn ON V.visitID = dn.visID) WHERE pID = $id";
		$result2 = mysqli_query($conn, $sql2);
		$past_visits = array();

		if(mysqli_num_rows($result2) > 0) {
			while($row = mysqli_fetch_assoc($result2)) {
				array_push($past_visits, $row);
			}
		}

		$conn->close();
	}
?>

<body>
	<div class = "main">
		<h1> WELCOME PATIENT </h1>

		<div class = "patient_listing">
			<h3> List of all diagnosis in descending order of visit </h3>

			<?php  
			$len = count($past_visits);
			$i = 0;
        	for($i = 0; $i < $len; $i++) {
            	echo $past_visits[$i]["DandT"]." | ".$past_visits[$i]["firstName"]." | ".$past_visits[$i]["DocNotes"]."<br>";
        	}

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
