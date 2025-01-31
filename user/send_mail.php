
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

// Sanitize and validate POST data
$first_name_user = filter_input(INPUT_POST, 'first_name_user', FILTER_SANITIZE_STRING);
$last_name_user = filter_input(INPUT_POST, 'last_name_user', FILTER_SANITIZE_STRING);
$email_user = filter_input(INPUT_POST, 'email_user', FILTER_SANITIZE_EMAIL);
$phone_number_user = filter_input(INPUT_POST, 'phone_number_user', FILTER_SANITIZE_STRING);
$ubication_user = filter_input(INPUT_POST, 'ubication_user', FILTER_SANITIZE_STRING);
$contact_firstname_user = filter_input(INPUT_POST, 'contact_firstname_user', FILTER_SANITIZE_STRING);
$contact_lastname_user = filter_input(INPUT_POST, 'contact_lastname_user', FILTER_SANITIZE_STRING);
$contact_email_user = filter_input(INPUT_POST, 'contact_email_user', FILTER_SANITIZE_EMAIL);

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0;                      // Disable verbose debug output in production
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'msospanika@gmail.com';                     //SMTP username
    $mail->Password   = 'vyoshdohdfbgmovv';                 // SMTP password from environment variable
    $mail->SMTPSecure = 'ssl';                                  // Enable implicit TLS encryption
    $mail->Port       = 465;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom('msospanika@gmail.com', 'Panika SOS');
    $mail->addAddress($contact_email_user);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Alerta SOS';

    $file = fopen("../templates/body_panic_ubication.html", "r");
    if (!$file) {
        echo 'No se pudo abrir la plantilla';
        exit;
    }
    $str = fread($file, filesize("../templates/body_panic_ubication.html"));
    fclose($file);

    $str = str_replace(
        ['{first_name_user}', '{last_name_user}', '{email_user}', '{phone_number_user}', '{ubication_user}', 
        '{contact_firstname_user}', '{contact_lastname_user}', '{contact_email_user}'],
        [$first_name_user, $last_name_user, $email_user, $phone_number_user, $ubication_user,
        $contact_firstname_user, $contact_lastname_user, $contact_email_user],
        $str
    );

    $mail->Body    = $str;

    $mail->send();
    echo 'Exito';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
