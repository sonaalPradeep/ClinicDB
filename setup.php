<?php 

    $conn = new mysqli('localhost','root','root','hospitalManagement');
    if($conn->connect_error) {
        die('Connection Failed: ' .$conn->connect_error);
    }

    else {
        echo 'Connection Established <br>';
        //Setuping up php
        
        $init_tables = array(
            
            "CREATE TABLE IF NOT EXISTS `patient` (
                `patientID` int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `firstName` varchar(255) NOT NULL,
                `lastName` varchar(255) NOT NULL,
                `Designation` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `dob` date NOT NULL,
                `contactNo` varchar NOT NULL,
                `addr` varchar(255) NOT NULL,
                `Age` int NOT NULL,
                `gnd` char(1) NOT NULL,
                `Pwd` varchar(255) NOT NULL
              )",
            
            "CREATE TABLE IF NOT EXISTS `doctor` (
                `doctorID` int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `firstName` varchar(255) NOT NULL,
                `lastName` varchar(255) NOT NULL,
                `contactNo` varchar NOT NULL,
                `email` varchar(255) NOT NULL,
                `addr` varchar(255) NOT NULL,
                `workingHr` varchar(255) NOT NULL,
                `password` varchar(255) NOT NULL
              )",
            
            "CREATE TABLE IF NOT EXISTS `visit` (
                `visitID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `DandT` datetime NOT NULL,
                `pID` int NOT NULL,
                `docID` int NOT NULL,
                FOREIGN KEY(docID) REFERENCES doctor(doctorID),
                FOREIGN KEY(pID) REFERENCES patient(patientID)
            )",
            
            "CREATE TABLE IF NOT EXISTS `diagnosis` (
                `diagnoseID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `DocNotes` varchar(1024) NOT NULL,
                `visID` int NOT NULL,
                FOREIGN KEY(visID) REFERENCES visit(visitID)
            )",
            
            "CREATE TABLE IF NOT EXISTS `referral` (
                `referralID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `refNotes` varchar(1024) NOT NULL,
                `diagID` int NOT NULL,
                FOREIGN KEY(diagID) REFERENCES diagnosis(diagnoseID)
            )",
            
            "CREATE TABLE IF NOT EXISTS `prescription` (
                `prescriptionID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `diagID` int NOT NULL,
                FOREIGN KEY(diagID) REFERENCES diagnosis(diagnoseID)
            )",
            
            "CREATE TABLE IF NOT EXISTS `medicine` (
                `medicineID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `medicineName` varchar(1024) NOT NULL,
                `distributer` varchar(1024),
                `stock` int NOT NULL
            )",
            
            "CREATE TABLE IF NOT EXISTS `test` (
                `testID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `testName` varchar(1024) NOT NULL
            )",
            "CREATE TABLE IF NOT EXISTS `visitAndtest` (
                `visID` int,
                `testID` int,
                FOREIGN KEY(testID) REFERENCES test(testID),
                FOREIGN KEY(visID) REFERENCES visit(visitID)
            )",
            
            "CREATE TABLE IF NOT EXISTS `medprescribed` (
                `prescID` int NOT NULL,
                `medID` int NOT NULL,
                FOREIGN KEY(medID) REFERENCES medicine(medicineID),
                FOREIGN KEY(prescID) REFERENCES prescription(prescriptionID)
            )",

            "CREATE VIEW `view_presc_med` AS 
                SELECT V.visitID, P.prescriptionID, M.medicineName FROM ((((visit V LEFT JOIN diagnosis D ON V.visitID = D.visID) LEFT JOIN prescription P ON P.diagID = D.diagnoseID) LEFT JOIN medprescribed mp ON P.prescriptionID = mp.prescID) LEFT JOIN medicine M on M.medicineID = mp.medID)
            "
            
        );
        $len = count($init_tables);
        // $i = 0;
        // for($i = 0; $i < $len; $i++) {
        //     if($conn->query($init_tables[$i]) === TRUE) {
        //         echo "Table[$i] constructed <br>";
        //     }
        //     else {
        //         echo "Not established <br>";
        //         echo $conn->error;
        //     }
        // }
        if($conn->query($quries[10]) === TRUE) {
            echo "Table Created\n";
        }
        else {
            echo "Not established";
            echo $conn->error;
        }

        // $load_row = array(
        //      "INSERT INTO `doctor`(`doctorID`, `firstName`, `lastName`, `contactNo`, `email`, `addr`, `workingHr`, `password`) VALUES (0,"A","B",8589503531,"ab@nitc.ac.in","Thrissur Kerala",9,"1111")"
        // );

        // $len = count($load_row);
        // $i = 0;
        // for($i = 0; $i < $len; $i++) {
        //     if($conn->query($load_rows[$i]) === TRUE) {
        //         echo "Row[$i] inserted <br>";
        //     }
        //     else {
        //         echo "Cannot insert [$i] <br>";
        //         echo $conn->error;
        //     }
        // }

        $conn->close();
        
    }

?>
