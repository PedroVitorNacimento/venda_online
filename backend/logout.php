<?php
// Inicia a sessão
session_start();

// Destrói todas as variáveis da sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header("Location:http://localhost/venda_online/");
exit;
