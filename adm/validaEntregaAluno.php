<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    html, body {
        margin: 0;
        padding: 0;
    }

    .custom-alert {
        background-color: #FFF0F5; /* azul claro */
        border: 2px dashed #D8BFD8; /* borda tracejada azul escuro */
        color: #000;
        margin:10px;
        box-sizing: border-box; /* incluir borda no cálculo da largura */
        padding: 10px;

    }
    .custom-alert-feita {
        background-color: #F0FFFF; /* azul claro */
        border: 2px dashed #B0E0E6; /* borda tracejada azul escuro */
        color: #000;
        margin:10px;
        box-sizing: border-box; /* incluir borda no cálculo da largura */
        padding: 10px;

    }

    .custom-icon-feito {
        font-size: 1.5rem;
        color: #00008b;
        margin-right: 10px;
    }
    .custom-icon {
        font-size: 1.5rem;
        color: #FF6347;
        margin-right: 10px;
    }
  </style>
</head>
<body>
<?php

$conexao = conectar("SPROTOCOLOS");
include "core/busca/buscaFichaAluno.php";




try {
    $queryBuscaFichaAluno->execute();
    $resultado = $queryBuscaFichaAluno->fetch(PDO::FETCH_NUM); // Retorna a próxima linha como array numérico
   
    if ($resultado) {
        $numProtocolo   = $resultado[0];
        $raAluno        = $resultado[1];
        $sigla          = $resultado[2];
        $dataEntrega    = $resultado[3];
        $numPro = base64_encode($numProtocolo);
        $link = "core/busca/buscaDisciplinaProfessor.php?numProtocolo=$numPro";
        echo "
        <div class='col-md-12'>
            <div class='alert custom-alert-feita d-flex justify-content-between align-items-center' role='alert'>
                <span class='custom-icon-feito'>👍 Trabalho dessa disciplina já foi entregue na data $dataEntrega.</span>
                
                <button type='button' class='btn btn-success' onclick='window.history.back()'>
                    <i class='fas fa-reply-all'></i> Voltar
                </button>
            </div>
        </div>";
        
        
        $desativaBotaoEntregaTarefa = "disabled";
    }else{
echo "
<div class='col-md-12'>
    <div class='alert custom-alert d-flex justify-content-between align-items-center' role='alert'>
        <span class='custom-icon'> <h5>⚠️ Essa tarefa ainda não foi entregue!</h5></span>
    
        <button type='button' class='btn btn-danger' onclick='scrollToBottom()'>
            <i class='fas fa-arrow-down'></i> Ir para Entrega
        </button>
    </div>
</div>

<script>
    function scrollToBottom() {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    }
</script>
";

        
        $desativaBotaoEntregaTarefa = "";
    }

} catch (PDOException $e) {
    echo $e;
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
    </script>");  */
} 
?>
</body>
</html>