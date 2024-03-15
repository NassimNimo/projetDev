<?php

class DB_class
{
    private $dsn = 'mysql:host=localhost;dbname=project_db';
    private $username = 'root';
    private $password = '';
    protected $pdo;

    private $pdf_dir = "C:/xampp/CV";

    public function __construct()
    {
        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            die();
        }
    }

    public function getClient(string $Email)
    {
        $sql = "SELECT * FROM client_users WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $Email]);
        $row = $stmt->fetch();
        var_dump($row);
    }

    public function getHR(string $email)
    {
        $sql = "SELECT * FROM HR_users WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();
        var_dump($row);
    }

    private function checkSociete($societe){
            try{
                $sql = "SELECT count(*) FROM HR_users WHERE nomSociete = :societe";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['societe' => $societe]);
                $row = $stmt->fetch();

                if ($row[0] == 0) {
                    return true;
                } else {
                    return false;
                }
            }catch(PDOException $e){
                echo"checkSociete error ". $e->getMessage();
            }
    }

    private function checkEmail($email, $role)
    {
        try {
            if ($role == "HR") {
                $sql = "SELECT count(*) FROM HR_users WHERE email = :email";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['email' => $email]);
                $row = $stmt->fetch();

                if ($row[0] == 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $sql = "SELECT count(*) FROM client_users WHERE email = :email";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['email' => $email]);
                $row = $stmt->fetch();

                if ($row[0] == 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo "checkEmail error: " . $e->getMessage();
        }

    }

    private function checkUsername($username, $role)
    {
        try {
            if ($role == "HR") {
                $sql = "SELECT count(*) FROM HR_users WHERE nomSociete = :username";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['username' => $username]);
                $row = $stmt->fetch();

                if ($row[0] == 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $sql = "SELECT count(*) FROM client_users WHERE username = :username";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['username' => $username]);
                $row = $stmt->fetch();

                if ($row[0] == 0) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo "checkUsername error: " . $e->getMessage();
        }

    }

    private function insertCV($File)
    {
        try {
            if (!file_exists($this->pdf_dir)) {
                mkdir($this->pdf_dir, 0777, true);
            }
            
            $filename = $File["name"];
            $tmpFilePath = $File["tmp_name"];
            $fileSize = filesize($tmpFilePath);

            $destination = $this->pdf_dir . "/" . $filename;
            if (!move_uploaded_file($tmpFilePath, $destination)) {
                echo "Failed to move uploaded file.";
                return;
            }

            $sql = "INSERT INTO cv_documents (fileName, path, size) 
                    VALUES (:filename, :path, :fileSize)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':filename', $filename, PDO::PARAM_STR);
            $stmt->bindParam(':path', $destination, PDO::PARAM_STR);
            $stmt->bindParam(':fileSize', $fileSize, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                echo "Error executing statement: ";
                print_r($stmt->errorInfo());
            }
        } catch (PDOException $e) {
            echo "insertCV error: " . $e->getMessage();
        }
    }

    public function selectCVPath(int $id_client){
        try{

            $sql = "SELECT cv.path FROM cv_documents cv, client_users cl WHERE cl.CV = cv.id AND cl.id = :id LIMIT 1;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id",$id_client);
            $stmt->execute();
            $res = $stmt->fetch();
            var_dump($res);
            return $res[0];

        }catch(PDOException $e){
            echo "selectCVPath error: " . $e->getMessage();
        }
    }

    public function insertClient($username, $password, $nom, $prenom, $ville, $profession, $email, $telephone, $File, $website, $github, $twitter, $instagram, $facebook)
    {
        try {
            if ($this->checkUsername($username, "client")) {
                if ($this->checkEmail($email, "client")) {

                    $this->insertCV($File);

                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $sql = "INSERT INTO client_users (username, password, nom, prenom, ville, profession, email, telephone, CV, website, github, twitter, instagram, facebook) 
                            VALUES (:username, :password, :nom, :prenom, :ville, :profession, :email, :telephone ,LAST_INSERT_ID(), :website, :github, :twitter, :instagram, :facebook)";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
                    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                    $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
                    $stmt->bindParam(':profession', $profession, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':telephone', $telephone, PDO::PARAM_INT);
                    $stmt->bindParam(':website', $website, PDO::PARAM_STR);
                    $stmt->bindParam(':github', $github, PDO::PARAM_STR);
                    $stmt->bindParam(':twitter', $twitter, PDO::PARAM_STR);
                    $stmt->bindParam(':instagram', $instagram, PDO::PARAM_STR);
                    $stmt->bindParam(':facebook', $facebook, PDO::PARAM_STR);
                    $stmt->execute();

                    echo "0";

                } else {
                    echo "2";
                }
            } else {
                echo "1";
            }
        } catch (PDOException $e) {
            echo "insertClient error : " . $e->getMessage();
        }

    }
    public function insertHR($companyName, $ICE, $industry, $HRFirstName, $HRLastName, $email, $password, $tel, $city)
    {
        try {
            if($this->checkSociete($companyName)){
                if ($this->checkEmail($email, "HR")) {

                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $sql = "INSERT INTO hr_users (nomSociete, ICE, ville, email, password, telephone, industrie, HRManagerNom, HRManagerPrenom)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindParam(1, $companyName, PDO::PARAM_STR);
                    $stmt->bindParam(2, $ICE, PDO::PARAM_STR);
                    $stmt->bindParam(3, $city, PDO::PARAM_STR);
                    $stmt->bindParam(4, $email, PDO::PARAM_STR);
                    $stmt->bindParam(5, $hash, PDO::PARAM_STR);
                    $stmt->bindParam(6, $tel, PDO::PARAM_STR);
                    $stmt->bindParam(7, $industry, PDO::PARAM_INT);
                    $stmt->bindParam(8, $HRLastName, PDO::PARAM_STR);
                    $stmt->bindParam(9, $HRFirstName, PDO::PARAM_STR);
                    
                    $stmt->execute();
    
                    echo "0";
    
                } else {
                    echo "1";
                }
            }else{
                echo "2";
            }
            

        } catch (PDOException $e) {
            echo $industry;
            echo "insertHR error : " . $e->getMessage();
        }

    }

    public function Authentification($email, $password, $role)
    {
        try {

            if ($role == "HR") {

                //if HR check the HR table for info
                $sql = "SELECT password, id FROM HR_users WHERE email = :email LIMIT 1";
            } else {

                //check the client table if anything else
                $sql = "SELECT password, id FROM client_users WHERE email = :email LIMIT 1";
            }

            //smae processes for both of them we get the id so we can get 
            //  into their informations easily cuz the primary key

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            //check if user exists
            if ($stmt->rowCount() == 1) {

                $user = $stmt->fetch();

                // Comparaison du mot de passe crypte par RSA
                if (password_verify($password, $user['password'])) {

                    echo "0";
                    return $user['id'];

                } else {

                    echo "1";
                    return null;
                }
            } else {

                echo "2";
                return null;
            }
        } catch (PDOException $e) {
            echo "AuthentificationClient error : " . $e->getMessage();
        }
    }

    public function getClientByID($id)
    {
        try {

            $sql = "SELECT * FROM client_users WHERE id = :id LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch();

            return $user;
            
        } catch (PDOException $e) {
            echo "getClientByID error : " . $e->getMessage();
        }
    }

    public function fetchProfessions(){
        try {

            $sql = "SELECT id, nom FROM profession";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $profession = $stmt->fetchAll();

            return $profession;
            
        } catch (PDOException $e) {
            echo "fetchProfession error : " . $e->getMessage();
        }
    }
    
    public function fetchIndustries(){
        try {

            $sql = "SELECT id, nom FROM industrie";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $industrie = $stmt->fetchAll();

            return $industrie;
            
        } catch (PDOException $e) {
            echo "fetchIndustries error : " . $e->getMessage();
        }
    }

    public function getClientData($id){
        try {

            $sql = "SELECT c.* , p.nom AS profession_name FROM client_users c , profession p  WHERE p.id = profession and c.id=:id LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $userData = $stmt->fetch();

            return $userData;
            
        } catch (PDOException $e) {
            echo "fetchIndustries error : " . $e->getMessage();
        }
    }

    public function getTech(int $profession_id){
        try{
            $sql = "SELECT nom from technologies WHERE profession_id  = :id LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id",$profession_id);
            $stmt->execute();
            $techArray = $stmt->fetch();
            $techs = explode(",", $techArray[0]);
            return $techs;
        }
        catch(PDOException $e){
            echo "getTech error : " . $e->getMessage();
        }
    }
}