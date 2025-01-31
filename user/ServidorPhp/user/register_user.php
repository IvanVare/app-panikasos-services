<?php
    include '../connection.php';

    $first_name_user=$_POST['first_name_user'];
    $last_name_user=$_POST['last_name_user'];
    $email_user=$_POST['email_user'];
    $phone_number_user=$_POST['phone_number_user'];
    $age_user=$_POST['age_user'];
    $password_user=$_POST['password_user'];
    $status_user=$_POST['status_user'];

    $sql = "INSERT INTO user_reg (first_name_user, last_name_user, email_user, phone_number_user, age_user, password_user, status_user) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = array($first_name_user, $last_name_user,$email_user, $phone_number_user,$age_user, $password_user, $status_user);

   
    $stmt = sqlsrv_prepare($connection, $sql, $params);

    if (sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
        echo "Registro fallido";
    }else{
        echo "Registro exitoso";
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($connection);
?>
