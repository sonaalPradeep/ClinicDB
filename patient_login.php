<!DOCTYPE HTML>
<?php
  session_start()
?>

<?php

  $servername = 'localhost';
  $dbname = 'hospitalManagement';
  $username = 'root';
  $password = 'root';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn) {
    die("Connection failed : ". mysqli_connect_error());
  }

  if(isset($_POST['username'])) {
    $uname = $_POST['username'];
    $upass = $_POST['password'];


    $sql = "SELECT * FROM patient WHERE patientID = $uname AND Pwd = $upass LIMIT 1";
    $result = mysqli_query($sql);

    if(mysqli_num_rows($result) == 1){

    }
    else {

    }
  }

  $conn->close();

?>

<html>
  <head>
    <title>Patient Login</title>
    <link rel= "stylesheet" type = "text/css" href= "patient_login.css">
   </head>

  <body>

    <h1>Welcome to the Health Centre</h1>
    <form class="box" action="patient_page.php" method="POST">
      <h1>Patient Login</h1>
      <input type="text" name = "username" placeholder="Username">
      <input type="password" name = "password" placeholder="Password">
      <input type="submit" name = "" value="Login">
    </form>
  </body>
</html>
