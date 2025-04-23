<?php
error_reporting(E_ALL & ~E_NOTICE);
//email da central de matricula
    //$emailDestino = "centraldematriculas@castelobranco.br";

//email de teste
    $emailDestino = "hugo.silva@castelobranco.br";
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
$mail->setFrom('suporteti@castelobranco.br', 'Protocolo Aluno Indica - UCB');
$mail->addReplyTo('suporteti@castelobranco.br', 'UCB');
$mail->addAddress($emailDestino, 'Aluno Indica UCB');
$mail->Subject = 'Tratamento de Protocolo - Aluno Indica- UCB';
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

$header = "MIME-Version: 1.0\n";
$header .= "Content-type: : multipart/related; charset=iso-8859-1\n";
$header .= "From: Sistema Aluno Indica -  UCB\n";
$mail->Body .= "
<!DOCTYPE html>
<html lang='pt-BR'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script type='text/javascript' src='qrcodejs/jquery.min.js'></script>
    <script type='text/javascript' src='qrcodejs/qrcode.js'></script>
    <title>Carta de Indicação - Campanha 'Aluno Indica Aluno'</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            color: #007BFF;
        }
        p {
            font-size: 14px;
            line-height: 1.3;
        }
        .important {
            font-weight: bold;
            color: #d9534f;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
        }
        .btn-download {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-download:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #000;
           
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

    <div class='container' id='carta'>
        <table >
            <tr>
                <td width='20%'><img src='https://aplicacao.castelobranco.br/lgpdHML/dist/img/logo_ucb.png' width='50%' height='50%'></td>
                <td width='50%'><h2>CARTA DE INDICAÇÃO</h2></td>
                <td width='30%'><center><div id='qrcode'>Protocolo:<br> $numProtocolo</div></center></td>
            </tr>
        </table>
        
        <h3><center>Campanha Aluno Indica Aluno</center></h3>
        
        <p style='text-align: justify;'>
            Eu, <strong>$nomeAluno  </strong>, regularmente matriculado(a) no curso de <strong>$curso</strong> da Universidade Castelo Branco (UCB), matrícula <strong> $ra </strong>, venho, por meio desta, indicar um(a) novo(a) candidato(a) para ingressar na UCB, conforme os termos da campanha 'Aluno Indica Aluno'.</p>
        
        <div class='section-title'>DADOS DO ALUNO/CANDIDATO INDICADO:</div>
        <ul>
            <li>Nome completo: $nomeIndicado  </li>
            <li>Telefone: $contatoIndicado </li>
            <li>E-mail: $emailIndicado </li>
            <li>CPF: $cpfIndicado </li>
            <li>Curso de interesse: $cursoIndicado</li>
            <li>Forma Ingresso: $formaIngresso </li>
        </ul>
        
        <p>Declaramos que estamos cientes desta indicação e dos processos de ingresso na Universidade Castelo Branco (UCB), assim como de todo o regulamento presente na página: <a href='https://castelobranco.br/aluno-indica/' target='_blank'>https://castelobranco.br/aluno-indica/</a></p>
        <p>Estamos cientes, também, de que ao final do primeiro semestre, o Aluno Indicador será informado sobre a adimplência ou não da matrícula do Aluno Indicado.</p>

        <p class='important'>IMPORTANTE: Esta carta só será válida quando anexada aos documentos necessários do candidato no sistema da UCB, através do sistema de matrícula da UCB, disponível no link: <a href='https://castelobranco.br/inscricao/' target='_blank'>https://castelobranco.br/inscricao/</a></p>

        <p>Agradecemos a oportunidade de participar da campanha 'Aluno Indica Aluno', contribuindo para o crescimento da nossa comunidade acadêmica.</p>

        <p>Atenciosamente,</p>
        
        <table >
            <tr>
                <td width='50%'>Dados Aluno Indicador</td>
                
                
            </tr>
            <tr>
                <td>
                    <p style='text-align: left;'>
                        <strong>NOME: $nomeAluno </strong><br>
                        <strong>CURSO: $curso</strong> <br>
                        <strong>RA: $ra</strong> <br>
                    </p>
                </td>
            </tr>
        </table>

        <div class='footer'>
            <p>Universidade Castelo Branco (UCB) @2025 - Todos os direitos reservados</p>
        </div>

        <!-- Botão para impressão -->
        <a href='javascript:window.print();' class='btn-download'>Imprimir Carta</a>
    </div>
    <script type='text/javascript'>
        var qrcode = new QRCode(document.getElementById('qrcode'), {
            width: 100,
            height: 100
        });

        // Variável com o valor para gerar o QR code
        var qrText = 'htmlspecialchars($urlValida)';  // Pode ser alterado para qualquer valor
        console.log(qrText)
        function makeCode() {
            if (!qrText) {
                alert('Texto para o QR code não definido');
                return;
            }

            qrcode.makeCode(qrText);
        }

        // Gerar o QR code assim que o script for carregado
        makeCode();
    </script>
</body>
</html>
";



$enviado = $mail->Send();
// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
// Exibe uma mensagem de resultado do envio (sucesso/erro)
if ($enviado) {
   // echo "<div style='background:#09C;color: #FFF;'>Cadastro Executado Com Sucesso</div>";
    // echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=lista_clientes_resumo.php'>";
} else {
    echo "Não foi possível enviar o e-mail.v1.2";
    echo "Detalhes do erro: " . $mail->ErrorInfo;
}
?>
