<?php

namespace App\Note;

use App\Core\AbstractModel;

// Model für Notizen


// ArrayAcess implementieren, damit man Eigenschaften von Klasse mit [""] verwenden kann
class NoteModel extends AbstractModel
{

  public $id;
  public $title;
  public $content;
  public $status;
  public $time;
  public $fk_user_id;
}
 ?>
