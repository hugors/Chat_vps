<!-- Inclusão do SweetAlert no cabeçalho do HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include "conexao.php";
$numProtocolo = $_POST['numProtocolo'];
$dataAbertura = $_POST['dataAbertura'];
$ra = $_POST['ra'];
$nomeAluno = $_POST['nomeAluno'];
$emailAluno = $_POST['emailAluno'];
$curso = $_POST['curso'];
$codCurso = $_POST['codCurso'];
$nomeCoordenador = $_POST['nomeCoordenador'];
$emailCoordenador = $_POST['emailCoordenador'];
$descricaoAluno = $_POST['descricaoAluno'];
$turnoAluno = $_POST['turnoAluno'];
$tipoProtocolo = $_POST['tipoProtocolo'];
$gradeAluno = $_POST['gradeAluno'];
$codCampusAluno = $_POST['codCampusAluno'];

include "validaAluno.php";
  verificaRaAluno($ra);

include "validaProtocoloAberto.php";
  verificaProtocoloAberto($ra, $codCurso,$tipoProtocolo);

/* tipos de protocolo
  acomplementar  - atividade complementares { pasta=pdfac}
  rde - RDE    { pasta=pdfrde}
  idisciplina - isencao de disciplina { pasta=pdfid}
*/
    if($tipoProtocolo == "acomplementar"){
      $dir = "../pdfac/";
      $idSetor = 1;
    } else if ($tipoProtocolo == "rde"){
      $dir = "../pdfrde/";
      $idSetor = 2;
    }else if ($tipoProtocolo == "id"){
      $dir = "../pdfid/";
      $idSetor = 1;
    }else {
      $dir = "../pdf/";
    }
// define o status de abertura 
  $status =  "Aberto";
  $dir3 = $dir.$numProtocolo."/"  ;

  if (!file_exists($dir3)) {
      mkdir($dir3, 0777, true);
  }


  $diretorio = $dir3;
  $arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;
  for ($controle = 0; $controle < count($arquivo['name']); $controle++) {

      $destino = $diretorio . "/" . $arquivo['name'][$controle];
      //valida extensão do arquivo

     // Verificação do tamanho do arquivo
     if ($arquivo['size'][$controle] > 100 * 1024 * 1024) {
        // Exibir mensagem de erro e interromper o upload para este arquivo
        //echo "Erro: O arquivo '{$arquivo['name'][$controle]}' excede o limite de 60MB.";
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
            continue; // Ignora o restante do loop para este arquivo
      }

        $type = strtolower(pathinfo($destino, PATHINFO_EXTENSION));
        if($type != "pdf") {
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
                      $paginaErro = "abreProdtocolo.php";
                      $numErro = "A01";
                      include "gravaLog.php";
                      die();
        }else {
              //  echo "Ärquivo certo!";
            //move_uploaded_file — Move um arquivo enviado para uma nova localização
            if (move_uploaded_file($arquivo['tmp_name'][$controle], $destino)) {
                      //  echo  "Ärquivo gravado";
                      include "gravaAberturaProtocolo.php";
                      // grava log de erros
                      $errorInfo = "Sucesso abertura";
                      $erro = $errorInfo;
                      $paginaErro = "abreProdtocolo.php";
                      $numErro = "SA02";
                      include "gravaLog.php";
                        
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

                          
                        // grava log de erros
                        $errorInfo = "Erro abertura :Problema no Arquivo";
                        $erro = $errorInfo;
                        $paginaErro = "abreProdtocolo.php";
                        $numErro = "A02";
                        include "gravaLog.php";
                      die();
                }
            
        }
  }
?>