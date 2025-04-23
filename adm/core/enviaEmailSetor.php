<?php
error_reporting(E_ALL & ~E_NOTICE);


  
//email de teste
    $emailDestino = "hugo.silva@castelobranco.br";
 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendEmailAsync(string $emailDestino, string $texto, string $numProtocolo): void {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'suporteti@castelobranco.br';
        $mail->Password = '@J1e2a3n4';
        $mail->setFrom('suporteti@castelobranco.br', 'Acesso Sistema Protocolos - UCB');
        $mail->addReplyTo('suporteti@castelobranco.br', 'UCB');
        $mail->addAddress($emailDestino);
        $mail->Subject = 'Email Automático do Sistema Protocolos - UCB';
        $mail->isHTML(true);
        $mail->CharSet = 'utf-8';
        
        $mail->Body = "
<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            min-height: 350px;
        }

        .header {
            background-color: #335ccc;
            color: #ffffff;
            padding: 1px;
            text-align: center;
            font-size: 20px;
            border-radius: 5px;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        #conteudo {
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .titulo {
            font-size: 30px;
            font-weight: bold;
        }

        .subtitulo {
            font-size: 20px;
        }
        /* Estilo para o botão de envio */
        .submit-button {
            background-color: blue; /* Cor de fundo azul */
            color: white; /* Cor do texto branca */
            font-size: 20px; /* Tamanho da fonte */
            padding: 10px 20px; /* Espaçamento interno */
            border: none; /* Sem borda */
            border-radius: 5px; /* Borda arredondada */
            cursor: pointer; /* Cursor ao passar o mouse */
        }

        /* Estilo para quando o mouse passa por cima do botão */
        .submit-button:hover {
            background-color: darkblue; /* Cor de fundo azul escuro */
        }
        .maiusculo {
            text-transform: uppercase;
        }

    </style>
</head>

<body>
    <div class='container'>
        <div class='header'>
            <p class='maiusculo'> RDE </p>
        </div>
        <div id='conteudo'>
            <p class='titulo'>$texto</p>
            <p class='subtitulo'> Numero do protocolo $numProtocolo. 
        </div>
    </div>
</body>

</html>
";
        
// Simulação de envio assíncrono
register_shutdown_function(function () use ($mail) {
    try {
        $mail->send();
      //  echo "Email enviado com sucesso para {$mail->getToAddresses()[0][0]}";
    } catch (Exception $e) {
        echo "Erro ao enviar email: " . $mail->ErrorInfo;
    }
});
} catch (Exception $e) {
echo "Erro ao configurar o e-mail: " . $e->getMessage();
}
}

// Exemplo de uso:
//$emailAluno = 'destinatario@example.com';

$texto = "Prezado usuário, chegou protocolo na sua fase de atuacão.";
sendEmailAsync($emailDestino, $texto, $numProtocolo);
?>
