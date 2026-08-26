<?php

require_once "../infra/conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM clientes WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$cliente = $stmt->get_result()->fetch_assoc();


$sql = "SELECT * FROM animais WHERE cliente_id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$animais = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detalhes do Cliente - AUmigos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

</head>

<body>

<div class="container mt-4">

    <h1>Detalhes do Cliente</h1>

    <div class="card mb-4">

        <div class="card-body">

            <h5><?= $cliente["nome"] ?></h5>

            <p>Email: <?= $cliente["email"] ?></p>

            <p>Telefone: <?= $cliente["telefone"] ?></p>

        </div>

    </div>

    <h2>Animais</h2>

    <table class="table table-bordered">

        <tr>
            <th>Nome</th>
            <th>Espécie</th>
            <th>Raça</th>
            <th>Idade</th>
        </tr>

        <?php while ($animal = $animais->fetch_assoc()) { ?>

        <tr>

            <td><?= $animal["nome"] ?></td>
            <td><?= $animal["especie"] ?></td>
            <td><?= $animal["raca"] ?></td>
            <td><?= $animal["idade"] ?></td>

        </tr>

        <?php } ?>

    </table>

    <a href="../index.php" class="btn btn-secondary">
        Voltar
    </a>

</div>

</body>
</html>