<?php
namespace App\Login;

use App\Core\AbstractController;

############################################################
//                Controller für Login/User     
############################################################
class LoginController extends AbstractController
{
    public function __construct(LoginService $loginService, LoginRepository $loginRepository, PwdResetRepository $pwdResetRepository)
    {
        $this->loginService = $loginService;
        $this->loginRepository = $loginRepository;
        $this->pwdResetRepository = $pwdResetRepository;
    }

##########################################################
// Dashboard für Admin (Userverwaltung)

    public function admDash()
    {


        $this->loginService->loginCheck();
        $this->loginService->loginAdmCheck();

        $users = $this->loginRepository->fetchAllUsers();

 


        $this->render("user/userAdm/admDash", [
            'users' => $users
        ]);
    }



###########################################################
// Dashboard for User

    public function dashboard()
    {
     
        $this->loginService->loginCheck();

        $userFirstName = $_SESSION['firstName'];

        $this->render("user/dashboard", [
            'userFirstName' => $userFirstName
        ]);
        
    }

    
###########################################################
//Login


    public function login()
    {
       // Umleitung falls schon eingeloggt
        if (isset($_SESSION['login'])) {
            header("location: dashboard");
       
            } 

        $message = "";
        $email = "";
        $password = "";


        if (isset($_POST['email']) && isset($_POST['password'])) {
            
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);


            //Prüfung ob E-mail eingegeben wurde
            if(empty($email))
            {
                $message .= "Sie müssen die E-Mail-Adresse eingeben!<br>";
  
            }
            

            if ($this->loginService->loginTry($email, $password)) {
                header("Location: dashboard");
                return;
            }  else {
                $message .= "Die Kombination aus Benutzername und Passwort ist falsch!<br>"; 
            }
            
        }

        //Parameter übergeben um sie in der View zu nutzen
        $this->render("user/login", [
            'email' => $email,
            'message' => $message]);
    }       

######################################################
//Logout
    
    public function logout()
    {
        $this->loginService->logout();
        header("Location: index");
    }






###########################################################
// Admin kann Userdaten ändern (inkl. Rolle)

    public function userEdit()
    {
        $this->loginService->loginCheck();
        $this->loginService->loginAdmCheck();
        $color = "";
        $message = "";
        $ok = true;
        $userId = $_GET['id'];
        $rolePrint = "";
       
        
        $user = $this->loginRepository->fetchUserById($userId);

        if ($user->role == "admin") {
            $rolePrint = "Admin";
        } else if ($user->role == "user") {
            $rolePrint = "User";
        }

        if (isset($_POST['submit'])) 
        {
            $user->lastName = strip_tags($_POST['lastName']);
            $user->firstName = strip_tags($_POST['firstName']);
            $user->email = strip_tags($_POST['email']);

            //Prüfung ob Nachname eingegeben wurde
            if(empty($user->lastName))
            {

                $ok=false;
                $message .= "Das Feld Nachname darf nicht leer sein!<br>";
            }

            //Prüfung ob Vorname eingegeben wurde
            if(empty($user->firstName))
            {

                $ok=false;
                $message .= "Das Feld Vorname darf nicht leer sein<br>";
            }

            //Prüfung ob E-Mail eingegeben wurde
            if(empty($user->email))
            {

                $ok=false;
                $message .= "Das Feld Email darf nicht leer sein<br>";
            }
            

            if (isset($_POST['admin'])) {
                $user->role = "admin";
              } else if (isset($_POST['user'])) {
                $user->role = "user";
              }  

            
            
            if ($ok===true) {
                $this->loginRepository->updateUser($user);
                $color = "green";
                $message .= "Eintrag erfolgreich geändert!";
                } else {
                    $color = "red";
            }
          
        }

            //welcher Text wird gezeigt nach "aktueller Status:"
            if ($user->role == "admin") {
                $rolePrint = "Admin";
            } else if ($user->role == "user") {
                $rolePrint = "User";
            }
            

        $this->render("user/userAdm/userEdit", [
            'user' => $user,
            'color' => $color,
            'message' => $message,
            'rolePrint' => $rolePrint
        ]);
    }


