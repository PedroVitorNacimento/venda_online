<?php
// conexão banco de dados 

$dsn = 'mysql:dbname=venda_online;host=localhost';
$user = 'root';
$password = '12345678';

try {
    //instanciando o banco de dados 
    $conexao = new Pdo($dsn, $user, $password);

    // configura o pdo para lançar excecões em caso de erro
    $conexao->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //trata os erros de conexao
    die(json_encode(["status" => "error", "message" => "Erro de conexão: " . $e->getMessage()]));
}
