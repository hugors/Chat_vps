<?php
function verificaProtocoloAberto($ra, $codCurso, $tipoProtocolo, $pdo = null) {
    // 1. Lista dos protocolos que NÃO permitem duplicidade
    $bloquearDuplicados = [
        'rde' => [
            'mensagem' => 'Já existe um Protocolo RDE aberto para este aluno/curso',
            'redirecionar' => 'index.php'
        ],
        'id' => [
            'mensagem' => 'Protocolo Inotas já está em aberto para este aluno',
            'redirecionar' => 'index.php'
        ]
        // Protocolos não listados aqui permitirão duplicidade
    ];

    // 2. Se for um protocolo que PERMITE duplicidade, retorna false
    if (!isset($bloquearDuplicados[$tipoProtocolo])) {
        return false;
    }

    try {
        // 3. Conexão com o banco
        $pdo = $pdo ?? conectar('SPROTOCOLOS');

        // 4. Query de verificação (SQL Server Syntax)
        $sql = "SELECT TOP 1 id, ra, curso, codcurso 
                FROM PROTOCOLOS 
                WHERE ra = ? 
                AND codcurso = ? 
                AND tipoProtocolo = ? 
                AND status = 'Aberto'";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$ra, $codCurso, $tipoProtocolo]);

        if ($protocolo = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // 5. Monta mensagem detalhada
            $mensagem = $bloquearDuplicados[$tipoProtocolo]['mensagem'];
            $detalhes = "<br><br><b>RA:</b> {$protocolo['ra']}<br>"
                      . "<b>Curso:</b> {$protocolo['curso']}<br>"
                      . "<b>Código:</b> {$protocolo['codcurso']}";
            
            // 6. Exibe alerta e ENCERRA o script
            echo'...';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                  <script>
                      Swal.fire({
                          icon: "error",
                          title: "Protocolo Existente",
                          html: `' . $mensagem . $detalhes . '`,
                          confirmButtonText: "OK",
                          allowOutsideClick: false
                        }).then(() => {
                            window.location.href = "../logoff.php";
                        });
                  </script>';
            exit(); // ⚠️ Encerra imediatamente o processamento
        }

        return false;

    } catch (PDOException $e) {
        // 7. Tratamento de erro que também encerra o script
        echo'...';
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Falha no Sistema",
                    text: "Erro ao verificar protocolos: ' . addslashes($e->getMessage()) . '",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "../logoff.php";
                });
              </script>';
        exit();
    }
}
?>