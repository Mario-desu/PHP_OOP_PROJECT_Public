<?php

namespace App\Login; 

use App\Core\AbstractModel;

// Model für Pwd-Reset-Tabelle


//  Model für Login/User
class PwdResetModel extends AbstractModel
{
    public $pwdResetId;
    public $pwdResetEmail;
    public $pwdResetSelector;
    public $pwdResetToken;
    public $pwdResetExpires;

}