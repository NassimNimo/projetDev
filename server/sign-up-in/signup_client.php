<?php
try {
    require_once "../custom_modules/DB_class.php";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        
        $DB = new DB_class();
        
        $DB->insertClient($_POST["username"], $_POST["password"], $_POST["firstName"], $_POST["lastName"], $_POST["city"], $_POST["job"], $_POST["email"], $_POST["tel"], $_FILES["cv"]);
        
    } catch (Exception $e) {
        echo "Database error: " . $e->getMessage();

    } 
}else{
    header("Location: index.html");
}
