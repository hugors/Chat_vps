<?php
$queryDisciplinaTratadaAluno = $conexao->prepare("
SELECT 
      [numProtocolo],
      [raAluno],
      [turma],
      [curso],
      [disciplina],
      [sigla],
      [nomeProfessor],
      [datainicio],
      [datafim],
      [tarefas],
      [bibliografia],
      [dataRetiradaAluno],
      [dataDevolucaoTarefas]
FROM 
      [SPROTOCOLOS].[dbo].[FICHAPROFESSOR]
WHERE 
      [numProtocolo] = :numProtocolo AND
      [raAluno] = :raAluno AND
      [disciplina] = :disciplina
");

// Verifica se o prepare() deu certo
if (!$queryDisciplinaTratadaAluno) {
    die("Erro ao preparar a query: " . implode(" ", $conexao->errorInfo()));
}

// Executa a query com os parâmetros
$queryDisciplinaTratadaAluno->execute([
    ':numProtocolo' => $numProtocolo,
    ':raAluno' => $raAluno,
    ':disciplina' => $disciplina
]);
