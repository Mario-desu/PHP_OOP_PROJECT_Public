<?php
namespace App\Login;

require_once("../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use App\Login\LoginRepository;

class LoginService
{
    //Loginrepository wird benötigt um LoginService zu bauen
    //Login Service hat somit Verbindung zur DB
    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

##########################################################    
    //Check ob User eingeloggt ist

    public function loginCheck()
    {
        if (isset($_SESSION['login'])) {
            return true;
       
            } else {
                header("Location: login");
                die(); //ev. besser Exception zu bauen
            }
    }


##########################################################    
    //Check ob man als Admin eingeloggt ist

    public function loginAdmCheck()
    {
        if ($_SESSION['role'] == 'admin') {
            return true;
       
            } else {
                header("Location: dashboard");
                die(); //ev. besser Exception zu bauen
            }
    }

###########################################################
// Registrierungsmail (bestätigen)


    public function registerMail($email, $firstName, $selector, $token)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings

            //Connection data in include_Datei:

            include("../includes/email_connect.php");
            ################### kommt von include ##############################################
            // $mail->isSMTP();                                            //Send using SMTP
            // $mail->Host       = '***********';                     //Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            // $mail->Username   = '***********';                     //SMTP username
            // $mail->Password   = '*************';                               //SMTP password                                
            // //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            ##########################################################################################
    


            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            // $mail->setFrom('****************'); kommt von include
            $mail->addAddress($email);     //Add a recipient

            
            
            //encode email
            $emailEncode = base64_encode(urlencode($email));

        

            $url = "http://localhost/udemy_php/notes_public/NotesAppVPrivate/public/index.php/verify-user?id=" . $emailEncode . "&selector=" . $selector . "&token=" . bin2hex($token);

            //http://localhost/udemy_php/notes_public/NotesAppVPrivate/public/index.php/verify-user?id=
            //https://mariodev.eu/NotesApp/public/index.php/dashboard/verify-user?id=

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->CharSet ="UTF-8"; // Umlaute sind dann möglich
            $mail->Subject = '[Notes] Verifiziere bitte deine Mail-Adresse';
            $mail->Body    = '<p><b>Hallo ' . $firstName . ',</b></p><br><br>
                              <p>vielen Dank für deine Registrierung bei Smart Notes</p>   
                              <p>Bitte bestätige deine E-Mail-Adresse um die Registrierung abzuschließen.</p><br>
                              <p>Klicke diesen Link oder kopiere ihn in den Browser<br><a href= "' . $url .'">' . $url .'</a></p>
                              <br>
                              <p>Dieser Link ist 20 Minuten aktiv</p>
                              <br>
                              <p>Liebe Grüße!</p>';

            $mail->AltBody = 'Bitte bestätige deine E-Mail-Adresse um die Registrierung abzuschließen. Bitte kopiere den Link in den Browser' . $url . '.';

            $mail->send();
            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
            }


 ##########################################################   
    //Was passiert, wenn man einloggt:
    
    public function loginTry($email, $password)
    {
        $user = $this->loginRepository->findByEmail($email);

        
        // var_dump($user);

        if(empty($user)) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['login'] = $user->email;
            $_SESSION['userId'] = $user->userId;
            $_SESSION['role'] = $user->role;
            $_SESSION['firstName'] = $user->firstName;
            $_SESSION['lastName'] = $user->lastName;
            session_regenerate_id(true); //Id wird bei jedem Aufruf geändert
            return true;
        } else {
            return false;
        }
    }


##########################################################
//Logout

    public function logout()
    {
        unset($_SESSION['login']);
        /*session_destroy funktioniert nicht mit IONOS, 
        es kann dann keine Session regeneriert werden*/
        // session_destroy();        
        session_regenerate_id(true);
    }


##########################################################
// User-Konto löschen

    public function removeAccount()
    {
        if($_POST){
    
            //sofort in Zahl umwandeln
            $userId=(int) $_POST["id"];
        }

        $this->loginRepository->deleteUser($userId);


    }   
    


}