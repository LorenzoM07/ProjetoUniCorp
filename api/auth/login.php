<?php
    session_start();
    header('Content-Type: application/json');

    include '../../db/conexão.php';

    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($email || !senha) {
        echo json_encode([
            'status' => 'erro', 
            'messagem' => 'Email e senha são obrigatórios.']);
        exit;
    }

    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $resultado = mysqli_query($conn, $sql);
    $usuario = mysqli_fetch_assoc($result);

    if ($usuario && ($usuario['senha'] == $senha)){
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_email'] = $usuario['email'];
        $_SESSION['usuario_papel'] = $usuario['papel'];

        echo json_encode ([
            'status' => 'sucesso', 
            'mensagem' => 'Usuario autenticado com sucesso.',
            'papel' => $usuario['papel']
        ]);
        }else {
            echo json_encode([
            'status' => 'erro', 
            'mensagem' => 'Email ou senha incorretos.'
        ]);
    }

?>