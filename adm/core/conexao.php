<?php

function conectar($database) {
    try {
        // Parâmetros configuráveis
        $servidor = "localhost";
        $porta = 3306; // Porta padrão do MariaDB/MySQL
        $usuario = "u565387349_atentus";
        $senha = "Atentus#25";

        // Construindo a DSN para MariaDB/MySQL
        $dsn = "mysql:host=$servidor;port=$porta;dbname=$database;charset=utf8mb4";

        // Criando a conexão
        $conexao = new PDO($dsn, $usuario, $senha);

        // Configurando para mostrar erros
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conexao;
    } catch (PDOException $e) {
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        die(); // Interrompe a execução do script em caso de erro
    }
}

//conectar("u565387349_atentus");
?>