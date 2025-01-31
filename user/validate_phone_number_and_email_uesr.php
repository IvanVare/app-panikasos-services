<?php 

    include '../connection.php';

    $phone_number_user=$_POST['phone_number_user'];
    
    $email_user=$_POST['email_user'];

    

    $sql = "SELECT 1 FROM user_reg WHERE phone_number_user=? OR email_user=?";
    $params = array($phone_number_user, $email_user);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $stmt = sqlsrv_query($connection, $sql, $params, $options);

    $response = array();

    if ($stmt === false) {
        $response["exito"] = "0";
        $response["error"] = "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true);
    } else {
        if (sqlsrv_has_rows($stmt)) {
            $response["exito"] = "0";  
        } else {
            $response["exito"] = "1";  
        }
    }

    echo json_encode($response);

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($connection);

?>