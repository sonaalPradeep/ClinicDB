<?php
    session_start();
?>

<!DOCTYPE html>

<html>
<head>
    <title>Doctor</title>
    <link rel= "stylesheet" type = "text/css" href= "doctor_page.css">
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
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM patient WHERE patientID = $id";
        $result = mysqli_query($conn, $sql);
        $patient = array();
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['patient_ID'] = $id;
    
            while($row = mysqli_fetch_assoc($result)) {
                $patient = $row;
            }
        }
        $conn->close();

        // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // $quries = "INSERT INTO visit(DandT, pID, )
        //           VALUES (:fname, :lname , :designation, :email, :dob, :contactNo, :addr, :age, :pass)";
    
        // $stmt = $conn->prepare($quries);
        // $stmt->bindParam(':fname',$fname);
        // $stmt->bindParam(':lname',$lname);
        // $stmt->bindParam(':designation',$designation);
        // $stmt->bindParam(':email',$email);
        // $stmt->bindParam(':dob',$dob);
        // $stmt->bindParam(':contactNo',$phoneno);
        // $stmt->bindParam(':addr',$addr);
        // $stmt->bindParam(':age',$age);
        // $pwd_encrypt = md5($pwd);
        // $stmt->bindParam(':pass',$pwd_encrypt); 
        // $stmt->execute();
        // echo "Inserted Successfully";
        // $conn = null;

        


    }




?>



<body>
    <div class="main">
        <h1> WELCOME DOCTOR </h1>
    </div>

    <div class='user_block'>
        <div class="user_scan">
        <form action="#" method='POST'>
            <label for="patient_id">Enter the Patient ID</label>
            <input type ="text" placeholder="patient ID" name="patient_id" required>

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