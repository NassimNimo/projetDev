<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   try {
       include("./DB.php");

       // Get user data
       $companyName = $_POST["companyName"];
       $ICE = $_POST["ICE"];
       $industry = $_POST["industry"];
       $HRFirstName = $_POST["HRFirstName"];
       $HRLastName = $_POST["HRLastName"];
       $email = $_POST["email"];
       $password = $_POST["password"];
       $tel = $_POST["tel"];
       $city = $_POST["city"];

       // inserting
       $hash = password_hash($password, PASSWORD_BCRYPT);
       $sql2 = "INSERT INTO hr_users (nomSociete, ICE, ville, email, password, telephone, industrie, HRManagerNom, HRManagerPrenom)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
       $stmt2 = $conn->prepare($sql2);
       $stmt2->bind_param("sssssssss", $companyName, $ICE, $city, $email, $hash, $tel, $industry, $HRFirstName, $HRLastName);

       if (!$stmt2) {
           throw new Exception("Error preparing statement: " . $conn->error);
       }

       if (!$stmt2->execute()) {
           throw new Exception("Error executing statement: " . $stmt2->error);
       }

       echo "New record inserted successfully";

       $stmt2->close();
   } catch (Exception $e) {
       echo "Error: " . $e->getMessage();
   }

   // Close connection
   $conn->close();
} else {
   header("Location: ../landingpage.html");
   exit;
}