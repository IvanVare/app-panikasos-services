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


$first_name_user=$_POST['first_name_user'];
$last_name_user=$_POST['last_name_user'];
$email_user= $_POST['email_user'];
$phone_number_user= $_POST['phone_number_user'];
$ubication_user= $_POST['ubication_user'];
$contact_firstname_user= $_POST['contact_firstname_user'];
$contact_lastname_user= $_POST['contact_lastname_user'];
$contact_email_user= $_POST['contact_email_user'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                     
    $mail->isSMTP();                             
    $mail->Host       = 'smtp.gmail.com';         
    $mail->SMTPAuth   = true;                       
    $mail->Username   = 'msospanika@gmail.com';    
    $mail->Password   = 'vyoshdohdfbgmovv';
    $mail->SMTPSecure = 'ssl';         
    $mail->Port       = 465;                  

    //Recipients
    $mail->setFrom('msospanika@gmail.com', 'MSOS Panika');
    $mail->addAddress($contact_email_user);   
    //$mail->addAddress('ellen@example.com');      

    //Content
    $mail->isHTML(true);                        
    $mail->Subject = 'Asunto test';


    $file = fopen("../templates/body_panic_warning.html", "r");
    $str = fread($file, filesize("../templates/body_panic_warning.html"));
    $str = trim($str);
    fclose($file);
    $str = str_replace('{first_name_user}','{last_name_user}','{email_user}','{phone_number_user}','{ubication_user}',
                        '{contact_firstname_user}','{contact_lastname_user}','{contact_email_user}',
                        $first_name_user, $last_name_user,$email_user,$phone_number_user, $ubication_user,
                        $contact_firstname_user,$contact_lastname_user,$contact_email_user, $str);
    $mail->Body    = $str;

    $mail->send();
    echo 'Exito';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}