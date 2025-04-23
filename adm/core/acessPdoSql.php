<?php
session_start();
// Receber o valor do campo "nome" via POST
$ra = trim($_POST['ra']);
$key = trim($_POST['key']);

// Remover espaços em branco no início do texto
$ra = ltrim($ra);
$key = ltrim($key);
include "conexao.php";

//TODO:criar processo para validar RA e KEY
$conexao = conectar("SPROTOCOLOS");
$validaLogin = $conexao->prepare(" 
            SELECT 
                  [raAluno]
                  ,[keyAluno]
                  ,[dataCadastro]
            FROM [dbo].[ACESSO]
            WHERE  (1=1)
                  AND raAluno = $ra 
                  AND keyAluno = $key

  ");

$validaLogin->execute();
$resultadoLogin = $validaLogin->fetchAll();

if (!$resultadoLogin) {
  echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../noIndex.htm'>";
} else {

  $conexao = conectar("CORPORERM");
  @include "queryLogin.php";

  $queryA->execute();
  $resultado = $queryA->fetchAll();


  if (!$resultado) {
    // nao encontrado ALuno no RM
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../noIndex.htm'>";
  } else {

    $_SESSION["campusAluno"] =  $resultado['0']['0'];
    $_SESSION["nomeAluno"] =  $resultado['0']['1'];
    $_SESSION["raAluno"] =     $resultado['0']['2'];
    $_SESSION["cursoAluno"] = $resultado['0']['3'];
    $_SESSION["codCursoAluno"] = $resultado['0']['4'];
    $_SESSION["emailAluno"] = $resultado['0']['5'];

    //exclui o acesso Temp
    include "excluirLogin.php";
    //Direciona para formulario
    
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../painelAluno.php'>";
  }
}
