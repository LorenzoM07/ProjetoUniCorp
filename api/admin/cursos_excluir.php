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

if (!$id) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'ID inválido!.'
    ]);
    exit;
}

if ($id == $_SESSION['usuario_id']) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Você não pode excluir seu próprio curso.'
    ]);
    exit;
}

$sql = "DELETE FROM cursos WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    

    echo json_encode([
        'status' => 'sucesso',
        'mensagem' => 'Curso excluido com sucesso!' 
    ]);
} else {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro ao excluir curso!'
    ]);
}

