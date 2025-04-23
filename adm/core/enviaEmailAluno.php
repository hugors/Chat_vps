<?php
error_reporting(E_ALL & ~E_NOTICE);
if($tipoProtocolo == "acomplementar"){
    $tipoProtocolo = "Atividades Complementares";
    $prazo = "sete dias úteis";
  } else if ($tipoProtocolo == "rde"){
    $tipoProtocolo = "RDE";
    $prazo = "sete dias úteis";
  }else {
    $tipoProtocolo = "Outros";
    $prazo = "sete dias úteis";
  }
  if($status =="Aberto"){
    $texto ="Protocolo: $numProtocolo, em até $prazo a resposta do seu protocolo estará em sua caixa de email";
  }else{
    $texto ="Protocolo: $numProtocolo, Foi fechado, Motivo: $descricao";
  }

$emailDestino = $emailAluno;

use PHPMailer\PHPMailer\PHPMailer;
@require 'vendor/autoload.php';
$mail = new PHPMailer;


$mail->isSMTP();
//$mail->SMTPDebug = 2;
$mail->Host = 'smtp.office365.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'suporteti@castelobranco.br';
$mail->Password = '@J1e2a3n4';
$mail->setFrom('suporteti@castelobranco.br', 'Abertura Protocolo  - UCB');
$mail->addReplyTo('suporteti@castelobranco.br', 'UCB');
$mail->addAddress($emailDestino, 'Abertura Protocolo UCB');
$mail->Subject = 'Abertura de Protocolo - UCB';
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

$header = "MIME-Version: 1.0\n";
$header .= "Content-type: : multipart/related; charset=iso-8859-1\n";
$header .= "From: Sistema Protocolos -  UCB\n";
$mail->Body .= "
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
            <p class='maiusculo'>$tipoProtocolo</p>
        </div>
        <div id='conteudo'>
            <p class='titulo'>Prezado(a) Aluno(a),</p>
            <p class='subtitulo'> Segue seu protocolo de $tipoProtocolo. 
           $texto
        </div>
    </div>
</body>

</html>
";



/*
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}*/

$enviado = $mail->Send();
// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
// Exibe uma mensagem de resultado do envio (sucesso/erro)
if ($enviado) {
    //envia email para coordenador 
    if($tipoProtocolo == "acomplementar"){
        include "enviaEmailCoordenador.php";
      } 
 
} else {
    echo "Não foi possível enviar o e-mail.v1.2";
    echo "Detalhes do erro: " . $mail->ErrorInfo;
}
?>
