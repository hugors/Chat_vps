<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
$dataHoje = date("d/m/Y");


$numProtocolo = $_GET['numProtocolo'];
//decodificando o id do protocolo
$numProtocolo  = base64_decode($numProtocolo);


$_SESSION["numProtocolo"] = $numProtocolo;
if(empty($numProtocolo)){
  header("Location: index.html");
 
}


//busca dados da base
include "core/coreBDSqlNotas.php";
include "core/buscaProtocolo.php";
$queryProtocolo->execute();
$resultado = $queryProtocolo->fetchAll();


if(!$resultado){
    // echo "vazio";
        //echo "dados n!ao encontrado";
}else{
    //   echo "encontrei";
        $numProtocolo       =  $resultado['0']['0'];
        $dataAbertura      =  $resultado['0']['1'];
        $ra                 =  $resultado['0']['2'];
        $nomeAluno          =  $resultado['0']['3'];
        $emailAluno         = $resultado['0']['4'];
        $curso              = $resultado['0']['5'];
        $nomeCoordenador    = $resultado['0']['6'];
        $emailCoordenador   = $resultado['0']['7'];
        $descricaoAluno     = $resultado['0']['8'];
        $status             = $resultado['0']['10'];
        $descricaoCoordenador  = $resultado['0']['9'];
        $turnoAluno  = $resultado['0']['11'];

        $_SESSION["raAluno"] =$ra;
    
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UCB -  INSENÇÃO DE DISCIPLINAS</title>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="apple-touch-icon" sizes="180x180" href="libraries/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="libraries/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="libraries/dist/img/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
    <!-- daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="libraries/dist/css/adminlte.min.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

  
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">


  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12">
        
            <h2 class="m-0"><font color="#0989EE"><i class="fa fa-user-graduate" ></i></font> Solicitação do Aluno</h2>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <p class="card-text">
                  <div class="col-md-12">
                    <form method="post" action="#"  enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                      <div class="form-group">
                                          <label>Protocolo</label>
                                          <div class="input-group">
                                              <input type="text" class="form-control" name="numProtocolo" value= "<?php echo $numProtocolo; ?>" readonly >
                                          </div>
                                          <!-- /.input group -->
                                      </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Data Abertura</label>
                                    <div class="input-group">
                                        <input type="text"  class="form-control" name="dataAbertura" value="<?php echo $dataAbertura ; ?>" readonly>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Matricula/RA</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="ra" value= "<?php echo $ra; ?>"  readonly>
                                    
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nomeAluno" value= "<?php echo $nomeAluno; ?>" readonly>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="emailAluno"  value= "<?php echo $emailAluno; ?>"  readonly>  
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Curso</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="curso"  value= "<?php echo $curso; ?>"  readonly>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Turno</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="curso"  value= "<?php echo $turnoAluno; ?>"  readonly>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nome Coordenador</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="nomeCoordenador"  value= "<?php echo $nomeCoordenador; ?>"  readonly>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="emailCoordenador"  value= "<?php echo $emailCoordenador; ?>" readonly>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                              </div>
                     
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descrição da solicitação</label>
                                       <textarea class="form-control" name="descricaoAluno" readonly><?php echo $descricaoAluno; ?></textarea>
                                    </div>
                                </div>
                                </div>

                                <div class="col-md-12">
                                     <div class="form-group">
                                        <label>Arquivos Anexados</label>
                                        <br>
                                       <?php
                                       include "listarArquivos.php";
                                       ?>
                                    </div>
                                </div>
                              <br/>
                              <div class="col-sm-12">
                                  <h2 class="m-0"><font color="#099447"><i class="fa fa-user-check" ></i></font> Isenção de Disciplinas -  Coordenador</h2>
                                </div><!-- /.col -->
                                <br/>
                              <div class="card card-primary card-outline">
                              <br/>
      
                                <div class="col-md-12">
                               
                                <iframe src="listDiscIsentasBlock.php" width="100%" height="240" frameborder="0" scrolling="auto" frameborder></iframe>
                            
                                    <!-- Modal -->
                                  <div class="modal fade" id="staticBackdrop">
                                    <div class="modal-dialog modal-xl">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                            <iframe src="liberaDisciplina.php" width="100%" height="900" frameborder="0" scrolling="auto" frameborder></iframe>
                                  
                                           
                                            </div>
                                            <button onclick="fecharModal()" class="btn btn-danger"><i class="fas fa-window-close"></i> FECHAR</button>
                                        </div>
                                      </div>
                                   </div>         
                                  </div>
  

                                  
                          
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Parececer da Coordenação</label>
                                      <input type="text" class="form-control"  name="status" value="<?php echo $status ; ?>" readonly>
                                        </div>
                                 </div>
                            </div>
                        
                                <div class="col-md-12">
                                     <div class="form-group">
                                        <label>Descrição do Coordenador</label>
                                       <textarea class="form-control" name="descricaoCoordenador" readonly><?php echo $descricaoCoordenador ; ?></textarea>
                                    </div>
                                </div>    
                                              
                    </form>
                    <button id="download">Gerar PDF</button>  
                 </div>
              </div>
            </div><!-- /.card -->
          </div>
      
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script>

document.getElementById('download').addEventListener('click', function () {
    // Seleciona o conteúdo que você quer converter para PDF
    var element = document.getElementById('content');

    // Configurações para o html2pdf
    var opt = {
        margin:       1,
        filename:     'pagina.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    // Converte o conteúdo em PDF e faz o download
    html2pdf().set(opt).from(element).save();
});

</script>
<script>
// Obtenha o botão e o modal

var modal = document.getElementById("staticBackdrop");

// Quando o usuário clicar no botão, abra o modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Função para fechar o modal e atualizar a página principal
function fecharModal() {
    modal.style.display = "none";
    window.location.reload(); // Atualiza a página principal
}

// Fechar o modal quando o usuário clicar fora da área do modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        window.location.reload(); // Atualiza a página principal
    }
}
</script>
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
