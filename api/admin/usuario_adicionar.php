<?php
    session_start();
    header('Content-Type: application/json');
    include '../../db/conexao.php';

    if(!isset($_SESSION['usuario_id']) || $_SESSION['usuario_papel'] !== 'admin'){
        echo json_encode([]); 
        exit;
    }

    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $papel = $_POST['papel'] ?? '';
 
    if (!$nome || !$email || !$senha){
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Preencha todos os campos obrigatórios'
        ]);
        exit;
    }

    $sql = "INSERT INTO usuarios (nome, email, senha, papel) VALUES ('$nome', '$email', '$senha', '$papel')";
    if (mysqli_query($conn, $sql)){
        echo json_encode([
            'status' => 'sucesso',
            'mensagem' => 'Usuário adicionado com sucesso!'
        ]);
    } else {
        echo json_encode([
            'status' => 'erro',
            'mensagem' => 'Erro ao adicionar usuário!'
        ]);
    }