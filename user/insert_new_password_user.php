<?php
    include '../connection.php';
    
    $email_user=$_POST['email_user'];
    $password_user=$_POST['password_user'];

    $sql = "UPDATE user_reg SET password_user = (?) WHERE email_user = '$email_user'";
    $params = array($password_user);
    $stmt = sqlsrv_prepare($connection, $sql, $params);

    if(sqlsrv_execute($stmt) === false){
        echo "Modificación fallida";
        die(print_r(sqlsrv_errors(), true));
    }else{
        echo "Modificación exitosa";
    }
    
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($connection);

?>



