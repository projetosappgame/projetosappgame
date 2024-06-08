<?php
require_once 'pdoconfig.php';
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username,$password);
    //echo "Conectado ao Banco de Dados $dbname em $host com Sucesso.";
} catch (PDOException $pe) {
    die("Não foi possível se conectar ao banco de dados $dbname :" . $pe
>getMessage());
}
?>