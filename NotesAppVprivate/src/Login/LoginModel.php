<?php

namespace App\Login; 

use App\Core\AbstractModel;


//  Model für Login/User
class LoginModel extends AbstractModel
{
    public $userId;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $role;

}

