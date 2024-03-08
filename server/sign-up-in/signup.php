<?php

try {

    require_once "../custom_modules/DB_class.php";

} catch (Exception $e) {

    echo "Error: " . $e->getMessage();

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form-name"])) {

    try {
        $DB = new DB_class();

        //checks what form we received the request from and treats it accordingly 

        if ($_POST["form-name"] == "client-form") {

            $DB->insertClient($_POST["username"], $_POST["password"], $_POST["firstName"], $_POST["lastName"], $_POST["city"], $_POST["job"], $_POST["email"], $_POST["tel"], $_FILES["cv"]);
        
        } elseif ($_POST["form-name"] == "HR-form") {

            $DB->insertHR($_POST["companyName"], $_POST["ICE"], $_POST["industry"], $_POST["HRFirstName"], $_POST["HRLastName"], $_POST["email"], $_POST["password"], $_POST["tel"], $_POST["city"]);
        
        } else {
            echo "Invalid form name.";
        }
    } catch (Exception $e) {

        echo "Database error: " . $e->getMessage();

    }
} else {

    header("Location: ../../signin-page.html");
    exit; // Ensure that script execution stops after redirection

}
?>