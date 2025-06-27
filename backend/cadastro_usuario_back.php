<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirma_senha = $_POST['confirma_senha'];

if (empty($nome) || empty($email) || empty($senha) || empty($confirma_senha)) {
    echo "verifique os campos novamente";
    exit;
}

if ($senha != $confirma_senha) {
    echo "As senha não são iguais";
    exit;
}

require_once "../data_base/conexao_db.php";


$query = "SELECT email FROM usuarios WHERE email = '$email'";
$retorno_banco = $conexao->query($query);

// pega o resultado como array
$dados = $retorno_banco->fetch(PDO::FETCH_ASSOC);

if (!$dados) {
    $query_insert = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    $conexao->exec($query_insert);
    header("Location: http://localhost/venda_online/frontend/cadastro_pruduto_front.php");
    exit;
} else {
    echo "email já cadastrado";
}
