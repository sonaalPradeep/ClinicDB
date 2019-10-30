<!DOCTYPE html>
<html>
<head>  
  <link rel= "stylesheet" type = "text/css" href= "register.css">
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
    $designation = $_POST['designation'];
    $email = $_POST['email'];
    $dob = $_POST['bday'];
    $phoneno = $_POST['phone_no'];
    $addr = $_POST['addr'];
    $pwd = $_POST['psw'];
    $age = 70;
    //sql binding
    $quries = "INSERT INTO patient(firstName, lastName, Designation, email, dob, contactNo, addr, Age, Pwd)
                  VALUES (:fname, :lname , :designation, :email, :dob, :contactNo, :addr, :age, :pass)";
    
    $stmt = $conn->prepare($quries);
    $stmt->bindParam(':fname',$fname);
    $stmt->bindParam(':lname',$lname);
    $stmt->bindParam(':designation',$designation);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':dob',$dob);
    $stmt->bindParam(':contactNo',$phoneno);
    $stmt->bindParam(':addr',$addr);
    $stmt->bindParam(':age',$age);
    $pwd_encrypt = md5($pwd);
    $stmt->bindParam(':pass',$pwd_encrypt); 
    $stmt->execute();
    echo "Inserted Successfully";
    $conn = null;
  }

  
?>
<body>
  
  <form style="border:1px solid #ccc" id = "myForm" action = "#" method = "POST">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="firstname"><b>First Name</b></label>
      <input type = "text" placeholder="Enter First Name" name = "fname" required>
      
      <label for="lastname"><b>Last Name</b></label>
      <input type = "text" placeholder="Enter Last Name" name = "lname" required>
      
      <label for="designation"><b>Designation</b></label><br>
      <input type = "radio" name = "designation" value = "faculty" checked> Faculty
      <input type = "radio" name = "designation" value = "student" checked> Student
      <br>
      <br>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="dob"><b>Date of Birth</b> </label>
      <input type="date" name="bday" required>
      
      <label for="phnumber"><b>Phone Number</b> </label>
      <input type="tel" placeholder="Enter Phone Number" name="phone_no" min=10 max=10 required>

      
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