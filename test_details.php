<!DOCTYPE html>

<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel= "stylesheet" type = "text/css" href= "medicine_details.css">
</head>

<?php
    $medicine_details;
    $servername = 'localhost';
    $dbname = 'hospitalManagement';
    $username = 'root';
    $password = 'root';
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM test";
    $result = mysqli_query($conn, $sql);
    $medicine_details = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($medicine_details,$row);
        }
    }

    $conn = null;
?>
<body>
    <h1> TEST DETAILS</h1>
    <div id="med_div" class = 'medicine'>
    <table id="medicine-details">
    <thead>
        <tr>
            <th>ID</th>
            <th>Medicine Name</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="m in med_details">
            <td>{{m.testID}}</td>
            <td>{{m.testName}}</td>
            
        </tr>
    </tbody>
    </table>
    </div>
   
<script>
    var details = new Vue ({
        el: '#med_div',
        data: {
            med_details : <?php echo json_encode($medicine_details); ?>,
        },
    });
</script>

</body>


</html>