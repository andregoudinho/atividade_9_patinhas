<?php

require_once "../infra/conexao.php";

$sql = "SELECT * FROM clientes";
$resultado = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clientes - AUmigos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style.css">

</head>

<body>

<div class="container mt-4">

    <h1>Clientes</h1>

    <a href="cadastrar_cliente.php" class="btn btn-primary mb-3">
        Cadastrar Cliente
    </a>

    <table class="table table-bordered">

        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>

        <?php while ($cliente = $resultado->fetch_assoc()) { ?>

        <tr>

            <td><?= $cliente["nome"] ?></td>

            <td>

                <a href="editar_cliente.php?id=<?= $cliente["id"] ?>" class="btn btn-secondary btn-sm">
                    Editar
                </a>

                <a href="excluir_cliente.php?id=<?= $cliente["id"] ?>" class="btn btn-danger btn-sm">
                    Excluir
                </a>

                <a href="dados_cliente.php?id=<?= $cliente["id"] ?>" class="btn btn-info btn-sm">
                    Ver
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>
     <a href="../index.php" class="btn btn-secondary">
        Voltar
    </a>

</div>

</body>

</html>