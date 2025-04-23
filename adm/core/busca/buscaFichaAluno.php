<?php

$queryBuscaFichaAluno = $conexao->prepare("
    SELECT 
        [numProtocolo],
        [raAluno],
        [sigla],
        [dataEntrega]
    FROM 
        [SPROTOCOLOS].[dbo].[FICHAALUNO]
    WHERE 
        [numProtocolo] = :numProtocolo AND 
        [raAluno] = :raAluno AND 
        [sigla] = :sigla
");

$queryBuscaFichaAluno->bindParam(':numProtocolo', $numProtocolo);
$queryBuscaFichaAluno->bindParam(':raAluno', $raAluno);
$queryBuscaFichaAluno->bindParam(':sigla', $sigla);

        ?>
