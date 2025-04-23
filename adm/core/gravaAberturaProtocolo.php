<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<?php
// Inicia sessão no TOPO do script (antes de qualquer output)
session_start();

// Verifica se é uma submissão POST válida
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.html");
    exit();
}

// 1. Inclua seu arquivo de conexão
require_once "conexao.php";

// 2. Verifique CSRF Token
if (!isset($_POST['csrf_token']) || !isset($_SESSION['form_token']) || 
    $_POST['csrf_token'] !== $_SESSION['form_token']) {
    http_response_code(403);
    echo "...";
    exit("
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro de Segurança',
            text: 'Token inválido ou formulário já enviado.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '../logoff.php';
        });
    </script>");
}

verificaRaAluno($ra);

// 5. Conexão e Processamento
$conexao = null;
try {
    $conexao = conectar("SPROTOCOLOS");
    
    // Gera número de protocolo (exemplo)
    $dataAbertura = date('Y-m-d H:i:s');
    $status = 'Aberto';

    // Query com parâmetros nomeados (mais legível)
    $abreProtocolo = "insert into [dbo].[PROTOCOLOS]
                    ([numProtocolo]
                    ,[dataAbertura]
                    ,[ra]
                    ,[nomeAluno]
                    ,[emailAluno]
                    ,[curso]
                    ,[codcurso]
                    ,[nomeCoordenador]
                    ,[emailCoordenador]
                    ,[descricaoAluno]
                    ,[status]
                    ,[turno]
                    ,[tipoProtocolo]
                    ,[grade]
                    ,[codCampus]
                    ,[idSetor])
                    values(
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?, 
                        ?,
                        ?, 
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?)";

            // Prepara a declaração
            $stmt = $conexao->prepare($abreProtocolo,
            array(
            PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY,
            PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1
            )
            );

            // Executa a declaração
            $stmt->execute(array(
                    $numProtocolo,
                    $dataAbertura,
                    $ra,
                    $nomeAluno,
                    $emailAluno,
                    $curso,
                    $codCurso,
                    $nomeCoordenador,
                    $emailCoordenador,
                    $descricaoAluno,
                    $status,
                    $turnoAluno,
                    $tipoProtocolo,
                    $gradeAluno,
                    $codCampusAluno,
                    $idSetor
                    ));

    $resultado = $stmt->rowCount();
    if ($resultado == 1) {
        // Limpa o token APÓS sucesso na gravação
            unset($_SESSION['form_token']);

            //  Resposta de sucesso
            echo "...";
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso Abretura!',
                    html: 'Protocolo <b>".htmlspecialchars($numProtocolo, ENT_QUOTES)."</b> criado, Acompamnhe seu processo pelo E-mail',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '../logoff.php';
                });
            </script>";

            //  Envia e-mail
            
                $emailAluno = 'hugo.silva@castelobranco.br';
                include "enviaEmailAluno.php";
              // Sucesso - Limpa sessao
              session_unset();
              session_destroy();
    }else{
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro no Banco',
                text: 'Houve um problema acione o administrador.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../logoff.php';
            });
        </script>";
    }
    

} catch (PDOException $e) {
    echo "...";
    error_log("ERRO DB: " . $e->getMessage());
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro no Banco',
            text: 'Houve um problema ao gravar os dados.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '../index.html';
        });
    </script>";
    echo $e ;
} finally {
    if ($conexao) $conexao = null;
}
?>