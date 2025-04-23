<!-- Inclusão do SweetAlert no cabeçalho do HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
//receber variavel do ALuno (RA)
$login = trim($_POST['login']);

// Remover espaços em branco no início do texto
$login = ltrim($login);

//criar processo para gerar senha e gravar senha temp np BD
$keyAluno = rand(1000, 9999);
$dataCadastro = date('Y-m-d H:i:s');

//gravar senha no BD
include "conexao.php";
$nomeBancoDeDados = "u565387349_atentus";
$conexaoMariaDB = conectar($nomeBancoDeDados);

// Agora você pode usar a variável $conexaoMariaDB para interagir com o banco de dados
if ($conexaoMariaDB) {
  echo "Conexão com MariaDB estabelecida com sucesso!";
  // Execute suas consultas aqui
  $conexaoMariaDB = null; // Fecha a conexão quando terminar
  exit();
}
$queryA = $conexao->prepare("SELECT login, email, perfil FROM `ACESSO` WHERE login = :login");
$queryA->bindParam(':login', $login, PDO::PARAM_STR);
$queryA->execute();
$resultado = $queryA->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
  echo "...";
  echo "<script>
           Swal.fire({
               icon: 'error',
               title: 'Usuario não encontrado!',
               text: 'Tente Novamente.',
               confirmButtonText: 'Ok'
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../index.html';  
                }
            });
       </script>";

  exit();
} else {

  //usuario existe na base

  try {


    $emailAluno = $resultado['email'];
    //Grava o dado de acesso
    try {
      $conexao = conectar($nomeBancoDeDados);

      $acesspTemp = "INSERT INTO acesso_temp
                              (LOGIN, PASSWORD, DATAINPUT)
                              VALUES (?, ?, ?)";

      // Prepare a consulta sem atributos específicos do SQL Server
      $stmt = $conexao->prepare($acesspTemp);

      // Executa a query com os parâmetros
      $stmt->execute(array($login, $keyAluno, $dataCadastro));

      // Verifica quantas linhas foram afetadas
      $resultado = $stmt->rowCount();


      if ($resultado > 0) {
        echo "<script>
                                  Swal.fire({
                                      icon: 'success',
                                      title: 'Sucesso!',
                                      text: 'A Senha de Acesso foi enviado para Seu email, verifique sua caixa.',
                                      confirmButtonText: 'Ok'
                                  });
                              </script>";

        include "envioCodigoAcesso.php";
      } else {
        echo "Nenhum dado foi inserido.";
      }
    } catch (PDOException $e) {
      echo "Erro ao conectar ou executar a query: " . $e->getMessage();
      exit();
    }
  } catch (PDOException $e) {
    // echo $e;
    echo "...";
    exit("
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Problemas Sistemicos',
                text: 'Estamos enfrentando problemas, volte daqui a pouco!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../index.html';
            });
        </script>");
  }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATENTUS</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../../libraries/dist/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../libraries/dist/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../libraries/dist/img/favicon-16x16.png">
    <link rel="manifest" href="../site.webmanifest">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../libraries/dist/css/adminlte.min.css">
    <!-- Inclusão do SweetAlert no cabeçalho do HTML -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Link para o Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'info', // Mantém o formato do alerta
            title: 'Aviso do Sistema!',
            text: 'A Senha de Acesso foi enviada para seu email, verifique sua caixa.',
            confirmButtonText: 'Ok',
            iconHtml: '<i class="fas fa-envelope"></i>', // Define o ícone como o ícone de email
            customClass: {
                confirmButton: 'btn-blue' // Classe personalizada para o botão
            }
        });
    });
    </script>

    <!-- Estilos CSS para a cor azul do botão -->
    <style>
    .btn-blue {
        background-color: #007bff;
        /* Azul */
        color: white;
        /* Cor do texto */
        border: 2px solid #007bff;
        /* Borda azul */
        padding: 10px 20px;
        /* Ajustar o padding se necessário */
        font-size: 16px;
        /* Ajuste do tamanho da fonte */
        border-radius: 5px;
        /* Arredondar os cantos do botão */
    }

    .btn-blue:hover {
        background-color: #0056b3;
        /* Azul mais escuro no hover */
        border-color: #0056b3;
        /* Borda azul mais escura no hover */
        cursor: pointer;
    }
    </style>

    <!-- <script src='https://www.google.com/recaptcha/api.js'></script>-->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <!--    <img src="../../libraries/dist/img/logo_ucb.png" alt="logo.png" height="60%" width="60%"> -->
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                <h3 align="center">Acesso Sistema</h3>
                </p>

                <form action="acessPdoSql.php" method="post">
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" value="<?php echo $login; ?>" name="ra" readonly>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-graduate"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="Digite senha" name="key" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>

                    <center>
                        <hr>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Acessar</button>
                        </div>
                        <br>
                    </center>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <script>
    const botao = document.querySelector('botaoSubmit'); // Seleciona o botão

    botao.addEventListener('click', function() {
        // Desabilita o botão após o clique
        this.disabled = true;
    });
    </script>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../libraries/dist/js/adminlte.min.js"></script>
</body>

</html>