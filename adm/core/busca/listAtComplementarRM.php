<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
$numProtocolo = $_SESSION["numProtocolo"];

$dataHoje = date("d/m/Y");

include "../conexao.php";
$conexao = conectar("SPROTOCOLOS");
include "buscaAtvComplementar.php";

$querydiscIsenta->execute();
$resultado = $querydiscIsenta->fetchAll(PDO::FETCH_ASSOC);
if(!$resultado){
    // echo "vazio";
        //echo "dados n!ao encontrado";
       // die();
}else{
   // echo "conectou";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UCB -  SISTEMA PROTOCOLOS</title>
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../libraries/dist/css/adminlte.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../libraries/dist/css/adminlte.min.css">
</head>
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


  
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
       
                      <table class="table">
                        <thead>
                          <tr>
                          <th >Cod. Componente</th>
                            <th>Cod. Modalidade</th>
                            <th>Carga HR</th>
                            <th >Creditos</th>
                            <th>Data Cadastro</th>
                            <th><center>RM</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                        foreach($resultado as $item)
                             {
                                 $id =  $item['id'];
                                 $ra =  $item['ra'];
                                 $codColigada =  $item['codColigada'];
                                 $idHabilitacaoOfficial =  $item['idHabilitacaoFilial'];
                                 $codComponente =  $item['codComponente'];
                                 $codModalidade =  $item['codModalidade'];
                                 $nomeComponente =  $item['nomeComponente'];
                                 $nomeModalidade =  $item['nomeModalidade'];
                                 $cargaHoraria =  $item['cargaHoraria'];
                                 $creditos =  $item['creditos'];
                                 $datainsert =  $item['datainsert'];
                                //TODO verificar daddos no RM
                                $conexao = conectar("CORPORERM_AMT_HML");
                                include "buscaAtvComplementarRM.php";
                                $queryATVRM->execute();
                                $resultadoRm = $queryATVRM->fetchAll(PDO::FETCH_ASSOC);
                                if(!$resultadoRm){
                                     //nao achou 
                                       $corIcon = "#b8271f";
                                       $icon = "fas fa-times-circle	";
                                }else{
                                       //achou
                                       $corIcon = "#25b04a";
                                       $icon = "fas fa-check-circle	";
                                }
                             
                        ?>
                          <tr>
                            <td><?php echo $nomeComponente ;?></td>
                            <td><?php echo $nomeModalidade ;?></td>
                            <td><?php echo $cargaHoraria ;?></td>
                            <td><?php echo $creditos ;?></td>
                            <td><?php echo $datainsert ;?></td>
                            <td><center><font color='<?php echo $corIcon ; ?>'><i class="<?php echo $icon ; ?>" ></i></font></center></td>
                          </tr>
                          <?php
                             }
                          ?>
                                 
                           
                          
                        </tbody>
                      </table>
                     
                    </div>
                    
                 </div>
        


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- AdminLTE App -->
<script src="libraries/dist/js/adminlte.min.js"></script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->

<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->



<!-- date-range-picker -->

<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2({
        theme: 'default'

      })
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
  
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()
  
      //Date picker
      $('#reservationdate').datetimepicker({
          format: 'L'
      });
  
      //Date and time picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
  
  
      
    
    }
      )
  
   
      

    
    
  
    
   
  
  </script>
</body>
</html>
