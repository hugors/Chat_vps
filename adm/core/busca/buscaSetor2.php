<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
//busca dados do setor 2 Divisao de ensino//busca dados da base

$conexao = conectar("SPROTOCOLOS");
$queryBuscaSetor2 = $conexao->prepare(" 
SELECT 
      [respAcao],
      [descricao]
FROM [SPROTOCOLOS].[dbo].[ETAPASRDE]
WHERE [numProtocolo] = '$numProtocolo'
AND [id] = (SELECT MAX([id]) 
            FROM [SPROTOCOLOS].[dbo].[ETAPASRDE]
            WHERE [numProtocolo] = '$numProtocolo');
");


try {
    // Executa a query
    $queryBuscaSetor2->execute();
    $resultado = $queryBuscaSetor2->fetchAll(); // Usa PDO::FETCH_ASSOC para evitar índices numéricos
  
    if (!$resultado) {
        // Caso não haja resultados
        echo "...";
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Aviso Sistema',
                        text: 'Dados do Aluno nao encontrado',
                        confirmButtonText: 'Ok'
                    });
                </script>";
    } else {
        // Extrai os dados do resultado
        $msgSetor2       = $resultado['0']['0'];
        $descricaoSetor2       = $resultado['0']['1'];
    
 
        }
    } catch (PDOException $e) {
        // Tratamento de erros
        echo "...";
        echo "<script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'OPs! Estamos com problemas , acionar Administrador.',
                    showConfirmButton: false,
                    timer: 1500
                });
                </script>";
       // echo "Erro ao executar a consulta: " . $e->getMessage();
     //echo "OPs! Estamos com problemas , acionar Administrador.";
      }
?>