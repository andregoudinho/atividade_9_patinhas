<?php

require_once "../infra/conexao.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $nome = $_POST["nome"]; 
    $email = $_POST["email"]; 
    $telefone = $_POST["telefone"]; 
    
    if ($nome == "" || $email == "" || $telefone == "") { 
        $mensagem = "Preencha todos os campos."; 
        } else { 
            $sql = "INSERT INTO clientes (nome, email, telefone) 
            VALUES (?, ?, ?)"; 
            
            $stmt = $conexao->prepare($sql); 
            $stmt->bind_param("sss", $nome, $email, $telefone); 
            if ($stmt->execute()) { 
                header("Location: listar_cliente.php"); 
            exit; 
            } else { 
                $mensagem = "Erro ao cadastrar cliente."; 
            } 
        } 
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Cliente - AUmigos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

</head>

<body>

<div class="container mt-4">

    <h1>Cadastrar Cliente</h1>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Cadastrar
        </button>

        <a href="listar_cliente.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>

</html>