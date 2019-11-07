<!DOCTYPE HTML>
<?php
  session_start();
  $_SESSION['patient_id'] = null;
?>

<?php
  if(isset($_POST['patient_login'])) {
    $servername = 'localhost';
    $dbname = 'hospitalManagement';
    $username = 'root';
    $password = 'root';

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn) {
      die("Connection failed : ". mysqli_connect_error());
    }
    else {
      $uname = $_POST['username'];
      $upass = $_POST['password'];
      $upass = md5($upass);

      $sql = "SELECT * FROM patient WHERE email = '$uname'";
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
          if($row['Pwd'] == $upass) {
            $_SESSION['patient_id'] = $row['patientID'];
            header("Location:patient_page.php");
          }
          else {
            echo "<p class = login_verification>Invalid password</p>";
          }
        }
      }
      else {
        echo "<p class = login_verification>Invalid email</p>";
      }
    }
  
    $conn->close();
  }

  

?>

<html>
  <head>
    <title>Patient Login</title>
    <link rel= "stylesheet" type = "text/css" href= "patient_login.css">
   </head>

  <body>

    <h1>Welcome to the Health Centre</h1>
    <form class="box" action="#" method="POST">
      <h1>Patient Login</h1>
      <input type="text" name = "username" placeholder="Username">
      <input type="password" name = "password" placeholder="Password">
      <input type="submit" name = "patient_login" value="Login">
    </form>
  </body>
</html>
