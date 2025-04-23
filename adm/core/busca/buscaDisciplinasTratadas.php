<?php

$queryDisciplinaTratada = $conexao->prepare("  
SELECT 
       [numProtocolo]
      ,[raAluno]
      ,[turma]
      ,[curso]
      ,[disciplina]
      ,[sigla]
      ,[nomeProfessor]
      ,[datainicio]
      ,[datafim]
      
  FROM 
        [SPROTOCOLOS].[dbo].[FICHAPROFESSOR]
  WHERE
        [numProtocolo] = '$numProtocolo'

");
$queryDisciplinaTratada->execute();
$resultadoTratada = $queryDisciplinaTratada->fetchAll(PDO::FETCH_ASSOC);
?>