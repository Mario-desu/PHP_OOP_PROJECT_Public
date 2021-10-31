<?php

namespace App\Login;

use App\Core\AbstractRepository;
use PDO;

class PwdResetRepository extends AbstractRepository
{
    public function getModelPath()
    {
        return "App\\Login\\PwdResetModel";
    }


    public function getTableName()
    {
        return "pwd_reset";
    }



###################################################################################
/* wenn es einen Eintrag mit dieser E-mail gibt in der DB  wird dieser gelöscht,
damit nicht mehrere Token zu einem User existieren: */

    public function deletePwdResetEntry($userEmail)
    {
        $table = $this->getTableName();
        
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE pwdResetEmail=:pwdResetEmail");
        $stmt -> bindParam(":pwdResetEmail", $userEmail);
        $stmt -> execute();
    }    

    ###################################################################################
    // Daten in Db eintragen (Pwd-reset-Tabelle)

    public function insertResetPwdEntry($pwdResetEmail, $pwdResetSelector, $pwdResetToken, $pwdResetExpires) 
    {
        $table = $this->getTableName();

        $stmt = $this->pdo->prepare("INSERT INTO $table (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires)
        VALUES (:pwdResetEmail,:pwdResetSelector,:pwdResetToken,:pwdResetExpires)");

        $stmt->bindParam(":pwdResetEmail",$pwdResetEmail); 
        $stmt->bindParam(":pwdResetSelector",$pwdResetSelector); 
        $stmt->bindParam(":pwdResetToken",$pwdResetToken); 
        $stmt->bindParam(":pwdResetExpires",$pwdResetExpires);
        $stmt->execute();
    }

#################################################################################
// Token aus Datenbank fetchen, wenn Token noch nicht abgelaufen ist

    public function getResetSelector($selector, $currentDate)
    {
        $table = $this->getTableName();
        $modelPath = $this->getModelPath();

        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE pwdResetSelector = :pwdResetSelector AND pwdResetExpires >= :currentDate");

        $stmt->bindParam(":pwdResetSelector",$selector); 
        $stmt->bindParam(":currentDate",$currentDate);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, $modelPath);
        $selector = $stmt->fetch(PDO::FETCH_CLASS); 

        return $selector;
    
    }




}   