<?php

require_once "../infra/conexao.php";

$mensagem = "";

$id = $_GET["id"];

$sql = "SELECT * FROM animais WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$animal = $stmt->get_result()->fetch_assoc();


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

        $sql = "UPDATE animais
                SET nome = ?, especie = ?, raca = ?, idade = ?, cliente_id = ?
                WHERE id = ?";

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssiii", $nome, $especie, $raca, $idade, $cliente_id, $id);

        if ($stmt->execute()) {

            header("Location: listar_animais.php");
            exit;

        } else {

            $mensagem = "Erro ao editar animal.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Animal - AUmigos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

</head>

<body>

<div class="container mt-4">

    <h1>Editar Animal</h1>

    <?php if ($mensagem != "") { ?>

        <div class="alert alert-danger">
            <?= $mensagem ?>
        </div>

    <?php } ?>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">Nome</label>

            <input type="text" name="nome" class="form-control"
                   value="<?= $animal["nome"] ?>" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Espécie</label>

            <input type="text" name="especie" class="form-control"
                   value="<?= $animal["especie"] ?>" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Raça</label>

            <input type="text" name="raca" class="form-control"
                   value="<?= $animal["raca"] ?>" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Idade</label>

            <input type="number" name="idade" class="form-control"
                   value="<?= $animal["idade"] ?>" required>

        </div>

        <div class="mb-3">

            <label class="form-label">Responsável</label>

            <select name="cliente_id" class="form-control" required>

                <?php while ($cliente = $clientes->fetch_assoc()) { ?>

                    <option value="<?= $cliente["id"] ?>"
                        <?= $cliente["id"] == $animal["cliente_id"] ? "selected" : "" ?>>

                        <?= $cliente["nome"] ?>

                    </option>

                <?php } ?>

            </select>

        </div>

        <button type="submit" class="btn btn-primary">
            Salvar
        </button>

        <a href="listar_animais.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>

</body>
</html>