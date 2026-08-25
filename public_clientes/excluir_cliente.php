<?php

require_once "../infra/conexao.php";

$id = $_GET["id"];

$sql = "DELETE FROM clientes WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header("Location: listar_cliente.php");
    exit;

} else {

    echo "Erro ao excluir cliente.";

}

?>