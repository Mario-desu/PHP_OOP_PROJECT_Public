<?php

namespace App\Login;

use App\Core\AbstractRepository;

use PDO;

class LoginRepository extends AbstractRepository
{
    public function getModelPath()
    {
        return "App\\Login\\LoginModel";
    }


    public function getTableName()
    {
        return "users";
    }

  ###########################################################################################  
  // alle User fetchen

    public function fetchAllUsers() // keine Unterstriche(_) in Klassen Methoden
    {
        $table = $this->getTableName();
        $modelPath = $this->getModelPath();
        $stmt = $this->pdo->prepare("SELECT * FROM $table" );
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS, $modelPath);
        return $users;
    }

  ###########################################################################################
  // User nach ID fetchen

    public function fetchUserById($userId) 
    {
        $table = $this->getTableName();
        $modelPath = $this->getModelPath();
        
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE `userId` = :userId" );
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, $modelPath);
        $user = $stmt->fetch(PDO::FETCH_CLASS); 

        return $user;
    }


    
  ###########################################################################################
  // User nach Email fetchen
  // wird auch bei Pwd-Reset verwendet:
  //User abrufen, der mit Token Passwort zurücksetzen will(gleiche E-mail)

    public function findByEmail($email)
    {
        $table = $this->getTableName();
        $modelPath = $this->getModelPath();

        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE email = :email ");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        $stmt->setFetchMode(PDO::FETCH_CLASS, $modelPath);
        $user = $stmt->fetch(PDO::FETCH_CLASS); 

        return $user;
    }
###########################################################################################
// für Registrierung: einfügen von Userdaten in Datenbank

    public function insertUser($lastName, $firstName, $role, $email, $password1) {
        $table = $this->getTableName();

        $stmt = $this->pdo->prepare("INSERT INTO $table (lastName,firstName,role,email,password)
        VALUES (:lastName,:firstName,:role,:email,:password)");

        $stmt->bindParam(":lastName",$lastName); 
        $stmt->bindParam(":firstName",$firstName); 
        $stmt->bindParam(":role",$role); 
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":password",$password1);
        $stmt->execute();
    }

 ###########################################################################################
 // für User-Edit: Änderung von Userdaten: 

        public function updateUser(LoginModel $model) 
        {
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("UPDATE `$table` SET `lastName` = :lastName, `firstName` = :firstName, `email` = :email, `role` = :role
        WHERE `userId` = :userId");

        $stmt->bindParam(":userId", $model->userId);
        $stmt->bindParam(":lastName", $model->lastName);
        $stmt->bindParam(":firstName", $model->firstName);
        $stmt->bindParam(":email", $model->email);
        $stmt->bindParam(":role", $model->role);       
        $stmt->execute();
        }    


 ###########################################################################################
 // für Pwd-reset: Änderung von Passwort In User-Tabelle: 

        public function updatePassword($password,$email) 
        {
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("UPDATE `$table` SET `password` = :password
        WHERE `email` = :email");

        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        
        $stmt->execute();
        }           

###########################################################################################
// für User-Delete: Nutzerkonto löschen

    public function deleteUser($userId)
    {
        $table = $this->getTableName();
        
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE userId=:userId");
        $stmt -> bindParam(":userId", $userId);
        $stmt -> execute();
      
    }




}