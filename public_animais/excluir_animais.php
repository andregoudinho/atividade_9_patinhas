<?php

require_once "../infra/conexao.php";

$id = $_GET["id"];

$sql = "DELETE FROM animais WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header("Location: listar_animais.php");
    exit;

} else {

    echo "Erro ao excluir animal.";

}

?>