###########################################################
###########################################################
// 1. Passwort zurücksetzen 


    public function pwResetRequest()
    {

        
        if (isset($_POST['resetRequestSubmit'])) 
        {
        /*Token generieren, mit bin2hex in hexadezimales Format umwandeln,
        damit man es im Link verwenden kann*/
            $selector = bin2hex(random_bytes(8));//Token 1
            $token =  bin2hex(random_bytes(32));// Token 2
            // echo $selector;
            $encodedToken = base64_encode(urlencode($token));

            
            

            // $url = "http://localhost/udemy_php/notes_public/NotesAppVPrivate/public/index.php/create-new-password?selector=" . $selector . "&validator=" . bin2hex($token);
            // $url = "https://mariodev.eu/NotesApp/public/index.php/create-new-password?selector=" . $selector . "&validator=" . bin2hex($token);

            $expires = date("U") + 1800; // Ablaufzeit Token 
            $userEmail = e($_POST['email']);
            

       ###########################################################     
       /* wenn es einen Eintrag mit dieser E-mail gibt in der DB  wird dieser gelöscht,
       damit nicht mehrere Token zu einem User existieren: */



            $this->pwdResetRepository->deletePwdResetEntry($userEmail);

         
       ###########################################################   
         // 2. Daten in Db eintragen (Pwd-reset-Tabelle)  
            // $options = ["cost" =>12];
            // $hashedToken = password_hash($token, PASSWORD_BCRYPT, $options) ;
            
            $this->pwdResetRepository->insertResetPwdEntry($userEmail, $selector, $encodedToken, $expires);

                   ###########################################################
            //3.Reset-E-mail erstellen:

            $this->loginService->pwdResetMail($userEmail, $selector, $encodedToken);


            header("location: reset-pw-request?reset=success");



        } else {
            header("location start");
        }


        $this->render("user/resetPassword", [
            // 'error' => $error,
        ]);
    }

###########################################################
// 4. Seite um Passwort zurückzusetzen nach Erhalt der E-mail
//Selector und Validator werden aus der URL geholt

    public function setNewPassword()
    {

        $selector = $_GET["selector"];
        $validator = $_GET["validator"];


        echo $selector;
        echo "<br>";
        echo $validator;

        if (empty($selector) || empty($validator)) {
            echo "Deine Anfrage konnte nicht validiert werden!";
        } else if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
            //es wird gecheckt, ob Tokens hexadezimale Token sind:

 
        }

        $this->render("user/createNewPassword", [
            'selector' => $selector,
            'validator' => $validator
        ]);

    }

###########################################################
//

    public function resetPasswordAction()
    {
        if (isset($_POST['resetPwdSubmit'])) {
            $selector = e($_POST['selector']);
            $validator = e($_POST['validator']);          
            $password = e($_POST['pwd']);
            $pwdRepeat = e($_POST['pwdRepeat']);
            echo $selector;

            if (empty($password) || empty($pwdRepeat)) {
                header("Location: reset-pw-request?newpwd=empty");
                exit();
            } else if ($password != $pwdRepeat) {
                header("Location: reset-pw-request?newpwd=pwdnotequal");
                exit();
            }

            $currentDate = date("U");


            $result = $this->pwdResetRepository->getResetSelector($selector, $currentDate);
            var_dump($result);


            // $tokenBinary = hex2bin($validator);
            $tokenDecoded = urldecode(base64_decode($validator));
            echo "<br>";
            echo $tokenDecoded;

            $tokenCheck = "";

            if ($tokenDecoded === urldecode(base64_decode($result['pwdResetToken']))) {
                $tokenCheck = true;
            } else {
                $tokenCheck = false;
            }
            // $tokenCheck = password_verify($validator, $result['pwdResetToken']);
            // $tokenCheck = true;
            echo "<br>";
            var_dump($tokenCheck);
            echo "<br>";
            
            // exit();

            if ($tokenCheck === false) {
                echo "Du musst deine Zurücksetzungsanfrage wiederholen";
                exit();
            } else if ($tokenCheck === true) {
                $tokenEmail = $result['pwdResetEmail'];
                echo $tokenEmail;

                $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
           
                $this->loginRepository->updatePassword($newPwdHash, $tokenEmail);
                //damit nicht mehrere Token vom selben USer in DB existieren:

                $this->pwdResetRepository->deletePwdResetEntry($tokenEmail);
                header("Location: login?newpwd=passwordupdated");
            }


        } else {
            header("location: start");
        }

  
    }


