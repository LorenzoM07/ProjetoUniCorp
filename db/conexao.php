<?php
// db/conexao.php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'projetounicorp';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn){
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro ao conectar ao Banco de Dados: ' . mysqli_connect_error()
    ]);
    exit;
}
?>