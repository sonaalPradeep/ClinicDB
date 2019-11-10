<!DOCTYPE html>
<html>
<head>  
  <link rel= "stylesheet" type = "text/css" href= "medicine_page.css">
</head>

<?php
  
  if (isset($_POST['medicine-stock'])) {
    $servername = 'localhost';
    $dbname = 'hospitalManagement';
    $username = 'root';
    $password = 'root';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $medname = $_POST['medname'];
    $dname = $_POST['dname'];
    $stock = $_POST['stock'];
    //sql binding
    $quries = "INSERT INTO medicine(medicineName, distributer, stock)
                  VALUES (:medname, :dname , :stock)";
    
    $stmt = $conn->prepare($quries);
    $stmt->bindParam(':medname',$medname);
    $stmt->bindParam(':dname',$dname);
    $stmt->bindParam(':stock',$stock);
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
        <label for="medname"><b>Medicine Name</b></label>
        <input type = "text" placeholder="Medicine Name" name = "medname" required>

        <label for="distributer"><b>Distributer Name</b></label>
        <input type = "text" placeholder="Distributer Name" name = "dname" >

        <label for="stock"><b>Stock</b></label>
        <input type="number" placeholder="Total amount" name="stock" require>
        <div class="clearfix">
          <button type="submit" class="signupbtn" name="medicine-stock">Submit</button>
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