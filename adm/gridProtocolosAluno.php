<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
include "core/conexao.php";
$login = $_SESSION["emailAluno"] ;
$ra = $_SESSION["raAluno"];
$nomeAluno = $_SESSION["nomeAluno"] ;


if (!isset($_SESSION["raAluno"])) {
  header("location: logoff.php");
}


// Log Auditoria de acesso
$tipo = "Entrada Aluno Painel";
include "core/logAudit.php";
$dataHoje = date("d/m/Y");
$conexao = conectar("SPROTOCOLOS");
include "core/busca/listaProtocolosAluno.php";

$queryListProtocolos->execute();
$resultado = $queryListProtocolos->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UCB - SISTEMA PROTOCOLO</title>
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="apple-touch-icon" sizes="180x180" href="../libraries/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../libraries/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../libraries/dist/img/favicon-16x16.png">

  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="../libraries/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../libraries/dist/css/gridProtocolosAluno.css">
<!-- <style>
        #listaAlunos {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            margin: 25px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        #listaAlunos thead {
            background: #0c23a8;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        #listaAlunos th {
            padding: 18px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 0.85rem;
            position: sticky;
            top: 0;
        }

        #listaAlunos tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        #listaAlunos tbody tr:last-child {
            border-bottom: none;
        }

        #listaAlunos tbody tr:hover {
            background-color: #f8f9ff;
            transform: translateX(4px);
        }

        #listaAlunos td {
            padding: 16px;
            color: #333;
            font-size: 0.95rem;
            vertical-align: middle;
        }

        /* Zebra striping */
        #listaAlunos tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #listaAlunos tbody tr:nth-child(even):hover {
            background-color: #f8f9ff;
        }

        /* Status indicators (opcional) */
        .status-aprovado {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            background: #4caf50;
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-reprovado {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            background: #f44336;
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            #listaAlunos {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            #listaAlunos th {
                font-size: 0.8rem;
                padding: 12px 8px;
            }
            
            #listaAlunos td {
                padding: 12px 8px;
                font-size: 0.85rem;
            }
        }
</style> -->
            </head>

        <!-- Main LISTA PROTOCOLOS -->
         <div class="content">
             <div class="">
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card card-success card-outline">
                             <div class="card-body">
                                 <div class="col-md-12">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="listaAlunos" class="">
                                            <thead>
                                                <tr>
                                                    <th>Protocolo</th>
                                                    <th>RA</th>
                                                    <th>Tipo</th>
                                                    <th>Status</th>
                                                    <th><center>Financeiro</th>
                                                    <th><center>Ficha Ativividade</center></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($resultado as $item) {
                                                    $numProtocolo =  $item['numProtocolo'];
                                                    $ra =  $item['ra'];
                                                    $curso =  $item['curso'];
                                                    $nomeCoordenador =  $item['nomeCoordenador'];
                                                    $status =  $item['status'];
                                                    $tipoProtocolo =  $item['tipoProtocolo'];
                                                    $numPro = base64_encode($numProtocolo);
                                                    include "alertaFichaAluno.php";

                                                    if ($tipoProtocolo == "acomplementar") {
                                                        $dir = "pdfac";
                                                        $linkFichaProf = "";
                                                        $tipoBotao = "btn btn-secondary";
                                                        $ativaBotao = "disabled";
                                                        $tipoProtocolo = "Atividades" . '<p>' . "Complementares";
                                                        $desativaLink = "onclick='return false;'";
                                                    } else if ($tipoProtocolo == "rde") {
                                                        $dir = "pdfrde";
                                                        $iconeFinanceiro = "fas fa-donate";
                                                        if ($statusFicha == 1) {
                                                            $ativaBotao = "";
                                                            $linkFichaProf = "core/busca/buscaDisciplinaProfessor.php?numProtocolo=$numPro";
                                                            $tipoBotao = "btn btn-primary";
                                                            $desativaLink = "";
                                                        } else {
                                                            $ativaBotao = "disabled";
                                                            $linkFichaProf = "#";
                                                            $tipoBotao = "btn btn-secondary";
                                                            $desativaLink = "onclick='return false;'";
                                                        }
                                                    
                                                        $tipoProtocolo = "RDE";
                                                    }

                                                ?>
                                                <tr>
                                                    <td><?php echo $numProtocolo; ?></td>
                                                    <td><?php echo $ra; ?></td>
                                                    <td><?php echo $tipoProtocolo; ?></td>
                                                    <td><?php echo $status; ?></td>

                                                    <!-- busca boleto pagamento -->
                                                    <td><center><?php include "mostraFiles.php"; ?></center></td>
                                                    <td>
                                                        <center>
                                                            <a href="<?php echo  $linkFichaProf ; ?>"  <?php echo $desativaLink; ?> >
                                                                <button class="<?php echo $tipoBotao ; ?>" type="button"
                                                                    data-toggle="tooltip" data-placement="left"
                                                                    title="Ficha atividades" <?php echo $ativaBotao ; ?>><i
                                                                        class="far fa-file-alt"></i>
                                                                </button></a>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                    
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         </div>
         </div>
         </div>