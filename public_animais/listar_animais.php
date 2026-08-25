<?php

require_once "../infra/conexao.php";

$sql = "SELECT animais.*, clientes.nome AS cliente
        FROM animais
        INNER JOIN clientes ON animais.cliente_id = clientes.id";

$resultado = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Animais - AUmigos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

</head>

<body>

<div class="container mt-4">

    <h1>Animais</h1>

    <a href="cadastrar_animal.php" class="btn btn-primary mb-3">
        Cadastrar Animal
    </a>

    <table class="table table-bordered">

        <tr>
            <th>Nome</th>
            <th>Espécie</th>
            <th>Raça</th>
            <th>Idade</th>
            <th>Responsável</th>
            <th>Ações</th>
        </tr>

        <?php while ($animal = $resultado->fetch_assoc()) { ?>

        <tr>

            <td><?= $animal["nome"] ?></td>

            <td><?= $animal["especie"] ?></td>

            <td><?= $animal["raca"] ?></td>

            <td><?= $animal["idade"] ?></td>

            <td><?= $animal["cliente"] ?></td>

            <td>

                <a href="editar_animal.php?id=<?= $animal["id"] ?>" class="btn btn-secondary btn-sm">
                    Editar
                </a>

                <a href="excluir_animal.php?id=<?= $animal["id"] ?>" class="btn btn-danger btn-sm">
                    Excluir
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>