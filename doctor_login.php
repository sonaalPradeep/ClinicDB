<!DOCTYPE html>
<?php
    session_start();
?>

<?php
    if (isset($_POST['login-form'])) {
        $servername = 'localhost';
        $dbname = 'hospitalManagement';
        $username = 'root';
        $password = 'root';
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else {
            $emailID = $_POST['email'];
            $pwd = $_POST['psw'];
            $age = 70;
            //sql binding
            $quries = "SELECT Pwd FROM doctor WHERE doctor.email = $emailID";
            
            $result = mysqli_query($conn, $sql);
            $patient = array();
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['patient_ID'] = $id;
            
                while($row = mysqli_fetch_assoc($result)) {
                    $patient = $row;
                }
            }
            $conn->close();
        }
?>
<html>

<head>
    <title>Doctor Login</title>
    <link rel= "stylesheet" type = "text/css" href= "register_patient.css">
</head>

<body>
<h1>Patient Registration</h1>
  <form style="border:1px solid #ccc" id = "myForm" action = "#" method = "POST">
    <div class="container">
      <h2>Log In</h2>
      <label for="email"><b>Email ID</b></label>
      <input type = "text" placeholder="Enter email" name = "email" required>
      
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <div class="clearfix">
        <button type="submit" class="signupbtn" name="login-form">Log In</button>
      </div>
    </div>
  </form> 
</body>


</html>