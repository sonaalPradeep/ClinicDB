<?php
	session_start();
	if(!isset($_SESSION['patient_id'])) {
		header("Location:patient_login.php");
	}
?>

<!DOCTYPE HTML>

<html>
<head>
	<title>Patient Page</title>
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
	<link rel = "stylesheet" type = "text/css" href = "patient_page.css">
</head>

<?php
	$patient = null;
	$past_visits;
	// if(isset($_POST['patient_scan'])) {
	// 	$id = $_POST['patient_id'];

		$servername = 'localhost';
		$dbname = 'hospitalManagement';
		$username = 'root';
		$password = 'root';

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if(!$conn) {
			die("Connection failed : ". mysqli_connect_error());
		}
		$id = $_SESSION['patient_id'];

		// Need to try to include ISNULL function to show if no medicines were given ISNULL(vpm.medicineName, 'N/A')
		$sql2 = "SELECT V.DandT, D.firstName, dn.DocNotes, GROUP_CONCAT(vpm.medicineName)
					FROM (((visit V INNER JOIN doctor D ON V.docID = D.doctorID)
						INNER JOIN diagnosis dn ON V.visitID = dn.visID)
						LEFT JOIN view_presc_med vpm ON vpm.visitID = V.visitID)
					WHERE V.pID = $id
					GROUP BY V.DandT, D.firstName, dn.DocNotes
					ORDER BY DandT DESC";
		$result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
		$past_visits = array();

		if(mysqli_num_rows($result2) > 0) {
			while($row = mysqli_fetch_assoc($result2)) {
				// echo $row['firstName'];
				array_push($past_visits, $row);
			}
		}

		$sql3 = "SELECT V.DandT, GROUP_CONCAT(t.testName)
					FROM ((visit V INNER JOIN visitAndtest vat ON V.visitID = vat.visID)
						INNER JOIN test t ON t.testID = vat.testID)
					WHERE V.pID = $id
					GROUP BY V.DandT
					ORDER BY DandT DESC";
		$result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
		$tests_cond = array();

		if(mysqli_num_rows($result3) > 0) {
			while($row = mysqli_fetch_assoc($result3)) {
				array_push($tests_cond, $row);
			}
		}
		else {
			// echo "No data found";
		}
		$conn->close();


		$conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

		$id = $_SESSION['patient_id'];
        $sql_new = "SELECT * FROM patient WHERE patientID = $id";
        $result = mysqli_query($conn, $sql_new);
        $patient = array();
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $patient = $row;
            }
        }
	// }
?>

<script>
   var items= <?php echo json_encode($past_visits); ?>;
   // console.log(items[2]); // Output: Bear
   // OR
   // alert(items[0]); // Output: Apple
</script>

<body>
	<div class = "main">
		<div class = 'abc'>
		<h1> Welcome to the Health Centre </h1>
		<div class = 'user_space'>
			<div id='patientDetails' class='patient_details'>
				<?php
					if($patient):
				?>
				<h3>{{name}}</h3>
				<h3>{{designation}}</h3>
				<h3>{{contactno}}</h3>
				<?php
					endif;
				?>
			</div>
		</div>
		</div>



		<?php
			if(isset($past_visits)):
		?>
		<div class="topnav">
  			<a class="active" href="#home">Home</a>
  			<a class="logout" href="patient_login.php">Logout</a>
		</div>

		<div class = "patient_listing">
			<h3><u>Diagnosis Details</u></h3>
			<?php
				echo '<table border=1px border-style=solid>';
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
			<h3><u>List of all tests conducted in descending order of visit</u></h3>
		</div>
		<div class = "test_listing">
			<?php
				echo '<table border=1px border-style=solid>';
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
	<?php
			endif;
	?>
	</div>

	<script>
		var test = <?php echo json_encode($patient); ?>;

		var val = test.firstName + " " + test.lastName;
		console.log(val);
		var pt = new Vue ({
			el:'#patientDetails',
			data: {
				name : val,
				designation : test.Designation,
				contactno : test.contactNo,
			},

		});

	</script>
</body>

</html>
