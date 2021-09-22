<?php
require __DIR__ . "/autoload.php";
// require __DIR__ . "/database.php";

/*      htmlentities: converts all characters to html-entities,
z.B <  = &lt, UTF8 to be flexible with server,
protection from Cross-Site-Scripting , similar to htmlspecialchars*/

function e($string) //e = escape
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

$container = new App\Core\Container();


//zum testen:
// $loginRepository = $container->create("loginRepository");
// var_dump($loginRepository->findByEmail("test@user.com"));
// die();

 ?>
