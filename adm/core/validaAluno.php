<?php
function verificaRaAluno($raAluno) {
    try {
        // Verificação robusta do RA
        if (!isset($raAluno) || $raAluno === '' || $raAluno === null || $raAluno === 0 || $raAluno === '0') {
            // Força o cabeçalho para evitar caching
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Data no passado

            // Verifica se a sessão não está ativa antes de iniciar
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Limpeza segura da sessão
            $_SESSION = array();
            
            // Destruição completa da sessão
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            
            session_destroy();
            $urlRequisicao = $_SERVER['REQUEST_URI']; // Ex: "/acomplementar/testes/url.php"

            // 2. Remove parâmetros de query (se houver)
            $caminho = strtok($urlRequisicao, '?');

            // 3. Divide o caminho em partes
            $partes = explode('/', trim($caminho, '/'));

            // 4. Pega a pasta desejada (última pasta antes do arquivo)
            $pastaAtual = '';

            if (count($partes) >= 2) {
                $pastaAtual = $partes[count($partes) - 2]; // Penúltimo segmento
            }
            if($pastaAtual == "core"){
                header("Location: ../logoff.php");
            }else{
                header("Location: logoff.php");
            }
        
            // Redirecionamento com SweetAlert2
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                  <script>
                      document.addEventListener("DOMContentLoaded", function() {
                          Swal.fire({
                              icon: "error",
                              title: "Erro de Validação",
                              html: "O RA do aluno é inválido ou não foi fornecido.<br><br>" +
                                    "<b>Código do erro:</b> RA_INVALIDO_001",
                              confirmButtonText: "OK",
                              allowOutsideClick: false,
                              backdrop: true
                          }).then((result) => {
                              if (result.isConfirmed) {
                                  window.location.href = "index.html";
                              }
                          });
                      });
                  </script>';
            exit();
        }

        // Se tudo estiver OK, retorna true
        return true;

    } catch (Exception $e) {
        header("Location: ../index.html");
        // Fallback para caso ocorra algum erro inesperado
        error_log("Erro na verificação do RA: " . $e->getMessage());
        
        echo '<script>
                alert("Ocorreu um erro inesperado. Por favor, recarregue a página.");
                window.location.href = "index.html";
              </script>';
        exit();
    }
}
?>