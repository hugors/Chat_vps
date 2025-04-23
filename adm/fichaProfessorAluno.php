<!-- Inclusão do SweetAlert no cabeçalho do HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$raAluno = $_POST['raAluno'];
$numProtocolo = $_POST['numProtocolo'];
$disciplina = $_POST['disciplina'];

$nomeAluno = $_POST['nomeAluno'];
$codTurma = $_POST['codTurma'];
$codCurso = $_POST['codCurso'];
$codCampus = $_POST['codCampus'];
$cargaHoraria = $_POST['cargaHoraria'];
$credito = $_POST['credito'];


include "core/conexao.php";
$conexao = conectar("SPROTOCOLOS");
//buscar tratamento das fichas 
include "core/busca/buscaDisciplinasTratadasAluno.php";


try {

 // Busca os dados
$resultadoTratadaAluno = $queryDisciplinaTratadaAluno->fetchAll();

// Verifica se encontrou resultados

    $numProtocolo =  $resultadoTratadaAluno[0][0];
    $raAluno =  $resultadoTratadaAluno[0][1];
    $turma =  $resultadoTratadaAluno[0][2];
    $curso =  $resultadoTratadaAluno[0][3];
    $disciplina =  $resultadoTratadaAluno[0][4];
    $sigla =  $resultadoTratadaAluno[0][5];
    $nomeProfessor =  $resultadoTratadaAluno[0][6];
    $datainicio =  $resultadoTratadaAluno[0][7];
    $datafim =  $resultadoTratadaAluno[0][8];
    $tarefas =  $resultadoTratadaAluno[0][9];;
    $bibliografia =  $resultadoTratadaAluno[0][10];
    $dataRetiradaAluno =  $resultadoTratadaAluno[0][11];
    $dataDevolucaoTarefas =  $resultadoTratadaAluno[0][12];
    

    // Separe o codDisciplinaDestino 
    list($codDisciplina, $nomeDisciplina) = explode(" - ", $disciplina);
} catch (PDOException $e) {
    echo $e->getMessage();
   /* echo "...";
    exit("
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Problemas Sistemicos',
            text: 'Estamos enfrentando problemas, volte daqui a pouco!',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'gridProtocolosAluno.php';
        });
    </script>"); */
} 

?>


<!DOCTYPE html>
<html lang="pt">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>UCB - SISTEMA PROTOCOLOS</title>
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Google Font: Source Sans Pro -->
<link rel="apple-touch-icon" sizes="180x180" href="core/plugins/libraries/dist/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="core/plugins/libraries/dist/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="core/plugins/libraries/dist/img/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">

<link rel="stylesheet" href="core/plugins/icheck-bootstrap/icheck-bootstrap.min.css">


<!-- Theme style -->
<link rel="stylesheet" href="core/plugins/libraries/dist/css/adminlte.min.css">
<link rel="stylesheet" href="core/plugins/libraries/dist/css/fichaProfessor.css">
<link rel="stylesheet" href="core/plugins/libraries/dist/css/upload.css">
<head>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('dropzone');
    const input = document.querySelector('.dropzone-input');
    const previewContainer = document.getElementById('preview-container');
    
    // Eventos para drag and drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropzone.classList.add('dragover');
    }
    
    function unhighlight() {
        dropzone.classList.remove('dragover');
    }
    
    // Manipula o drop de arquivos
    dropzone.addEventListener('drop', handleDrop, false);
    input.addEventListener('change', handleFiles, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        input.files = files;
        handleFiles({target: input});
    }
    
    // Exibe preview dos arquivos
    function handleFiles(e) {
        const files = e.target.files;
        
        if(files.length > 0) {
            previewContainer.style.display = 'block';
            previewContainer.innerHTML = '';
            
            Array.from(files).forEach(file => {
                if(file.type === 'application/pdf') {
                    const preview = document.createElement('div');
                    preview.className = 'file-preview';
                    
                    preview.innerHTML = `
                        <i class="fas fa-file-pdf"></i>
                        <span class="file-name">${file.name}</span>
                        <span class="file-size">(${(file.size/1024/1024).toFixed(2)} MB)</span>
                    `;
                    
                    previewContainer.appendChild(preview);
                }
            });
        } else {
            previewContainer.style.display = 'none';
        }
    }
});
</script>


  
</head>

