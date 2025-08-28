<?php
    session_start();
    header('Content-Type: application/json');
    include '../../db/conexao.php';

    if(!isset($_SESSION['usuario_id']) || $_SESSION['usuario_papel'] !== 'admin'){
        echo json_encode([]); 
        exit;
    }

    $sql = "SELECT id, nome, email, papel FROM usuarios ORDER BY id DESC";
    $res = mysqli_query($conn, $sql);

    $usuarios = [];
    while($row = mysqli_fetch_assoc($res)){
        $usuarios[] = $row;
    }
 
    echo json_encode($usuarios);