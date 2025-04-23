<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
// Define o fuso horário para São Paulo
date_default_timezone_set('America/Sao_Paulo');
session_start();
$login = $_SESSION["login"] ;
//$emailAluno = $_SESSION["emailAluno"];

    // Parâmetros recebidos do formulário ou de outra fonte
        $idSetor = $_POST['idSetor'];
        $numProtocolo = $_POST['numProtocolo'];
       
        include "conexao.php"; // Certifique-se de que a conexão está configurada corretamente
        // Definindo a conexão
        $conexao = conectar("SPROTOCOLOS");

        try {
            $dataFechamento = date('Y-m-d H:i:s');

                if(($idSetor == 2) or ($idSetor == 5)){
                    $aprovRde = $_POST['aprovRde'];
                    $descricao = $_POST['descricaoDivEnsi'];

                    if($aprovRde == 0){
                        $status = "Fechado";
                        $idSetor = 2;
                        $respAcao = "Indeferido";
                         // envia email aluno se fechado
                         $tipoProtocolo = "RDE";
                         $emailAluno = "hugo.silva@castelobranco.br";
                         include "enviaEmailAluno.php";

                    
                    }else{
                        $status = "Aberto";
                        $idSetor = 3;
                        $respAcao = "Deferido";

                        
                    }
                    $acaoDesejada = "deferir_Indeferir";
                    // Atualiza tb protocolo com parecer do setor 2 - Divisao de Ensino
                    $sql = "UPDATE [dbo].[PROTOCOLOS] SET [status] = :status ,[dataFechamento] = :dataFechamento ,[idSetor] = :idSetor WHERE  [numProtocolo] = :numProtocolo";

                    // Preparando a consulta
                    $stmt = $conexao->prepare($sql);

                    // Bind dos parâmetros
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    $stmt->bindParam(':dataFechamento', $dataFechamento, PDO::PARAM_STR);
                    $stmt->bindParam(':idSetor', $idSetor, PDO::PARAM_STR);
                    $stmt->bindParam(':numProtocolo', $numProtocolo, PDO::PARAM_INT);

                    // Executando a consulta
                    $stmt->execute();

                   

                    //envia email para setor (Financeiro)
                   
                    $emailAluno = "hugo.silva@castelobranco.br";
                    include "enviaEmailSetor.php";

                } else if (($idSetor == 3) or ($idSetor == 5)){
                   
                    $baixaBoleto = isset($_POST['baixaBoleto']) && !empty($_POST['baixaBoleto']) ? $_POST['baixaBoleto'] : 0;

                    if($baixaBoleto == 0){
                        //somente anexa boleto e permanece na mesma etapa do professor
                          // Defina o diretório de destino onde o arquivo será salvo
                          $targetDirectory = "../pdfrde/".$numProtocolo."/boleto/";

                          // Verifique se o diretório existe, caso contrário, crie-o
                          if (!is_dir($targetDirectory)) {
                              mkdir($targetDirectory, 0777, true);
                          }
  
                          // Defina o caminho completo para salvar o arquivo
                          $targetFile = $targetDirectory . basename($_FILES["pdfFile"]["name"]);
  
                          // Verifique se o arquivo realmente é um PDF
                            if ($_FILES["pdfFile"]["type"] == "application/pdf") {
                                    // Verifique se o upload foi feito com sucesso
                                    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
                                        // aqui o arquivo e gravado com sucesso na pasta
                                            //definicao de historico de atividades
                                            $acaoDesejada = "anexou_boleto";
                                            $respAcao = "sim";
                                            $descricao = "Anexado boleto para pagamento tx.";
                                        
                                    } else {
                                        $acaoDesejada = "anexou_boleto";
                                        $respAcao = "nao";
                                        $descricao = "Erro Anexar boleto para pagamento tx.";
                                        echo "...";
                                        echo "<script>
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Aviso',
                                                text: 'OPS! Houve um erro ao enviar o arquivo',
                                                confirmButtonText: 'Ok'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = '../ucb/dashboard.php';  // Redireciona para a lista de usuários
                                                }
                                            });
                                        </script>";
                                        // echo "<p class='text-danger text-center'>Houve um erro ao enviar o arquivo.</p>";
                                            exit(); 
                                    }
                            }else{
                                    $acaoDesejada = "anexou_boleto";
                                    $respAcao = "nao";
                                    $descricao = "Erro em anexar boleto para pagamento tx.";
                                    echo "...";
                                    echo "<script>
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Aviso',
                                            text: 'Por favor, envie um arquivo PDF.',
                                            confirmButtonText: 'Ok'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = '../ucb/dashboard.php';  // Redireciona para a lista de usuários
                                            }
                                        });
                                    </script>";
                                    //echo "<p class='text-danger text-center'>Por favor, envie um arquivo PDF.</p>";
                                        
                            }

                    }else{
                        $acaoDesejada = "baixa_boleto";
                        $respAcao = "sim";
                        $descricao = "baixa doboleto para pagamento tx.";
                        // dado baixa do boleto, muda de etapa para professores
                        // Aqui atualiza o processo para fase de professor Etapa 4
                        $idSetor = 4 ;
                        $sql = "UPDATE [dbo].[PROTOCOLOS] SET [idSetor] = :idSetor WHERE  [numProtocolo] = :numProtocolo";

                        // Preparando a consulta
                        $stmt = $conexao->prepare($sql);

                        // Bind dos parâmetros
                        $stmt->bindParam(':idSetor', $idSetor, PDO::PARAM_STR);
                        $stmt->bindParam(':numProtocolo', $numProtocolo, PDO::PARAM_INT);

                        // Executando a consulta
                        $stmt->execute();
                        //Envia Email para Coordenador
                        $tipoProtocolo = "RDE";
                        include "enviaEmailSetor.php";
                    }
                   

                      


                } else if (($idSetor == 4) or ($idSetor == 5)){
                    $respAcao = "sim";
                    $acaoDesejada ="tratar_fichas";
                    $descricao = "Finalizando etapa de fichas Professores fecha protocolo";

                     // Aqui atualiza o processo para fase de professor Etapa 4
                     $idSetor = 2 ;
                     $status = "Fechado";
                     $sql = "UPDATE [dbo].[PROTOCOLOS] SET [idSetor] = :idSetor, [status] = :status  WHERE  [numProtocolo] = :numProtocolo";

                     // Preparando a consulta
                     $stmt = $conexao->prepare($sql);

                     // Bind dos parâmetros
                     $stmt->bindParam(':idSetor', $idSetor, PDO::PARAM_STR);
                     $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                     $stmt->bindParam(':numProtocolo', $numProtocolo, PDO::PARAM_INT);

                     // Executando a consulta
                     $stmt->execute();
                }
               
            

                // Gravar etapas de atualizacao em tabelas auxiliar para obter historico
                $sqlEtapasLog =  "
                INSERT INTO [dbo].[ETAPASRDE]
                                ([numProtocolo]
                                ,[login]
                                ,[dataLog]
                                ,[acaoDesejada]
                                ,[respAcao]
                                ,[descricao])
                            VALUES
                                (?
                                ,?
                                ,?
                                ,?
                                ,?
                                ,?)" ;

                 // Prepara a declaração
                $stmt = $conexao->prepare($sqlEtapasLog,
                array(
                        PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,
                        PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1
                        )
                    );
                  
                   
                // Executa a declaração
                $stmt->execute(array(
                    $numProtocolo,
                    $login,
                    $dataFechamento,
                    $acaoDesejada,
                    $respAcao,
                    $descricao
                ));

                $resultado = $stmt->rowCount(); 

                echo "...";
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Protocolo Atualizado com sucesso.',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../ucb/dashboard.php';  // Redireciona para a lista de usuários
                        }
                    });
                </script>";
                
            
            } catch (PDOException $e) {
                // Captura de exceções PDO
                echo "...";
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Aviso',
                        text: 'OPS! Protocolo nãò foi atualizado',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '../ucb/dashboard.php';  // Redireciona para a lista de usuários
                        }
                    });
                </script>";
                echo "Erro ao atualizar registro: " . $e->getMessage();
               
            }
        $conexao = null;
?>