###########################################################
###########################################################
// normaler User kann sein Konto löschen, Admin alle

    // Bestätigungsseite:

    public function userDeleteConf()
    {   
        $this->loginService->loginCheck();

        $userId = $_GET['id'];
        $userRole = $_SESSION['role'];

        $this->loginService->loginCheck();

        //Damit man nicht anderen Usre löschenkann als normaler User
        
        if ($userId == $_SESSION['userId']) {
            true;
        } else if ($userId !== $_SESSION['userId'] && $userRole !== 'admin') {
            header("Location: dashboard");
        }

        $this->render("user/userAdm/userDeleteConf", [
            'userId' => $userId          
        ]);

    }

    // Action-Seite:
    public function userDeleteAction()
    {
        $this->loginService->loginCheck();

        
        $this->loginService->removeAccount();


        if($_SESSION['role'] == 'user') {
            header("Location: logout");
       } else if($_SESSION['role'] == 'admin') {
            header("Location: dashboard");
       }

       
    }


###########################################################
// neuen User registrieren

    public function register(){

        $lastName="";
        $firstName="";
        $email="";
        $password1="";
        $password2="";
        $zustimmungAGB="";
        $zustimmungDatenschutz="";

        //getting recaptcha from include

        include("../includes/recaptcha.php");
        
        // $publicKeyRecaptcha = "**********************";
        // $secretKeyRecaptcha ="***********************";
        // $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify";
            
        $ok=true;
        $message="";

        if(isset($_POST["submit"]))//erst wenn Absenden gedrückt wird
        
        {

            //Google recaptcha
            $response_key = $_POST['g-recaptcha-response'];

            $response = file_get_contents($recaptchaUrl . "?secret=" . $secretKeyRecaptcha . "&response=" . $response_key . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
            $response = json_decode($response);
            // print_r($response);

            if(!$response->success == 1){
                $ok=false;
                $message .="Bitte Captcha verwenden!<br>";
            }

            $lastName=strip_tags($_POST["lastName"]);
            $firstName=strip_tags($_POST["firstName"]);
            $email=strip_tags($_POST["email"]);
            $password1=$_POST["password1"];
            $password2=$_POST["password2"];

            
            //Prüfung ob Nachname eingegeben wurde
            if(empty($lastName))
            {

                $ok=false;
                $message .= "Sie müssen den Nachnamen eingeben!<br>";
            }

            //Prüfung ob Vorname eingegeben wurde
            if(empty($firstName))
            {

                $ok=false;
                $message .= "Sie müssen den Vornamen eingeben!<br>";
            }


            //Prüfung ob AGB angehakt
            if(isset($_POST["zustimmungAGB"]))
            {
                $zustimmungAGB=$_POST["zustimmungAGB"];
            }
            else
            {
                $ok=false;
                $message .= "Sie müssen den AGBs zustimmen!<br>";
            }

            //Prüfung ob Datenschutz angehakt
            if(isset($_POST["zustimmungDatenschutz"]))
            {
                $zustimmungDatenschutz=$_POST["zustimmungDatenschutz"];
            }
            else
            {
                $ok=false;
                $message .= "Sie müssen dem Datenschutz zustimmen!<br>";
            }

            //Prüfung ob es Email ist
            if(filter_var($email, FILTER_VALIDATE_EMAIL)===false)
            {
                $ok=false;
                $message .= "Keine gültige Email-Adresse!<br>";
            }

            //Prüfung ob PW Mind. 8 Zeichen hat
            if(strlen($password1) < 8)
            {
                $ok=false;
                $message .= "Das Passwort muss mind 8 Zeichen haben!<br>";
            }

            //Prüfung ob PW übereinstimmt
            if($password1<>$password2)
            {
                $ok=false;
                $message .= "Das Passwort stimmt nicht überein!<br>";
            }

            // Passwort-Check, muss vorkommen, egal wo
            $muster1="/[A-Z]/";
            $muster2="/[a-z]/";
            $muster3="/[0-9]/";
            $muster4="/[!?%#\.]/";

            if(
            preg_match($muster1,$password1) && 
            preg_match($muster2,$password1) && 
            preg_match($muster3,$password1) &&     
            preg_match($muster4,$password1)  )      
            {
            
            }
            else {
            $ok=false;
            $message .="Das Passwort braucht Kleinbuchstabe, Großbuchstabe, Zahl und Sonderzeichen(!?%#.)!<br>";
            }    

            //Prüfung ob Email existiert
            $user = $this->loginService->loginRepository->findByEmail($email);
            if($user !==false){
                $ok=false;
                $message .="User mit dieser Email existiert bereits!<br>";
            }

            if($ok===true)
            {
                $message = "<h4>HALLO $firstName!</h4> Du bist fast registriert, bitte checke noch deine E-Mail!";
            }

            $options=["cost"=>12]; 
            $password1=password_hash($password1, PASSWORD_BCRYPT, $options);//überschreiben (was, wie, wie oft)
            
            // Default vor Bestätigungsmail-Verifizierung      
            $role="inactive";   

            
            //token erzeugen für Bestätigungsmail:

            /*Token generieren, mit bin2hex in hexadezimales Format umwandeln,
            damit man es im Link verwenden kann*/
            $selector = bin2hex(random_bytes(8));//Token 1
            $token =  random_bytes(16);// Token 2
        
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);//überschreiben (was, wie, wie oft)

            if($ok===true) {
                //Bestätigungs-Mail
                $this->loginService->registerMail($email, $firstName, $selector, $hashedToken);
                $this->loginRepository->insertUser($lastName, $firstName, $role, $email, $password1, $selector, $hashedToken);

            }

            //Formular wieder leeren nach abschicken
                if($ok===true) {
                $lastName="";
                $firstName="";
                $email="";
                $password1="";
                $password2="";
                $zustimmungAGB="";
                $zustimmungDatenschutz="";
            }
        }


        $this->render("user/register", [
            'message' => $message,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'zustimmungDatenschutz' => $zustimmungDatenschutz,
            'zustimmungAGB' => $zustimmungAGB,
            'publicKeyRecaptcha' => $publicKeyRecaptcha,
            'secretKeyRecaptcha' => $secretKeyRecaptcha,
            'recaptchaUrl' => $recaptchaUrl
        ]);
    }

###########################################################
// neuen registrierten User verifizieren

    public function verifyUser()
    {
        if (isset($_GET['id']) && isset($_GET['selector']) && isset($_GET['token'])) {
            $email = urldecode(base64_decode($_GET['id']));
            $selector = $_GET['selector'];
            $token = $_GET['token'];


            if (empty($selector) || empty($token)) {
                echo "Deine Anfrage konnte nicht validiert werden!";
                    //es wird gecheckt, ob Tokens hexadezimale Token sind:
            } else if (ctype_xdigit($selector) !== false && ctype_xdigit($token) !== false) {
                    //set status from "inactive" to "user"
                    $this->loginRepository->setUserActive($email, $selector, hex2bin($token));
                
            }





            

        }


        $this->render("user/verifyUser", [
            
        ]);

    }
}