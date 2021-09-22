<?php
namespace App\Core;

use PDO;

//Abstract Repository generisch, zum erweitern
abstract class AbstractRepository
  {
      protected $pdo;

      public function __construct(PDO $pdo)
      {
        $this->pdo = $pdo;
      }
      // wenn abstract Repository erweitert wird, müssen diese Functions drinnen sein:
      abstract public function getTableName();      
      abstract public function getModelPath();

      
      function fetchAll() // keine Unterstriche(_) in Klassen Methoden
      {
          $table = $this->getTableName();
          $modelPath = $this->getModelPath();
          $stmt = $this->pdo->query("SELECT * FROM $table");
          //bei mehereren Ausgaben
          $notes = $stmt->fetchAll(PDO::FETCH_CLASS, $modelPath);
          return $notes;
      }
    
      function fetchSingle($id)//bei einzelnen Ausgaben
      {
        $table = $this->getTableName();
        $modelPath = $this->getModelPath();
        $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
        $stmt->bindParam(":id", $id);
        //oder: $stmt->execute(['id' => $id]); ohne bindParam
        $stmt->execute();
        //bei einzelnen Ausgaben:
        $stmt->setFetchMode(PDO::FETCH_CLASS, $modelPath);//die ausgeführte Klasse, :: weil es Klasse ist, bei Variable -> stattdessen
        $note = $stmt->fetch(PDO::FETCH_CLASS); //eine Klasse aus dem Ergebnis erzeugen
    
        return $note;
      }

      
    }
      
