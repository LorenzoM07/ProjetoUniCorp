<?php
    session_start();
    header('Content-Type: application/json');
    include '../../db/conexao.php';

    if(!isset($_SESSION['usuario_id']) || $_SESSION['usuario_papel'] !== 'admin'){
        echo json_encode([]); 
        exit;
    }

    $id = $_POST['id'] ?? 0;
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $papel = $_POST['papel'] ?? '';

    if(!$id || !$nome || !$email){
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Preencha todos os campos obrigatórios'
        ]);
        exit;
    }

    $id = $_POST['id'] ?? 0;

    if(!$id){
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'ID inválido!'
        ]);
        exit;
    }

    if($id == $_SESSION['usuario_id']){
        json_encode([
            'status' => 'erro',
            'mensagem' => 'Você não poed excluir seu próprio usuário!'
        ]);
        exit;
    }

    $sql = "DELETE FROM usuarios WHERE id=4";

    if (mysqli_query($conn, $sql)){
        echo json_encode([
            'status' => 'sucesso',
            'mensagem' => 'Usuário excuído com sucesso!'
        ]);
    }else{
        echo json_encode(value: [
            'status' => 'erro',
            'mensagem' => 'Erro ao excluir usuário!'
        ]);
    }