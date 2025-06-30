<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../index.html");
    exit;
}
$id_produto = $_POST['id_produto'];
$nome_produto = $_POST['nome_produto'];
$preco_produto = $_POST["preco"];
$descricao = $_POST["descricao"];
$categoria = $_POST["categoria"];
$quantidade = $_POST["quantidade"];

if (empty($nome_produto) && empty($preco_produto) && empty($descricao) && empty($quantidade)) {
    echo "algo deu errado ";
    header("LOCATION:../venda_online/frontend/estoque_loja_front.php");
}

require_once "../data_base/conexao_db.php";

$query = "UPDATE produtos 
          SET nome_produto = '$nome_produto',
              desccricao = '$descricao',
              preco = '$preco_produto',
              categoria = '$categoria',
              quantidade = '$quantidade'
          WHERE id_produto = '$id_produto'";
$conexao->exec($query);

header("LOCATION:../frontend/estoque_loja_front.php");
