<?php

require_once "../infra/conexao.php";

$mensagem = "";

$sql = "SELECT * FROM clientes";
$clientes = $conexao->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $especie = $_POST["especie"];
    $raca = $_POST["raca"];
    $idade = $_POST["idade"];
    $cliente_id = $_POST["cliente_id"];

    if ($nome == "" || $especie == "" || $raca == "" || $idade == "" || $cliente_id == "") {

        $mensagem = "Preencha todos os campos.";

    } else {

        $sql = "INSERT INTO animais (nome, especie, raca, idade, cliente_id)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssii", $nome, $especie, $raca, $idade, $cliente_id);

        if ($stmt->execute()) {

            header("Location: listar_animais.php");
            exit;

        } else {

            $mensagem = "Erro ao cadastrar animal.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastrar Animal - AUmigos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

</head>

<body>

<div class="container mt-4">

    <h1>Cadastrar Animal</h1>

    <?php if ($mensagem != "") { ?>

        <div class="alert alert-danger">
            <?= $mensagem ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">Nome</label>

            <input type="text" name="nome" class="form-control" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Espécie</label>

            <input type="text" name="especie" class="form-control" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Raça</label>

            <input type="text" name="raca" class="form-control" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Idade</label>

            <input type="number" name="idade" class="form-control" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Responsável</label>

            <select name="cliente_id" class="form-control" required>

                <option value="">Selecione um cliente</option>

                <?php while ($cliente = $clientes->fetch_assoc()) { ?>

                    <option value="<?= $cliente["id"] ?>">
                        <?= $cliente["nome"] ?>
                    </option>

                <?php } ?>

            </select>

        </div>

        <button type="submit" class="btn btn-primary">
            Cadastrar
        </button>

        <a href="listar_animais.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>
</html>