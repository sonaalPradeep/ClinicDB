<?php 

    $conn = new mysqli('localhost','root','root','hospitalManagement');
    if($conn->connect_error) {
        die('Connection Failed: ' .$conn->connect_error);
    }

    else {
        echo 'connection established';
        //Setuping up php
        
        $quries = array(
            
            "CREATE TABLE IF NOT EXISTS `patient` (
                `patientID` int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `firstName` varchar(255) NOT NULL,
                `lastName` varchar(255) NOT NULL,
                `Designation` varchar(255) NOT NULL,
                `email` varchar(255) NOT NULL,
                `dob` DATE NOT NULL,
                `contactNo` int NOT NULL,
                `addr` varchar(255) NOT NULL,
                `Age` int NOT NULL,
                `Pwd` varchar(255) NOT NULL
              )",
            
            "CREATE TABLE IF NOT EXISTS `doctor` (
                `doctorID` int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                `firstName` varchar(255) NOT NULL,
                `lastName` varchar(255) NOT NULL,
                `contactNo` int NOT NULL,
                `email` varchar(255) NOT NULL,
                `addr` varchar(255) NOT NULL,
                `workingHr` int NOT NULL,
                `password` varchar(255) NOT NULL
              )",
            
            "CREATE TABLE IF NOT EXISTS `visit` (
                `visitID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `DandT` varchar(255) NOT NULL,
                `pID` int NOT NULL,
                `docID` int NOT NULL,
                FOREIGN KEY(docID) REFERENCES doctor(doctorID),
                FOREIGN KEY(pID) REFERENCES patient(patientID)
            )",
            
            "CREATE TABLE IF NOT EXISTS `diagnosis` (
                `diagnoseID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `DocNotes` varchar(1000) NOT NULL,
                `visID` int NOT NULL,
                FOREIGN KEY(visID) REFERENCES visit(visitID)
            )",
            
            "CREATE TABLE IF NOT EXISTS `referral` (
                `referralID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `refNotes` varchar(1000) NOT NULL,
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
                `medicineName` varchar(1000) NOT NULL,
                `distributer` varchar(1000),
                `stock` int NOT NULL
            )",
            
            "CREATE TABLE IF NOT EXISTS `test` (
                `testID` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `testName` varchar(1000) NOT NULL
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
            
        );
        $len = count($quries);
        // $i = 0;
        // for($i = 0; $i < $len; $i++) {
            // if($conn->query($quries[$i]) === TRUE) {
            //     echo "Table Created $quries[$i]\n";
            // }
            // else {
            //     echo "Not established";
            //     echo $conn->error;
            // }
        // }
        if($conn->query($quries[9]) === TRUE) {
            echo "Table Created\n";
        }
        else {
            echo "Not established";
            echo $conn->error;
        }
        $conn->close();
        
    }

?>