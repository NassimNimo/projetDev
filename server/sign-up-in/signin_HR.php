<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../DB.php");

    $password = $_POST["password"];
    $email = $_POST["email"];

    // Utilisation d'une requête préparée avec des paramètres liés pour éviter l'injection SQL
    $query = "SELECT * FROM hr_users WHERE email = ? LIMIT 1";
    $statement = $conn->prepare($query);
    $statement->bind_param('s', $email);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Comparaison du mot de passe crypté
        if (password_verify($password, $user['password'])) {
            echo "0";
        } else {
            echo "1";
        }
        
    }else{
        echo "2";
    }
}else{
    header("Location: ../../index.html");
    exit; // Ensure that script execution stops after redirection
}
?>
