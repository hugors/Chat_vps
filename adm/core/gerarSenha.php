<?php


function gerarSenhaRandomica()
{

    // Define os caracteres disponíveis para a senha
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Gera a senha randômica utilizando os caracteres definidos
    $senha = '';
    for ($i = 0; $i < 8; $i++) {
        $senha .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    // Retorna a senha gerada
    return $senha;
}


    ?>