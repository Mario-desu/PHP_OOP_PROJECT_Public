<?php
namespace App\Core;

//Abstrakt, da Controller anderen zum erweitern braucht
//falls neuer Controller dazukommt, muss man ihn nicht neu erstellen

abstract class AbstractController {

  //protected, da Funktion nur im Controller verwendet wird
  protected function render($view, $params)
  {
    /* foreach ($params AS $key => $value) {
      ${$key} = $value;
     }
    

    extract macht das gleiche wie foreach, erstellt Variablen*/
    extract($params);
    include __DIR__ . "/../../views/{$view}.php";
  }

}