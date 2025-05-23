<?php

$buscaIDofficial = $conexao->prepare(" 
SELECT DISTINCT

SALUNO.RA                       AS RAbusca,
SHABILITACAOFILIAL.IDHABILITACAOFILIAL AS IDHABOFFICIAL,
SCURSO.CODCURSO						as codcurso



FROM SALUNO

/* FAZ A RELAÇÃO DA TABELA SALUNO COM A TABELA PPESSO ONDE HÁ VÁRIOS CAMPOS DE DADOS CADASTRAIS*/
JOIN	PPESSOA								ON	PPESSOA.CODIGO = SALUNO.CODPESSOA

/* FAZ A RELAÇÃO DA TABELA SALUNO COM A TABELA SCONTRATO PARA CHECAR SE O ALUNO POSSUI UM CONTRATO VIGENTE */
LEFT JOIN	SCONTRATO	(NOLOCK)			ON	SCONTRATO.CODCOLIGADA	= SALUNO.CODCOLIGADA
                                    AND	SCONTRATO.RA			= SALUNO.RA

/* FAZ A RELAÇÃO DA TABELA SCONTRATO COM A TABELA SPLETIVO PARA VALIDAR O PERÍODO LETIVO ATUAL E TAMBÉM VALIDA O TIO DE CURSO (GRAD., PÓS, EXT, COLEGIO)*/
JOIN	SPLETIVO	(NOLOCK)				ON	SPLETIVO.CODCOLIGADA	= SCONTRATO.CODCOLIGADA
                                    AND	SPLETIVO.IDPERLET		= SCONTRATO.IDPERLET
                                    AND SPLETIVO.CODTIPOCURSO = 7

/* aqui faz a validação da estrutura curricula atual do aluno com a filial que estuda (realengo ou penha) */
JOIN	SHABILITACAOFILIAL	(NOLOCK)		ON	SHABILITACAOFILIAL.CODCOLIGADA				= SCONTRATO.CODCOLIGADA
                                    AND	SHABILITACAOFILIAL.IDHABILITACAOFILIAL		= SCONTRATO.IDHABILITACAOFILIAL

/* aqui faz a validação da matriz aplicada para a definição do turno de oferta (manhã, tarde, noite, integral)*/
JOIN	SHABILITACAO	(NOLOCK)			ON	SHABILITACAO.CODCOLIGADA		= SHABILITACAOFILIAL.CODCOLIGADA
                                    AND	SHABILITACAO.CODCURSO			= SHABILITACAOFILIAL.CODCURSO
                                    AND	SHABILITACAO.CODHABILITACAO		= SHABILITACAOFILIAL.CODHABILITACAO

/* aqui faz a validação estrutura curricular atual do aluno */
JOIN	SHABILITACAOALUNO	(NOLOCK)		ON	SHABILITACAOALUNO.CODCOLIGADA				= SHABILITACAOFILIAL.CODCOLIGADA
                                    AND	SHABILITACAOALUNO.IDHABILITACAOFILIAL		= SHABILITACAOFILIAL.IDHABILITACAOFILIAL
                                    AND	SHABILITACAOALUNO.RA						= SALUNO.RA

/* aqui faz a validação do curso  com a filial (realengo ou penha)*/
JOIN	SCURSO	(NOLOCK)					ON	SCURSO.CODCOLIGADA			= SHABILITACAOFILIAL.CODCOLIGADA
                                    AND	SCURSO.CODCURSO				= SHABILITACAOFILIAL.CODCURSO

/* aqui faz a validação do turno (pegar o nome do turno)da estrutura curricular do aluno */
JOIN	STURNO	(NOLOCK)					ON	STURNO.CODCOLIGADA			= SHABILITACAOFILIAL.CODCOLIGADA
                                    AND	STURNO.CODTURNO				= SHABILITACAOFILIAL.CODTURNO

/* aqui faz a validação da unidade com base na da estrutura curricular atual do aluno */
LEFT JOIN	SHABILITACAOFILIALCAMPUS	(NOLOCK)	ON	SHABILITACAOFILIALCAMPUS.CODCOLIGADA			= SHABILITACAOALUNO.CODCOLIGADA
                                            AND	SHABILITACAOFILIALCAMPUS.IDHABILITACAOFILIAL	= SHABILITACAOALUNO.IDHABILITACAOFILIAL
                                            AND	SHABILITACAOFILIALCAMPUS.CODCAMPUS				= SHABILITACAOALUNO.CODCAMPUS

LEFT JOIN	SDISCGRADE	(NOLOCK)	ON	SHABILITACAOFILIAL.CODCOLIGADA			= SDISCGRADE.CODCOLIGADA
                            AND  SHABILITACAOFILIAL.CODCURSO = SDISCGRADE.CODCURSO
                            AND  SHABILITACAOFILIAL.CODHABILITACAO = SDISCGRADE.CODHABILITACAO
                            AND SHABILITACAOFILIAL.CODGRADE = SDISCGRADE.CODGRADE

LEFT JOIN	SDISCIPLINA	(NOLOCK)	ON	SDISCIPLINA.CODDISC			= SDISCGRADE.CODDISC
                            

/* aqui faz a validação da unidade (pegar o nome da unidade) com base na unidade em que o aluno está matriculado (Penha ou Realengo) */
LEFT JOIN	SCAMPUS		(NOLOCK)	ON	SCAMPUS.CODCAMPUS			= SHABILITACAOFILIALCAMPUS.CODCAMPUS

/* aqui faz a validação do tipo de ingresso do aluno (pegar o nome do tipo de ingresso) com base no tipo de ingreso assumido pelo aluno (portador, transferência....) */
LEFT JOIN STIPOINGRESSO (NOLOCK)	ON	STIPOINGRESSO.CODCOLIGADA		= SHABILITACAOALUNO.CODCOLIGADA
                            AND	STIPOINGRESSO.CODTIPOINGRESSO	= SHABILITACAOALUNO.CODTIPOINGRESSO

/* aqui faz a validação tabela spessoa com ppssoa para que possa buscar a Especialização da Pessoa */
LEFT JOIN SPESSOA (NOLOCK)			ON	SPESSOA.CODIGO = PPESSOA.CODIGO

/* aqui faz a validação tabela sinstituicao com spssoa para que possa buscar o nome da IES de segundo grau do aluno */
LEFT JOIN SINSTITUICAO (NOLOCK)		ON	SINSTITUICAO.CODINST = SPESSOA.CODINST2GRAU

/* aqui faz a validação tabela sstatus com shabilitacaoaluno para buscar o nome referente a situação de matricula do aluno */
JOIN	SSTATUS		(NOLOCK)		ON	SSTATUS.CODCOLIGADA	= SHABILITACAOALUNO.CODCOLIGADA
                            AND	SSTATUS.CODSTATUS		= SHABILITACAOALUNO.CODSTATUS
                            AND SSTATUS.CODTIPOCURSO = 7



WHERE 

SALUNO.CODCOLIGADA = 1
AND SALUNO.RA =  '$raAluno' 

");

$buscaIDofficial->execute();
$resbuscaid = $buscaIDofficial->fetchAll(PDO::FETCH_ASSOC);
foreach($resbuscaid as $i)
{
$rabusca =  $i['RAbusca'];
$IDHABILITACAOFILIAL =  $i['IDHABOFFICIAL'];
$CODCURSO =  $i['codcurso'];

}

?>