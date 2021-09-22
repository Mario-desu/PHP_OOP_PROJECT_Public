<?php

session_start();

require __DIR__ . "/../init.php";

/**********************************************************************
                     Routing hinzufügen für URL
***********************************************************************/

$pathInfo = $_SERVER["PATH_INFO"]; //["ORIG_PATH_INFO"] für Hosting (meine Homepage)sonst ohne ORIG_

// var_dump($_SERVER);



//vor diesem Schritt noch im Container definieren wie Login-Controller 
//gebaut wird
//auf welchen controller bzw. method zeigt
$routes = [
    "/start" => [
        "controller" => "notesController",
        "method" => "landing"
    ],

    "/index" => [
        "controller" => "notesController",
        "method" => "index"
    ],

    "/note" => [
        "controller" => "notesController",
        "method" => "showNote"
    ],




    "/register" => [
        "controller" => "loginController",
        "method" => "register"
    ],
    "/verify-user" => [
        "controller" => "loginController",
        "method" => "verifyUser"
    ],


    "/login" => [
        "controller" => "loginController",
        "method" => "login"
    ],

    "/reset-pw-request" => [
        "controller" => "loginController",
        "method" => "pwResetRequest"
    ],

    "/create-new-password" => [
        "controller" => "loginController",
        "method" => "setNewPassword"
    ],

    "/reset-pw-action" => [
        "controller" => "loginController",
        "method" => "resetPasswordAction"
    ],


    "/admdash" => [
        "controller" => "loginController",
        "method" => "admDash"
    ],

    "/dashboard" => [
        "controller" => "loginController",
        "method" => "dashboard"
    ],

    "/logout" => [
        "controller" => "loginController",
        "method" => "logout"
    ],

    "/user-edit" => [
        "controller" => "loginController",
        "method" => "userEdit"
    ],

    "/user-delconf" => [
        "controller" => "loginController",
        "method" => "userDeleteConf"
    ],

    "/user-delete" => [
        "controller" => "loginController",
        "method" => "userDeleteAction"
    ],



    "/mynotes" => [
        "controller" => "notesAdminController",
        "method" => "myNotes"
    ],    

    "/mynotes-detail" => [
        "controller" => "notesAdminController",
        "method" => "showMyNote"
    ],    

    "/notes-admin" => [
        "controller" => "notesAdminController",
        "method" => "notesAdmin"
    ],    

    "/notes-create" => [
        "controller" => "notesAdminController",
        "method" => "newNote"
    ],

    "/notes-edit" => [
        "controller" => "notesAdminController",
        "method" => "noteEdit"
    ],

    "/notes-delconf" => [
        "controller" => "notesAdminController",
        "method" => "noteDeleteConf"
    ],

    "/notes-delete" => [
        "controller" => "notesAdminController",
        "method" => "noteDeleteAction"
    ],
];

// var_dump($pathInfo);

//wenn Route definiert ist, wird Controller gebaut und Methode aufgerufen
if (isset ($routes[$pathInfo])) {
    $route = $routes[$pathInfo];
    // var_dump($route);
    $controller = $container->create($route["controller"]);
    $method = $route["method"];
    $controller->$method();
}


?>