<?php

if (isset($_SESSION["login"])) {
    // A chave 'login' existe no array $_POST
    $login = $_SESSION["login"];
} else {
    // Caso a chave 'login' não exista
    $login = null;  // ou qualquer valor padrão que você queira
}


// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');

$ip =$_SERVER['REMOTE_ADDR'];
$tela = $_SERVER['SCRIPT_NAME'];


// Esses campos precisam estar no arquivo auditado com acao de Entrada e saida
$dataInsert =  date('Y-m-d H:i:s');  // '2025-02-28 14:30:00'

//Processo de gravar no BD

//$tipo = (!empty($tipo) && !is_null($tipo)) ? $tipo : "";
$ra = (!empty($ra) && !is_null($ra)) ? $ra : "";
$numProtocolo = (!empty($numProtocolo) && !is_null($numProtocolo)) ? $numProtocolo : "";
$login = (!empty($login) && !is_null($login)) ? $login : "";

try {
    /* AQUI GRAVA OS DADOS NO BANCO DE DADOS */
    $conexao = conectar("SPROTOCOLOS");
    $gravaAudit = "INSERT INTO [dbo].[AUDIT]
                        ([ip] ,[urlTela] ,[loginAcesso] ,[tipoAcao] ,[dataInsert] ,[raAluno] ,[numProtocolo])
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração
    $stmt = $conexao->prepare($gravaAudit);

    // Executa a declaração
    $executado = $stmt->execute(array($ip, $tela, $login, $tipo, $dataInsert, $ra, $numProtocolo));

    // Verifica se a inserção foi bem-sucedida
    if ($executado) {
       // echo "gravou ok";
    } else {
       // echo "deu ruim";
    }
} catch (PDOException $e) {
    // Exibe o erro se ocorrer uma exceção
    echo "Erro: " . $e->getMessage();
}


?>
