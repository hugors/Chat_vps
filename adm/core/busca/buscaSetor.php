<?php
try {
    $conexao = conectar("SPROTOCOLOS");
    
    $buscaSetores = $conexao->prepare(" 
        SELECT [id]
              ,[nome]
        FROM [SPROTOCOLOS].[dbo].[SETOR]
        WHERE id = :idSetor
    ");
    
    // Usando parâmetro nomeado para evitar SQL injection
    $buscaSetores->bindParam(':idSetor', $idSetor, PDO::PARAM_INT);
    
    $buscaSetores->execute();
    $resultadoSetor = $buscaSetores->fetchAll(PDO::FETCH_ASSOC);

    $nomeSetor = ''; // Inicializa a variável
    
    foreach($resultadoSetor as $setor) {
        $nomeSetor = $setor['nome'];
    }
    
} catch (PDOException $e) {
    // Log do erro ou tratamento adequado
    error_log("Erro ao buscar setor: " . $e->getMessage());
    $nomeSetor = ''; // Ou algum valor padrão em caso de erro
    
    // Opcional: lançar a exceção novamente se quiser que o código superior trate
    // throw $e;
} catch (Exception $e) {
    // Captura outras exceções não relacionadas ao PDO
    error_log("Erro geral: " . $e->getMessage());
    $nomeSetor = '';
}
?>