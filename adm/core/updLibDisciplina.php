<?php
$idProtocolo = $_POST['idProtocolo'];
$numProtocolo = $_POST['numProtocolo'];
$ra = $_POST['ra'];
$dataInput = date("d/m/Y");

$CoddisciplinaOrigem = $_POST['CoddisciplinaOrigem'];
$CodInstOrigem = $_POST['CodinstOrigem'];
$periodoOrigem = $_POST['periodoOrigem'];
$cargaHorariaOrigem = $_POST['cargaHorariaOrigem'];
$conceitoOrigem = $_POST['conceitoOrigem'];
$nroCreditosOrigem = $_POST['nroCreditosOrigem'];
$FaltasOrigem = $_POST['FaltasOrigem'];
$situacaoOrigem = $_POST['situacaoOrigem'];

$codDisciplinaDestino = $_POST['codDisciplinaDestino'];
$instDestino = $_POST['instDestino'];
$periodoDestino = $_POST['periodoDestino'];
$cargaHorariaDestino = $_POST['cargaHorariaDestino'];
$conceitoDestino = $_POST['conceitoDestino'];
$nrocreditosaDestino = $_POST['nrocreditosaDestino'];
$FaltasDestino = $_POST['FaltasDestino'];
$situacaoDestino = $_POST['situacaoDestino'];

$codCurso = $_POST['codCurso'];
$idHabOfficial = $_POST['idHabOfficial'];

if($conceitoOrigem == null){
    $conceitoOrigem = "0.00";
}
if($conceitoDestino == null){
    $conceitoDestino = "0.00";
}
if($cargaHorariaOrigem == null){
    $cargaHorariaOrigem = "00";
}
if($cargaHorariaDestino == null){
    $cargaHorariaDestino = "00";
}

// Separe o CodInstOrigem 
list($CodInstOrigem, $NomeInstOrigem) = explode(" - ", $CodInstOrigem);

// Separe o codDisciplinaDestino 
list($codDisciplinaDestino, $nomeDisciplinaDestino) = explode(" - ", $codDisciplinaDestino);

//verificar se a didsciplina ja existe no RM
include "coreBDSqlRm.php";
$raAluno = $ra;
include "buscaDiscIsentasRM.php";

$querydiscIsentaRM ->execute();
$resultadoRm = $querydiscIsentaRM->fetchAll(PDO::FETCH_ASSOC);
foreach($resultadoRm as $item)
{


    $CODDISCRm =  $item['CODDISC'];
   
    
    if($codDisciplinaDestino == $CODDISCRm){
                echo "<style>
                body {
                background-image: url(../dist/img/fundo.jpeg);
                background-size: cover;
                margin: 0;
                padding: 0;
                background-position: center;
                background-attachment: fixed; /* Isso faz com que a imagem de fundo não role com a página */
        
                }

                .overlay {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    padding: 20px;
                    background-color: #fff;
                    border: 2px solid #ccc;
                    border-radius: 8px;
                    text-align: center;
                    font-size: 18px;
                    color: #333;
                    margin-bottom: 15px;
                }

                .overlay-message {
                    font-size: 16px;
                    color: #666;
                }

                .overlay-button {
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>";

            echo "<div class='overlay'>
                <p>Liberação da Disciplina Adicionada </p>
            
            </div>";
          

                echo "<div class='overlay'>
                <p>AVISO  </p>
                <p class='overlay-message'>Não é possivel escolher essa disciplina, Já esta Isenta!</p>
                <button class='overlay-button' onclick=\"window.location.href = '../liberaDisciplina.php';\">OK</button>
                </div>";
                $erro = "Erro na gravacao da liberaçào da disciplina";
                $paginaErro = "gravaLibDisciplina.php";
                $numErro = "022";
                include "gravaLog.php";
                die();     
       
    }
   
}




@include "coreBDSqlNotas.php";
/* AQUI GRAVA OS DADOS NO BANCO DE DADOS */
                   
    $liberaDisciplina ="UPDATE [dbo].[ISENTADISCIPLINA] 
            SET
                [RA] = ?,
                [DATAINPUT] = ?,
                [NOMEDISCIPLINAORIGEM] = ?,
                [CODDINSTIORIGEM] = ?,
                [NOMEDINSTIORIGEM] = ?,
                [PERIODOORIGEM] = ?,
                [CARGAGHORAORIGEM] = ?,
                [CONCEITOORIGEM] = ?,
                [NROCREDITOORIGEM] = ?,
                [FALTASORIGEM] = ?,
                [SITUACAOORIGEM] = ?,
                [IDHABILITACAOFILIAL] = ?,
                [CODCURSO] = ?,
                [CODDISCIPLINADESTINO] = ?,
                [NOMEDISCIPLINADESTINO] = ?,
                [INSTIODESTINO] = ?,
                [PERIODODESTINO] = ?,
                [CARGAHORADESTINO] = ?,
                [CONCEITODESTINO] = ?,
                [NROCREDITODESTINO] = ?,
                [FALTASDESTINO] = ?,
                [SITIACAODESTINO] = ?
            WHERE
                [ID] = ? ";
             
            $stmt = $conexao->prepare($liberaDisciplina, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1));
            $stmt->execute(array(
                $ra, $dataInput, $CoddisciplinaOrigem, $CodInstOrigem, $NomeInstOrigem, $periodoOrigem, $cargaHorariaOrigem, $conceitoOrigem, $nroCreditosOrigem, $FaltasOrigem,
                $situacaoOrigem, $idHabOfficial, $codCurso, $codDisciplinaDestino, $nomeDisciplinaDestino, $instDestino, $periodoDestino, $cargaHorariaDestino, $conceitoDestino,
                $nrocreditosaDestino, $FaltasDestino, $situacaoDestino, $idProtocolo // Adicione o NUMPROTOCOLO como último parâmetro
           
            $resultado = $stmt->rowCount();
            
          if ($resultado==1){
          //AQUI RESULTADO OK PARA INSERT DOS DADOS
          echo "<style>
          body {
            background-image: url(../dist/img/fundo.jpeg);
            background-size: cover;
            margin: 0;
            padding: 0;
            background-position: center;
            background-attachment: fixed; /* Isso faz com que a imagem de fundo não role com a página */
    
          }
  
          .overlay {
              position: fixed;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              padding: 20px;
              background-color: #fff;
              border: 2px solid #ccc;
              border-radius: 8px;
              text-align: center;
              font-size: 18px;
              color: #333;
              margin-bottom: 15px;
          }
  
          .overlay-message {
              font-size: 16px;
              color: #666;
          }
  
          .overlay-button {
              padding: 10px 20px;
              background-color: #007bff;
              color: #fff;
              border: none;
              border-radius: 5px;
              cursor: pointer;
          }
      </style>";
  
      echo "<div class='overlay'>
          <p>Dados Alterados com sucesso! </p>
         
      </div>";
            

            }else{
                echo "<div class='overlay'>
                <p>ERRO #022! Problemas Sistemicos, dados nao alterados </p>
                <p class='overlay-message'>Favor tentar daqui a pouco.</p>
                <button class='overlay-button' onclick=\"window.location.href = '../listDiscIsentas.php?numProtocolo=$numProtocolo';\">OK</button>
            </div>";
            $erro = "Erro na gravacao da liberaçào da disciplina";
            $paginaErro = "gravaLibDisciplina.php";
            $numErro = "022";
            include "gravaLog.php";
              }

// FIM FO BLOCO DE GRAVAR BANCO DE DADOS

?>
