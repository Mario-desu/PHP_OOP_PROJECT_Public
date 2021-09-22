<?php

namespace App\Note;

use App\Core\AbstractModel;

// Model für Kommentare

class CommentModel extends AbstractModel
{

  public $id;
  public $content;
  public $fk_entry_id;
  public $time;
  public $fk_user_id;

}
 ?>