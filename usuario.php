<?php
//importar conexion
require 'includes/config/database.php'; 
$db = conectarDB();
//crear email y password
$email = 'correo@correo.com';
$password = 123456;
$passwordHash = password_hash($password, PASSWORD_BCRYPT);
var_dump($passwordHash);
//query para crear usuario
$query = "INSERT INTO usuarios (email, password)VALUES ('{$email}', '{$passwordHash}')";
//agregarlo a la base de datos
mysqli_query($db, $query);

