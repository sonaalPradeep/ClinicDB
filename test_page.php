<!DOCTYPE html>
<html>
<head>  
  <link rel= "stylesheet" type = "text/css" href= "medicine_page.css">
</head>

<?php
  
  if (isset($_POST['test-stock'])) {
    $servername = 'localhost';
    $dbname = 'hospitalManagement';
    $username = 'root';
    $password = 'root';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $testname = $_POST['testname'];
    //sql binding
    $quries = "INSERT INTO test(testName)
                  VALUES (:testname)";
    
    $stmt = $conn->prepare($quries);
    $stmt->bindParam(':testname',$testname);
    $stmt->execute();
    echo "Inserted Successfully";
    $conn = null;
  }

  
?>
<body>
  <h1>Medicine Stock</h1>
  <form style="border:1px solid #ccc" id = "myForm" action = "#" method = "POST">
    <div class="container">
        <h2>Enter Details</h2>
        <p>Please Enter the details of the medicine.</p>
        <hr>
        <label for="testname"><b>Test Name</b></label>
        <input type = "text" placeholder="Medicine Name" name = "testname" required>

        <div class="clearfix">
          <button type="submit" class="signupbtn" name="test-stock">Submit</button>
        </div>
    </div>
  </form> 
  <script>
    document.querySelector("#myForm").addEventListener("submit", function(e){
      var isValid = true;
      
      if(!isValid){
        e.preventDefault();    //stop form from submitting
      }
    });
  </script>
</body>
</html>