<body>
<br>
<?php include "validaEntregaAluno.php"; ?>

    
    <!-- Cabeçalho -->
    <div class="header">
        <img src="core/plugins/libraries/dist/img/logo_ucb.png" alt="logo.png" class="logo">
        <h1 class="titulo">REGIME DIDÁTICO ESPECIAL (RDE)<br>MAPA DE TAREFAS DOMICILIARES</h1>
    </div>

    <!-- Dados do Aluno -->
    
        <table class="tabela">
            <tr>
                <td>MATRICULA</td>
                <td><input type="text" name="raAluno" value="<?php echo $raAluno; ?>" disabled></td>
                <td>PROTOCOLO</td>
                <td with="250"><input type="text" name="numProtocolo" value="<?php echo $numProtocolo; ?>" disabled>
                </td>
            </tr>
            <tr>
                <td>ALUNO</td>
                <td width="350"><input type="text" name="nomeAluno" value="<?php echo $nomeAluno; ?>" disabled> </td>
                <td width="">TURMA</td>
                <td><input type="text" name="codTurma" value="<?php echo $codTurma; ?>" disabled></td>

            </tr>
            <tr>
                <td>CURSO</td>
                <td><input type="text" name="codCurso" value="<?php echo $codCurso; ?>" disabled></td>
                <td>TURNO</td>
                <td><input type="text" name="turno" value="" disabled></td>
            </tr>
            <tr>
                <td>PROFESSOR</td>
                <td colspan="4"><input type="text" name="professor" id="nomeProfessor"
                        value="<?php echo $nomeProfessor; ?>" disabled></td>

            </tr>

        </table>
        <table class="tabela">
            <tr>
                <td>PERÍODO AFASTAMENTO</td>
                <td width="240"><input type="date" name="iniData" value="<?php echo $datainicio; ?>" disabled></td>
                <td width="240"><input type="date" name="fimData" value="<?php echo $datafim; ?>" required></td>



            </tr>
        </table>

        <!-- Dados da Disciplina -->
        <table class="tabela">
            <tr>
                <td>DISCIPLINA</td>
                <td width="240"><input type="text" name="disciplina" value="<?php echo $disciplina; ?>" disabled></td>
                <td>SIGLA</td>
                <td width="160"><input type="text" name="codDisciplina" value="<?php echo $codDisciplina; ?>" disabled>
                </td>
                <td>CRÉDITOS</td>
                <td width="80"><input type="text" name="credito" value="<?php echo $credito; ?>" disabled></td>
                <td>CARGA HORÁRIA</td>
                <td width="80"><input type="text" name="cargaHoraria" value="<?php echo $cargaHoraria; ?>" disabled>
                </td>
            </tr>
        </table>

        <!-- Tarefas e Bibliografia -->
        <table class="tabela">
            <tr>
                <td class="coluna-tarefa">
                    <div class="titulo-celula">TAREFAS</div>
                    <textarea name="tarefas"  disabled><?php echo $tarefas; ?></textarea>
                </td>
                <td class="coluna-bibliografia">
                    <div class="titulo-celula">BIBLIOGRAFIA</div>
                    <textarea name="bibliografia"  disabled><?php echo $bibliografia; ?></textarea>
                </td>
            </tr>
        </table>

        <!-- Assinaturas -->
        <table class="tabela-formulario">
         <!--   <tr>
                <td><label for="dtRetirada">Data de Retirada dos Trabalhos pelo Aluno</label></td>

            </tr>
            <tr>
                <td><input type="date" id="dtRetirada" name="dtRetirada" value="<?php echo $dataRetiradaAluno; ?>" disabled></td>

            </tr> -->
            <tr>
                <td><label for="dtLimite">Data Limite para a Devolução das Tarefas</label></td>
            </tr>
            <tr>
                <td><input type="date" id="dtLimite" name="dtLimite" value="<?php echo $dataDevolucaoTarefas; ?>" disabled></td>
            </tr>
        </table>
        <p>
        <div class="col-sm-12">
             <h2 class="m-0"><font color="#0989EE"><i class="fas fa-paperclip" ></i></font> Entrega Tarefas da Disciplina </h2>
        </div><!-- /.col -->
        <br>

       
       
       
       

    <form method="post" action="core/gravaDevolutivaAluno.php" id="entregaTrabalho" enctype="multipart/form-data">

          <!-- campos ocultos mais necessarios -->
               <input type="text" name="numProtocolo" value="<?php echo $numProtocolo; ?>" hidden>
                <input type="text" name="disciplina" value="<?php echo $disciplina; ?>" hidden>
                <input type="text" name="codDisciplina" value="<?php echo $codDisciplina; ?>" hidden>
                <input type="text" name="raAluno" value="<?php echo $raAluno; ?>" hidden>    
        <!-- Inicio do upload -->
            <div class="col-md-12">
              
                    <div class="dropzone-container">
                        <div class="dropzone-area" id="dropzone">
                            <div class="dropzone-content">
                                <i class="fas fa-cloud-upload-alt dropzone-icon"></i>
                                <h3 class="dropzone-title">Arraste e solte seus arquivos aqui</h3>
                                <p class="dropzone-text">ou clique para selecionar</p>
                                <small class="dropzone-hint">
                                    <i class="fas fa-exclamation-triangle text-warning"></i> 
                                    Formatos aceitos: PDF (Máx. 5MB cada)
                                </small>
                            </div>
                            <input type="file" name="arquivo[]" multiple="multiple" class="dropzone-input" id="anexo" accept=".pdf" required>
                        </div>
                        <div class="dropzone-preview" id="preview-container">
                            <!-- Arquivos aparecerão aqui -->
                        </div>
                    </div>
            </div>
           <!--FIM-->
            <br>
            <div class="col-md-12">
                <div class="form-button">
                    <div class="button-container">
                        <center>
                            <?php
                            $numPro = base64_encode($numProtocolo);
                        $link = "core/busca/buscaDisciplinaProfessor.php?numProtocolo=$numPro";
                            ?>
                            <button type="button" class="btn btn-success" onclick="window.location.href='<?php echo $link ; ?>'">
                                <i class="fas fa-reply-all"></i> Voltar
                            </button>
                            <button type="submit"  id="btnEnviar" class="btn btn-primary" <?php echo $desativaBotaoEntregaTarefa; ?>>
                                <i class="fas fa-check" ></i> Enviar arquivos
                            </button>
                        </center>
                    </div>
                </div>
            </div>

    </form>
     <!-- Bootstrap JS Bundle with Popper -->
     
</body>

</html>