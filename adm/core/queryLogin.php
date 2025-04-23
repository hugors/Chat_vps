<?php

$queryA = $conexao->prepare("SELECT login, email, perfil FROM `ACESSO` WHERE login = :login");
$queryA->bindParam(':login', $login, PDO::PARAM_STR);
$queryA->execute();
$resultado = $queryA->fetch(PDO::FETCH_ASSOC);

// Agora você pode acessar os dados do usuário através da variável $resultado
if ($resultado) {
    $loginUsuario = $resultado['login'];
    $emailUsuario = $resultado['email'];
    $perfilUsuario = $resultado['perfil'];
    // Faça o que precisar com os dados do usuário
} else {
    // Usuário não encontrado
}

    ?>