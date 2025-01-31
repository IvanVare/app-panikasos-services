<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';


$email_user=$_POST['email_user'];
$codeverification=$_POST['codeverification'];

//$first_name_user='user';



$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                     
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'msospanika@gmail.com';                     //SMTP username
    $mail->Password   = 'vyoshdohdfbgmovv';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom('msospanika@gmail.com', 'MSOS Panika');
    $mail->addAddress($email_user);
    //$mail->addAddress($email_user, $first_name_user);       //Add a recipient
       

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Asunto test';

    
    $file = fopen("../templates/body_reset_password.html", "r");
    $str = fread($file, filesize("../templates/body_reset_password.html"));
    $str = trim($str);
    fclose($file);
    $str = str_replace('{codeVerification}', $codeverification, $str);
    $mail->Body    = $str;


    $mail->send();
    echo 'Exito';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}