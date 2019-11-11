<?php
    session_start();
    if(!isset($_SESSION['doctor_id'])) {
        header('Location:doctor_login.php');
    }
    if(!isset($_SESSION['count'])) {
        $_SESSION['count'] = 0;
        $_SESSION['flag'] = 0;
    }
?>

<!DOCTYPE html>

<html>
<head>
    <title>Doctor</title>
    <link rel= "stylesheet" type = "text/css" href= "doctor_page.css">

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='select2.min.js' type='text/javascript'></script>

    <link href='select2.min.css' rel='stylesheet' type='text/css'>

</head>
<?php 
    $patient;
    
    $servername = 'localhost';
    $dbname = 'hospitalManagement';
    $username = 'root';
    $password = 'root';
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql2 = "SELECT medicineID,medicineName FROM medicine";
    $med_result = mysqli_query($conn, $sql2);
    $medicine_names = array();
    if(mysqli_num_rows($med_result) > 0) {
        while($row = mysqli_fetch_assoc($med_result)) {
            array_push($medicine_names, $row);
        }
    }

    $sql10 = 'SELECT testID,testName FROM test'; 
    $test_result = mysqli_query($conn, $sql10);
    $test_names = array();
    if(mysqli_num_rows($test_result) > 0) {
        while($row = mysqli_fetch_assoc($test_result)) {
            array_push($test_names, $row);
        }
    }

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

        $sql2 = "SELECT V.DandT, D.firstName, dn.DocNotes 
                    FROM ((visit V INNER JOIN doctor D ON D.doctorID = V.docID) 
                        INNER JOIN diagnosis dn ON dn.visID = V.visitID) 
                    WHERE V.pID = $id ORDER BY DandT DESC LIMIT 5";

        $result2 = mysqli_query($conn, $sql2);
        $past_visits = array();

        if(mysqli_num_rows($result2) > 0) {
            while($row = mysqli_fetch_assoc($result2)) {
                array_push($past_visits, $row);
            }
        }
        $conn->close();
        
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $quries = "INSERT INTO visit(DandT, pID, docID)
                        VALUES (:datetimenow, :patientID , :docID)";
        date_default_timezone_set('Asia/Calcutta');
        $now = new DateTime();
        $time_val = $now->format('Y-m-d H:i:s');
        $stmt = $conn->prepare($quries);
        $stmt->bindParam(':datetimenow', $time_val);
        $stmt->bindParam(':patientID',$id);
        $docID = $_SESSION['doctor_id'];
        $stmt->bindParam(':docID',$docID);
        $stmt->execute();
        $_SESSION['visitID'] = $conn->lastInsertId();
        
        $_SESSION['count'] = 0;
        $conn = null;
        $_POST['patient_scan'] = null;
    }

    if(isset($_POST['doctor_diagnosis'])) {
        $servername = 'localhost';
        $dbname = 'hospitalManagement';
        $username = 'root';
        $password = 'root';
        
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $quries = "INSERT INTO diagnosis(DocNotes, visID)
                        VALUES (:notes, :visID)";
        
        $stmt = $conn->prepare($quries);

        $stmt->bindParam(':notes', $_POST['diagnosis']);
        $stmt->bindParam(':visID', $_SESSION['visitID']);
        $stmt->execute();
        $diagnosisID = $conn->lastInsertId();

        $quries = "INSERT INTO prescription(diagID)
                         VALUES (:diagID)";
        $stmt = $conn->prepare($quries);
        $stmt->bindParam(':diagID',$diagnosisID);
        $stmt->execute();
        $prescriptionID = $conn->lastInsertId();

        $med_names = [];
        $dosage = [];
        $count = $_SESSION['count'];
        
        $x = 0;

        while($x <= $count) {
            $temp2 = $_POST['medicine_name'.(string)$x];
            $temp3 = $_POST['dosage'.(string)$x];
            array_push($med_names,$temp2);
            array_push($dosage,$temp3);
            $x++;
        }
        
        $quries = "INSERT INTO medprescribed(prescID, medID, dosage)
                             VALUES (:prescID, :medID, :dosage)";
        $x = 0;
        while($x <= $count) {

            $val = $med_names[$x];
            $dos = $dosage[$x];
            $stmt = $conn->prepare($quries);

            $stmt->bindParam(':prescID', $prescriptionID);
            $stmt->bindParam(':medID', $val);
            $stmt->bindParam(':dosage',$dos);
            $stmt->execute();

            //Reducing the stock Count----
            $conn_new = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
            if (!$conn_new) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $stck = $dos * 3;
            $nnn_sql = "UPDATE medicine SET stock=stock-$stck 
                            WHERE medicineID = $val";
            $res = mysqli_query($conn_new,$nnn_sql);
            //----

            $x++;
        }

        $conn = null;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // $test = $_POST['test_sel'];
        // if(sizeof($test) != 0) {
        //     print_r($test);
        //     $quries = "INSERT INTO visitAndtest(visID, testID)
        //                          VALUES (:visID, :testID)";
        //     foreach($test as $val) {
        //         $stmt = $conn->prepare($quries);
        //         $stmt->bindParam(':visID', $_SESSION['visitID']);
        //         $stmt->bindParam(':testID', $val);
        //         $stmt->execute();
        //     }
        // }
        $test = $_POST['test_sel'];
        print_r($test);
        $quries = "INSERT INTO visitAndtest(visID, testID)
                             VALUES (:visID, :testID)";
        foreach($test as $val) {
            $stmt = $conn->prepare($quries);
            $stmt->bindParam(':visID', $_SESSION['visitID']);
            $stmt->bindParam(':testID', $val);
            $stmt->execute();
        }
    }
