<?php

namespace App\Note;

use App\Core\AbstractController;
use App\Login\LoginRepository;
use App\Login\LoginService;

class NotesAdminController extends AbstractController
{

    public function __construct(NotesRepository $notesRepository,
    LoginService $loginService, CommentsRepository $commentsRepository, LoginRepository $loginRepository)
    {
        $this->notesRepository = $notesRepository;
        $this->loginService = $loginService;
        $this->commentsRepository = $commentsRepository;
        $this->loginRepository = $loginRepository;
    }


###########################################################################
//Nur Notizen vom eingeloggten User sollen erscheinen (persönliche Notizen in Dashboard)
// zum ANZEIGEN


    public function myNotes()
    { 
          $this->loginService->loginCheck();
          $userId =$_SESSION['userId'];  
          $notes = $this->notesRepository->fetchByUser($userId);
    
        $this->render("note/noteAdmin/myNotes", [
          'notes' => $notes
        ]);
  
    }

 //einzelne Notizen von eingeloggten User zeigen (Details):   

    public function showMyNote()
      {   
            $color = "";
            $commentMessage = "";
            $this->loginService->loginCheck();
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
          header("location: dashboard");
        }

        

        $comments = $this->commentsRepository->getAllByNote($id);//show comments


        $this->render("note/noteAdmin/showMyNote", [
          'note' => $note,
          'comments' => $comments,
          'color' => $color,
          'commentMessage' => $commentMessage
          ]);
    }

 ###########################################################################
 //Neue Notiz erstellen:

    public function newNote()
    {   
        $this->loginService->loginCheck();

        $title="";
        $content="";
        $status="";

        $userId =$_SESSION['userId'];    
    
        $message="";
        $color = "";
        $ok = true;

        if(isset($_POST["submit"]))//erst wenn Absenden gedrückt wird
        {
          if (empty($_POST["title"])) {
            $ok = false;

            $message .= "Bitte Titel eintragen! <br>";
          } else {
            $title = strip_tags($_POST["title"]);
          }
          
            $content=strip_tags($_POST["content"]);
            // $status=$_POST["status"];

            if (isset($_POST['private'])) {
              $status = "private";
            } else if (isset($_POST['public'])) {
              $status = "public";
              
            }  else {

              $message .= "Bitte Status wählen! <br>";
              $ok = false;
            }

          if ($ok===true) {
            $this->notesRepository->createNote($title, $content, $status, $userId);
            //wenn Eintrag erfolgreich
              $color .= "green";
              $message = "Notiz erfolgreich erstellt!";
              
            	} else {
                $color .= "red";
              }

          //Formular wieder leeren nach abschicken
          if($ok===true) {
            $title="";
            $content="";

            }    
            
        }

        
        
        $this->render("note/noteAdmin/notesCreate", [
          'title' => $title,
          'content' => $content,
          'message' => $message,
          'color' => $color

        ]);
        // var_dump($notes);
    }
  
###########################################################################
//Nur Notizen vom eingeloggten User sollen erscheinen (persönliche Notizen in Dashboard)
// zum EDITIEREN


    public function notesAdmin()
    {
        $this->loginService->loginCheck();
        $userId =$_SESSION['userId'];  

        $notes = $this->notesRepository->fetchByUser($userId);

        $this->render("note/noteAdmin/notesAdmin", [
            'notes' => $notes
        ]);
    }

  ###########################################################################
    //Notizen bearbeiten


    public function noteEdit()
    {   
        $this->loginService->loginCheck();
        $message = "";
        $color = "";
        $userId =$_SESSION['userId']; 
        $id = $_GET['id'];
        $statusPrint = "";
        $ok = true;
        $note = $this->notesRepository->fetchSingle($id); // show single Notes

        /*damit User nicht auf private Notizen anderer User zugreifen kann
         durch Manipulation der URL*/
         if ($note['fk_user_id'] !== $userId) {
          header("location: dashboard");
        }

        if (isset($_POST['title']) && isset($_POST['content'])) 
        {

          //Titel darf nicht leer sein
          if (empty($_POST["title"])) {
            $ok = false;
 
            $message .= "Bitte Titel eintragen! <br>";
          } else {
            $note->title = strip_tags($_POST["title"]);
          }

          $note->content = strip_tags($_POST['content']);

          if (isset($_POST['private'])) {
            $note->status = "private";
          } else if (isset($_POST['public'])) {
            $note->status = "public";
          }  
          
          if ($ok===true) {
          $this->notesRepository->updateNote($note);
          $color = "green";
          $message .= "Notiz erfolgreich geändert!";
          } else {
            $color = "red";
          }
        }

          //welcher Text wird gezeigt nach "aktueller Status:"
          if ($note->status == "private") {
            $statusPrint = "privat";
          } else if ($note->status == "public") {
            $statusPrint = "öffentlich";
          }
  
        
  
        $this->render("note/noteAdmin/notesEdit", [
          'note' => $note,
          'color' => $color,
          'message' => $message,
          'statusPrint' => $statusPrint
        ]);

        
    }

##########################################################################
    //Notizen löschen

    // Bestätigungsseite:

    public function noteDeleteConf()
    {

        $this->loginService->loginCheck();
        $noteId = $_GET['id'];
        $note = $this->notesRepository->fetchSingle($noteId);

          /*damit ma nicht man nicht auf Notizen anderer User löschen kann
         durch Manipulation der URL*/
         if ($note['fk_user_id'] !== $_SESSION['userId']) {
          header("location: dashboard");
        }

        $this->render("note/noteAdmin/noteDeleteConf", [
          'noteId' => $noteId          
        ]);

    }

    //Action:
    
    public function noteDeleteAction(){

      if ($_POST)
      {

        $this->loginService->loginCheck();
        $id = $_POST['id'];
        
        $this->notesRepository->deleteNote($id);

        header("location: notes-admin");

      }

    }

}