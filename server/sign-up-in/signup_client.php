<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        
        include("../DB.php");

        // Get user data
        $username = $_POST["username"];
        $password = $_POST["password"];
        $nom = $_POST["firstName"];
        $prenom = $_POST["lastName"];
        $ville = $_POST["city"];
        $profession = $_POST["job"];
        $email = $_POST["email"];
        $telephone = $_POST["tel"];

        // Check if the username already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM client_users WHERE username = ?");
        $stmt->bind_param("s", $username); // Bind username to the first placeholder
        $stmt->execute();
        $userCount = $stmt->get_result()->fetch_row()[0]; // Fetch the count value

        // Check if the email already exists
        $stmt2 = $conn->prepare("SELECT COUNT(*) FROM client_users WHERE email = ?");
        $stmt2->bind_param("s", $email); // Bind email to the first placeholder
        $stmt2->execute();
        $emailCount = $stmt2->get_result()->fetch_row()[0]; // Fetch the count value
        if ($userCount > 0) {
            echo "1";
        } 
        else if($emailCount > 0){
            echo "2";
        }else {

                // Upload CV file
                if(isset($_FILES["cv"])) {
                    $filename = $_FILES["cv"]["name"];
                    $filedata = file_get_contents($_FILES["cv"]["tmp_name"]);
                    $mimeType = $_FILES["cv"]["type"];
                    $fileSize = $_FILES["cv"]["size"];
                } else {
                    // Handle case where "cv" file was not uploaded
                    throw new Exception("CV file is required.");
                }
                // Insert CV file data
                $sql = "INSERT INTO cv_documents (fileName, data, mimeType, fileSize) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
        
                if ($stmt) {
                    // Bind parameters
                    $stmt->bind_param("sssi", $filename, $filedata, $mimeType, $fileSize);
            
                    // Execute the statement
                    if ($stmt->execute()) {

                    } else {
                        echo "Error executing statement: " . $stmt->error;
                    }
            
                    // Close the statement
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
                // Insert user data including CV file reference
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $sql2 = "INSERT INTO client_users (username, password, nom, prenom, ville, profession, email, telephone, CV)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, LAST_INSERT_ID())";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("sssssssi", $username, $hash, $nom, $prenom, $ville, $profession, $email, $telephone);
                if (!$stmt2->execute()) {
                    throw new Exception("Error inserting user data: " . $stmt2->error);
                }
                $stmt2->close();
        
                // Commit the transaction if everything is successful
                $conn->commit();
                echo "0";
            }
        
    } catch (Exception $e) {
        echo "Database error: " . $e->getMessage();

    } finally {
        // Close the connection
        $conn->close();
    }
}else{
    header("Location: index.html");
}
?>
