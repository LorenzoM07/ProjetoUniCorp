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


$sql = "SELECT id, nome, descricao, status FROM cursos ORDER BY id DESC";
$res = mysqli_query($conn, $sql);
//var_dump($res);

$cursos = [];
while ($row = mysqli_fetch_assoc($res)) {
    $cursos[] = $row;
}

echo json_encode($cursos);

?>


