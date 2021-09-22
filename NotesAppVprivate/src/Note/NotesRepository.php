<?php
namespace App\Note;

use App\Core\AbstractRepository;
use PDO;


class NotesRepository extends AbstractRepository
{
  public function getTableName()
  {
    return "entries";
  }


  public function getModelPath()
  {
    return "App\\Note\\NoteModel";
  }

  #########################################################################

  //alle Notizen fetchen mit Status public

  public function fetchAllPublic() // keine Unterstriche(_) in Klassen Methoden
  {
      $table = $this->getTableName();
      $modelPath = $this->getModelPath();
      $status = "public";
      $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE `status` = :status ORDER BY `time` DESC" );
      $stmt->bindParam(":status", $status);
      $stmt->execute();
      $notes = $stmt->fetchAll(PDO::FETCH_CLASS, $modelPath);
      return $notes;
  }

  
###########################################################################################
  //alle Notizen fetchen für eingeloggten User

  public function fetchByUser($userId) 
  {
      $table = $this->getTableName();
      $modelPath = $this->getModelPath();
     
      $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE `fk_user_id` = :fk_user_id" );
      $stmt->bindParam(":fk_user_id", $userId);
      $stmt->execute();
      // PDO::FETCH_CLASS -> Im Ergebnis Klasse erzeugen
      $notes = $stmt->fetchAll(PDO::FETCH_CLASS, $modelPath);
      return $notes;
  }



###########################################################################################
// eine Notiz erstellen

  public function createNote($title, $content, $status, $userId) 
  {
    $table = $this->getTableName();

    $stmt = $this->pdo->prepare("INSERT INTO $table (fk_user_id,title,content,status)
    VALUES (:fkUserId,:title,:content,:status)");
 

    $stmt->bindParam(":fkUserId", $userId);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":status", $status);       
    $stmt->execute();
  }

  ###########################################################################################
  // Notizen in Datenbank updaten

  public function updateNote(NoteModel $model) 
  {
    $table = $this->getTableName();
    $stmt = $this->pdo->prepare("UPDATE `$table` SET `title` = :title, `content` = :content, `status` = :status
    WHERE `id` = :noteId");

    $stmt->bindParam(":noteId", $model->id);
    $stmt->bindParam(":title", $model->title);
    $stmt->bindParam(":content", $model->content);
    $stmt->bindParam(":status", $model->status);       
    $stmt->execute();
  }

###########################################################################################
// Notizen aus Datenbank löschen

public function deleteNote($noteId)
{
    $table = $this->getTableName();
    
    $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id=:noteId");
    $stmt -> bindParam(":noteId", $noteId);
    $stmt -> execute();
    var_dump($stmt);
}


}

?>
