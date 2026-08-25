
<?php

require_once "../infra/conexao.php";

$mensagem = "";

$id = $_GET["id"];

$sql = "SELECT * FROM clientes WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$cliente = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    if ($nome == "" || $email == "" || $telefone == "") {

        $mensagem = "Preencha todos os campos.";

    } else {

        $sql = "UPDATE clientes SET nome = ?, email = ?, telefone = ? WHERE id = ?";

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssi", $nome, $email, $telefone, $id);

        if ($stmt->execute()) {

            header("Location: listar_cliente.php");
            exit;

        } else {

            $mensagem = "Erro ao editar cliente.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Cliente - AUmigos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

</head>

<body>

<div class="container mt-4">

    <h1>Editar Cliente</h1>

    <?php if ($mensagem != "") { ?>

        <div class="alert alert-danger">
            <?= $mensagem ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">Nome</label>

            <input type="text" name="nome" class="form-control"
                   value="<?= $cliente["nome"] ?>" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Email</label>

            <input type="email" name="email" class="form-control"
                   value="<?= $cliente["email"] ?>" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Telefone</label>

            <input type="text" name="telefone" class="form-control"
                   value="<?= $cliente["telefone"] ?>" required>

        </div>

        <button type="submit" class="btn btn-primary">
            Salvar
        </button>

        <a href="listar_cliente.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>

</html>