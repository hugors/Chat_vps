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
$queryBuscaFichaAluno = $conexao->prepare("
    SELECT 
        [numProtocolo]
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
        ,[login]
    FROM 
        [SPROTOCOLOS].[dbo].[FICHAPROFESSOR]
    WHERE 
        [numProtocolo] = :numProtocolo AND 
        [raAluno] = :raAluno 
       
");

$queryBuscaFichaAluno->bindParam(':numProtocolo', $numProtocolo);
$queryBuscaFichaAluno->bindParam(':raAluno', $ra);


try {
    $queryBuscaFichaAluno->execute();
    $resultado = $queryBuscaFichaAluno->fetch(PDO::FETCH_NUM); // Retorna a próxima linha como array numérico
   
    if ($resultado) {
        $numProtocolo   = $resultado[0];
        $raAluno        = $resultado[1];
        $statusFicha = 1;
    }else{
        $statusFicha = 0;
       
    }

} catch (PDOException $e) {
  //  echo $e;
    echo "...";
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
    </script>");  
} 
?>
</body>
</html>