<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php


    // Parâmetros recebidos do formulário ou de outra fonte
        $numProtocolo = $_POST['numProtocolo'];
        $descicaoCoordenador = $_POST['descricaofechado'];
        $status = "Fechado";
        $dataFechamento = date('Y-m-d H:i:s');

    // Configurações de conexão com o banco de dados
        include "conexao.php";

try {
    $conexao = conectar("SPROTOCOLOS");
    include "busca/buscaAtvComplementar.php";

        $querydiscIsenta->execute();
        $resultado = $querydiscIsenta->fetchAll(PDO::FETCH_ASSOC);
                // echo "conectou";
                   if(!$resultado){
                    //nao tem atividades complementares para inserir, apenas fechar protocolo
                        include  "fechaProtocolo.php";
                   }else{
                        // Encontrou atividades complementares, vai listar
                        foreach($resultado as $item)
                        {   
                            $codColigada            = $item['codColigada'];
                            $ra                     = $item['ra'];
                            $codFilial              = $item['codFilial'];
                            $idHabilitacaOFilial    = $item['idHabilitacaoFilial'];
                            $periodoLetivo          = $item['periodoLetivo'];
                            $codComponente          = $item['codComponente'];
                            $codModalidade          = $item['codModalidade'];
                            $cargaHoraria           = $item['cargaHoraria'];
                            $creditos               = $item['creditos'];
                            $descricao              = $item['descricao'];
                            $dataInicio             = $item['dataInicio'];
                            $dataFim                = $item['dataFim'];
                        
                                /* Executa a procedure Atividades Complementares */
                                $conexao = conectar("CORPORERM_AMT_HML");

                                try {
                                        // Montar a chamada da stored procedure com os parâmetros
                                        $sql2 = "DECLARE @RC int
                                        DECLARE @CODCOLIGADA int
                                        DECLARE @RA varchar(20) 
                                        DECLARE @CODFILIAL int
                                        DECLARE @IDHABILITACAOFILIAL int
                                        DECLARE @PERIODOLETIVO varchar(20) 
                                        DECLARE @CODCOMPONENTE int 
                                        DECLARE @CODMODALIDADE int 
                                        DECLARE @CARGAHORARIA int 
                                        DECLARE @CREDITOS int 
                                        DECLARE @DESCRICAO varchar(255) 
                                        DECLARE @DATAINICIO datetime 
                                        DECLARE @DATAFIM datetime 
                                        
                                        EXEC @RC = [dbo].[SP_ATVIDADESCOMPLEMENTARES] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
                                        $stmt2 = $conexao->prepare($sql2);

                                        // Vincular os parâmetros à stored procedure
                                        $stmt2->bindParam(1,  $codColigada, PDO::PARAM_INT);
                                        $stmt2->bindParam(2,  $ra, PDO::PARAM_STR);
                                        $stmt2->bindParam(3,  $codFilial, PDO::PARAM_STR);
                                        $stmt2->bindParam(4,  $idHabilitacaOFilial, PDO::PARAM_INT);
                                        $stmt2->bindParam(5,  $periodoLetivo, PDO::PARAM_STR);
                                        $stmt2->bindParam(6,  $codComponente, PDO::PARAM_INT);
                                        $stmt2->bindParam(7,  $codModalidade, PDO::PARAM_INT);
                                        $stmt2->bindParam(8,  $cargaHoraria, PDO::PARAM_INT);
                                        $stmt2->bindParam(9,  $creditos, PDO::PARAM_INT);
                                        $stmt2->bindParam(10, $descricao, PDO::PARAM_STR);
                                        $stmt2->bindParam(11, $dataInicio, PDO::PARAM_STR);
                                        $stmt2->bindParam(12, $dataFim, PDO::PARAM_STR);
                                    
                                        // Executar a stored procedure
                                        $stmt2->execute();
                                            
                                        
                                    } catch(PDOException $e) {
                                        //echo $e ;
                                        echo "...";
                                        echo "<script>
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Aviso Sistema',
                                                        text: 'Falha Atualizar RM, favor contactar Administrador Sistema',
                                                        confirmButtonText: 'Ok'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location.href = '../ucb/dashboard.php';
                                                            }
                                                        });
                                                </script>";
                                                exit();
                                    }
                        }
                         //Depois o LOOP fecha protocolo
                        include  "fechaProtocolo.php";     
                         // Fechar a conexão com o banco de dados
                        $conn = null;
                    }
} catch (PDOException $e) {
       
        echo "...";
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Aviso Sistema',
                        text: 'Falha Atualizar Atividades',
                        confirmButtonText: 'Ok'
                    });
                </script>";
    

    echo $e ;

}

// Fechando a conexão com o banco de dados
$conexao = null;
?>
