<?php
namespace App\Note;

use App\Core\AbstractRepository;
use PDO;

class CommentsRepository extends AbstractRepository
{
  public function getTableName()
  {
    return "comments";
  }


  public function getModelPath()
  {
    return "App\\Note\\CommentModel";
  }


  ##################################################################################
  // Kommentare in Datenbank einfügen


  public function insertComment($noteId, $content, $userId) 
  {
    $table = $this->getTableName();
    $stmt = $this->pdo->prepare("INSERT INTO `$table` (`content`, `fk_entry_id`, `fk_user_id`)
    VALUES (:content, :fk_entry_id, :fk_user_id)");
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":fk_entry_id", $noteId);
    $stmt->bindParam(":fk_user_id", $userId);
    $stmt->execute();
  }


  ####################################################################################
  //alle Kommentare von einer bestimmten Notiz fetchen


  function getAllByNote($id) // keine Unterstriche(_) in Klassen Methoden
  {
      $table = $this->getTableName();
      $modelPath = $this->getModelPath();

      $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE fk_entry_id = :id");
      $stmt->bindParam(":id", $id);
      $stmt->execute();
      
      $comments = $stmt->fetchAll(PDO::FETCH_CLASS, $modelPath);
      return $comments;
  }


}

?>