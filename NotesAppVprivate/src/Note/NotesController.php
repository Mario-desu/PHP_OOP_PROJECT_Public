<?php

namespace App\Note;

use App\Core\AbstractController;
use App\Login\LoginService;

class NotesController extends AbstractController
{

  public function __construct(NotesRepository $notesRepository, CommentsRepository $commentsRepository, LoginService $loginService)
  {
      $this->notesRepository = $notesRepository;
      $this->commentsRepository = $commentsRepository;
      $this->loginService = $loginService;
  }

 ###########################################################################
// Startseite:


public function landing()
{
     

    $this->render("note/startPage", []);
    
}

  // Seiten mit allen Notizen(öffentliche Seite):

###########################################################################

  public function index()
  {
        $notes = $this->notesRepository->fetchAllPublic();

      $this->render("note/index", [
        'notes' => $notes
      ]);
      // var_dump($notes);
  }



###########################################################################
//Einzelne Notizen zeigen:


  public function showNote()
  {   
    $this->loginService->loginCheck();
      
      $color = "";
      $commentMessage ="";
      $userId =$_SESSION['userId'];  
      $id = $_GET['id'];
      //Kommentar-Content:
      if (isset($_POST['content'])) {
        $content = strip_tags($_POST['content']);

        //Es wird kein leerer Kommentar gepostet
        if(!empty($content)){
          $this->commentsRepository->insertComment($id, $content, $userId);
          $color = "green";
          $commentMessage .= "Kommentar erfolgreich gepostet!";
          } else {
            $color = "red";
            $commentMessage .= "Bitte Kommentar eingeben!";
          }

      }

      $note = $this->notesRepository->fetchSingle($id); // show single Notes

      /*damit User nicht auf private Notizen anderer User zugreifen kann
      durch Manipulation der URL*/
      if ($note['fk_user_id'] !== $userId && $note['status'] !== 'public') {
      header("location: index");
      }  

      $comments = $this->commentsRepository->getAllByNote($id);//show comments

     
      $this->render("note/showNote", [
        'note' => $note,
        'comments' => $comments,
        'color' => $color,
        'commentMessage' => $commentMessage
      ]);
  }
}

 ?>
