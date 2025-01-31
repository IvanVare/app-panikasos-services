<?php 

    include '../connection.php';

    $email_user=$_POST['email_user'];

    $sql = "SELECT * FROM user_reg WHERE email_user=?";
    $params = array($email_user);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

    $stmt = sqlsrv_query($connection, $sql, $params, $options);


    $userR = array();
    $userR['data'] =array();
    while ($row = sqlsrv_fetch_array($stmt)) {
        $index['first_name_user'] =$row['1'];
        $index['last_name_user'] =$row['2']; 
        $index['phone_number_user'] =$row['3'];
        $index['age_user'] = $row['4'];
        $index['email_user'] = $row['7'];

        array_push($userR['data'], $index);
    }
    $userR["exito"]="1";
    echo json_encode($userR);

    if ($stmt === false) {
        echo "Error al ejecutar la consulta: " . print_r(sqlsrv_errors(), true);
    } else {
        if (sqlsrv_has_rows($stmt)) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                echo json_encode($row, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($connection);

?>