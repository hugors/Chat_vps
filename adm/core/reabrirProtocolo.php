<?php

$numProtocolo = $_GET['numProtocolo'];
$numProtocolo = base64_decode($numProtocolo);

//busca dados da base
include "conexao.php";
$conexao = conectar("SPROTOCOLOS");
try {
    // Conectar ao banco de dados usando PDO
   
    
    // ID do registro a ser excluído
    $numProtocolo = $numProtocolo; // Defina o ID que deseja excluir aqui
    
    // Query para excluir o registro
    $sql = "UPDATE [dbo].[PROTOCOLOS] SET [status] = 'Aberto' WHERE [numProtocolo] = ?";
    
    // Preparar a declaração
    $stmt = $conexao->prepare($sql);
    
    // Executar a declaração
    $stmt->execute([$numProtocolo]);
    
   header("Location: ../dashboard.php");
    //echo "Efetuou update";

} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Fechar a conexão
$conn = null;



?>