<!-- Inclusão do SweetAlert no cabeçalho do HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
$login = $_SESSION["login"] ;
$dataInsere = date("d/m/Y H:i:s");

$numProtocolo = $_POST['numProtocolo'];
$raAluno = $_POST['raAluno'];
$codTurma = $_POST['codTurma'];
$codCurso = $_POST['codCurso'];
$disciplina = $_POST['disciplina'];
$sigla = $_POST['codDisciplina'];
$professor = $_POST['professor'];
$iniData = $_POST['iniData'];
$fimData = $_POST['fimData'];
$tarefas = $_POST['tarefas'];
$bibliografia = $_POST['bibliografia'];
$dtRetirada = $_POST['dtRetirada'];
$dtLimite = $_POST['dtLimite'];




  include "conexao.php";
  $conexao = conectar("SPROTOCOLOS");

try {
    // Início do bloco try
    /* AQUI GRAVA OS DADOS NO BANCO DE DADOS */
    $abreProtocolo = "insert into [dbo].[FICHAPROFESSOR]
                            ([numProtocolo]
                            ,[raAluno]
                            ,[turma]
                            ,[curso]
                            ,[disciplina]
                            ,[sigla]
                            ,[nomeProfessor]
                            ,[datainicio]
                            ,[datafim]
                            ,[tarefas]
                            ,[bibliografia]
                            ,[dataRetiradaAluno]
                            ,[dataDevolucaoTarefas]
                            ,[datainsere]
                            ,[login])
                      values(
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?, 
                            ?,
                            ?, 
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?)";

    // Prepara a declaração
    $stmt = $conexao->prepare($abreProtocolo,
        array(
            PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,
            PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1
        )
    );

    // Executa a declaração
    $stmt->execute(array(
        $numProtocolo,
        $raAluno,
        $codTurma,
        $codCurso,
        $disciplina,
        $sigla,
        $professor,
        $iniData,
        $fimData,
        $tarefas,
        $bibliografia,
        $dtRetirada,
        $dtLimite,
        $dataInsere,
        $login
    ));

    $resultado = $stmt->rowCount();

    if ($resultado == 1) {
        // AQUI RESULTADO OK PARA INSERT DOS DADOS
        $numPro = base64_encode($numProtocolo);
        echo "...";
        echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Aviso',
                        text: 'Fecha salva com Sucesso!.',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        window.location.href = 'busca/buscaDisciplinaProfessor.php';
                    });
               </script>";
           
    
    } else {
        // Caso nenhum dado tenha sido inserido
        throw new Exception("Nenhum registro foi inserido no banco de dados.");
        
    }
} catch (PDOException $e) {
    // Erros relacionados ao banco de dados
    echo "...";
    echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Problemas Sistêmicos',
                    text: 'Favor tentar daqui a pouco.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    window.location.href = 'busca/buscaDisciplinaProfessor.php';
                });
            </script>";
           // $erro = "Erro genérico: " . $e->getMessage();
            //    echo $e->getMessage();
   
} catch (Exception $e) {
    // Erros genéricos
    echo "...";
    echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Problemas Sistêmicos',
                    text: 'Favor acionar administador sistema.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    window.location.href = 'busca/buscaDisciplinaProfessor.php';
                });
            </script>";
           // echo $e->getMessage();
    
} finally {
    // Fechamento do banco de dados no bloco finally
    if (isset($conexao)) {
        $conexao = null; // Fecha a conexão com o banco de dados
    }
}
?>