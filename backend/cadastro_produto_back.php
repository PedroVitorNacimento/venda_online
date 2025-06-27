<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
$nome_produto = $_POST["nome_produto"];
$categoria = $_POST["categoria"];
$descricao = $_POST["descricao"];
$quantidade = $_POST["quantidade"];
$preco = $_POST["preco"];

if (empty($nome_produto || $categoria || $descricao || $quantidade || $preco)) {
    echo "verifique se todos os campos estão preenchidos";
    exit;
}

require_once "../data_base/conexao_db.php";

$query = "INSERT INTO produtos (nome_produto, categoria, desccricao, quantidade, preco, id_usuario) VALUES 
                              ('$nome_produto', '$categoria','$descricao','$quantidade','$preco', '$id_usuario')";
$conexao->exec($query);

header("LOCATION:http://localhost/venda_online/frontend/cadastro_pruduto_front.php");
