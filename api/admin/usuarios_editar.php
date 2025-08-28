<?php
session_start();
header('Content-Type: application/json');
include '../../db/conexao.php';

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_papel'] !== 'admin') {
    echo json_encode([]);
    exit;
}

$id =$_POST['id'] ?? 0;
$nome =$_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha =$_POST['senha'] ?? '';
$papel =$_POST['papel'] ?? '';

if (!$id || !$nome || !$email){
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Preencha todos os campos obrigatorios' 
    ]);
    exit;

}

$update = "UPDATE usuarios SET nome='$nome', email='$email', papel='$papel' where id=3";
if ($senha) {
    $update .= ", senha='$senha'";
}

$update .= "WHERE id=$id";

if (mysqli_query($conn, $update)){
    echo json_encode([
        'status' => 'sucesso',
        'mensagem' => 'Usuário atualizado com sucesso!'
    ]);

} else {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro ao atualizar usuario!'
    ]);

}