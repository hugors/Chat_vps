<?php
try {
    $conexao = conectar("SPROTOCOLOS");               
    // Consulta SQL para atualizar o registro na tabela protocolos
    $sql = "UPDATE [dbo].[PROTOCOLOS] SET descicaoCoordenador = :descicaoCoordenador, Status = :status, dataFechamento = :dataFechamento WHERE numProtocolo = :numProtocolo";
   
    // Preparando a consulta
    $stmt1 = $conexao->prepare($sql);
   
    // Bind dos parâmetros
    $stmt1->bindParam(':descicaoCoordenador', $descicaoCoordenador, PDO::PARAM_STR);
    $stmt1->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt1->bindParam(':dataFechamento', $dataFechamento, PDO::PARAM_STR);
    $stmt1->bindParam(':numProtocolo', $numProtocolo, PDO::PARAM_INT);
   
    // Executando a consulta de Update do protocolo
    $stmt1->execute();

    echo "...";
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Aviso Sistema',
                text: 'Protocolo Atualizado com Sucesso!',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../ucb/dashboard.php';
                }
            });
            </script>";
            /* Envia Email de Fechamento p/Aluno */

        $emailAluno = "hugo.silva@castelobranco.br";
        include "enviaEmailRespostaAluno.php";
}catch(PDOException $e) {
    echo "...";
    echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Aviso Sistema',
                    text: 'Falha Atualizar, favor contactar Administrador Sistema',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../ucb/dashboard.php';
                    }
                })
            </script>";
            echo $e;

}

    // Fechar a conexão com o banco de dados
    $conn = null;
     


?>