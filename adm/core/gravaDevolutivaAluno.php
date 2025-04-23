<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
// Define o fuso horário para São Paulo
date_default_timezone_set('America/Sao_Paulo');

 $numProtocolo = $_POST['numProtocolo'];
 $raAluno = $_POST['raAluno'];
 $disciplina = $_POST['disciplina'];
 $sigla = $_POST['codDisciplina'];
 $dataEntrega = date('Y-m-d H:i:s');

 $numPro = base64_encode($numProtocolo);
 $link = "core/busca/buscaDisciplinaProfessor.php?numProtocolo=$numPro";
 

 //definindo local dos arquivos, sera criado uma pasta para cada disciplina
 $dir = "../../pdfrde/";
 $diretorio = $dir.$numProtocolo."/".$sigla."/"  ;

 
 if (!file_exists($diretorio)) {
    mkdir($diretorio, 0777, true);
}

$arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : false;

// Verifica se há arquivos válidos
if ($arquivo && isset($arquivo['name']) && is_array($arquivo['name']) && count($arquivo['name']) > 0 && $arquivo['name'][0] != '') {

    for ($controle = 0; $controle < count($arquivo['name']); $controle++) {

        $destino = $diretorio . "/" . $arquivo['name'][$controle];

        // Verificação do tamanho do arquivo
        if ($arquivo['size'][$controle] > 100 * 1024 * 1024) {
            echo "...";
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'AVISO ! Arquivo excede tamanho!',
                    text: 'Somente é permitido arquivo em formato PDF até 60MB',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    window.history.back();
                });
            </script>";
            continue;
        }

        $type = strtolower(pathinfo($destino, PATHINFO_EXTENSION));
        if ($type != "pdf") {
            echo "...";
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'ERRO ! Arquivo Não Aceito!',
                    text: 'Somente é permitido arquivo em formato PDF.',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    window.history.back();
                });
            </script>";

            // grava log de erros
            $errorInfo = "Erro abertura: Arquivo PDF nao aceito";
            $erro = $errorInfo;
            $paginaErro = "gravaDevolutivaAluno.php";
            $numErro = "D01";
            include "gravaLog.php";
            die();
        } else {
            if (move_uploaded_file($arquivo['tmp_name'][$controle], $destino)) {

                include "conexao.php";
                $conexao = conectar("SPROTOCOLOS");

                $sqlEtapasLog =  "
                    INSERT INTO [dbo].[FICHAALUNO]
                        ([numProtocolo], [raAluno], [sigla], [dataEntrega])
                    VALUES (?, ?, ?, ?)";

                $stmt = $conexao->prepare($sqlEtapasLog, array(
                    PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,
                    PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1
                ));

                $stmt->execute(array(
                    $numProtocolo,
                    $raAluno,
                    $sigla,
                    $dataEntrega
                ));

                $resultado = $stmt->rowCount();

                echo "...";
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: 'Arquivos enviados com sucesso.',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '$link';
                        }
                    });
                </script>";
            } else {
                echo "...";
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ERRO ! Problemas Arquivo!',
                        text: 'Tente Novamente.',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        window.history.back();
                    });
                </script>";
            }
        }
    }

} else {
    // Nenhum arquivo foi enviado
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Atenção!',
            text: 'Nenhum arquivo foi selecionado para envio.',
            confirmButtonText: 'Ok'
        }).then(() => {
            window.history.back();
        });
    </script>";
}


?>