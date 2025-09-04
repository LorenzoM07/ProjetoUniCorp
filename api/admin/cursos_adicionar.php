<?php
// api/admin/usuarios_listar.php
session_start();
header('Content-Type: application/json');
include '../../db/conexao.php';

// cria a sessão de Login do usuario 'Admin'
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_papel'] !== 'admin')) {
    echo json_encode([]);
    exit;
}

$nome = $_POST['nome'] ?? '';
$descriçao = $_POST['descrição'] ?? '';
$status = $_POST['status'] ?? '';


if (!$nome || !$descriçao || !$status) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Preencha todos os campos!'
    ]);
    exit;
}

$sql = "INSERT INTO usuarios (id, nome, descriçao, status) VALUES ('$id', '$nome', '$descriçao', '$status')";
if (mysqli_query($conn, $sql)) {
    echo json_encode([
        'status' => 'sucesso',
        'mensagem' => 'Curso adicionado com sucesso!'
    ]);
} else {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro ao adicionar curso!'
    ]);
}
