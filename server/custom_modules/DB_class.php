<?php

class DB_class
{
    private $dsn = 'mysql:host=localhost;dbname=project_db';
    private $username = 'root';
    private $password = '';
    private $pdo;

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
            $filename = $File["name"];
            $filedata = file_get_contents($File["tmp_name"]);
            $mimeType = $File["type"];
            $fileSize = $File["size"];

            $sql = "INSERT INTO cv_documents (fileName, data, mimeType, fileSize) 
                    VALUES (:filename, :filedata, :mimeType, :fileSize)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':filename', $filename, PDO::PARAM_STR);
            $stmt->bindParam(':filedata', $filedata, PDO::PARAM_LOB);
            $stmt->bindParam(':mimeType', $mimeType, PDO::PARAM_STR);
            $stmt->bindParam(':fileSize', $fileSize, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                echo "Error executing statement: " . $stmt->errorInfo();
            }
        } catch (PDOException $e) {
            echo "insertCV error: " . $e->getMessage();
        }

    }

    public function insertClient($username, $password, $nom, $prenom, $ville, $profession, $email, $telephone, $File)
    {
        try{
            if ($this->checkUsername($username, "client")) {
                if ($this->checkEmail($email, "client")) {
    
                    $this->insertCV($File);
    
                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $sql = "INSERT INTO client_users (username, password, nom, prenom, ville, profession, email, telephone, CV) 
                            VALUES (:username, :password, :nom, :prenom, :ville, :profession, :email, :telephone ,LAST_INSERT_ID())";
                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->bindParam(':password', $hash, PDO::PARAM_STR);
                    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                    $stmt->bindParam(':ville', $ville, PDO::PARAM_STR);
                    $stmt->bindParam(':profession', $profession, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':telephone', $telephone, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    echo "0";
    
                } else {
                    echo "2";
                }
            } else {
                echo "1";
            }
        }catch(PDOException $e){
            echo "insertClient error : " . $e->getMessage();
        }

    }
    public function insertHR($companyName, $ICE, $industry, $HRFirstName, $HRLastName, $email, $password, $tel, $city)
    {
        try{
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
                    $stmt->bindParam(7, $industry, PDO::PARAM_STR);
                    $stmt->bindParam(8, $HRLastName, PDO::PARAM_STR);
                    $stmt->bindParam(9, $HRFirstName, PDO::PARAM_STR);
                    $stmt->execute();
                    
                    echo "0";
    
                } else {
                    echo "1";
                }

        }catch(PDOException $e){
            echo "insertHR error : " . $e->getMessage();
        }

    }
}