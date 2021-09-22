<?php

namespace App\Core;

use PDO;
use Exception;
use PDOException;

use App\Note\NotesController;
use App\Login\LoginController;
use App\Note\NotesAdminController;
use App\Note\NotesRepository;
use App\Note\CommentsRepository;
use App\Login\LoginRepository;
use App\Login\PwdResetRepository;
use App\Login\LoginService;





class Container
{

  private $receipts = [];
  private $instances = [];

  //"Bauanleitungen":
  public function __construct()
  {
    $this->receipts = [

      'notesAdminController' => function() {
        return new NotesAdminController(
          $this->create("notesRepository"),
          $this->create("loginService"),
          $this->create("commentsRepository"),
          $this->create("loginRepository")
          );        
      },

      // 2. LoginService wird gebaut, nachdem ein LoginRepository kreiert wird
      'loginService' => function() {
        return new LoginService(
          $this->create("loginRepository")
      ); 
      
      },
      // 3. LoginController wird mit LoginService gebaut
      'loginController' => function() {
        return new LoginController(
          $this->create("loginService"),
          $this->create("loginRepository"),
          $this->create(("pwdResetRepository"))
        );
      },
      
      'notesController' => function() {
        return new NotesController(
          $this->create("notesRepository"),
          $this->create("commentsRepository"),
          $this->create("loginService"),
          $this->create("loginRepository")
        );
      },

      'notesRepository' => function() {
        return new NotesRepository(
          $this->create("pdo")
        );//die PDO_verbindung herstellen
      },

      'commentsRepository' => function() {
        return new CommentsRepository(
          $this->create("pdo")
        );//die PDO_verbindung herstellen
      },

      'pwdResetRepository' => function() {
        return new PwdResetrepository(
          $this->create("pdo")
      ); 
      //die PDO_verbindung herstellen
    },

      //1. LoginRepository wird gebaut mit DB-Verbindung
      'loginRepository' => function() {
        return new LoginRepository(
          $this->create("pdo")
      ); 
      //die PDO_verbindung herstellen
      },



      'pdo' => function() {

        $host_name = 'localhost';
        $database = 'notes2';
        $user_name = 'root';
        $password = '****';
        $pdo = null;

        // damit Passwort nicht angezeigt wird:
        try {$pdo = new PDO(
          "mysql:host=$host_name; dbname=$database;", 
          $user_name, 
          $password

        );
      
      } catch (PDOException $e) {
         echo "Verbindung zur Datenbank fehlgeschlagen";
        
        die();
      }
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // deaktivieren, wegen sql-injection
        //https://stackoverflow.com/questions/134099/are-pdo-prepared-statements-sufficient-to-prevent-sql-injection/12202218#12202218

        return $pdo;
      }
    ];
  }

  public function create($name)
  {
    if (!empty($this->instances[$name]))
    {
      return $this->instances[$name];
    }

    if (isset($this->receipts[$name])) {
      $this->instances[$name] = $this->receipts[$name]();
    }

    return $this->instances[$name];
  }

}