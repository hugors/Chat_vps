<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
include "core/conexao.php";
$login = $_SESSION["emailAluno"] ;
$ra = $_SESSION["raAluno"];
$nomeAluno = $_SESSION["nomeAluno"] ;


if (!isset($_SESSION["raAluno"])) {
  header("location: logoff.php");
}

/*
// Log Auditoria de acesso
$tipo = "Entrada Aluno Painel";
include "core/logAudit.php";
$dataHoje = date("d/m/Y");
$conexao = conectar("SPROTOCOLOS");
include "core/busca/listaProtocolosAluno.php";

$queryListProtocolos->execute();
$resultado = $queryListProtocolos->fetchAll(PDO::FETCH_ASSOC);
*/
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UCB - SISTEMA PROTOCOLO</title>
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="apple-touch-icon" sizes="180x180" href="../libraries/dist/img/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../libraries/dist/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../libraries/dist/img/favicon-16x16.png">

  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="../libraries/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../libraries/dist/css/painelAluno.css">

 <!-- <style>
    .banner {
      font-family: 'Roboto', sans-serif;
      width: 100%;
      height: 110px;
      background: linear-gradient(to right, #002f6c, #4a90e2);
      color: white;
      text-align: left;
      font-weight: bold;
      padding: 20px;
      font-size: 1.5em;
      display: flex;
      border-radius: 10px;


      position: relative;
    }

    .banner img {
      position: absolute;
      right: 20px;
      height: 80px;
    }

    .banner h1 {
      font-size: 2em;
      font-weight: bold;
      margin: 0;
    }

    .container {

      justify-content: center;
      /* Alinha horizontalmente */
      align-items: center;
      /* Alinha verticalmente */
      position: relative;
    }

    /* Estilo para a div do gráfico */
    .chart-container {
      background-color: white;
      /* Fundo branco */
      width: 500px;
      /* Ajuste o tamanho conforme necessário */
      height: 350px;
      /* Ajuste o tamanho conforme necessário */
      border-radius: 20px;
      /* Bordas arredondadas */
      overflow: hidden;
      /* Garante que o gráfico não ultrapasse as bordas */
      border: 2px solid #ccc;
      /* Cor da borda */
      /* margin: 5px; /* Adiciona espaçamento externo ao redor da div */
      padding: 10px;


    }

    #piechart_3d,
    #columnchart_material {
      width: 100%;
      height: 100%;
    }

    .containerGrafico {
      display: flex;
      justify-content: space-between;
      /* Espaço entre os gráficos */
      gap: 5px;
      /* Distância entre as divs */
      flex-wrap: wrap;
      /* Permite quebra de linha quando necessário */
    }

    /* Estilo padrão do link */
    .nav-item .nav-link {
      color: #000;
      /* Cor do texto inicial (preto, por exemplo) */
      text-decoration: none;
      /* Remove o sublinhado padrão do link */
    }

    /* Efeito ao passar o mouse */
    .nav-item .nav-link:hover {
      color: red;
      /* Muda a cor do texto para vermelho */
    }

    /* Se você também quiser mudar a cor do ícone */
    .nav-item .nav-link i {
      color: inherit;
      /* Mantém a cor do ícone igual à do link */
    }

    /* Muda a cor do ícone para vermelho quando passar o mouse */
    .nav-item .nav-link:hover i {
      color: blue;
      /* O ícone também ficará vermelho */
    }

    .user-info {
      display: inline-block;
      text-align: right;
    }

    .login-text {
      font-size: 1em;
      /* Tamanho normal para o login */
      margin-left: 5px;
      /* Espaço após o ícone */
    }

    .setor-text {
      font-size: 0.8em;
      /* Texto menor para o setor */
      color: #666;
      /* Cor mais suave para o setor */
      margin-left: 20px;
      /* Alinhado com o texto acima */
      display: block;
      /* Garante que fica em linha separada */
    }

    .fa-user-alt {
      margin-right: 5px;
      /* Espaço entre o ícone e o texto */
    }
    #meuIframe {
    border: none;
   
    margin: 10px;
    overflow: auto;
   
  
}
  </style> -->

</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="#" class="navbar-brand">
          <img src="../libraries/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">PROTOCOLOS DO ALUNO</span>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
          data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


        <ul class="order-1 order-md-6 navbar-nav  ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="logoff.php">
              <i class="fas fa-door-open" style="color;"></i> SAIR
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="col-sm-12 text-right mr-3">
          <!-- 'mr-3' adiciona uma margem direita (1rem = ~16px) -->
          <div class="col-sm-12 text-end position-relative">
            <div style="margin-right: 20px;">
              <i class="fas fa-user-alt me-2"></i>
              <span><?php echo $nomeAluno; ?></span>
            </div>
          </div>
          
          <div class="col-sm-12">
            <div class="banner">
              <h1> Painel do Aluno de Protocolos </h1>
              <img src="../libraries/dist/img/logo_ucb.png" alt="logo.png">
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
<br>

        <!-- /.content-header -->
        <div class="card-body">

          <div id="accordion">
            <div class="card card-success">
              <div class="card-header">
                <h4 class="card-title w-100">
                  <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                    Meus Protocolos
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                <iframe id="meuIframe" src="gridProtocolosAluno.php"  width="100%" height="700" frameborder="0"></iframe>
                </div>
              </div>
            </div>
          </div>
          <!-- /.content-wrapper -->

        </div>
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & ../plugins -->
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        
        <!-- AdminLTE App -->
        <script src="../libraries/dist/js/adminlte.min.js"></script>

        

</body>

</html>