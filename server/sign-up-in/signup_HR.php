<?php

require_once("../custom_modules/DB_class.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $DB = new DB_class();

    $DB->insertHR($_POST["companyName"], $_POST["ICE"], $_POST["industry"], $_POST["HRFirstName"], $_POST["HRLastName"], $_POST["email"], $_POST["password"], $_POST["tel"], $_POST["city"]);


} else {
    header("Location: ../landingpage.html");
    exit;
}