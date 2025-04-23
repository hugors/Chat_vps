<!-- Inclusão do SweetAlert no cabeçalho do HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();

$usercadastro = $_SESSION["login"] ;
$dataInput = date('Y-m-d H:i:s');
$numProtocolo = $_POST['numProtocolo'];
$raAluno = $_POST['raAluno'];
$nomeAluno = $_POST['nomeAluno'];
$cursoAluno = $_POST['cursoAluno'];
$gradeAluno = $_POST['gradeAluno'];
$ativoOfertada = isset($_POST['ativoOfertada']) && $_POST['ativoOfertada'] !== '' ? $_POST['ativoOfertada'] : "";  
$tipoParticipacao = isset($_POST['tipoParticipacao']) && $_POST['tipoParticipacao'] !== '' ? $_POST['tipoParticipacao'] : "";  
$instituicao = isset($_POST['instituicao']) && $_POST['instituicao'] !== '' ? $_POST['instituicao'] : ""; 
$local = $_POST['local'];
$convenio = isset($_POST['convenio']) && $_POST['convenio'] !== '' ? $_POST['convenio'] : ""; 
$status = "Aberto";


$inscConfirmada = isset($_POST['inscConfirmada']) ? $_POST['inscConfirmada'] : 'n';
$cumpriu = isset($_POST['cumpriu']) ? $_POST['cumpriu'] : 'n';
$docEntregue = isset($_POST['docEntregue']) ? $_POST['docEntregue'] : 'n';


/* Aqui nesses campos o cod vira junto do nome
    Precisa separar e somente o codigo vai para procedure 
*/
    $comboComponente = $_POST['comboComponente'];
    $comboModalidade = $_POST['comboModalidade'];

    // Separe o campos  
    list($codComponente, $nomeComponente) = explode(" - ", $comboComponente);
    list($codModalidade, $nomeModalidade) = explode(" - ", $comboModalidade);
/* campos usados na procedure */
    $codColigada = 1 ;
    $codFilial = $_POST['codFilial'];
    $idHabilitacaoOfficial = $_POST['idHabilitacaoOfficial'];
    $periodoLetivo = $_POST['periodoLetivo'];
    $codComponente = $codComponente;
    $codModalidade = $codModalidade;
    $cargaHoraria = $_POST['cargaHoraria'];
    $creditos = isset($_POST['creditos']) && $_POST['creditos'] !== '' ? $_POST['creditos'] : 0;
    $descricao = $_POST['descricao'];
    $dataInicio = $_POST['dataInicio'];
    $dataFim = $_POST['dataFim'];
/*-----------*/

 /* Inserir dados na Base SPROTOCLO
    Etapas:
        1. insert base SPROTOCOLO
        2. insert base RM
*/
include "conexao.php";
$conexao = conectar("SPROTOCOLOS");
      /* AQUI GRAVA OS DADOS NO BANCO DE DADOS */
            
$insereAtividadesComplemetar = "
            insert into [dbo].[ACOMPLEMENTAR]
                    ([numProtocolo]
                    ,[codColigada]
                    ,[ra]
                    ,[codFilial]
                    ,[idHabilitacaoFilial]
                    ,[periodoLetivo]
                    ,[codComponente]
                    ,[nomeComponente]
                    ,[codModalidade]
                    ,[nomeModalidade]
                    ,[cargaHoraria]
                    ,[creditos]
                    ,[descricao]
                    ,[dataInicio]
                    ,[dataFim]
                    ,[curso]
                    ,[grade]
                    ,[ativofertada]
                    ,[tipoparticipacao]
                    ,[instituicao]
                    ,[local]
                    ,[convenio]
                    ,[inscricaoconfirmada]
                    ,[cumpriuatividade]
                    ,[docentregue]
                    ,[usercadastro]
                    ,[datainsert]
                    ,[status])

                values( ?, ?, ?,?, ?,?, ?, ?, ?,?,?,?, ?,?, ?, ?,?, ?,?, ?, ?,?, ?,?, ?, ?,?, ? )";


            $stmt = $conexao ->prepare( $insereAtividadesComplemetar, array( PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1  ) );
            $stmt->execute( array( 
                $numProtocolo, 
                $codColigada,
                $raAluno, 
                $codFilial, 
                $idHabilitacaoOfficial, 
                $periodoLetivo, 
                $codComponente,
                $nomeComponente, 
                $codModalidade, 
                $nomeModalidade, 
                $cargaHoraria, 
                $creditos, 
                $descricao, 
                $dataInicio,  
                $dataFim, 
                $cursoAluno, 
                $gradeAluno, 
                $ativoOfertada, 
                $tipoParticipacao, 
                $instituicao, 
                $local, 
                $convenio, 
                $inscConfirmada, 
                $cumpriu, 
                $docEntregue, 
                $usercadastro,
                $dataInput,
                $status ));
            $resultado = $stmt->rowCount();

                        if ($resultado==1){
                                //AQUI RESULTADO OK PARA INSERT DOS DADOS
                                                                       
                                echo "...";
                                echo "<script>
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Aviso Sistema',
                                                text: 'Atividade Gravada com Sucesso',
                                                confirmButtonText: 'Ok'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = '../addComplementar.php';
                                                }
                                            });
                                        </script>";
                        
                            

                                    }else{
                                        echo "...";
                                        echo "<script>
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Aviso Sistema',
                                                        text: 'Tivemos problemas no acesso, favor acionar Adminstrador do Sistema',
                                                        confirmButtonText: 'Ok'
                                                    });
                                                </script>";
                                        $erro = "Erro na gravacao da liberaçào da disciplina";
                                        $paginaErro = "gravaLibDisciplina.php";
                                        $numErro = "022";
                                        include "gravaLog.php";
                                    }
                                // FIM FO BLOCO DE GRAVAR BANCO DE DADOS
        
  



?>
