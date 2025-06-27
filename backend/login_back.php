<?php
$email = $_POST['email'];
$senha = $_POST['senha'];

if (empty($email || $senha)) {
    echo "email ou senha não enviados";
    header("LOCATION:../venda_online/index.html");
    exit;
}

require_once "../data_base/conexao_db.php";

$query = "SELECT id_usuario, nome, email, senha FROM usuarios WHERE email = '$email' LIMIT 1";
$retorna_banco = $conexao->query($query);


$usuario = $retorna_banco->fetch(pdo::FETCH_ASSOC);


if ($usuario["email"] != $email) {
    header("LOCATION: ../venda_online/index.html");
    exit;
} elseif ($usuario['senha'] != $senha) {
    header("LOCATION: ../venda_online/index.html");
    exit;
}


session_start();
$_SESSION['id_usuario'] = $usuario["id_usuario"];
$_SESSION['nome'] = $usuario['nome'];


header("LOCATION:http://localhost/venda_online/frontend/cadastro_pruduto_front.php");
exit;
