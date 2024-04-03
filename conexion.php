<?php
$hostname='';
$database='';
$username='';
$password='';

$conexion=new mysqli($hostname,$username,$password,$database);
if($conexion->connect_errno){
    echo "No se puede conectar"
}

?>