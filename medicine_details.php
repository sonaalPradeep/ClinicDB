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
    
    $sql = "SELECT * FROM medicine";
    $result = mysqli_query($conn, $sql);
    $medicine_details = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($medicine_details,$row);
        }
    }

    if(isset($_POST['changeBtn'])) {
        $stck = $_POST['stock'];
        $id = $_POST['medID'];
        $sql = "UPDATE medicine SET stock=stock+$stck 
                    WHERE medicineID = $id";
        $res = mysqli_query($conn,$sql);
        if($res) {
            echo "Inserted Successfully";
        }
        else {
            echo "error";
        }

        header('Refresh:0');
    }
?>
<body>
    <div id="med_div">
    <table id="medicine-details">
    <th>
        <tr>
            <th>ID</th>
            <th>Medicine Name</th>
            <th>Distributer</th>
            <th>Stock</th>
        </tr>
    </th >
    <tbody>
        <tr v-for="m in med_details">
            <td>{{m.medicineID}}</td>
            <td>{{m.medicineName}}</td>
            <td>{{m.distributer}}</td>
            <td>{{m.stock}}</td>
        </tr>
    </tbody>
    </table>
    </div>
    <div>
        <h3>Change Medicine</h3>
        <form action='#' method='POST'>
            <label for="Medicine ID">Enter the Medicine Details</label>
            <input name="medID" placeholder="Enter the id of medicine" required>

            <label for="Stock">Stock Amount</label>
            <input name="stock" placeholder="Stock Amount" required>

            <button type="submit" name="changeBtn">Add stock</button>
        </form>
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