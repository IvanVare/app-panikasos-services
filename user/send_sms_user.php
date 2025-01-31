<?php
    // Asegúrate de cargar todas las dependencias de Composer
    require_once '/path/to/vendor/autoload.php';
    use Twilio\Rest\Client;

    // Utiliza variables de entorno para manejar las credenciales de forma segura
    $sid    = getenv('TWILIO_ACCOUNT_SID');
    $token  = getenv('TWILIO_AUTH_TOKEN');
    $twilio = new Client($sid, $token);

    $message = $twilio->messages
      ->create("+522464934066", // Número al que se enviará el SMS
        array(
          "from" => "+12285911003", // Tu número de Twilio
          "body" => "Hola, este es un mensaje de prueba desde Twilio."
        )
      );

    // Imprime el SID del mensaje, que es un identificador único para el mensaje enviado
    print($message->sid);
?>
