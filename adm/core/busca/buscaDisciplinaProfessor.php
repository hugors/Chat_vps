<?php
// Inicia a sessão
session_start();
$ra = $_SESSION["raAluno"];
$numProtocolo = $_GET['numProtocolo'];

$numProtocolo = base64_decode($numProtocolo);
include "../conexao.php";
$conexao = conectar("CORPORERM");
include "buscaDisciplinas.php"; 
$queryDisciplina->execute();
$resultado = $queryDisciplina->fetchAll();


$idHabOfficial = $resultado['0']['1'];
$codCurso = $resultado['0']['3'];
$codturma = $resultado['0']['4'];
$codDisciplina = $resultado['0']['5'];
$cargaHoraria = $resultado['0']['6'];
$creditos = $resultado['0']['7'];
$nomeAluno = $resultado['0']['10'];
$codCampus = $resultado['0']['11'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCB - SISTEMA PROTOCOLOS</title>
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="apple-touch-icon" sizes="180x180" href="../plugins/libraries/dist/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../plugins/libraries/dist/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/libraries/dist/img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../plugins/libraries/dist/css/adminlte.min.css">
</head>
<style>
.btn-disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.fa-spin {
    margin-right: 8px;
}
</style>
<br>
<div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-success card-outline">
                    <div class="card-body">
                        <div class="col-md-12">
                             <h4 class="mb-4">Fichas de Atividades do Aluno</h4>
                            <form method="post" action="../../fichaProfessorAluno.php" enctype="multipart/form-data" id="fichaProfessor">

        
                                <i class="fas fa-bullhorn" style="color: #820719;"></i> Escolha abaixo a disciplina desejada para consultar a ficha de Atividaes
                                    <p>  
                                    <input type="text" name="raAluno" class="form-control" value="<?php echo $ra ; ?>" hidden>
                                    <input type="text" name="numProtocolo" class="form-control" value="<?php echo $numProtocolo ; ?>" hidden>
                                    <input type="text" name="nomeAluno" class="form-control" value="<?php echo $nomeAluno ; ?>" hidden>
                                    <input type="text" name="codTurma" class="form-control" value="<?php echo $codturma ; ?>" hidden>
                                    <input type="text" name="codCurso" class="form-control" value="<?php echo $codCurso ; ?>" hidden>

                                    <input type="text" name="codCampus" class="form-control" value="<?php echo $codCampus ; ?>" hidden>
                                    <input type="text" name="cargaHoraria" class="form-control" value="<?php echo $cargaHoraria ; ?>" hidden>                                                            
                                    <input type="text" name="credito" class="form-control" value="<?php echo $creditos ; ?>" hidden>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Escolha a disciplina abaixo </label>
                                            <select class="form-control" multiple data-placeholder="Escolher Instituição" name="disciplina"
                                                style="width: 100%;" REQUIRED>
                                                <?php
                                                    //TODO: Criar busca de disciplinas tratadas
                                                    $conexao = conectar("SPROTOCOLOS");
                                                    include "buscaDisciplinasTratadas.php"; 
                                                    
                                                    $codigosArray = []; // Array para acumular os códigos
                                                    foreach($resultadoTratada as $trato)
                                                    {
                                                        $disciplina =  $trato['disciplina'];
                                                      
                                                       
                                                        ?>
                                                        <option value="<?php echo $disciplina ?>"><?php echo $disciplina ; ?></option>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                    </select>
                                          
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-button">
                                                <div class="button-container">
                                                    <button type="submit" class="btn btn-primary" id="gerarFicha"
                                                        
                                                        <i class="fas fa-check"></i> Abrir Ficha
                                                    </button>
                                                    <button type="button" class="btn btn-success" onclick="window.location.href='../../gridProtocolosAluno.php'">
                                                        <i class="fas fa-reply-all"></i> Voltar
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o formulário e o botão submit
    const form = document.querySelector('form'); // Seleciona o formulário pai
    const submitBtn = document.querySelector('button[type="submit"]');

    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Altera o texto e desabilita o botão
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Aguarde...';
            submitBtn.disabled = true;

            // Opcional: Adiciona uma classe para feedback visual
            submitBtn.classList.add('btn-disabled');

            // O formulário continuará com o submit normal
            // Se quiser fazer submit via AJAX, precisaria de preventDefault()
            // e tratar a requisição manualmente
        });
    }
});
</script>