<?php
$host = "localhost";
$user = "root";
$password = "root";
$banco = "petshop_db";

$conexao = mysqli_connect($host, $user, $password, $banco);
if (!$conexao->connect_error) {
    die("Falha na conexão: " . ($conexao->connect_error));
}

$conexao->set_charset("utf8mb4");
?>