<?php
session_start();

// Limpa todas as variáveis da sessão
$_SESSION = array();

// Limpa a sessão
session_unset();
session_destroy();

// Limpa os cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 1000);
        setcookie($name, '', time() - 1000, '/');
    }
}


//grava log
/*
$tipo = "logoff_Aluno";
include "core/conexao.php";
include "logAudit.php";
*/
// Redirecionar para a página de login
header('Location: index.html');

?>