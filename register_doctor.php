<!DOCTYPE html>
<html>
<head>  
  <link rel= "stylesheet" type = "text/css" href= "register_patient.css">
</head>

<?php
  
  if (isset($_POST['register-form'])) {
    $servername = 'localhost';
    $dbname = 'hospitalManagement';
    $username = 'root';
    $password = 'root';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phoneno = $_POST['phone_no'];
    $email = $_POST['email'];
    $addr = $_POST['addr'];
    $pwd = $_POST['psw'];
    $working_hr = 0;
    //sql binding
    $quries = "INSERT INTO doctor(firstName, lastName, contactNo, email, addr, workingHr, Pwd)
                  VALUES (:fname, :lname , :contactNo, :email, :addr, :working_hr, :pass)";
    
    $stmt = $conn->prepare($quries);
    $stmt->bindParam(':fname',$fname);
    $stmt->bindParam(':lname',$lname);
    $stmt->bindParam(':contactNo',$phoneno);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':addr',$addr);
    $stmt->bindParam(':working_hr',$working_hr);
    $pwd_encrypt = md5($pwd);
    $stmt->bindParam(':pass',$pwd_encrypt); 
    $stmt->execute();
    echo "Inserted Successfully";
    $conn = null;
  }

  
?>
<body>
  <h1>Doctor Registration</h1>
  <form style="border:1px solid #ccc" id = "myForm" action = "#" method = "POST">
    <div class="container">
      <h2>Sign Up</h2>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="firstname"><b>First Name</b></label>
      <input type = "text" placeholder="Enter First Name" name = "fname" required>
      
      <label for="lastname"><b>Last Name</b></label>
      <input type = "text" placeholder="Enter Last Name" name = "lname" required>
      
      <label for="phnumber"><b>Phone Number</b> </label>
      <input type="tel" placeholder="Enter Phone Number" name="phone_no" min=10 max=10 required>

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="addr"><b>Address</b></label>
      <input type = "text" placeholder="Full Address" name = "addr" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

      <div class="clearfix">
        <button type="button" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn" name="register-form">Sign Up</button>
      </div>
    </div>
  </form> 
  <script>
    // function verify() {
      
    //   console.log("sadasds");
    //   var fname = document.getElementsByName("fname")[0];
    //   console.log(fname);
      
    // }
    document.querySelector("#myForm").addEventListener("submit", function(e){
      var isValid = true;
      
      if(!isValid){
        e.preventDefault();    //stop form from submitting
      }
    });
  </script>
</body>
</html>