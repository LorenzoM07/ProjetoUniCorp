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

$id = $_POST['id'] ?? 0;
$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$status = $_POST['status'] ?? '';



if (!$id || !$nome || !$descricao || !$status) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Preencha todos os campos obrigatórios'
    ]);
    exit;
}

$update = "UPDATE cursos SET nome='$nome', descricao='$descricao', status='$status'";

$update .=" WHERE id=$id";

if (mysqli_query($conexao, $update)) {
    echo json_encode([
        'status' => 'sucesso',
        'mensagem' => 'Curso atualizado com sucesso!'
    ]);
} else {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro ao atualizar curso!' 
    ]);
}