?>
<script>
$(document).ready(function(){
            $("#selMedicine").select2();

});
</script>

<body>
    <div class="main">
        <h1> WELCOME DOCTOR </h1>

        <div class="topnav">
            <a class="active" href="#home">Home</a>
            <a class="logout" href="doctor_login.php">Log Out</a>
        </div> 

        <?php 
            if(isset($patient)):
        ?>
        <div id='result' class="diagnosis">
            <form action="#" method='POST' class='report'>

                <label for="Report"><b>Diagnosis Report</b></label>
                <textarea type="text" name= "diagnosis" placeholder="Enter the diagnosis Report of the Patient" rows="10" columns="40"></textarea>
                
                <label for="medicine"><b>Select Medicine</b></label>
                <div class='med'>
                    <table id="medAdd">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Dosage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="medicine_name0">
                                    <?php 
                                        foreach($medicine_names as $med_name) {
                                            echo '<option value="'.$med_name['medicineID'].'">'.$med_name['medicineName'].'</option>';
                                        } 
                                    ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name='dosage0' placeholder='Enter the number of days'>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button background-color='#f1f1f1' class='add' type='button' onclick="myfunction()">Add</button>
                    
                </div>

                    
                <label for="Reference"><b>Reference</b></label>
                <textarea type="text" name="reference" placeholder="Enter the reference details" rows="10" columns="40"></textarea>

                <label for="test"><b>Test</b></label>
                <!-- <textarea type="text" name="test" placeholder="Enter the test details" rows="10" columns="40"></textarea>
                 -->
                <select multiple id='selMedicine' class="medicine_sel" name="test_sel[]" placeholder="select Medicine">
                    <?php 
                        foreach($test_names as $med_name) {
                            echo '<option value="'.$med_name['testID'].'">'.$med_name['testName'].'</option>';
                        } 
                    ?>
                </select>
                
                <button type="submit" name="doctor_diagnosis" id="but_read">Submit</button>


            </form>
        </div>
        <?php 
            endif;
        ?>
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

            <p><?="ID :  ".$patient['patientID'];?></p>

            <h3><?=$patient['firstName']."   ".$patient['lastName'];?></h3>

            <p><?=$patient['email'];?></p>

            <p><?=$patient['contactNo'];?></p>

            <p>
                <?php
                    $from = $patient['dob'];
                    $to = new DateTime('today');

                    echo $patient['dob']." (".date_diff(date_create($patient['dob']), date_create('today'))->y.") ";
                ?>
            </p>
        </div>
        <div class="user_history">
            <h4><u>Patient History</u></h4>
            <?php
                echo '<table align = "center">';
                echo '<tr><th>Visiting Date and Time</th>
                <th>Doctor name</th>
                <th>Diagnosis</th></tr>';

                foreach( $past_visits as $past_visit)
                {
                    echo '<tr>';
                    foreach( $past_visit as $val )
                    {
                        if($val == '') {
                            echo '<td>'.'--'.'</td>';    
                        }
                        else {
                            echo '<td>'.$val.'</td>';
                        }
                        
                    }
                    echo '</tr>';
                }
                echo '</table>';
            ?>

        </div>
        <?php endif; ?>
    </div>
    <script>
        
        function myfunction() {
            <?php 
                $_SESSION['count']++;
            ?>

            var count = <?php echo $_SESSION['count']; ?>;
            console.log(count);
            
            var med_n = <?php echo json_encode($medicine_names); ?>;
            
            var final_str = [];
            for(i = 0; i<med_n.length;i++) {
                var str = "<option value='" + med_n[i].medicineID + "'>" + med_n[i].medicineName + "</option>";
                final_str = final_str + str;
                
            }
            var new_row="<tr><td><select name='medicine_name"+ count +"'>"+ final_str +"</td><td><input type='number' name='dosage"+ count +"' placeholder='Enter the number of days'></td></tr>";
            $('#medAdd').append(new_row);

        }
    </script>
</body>


</html>