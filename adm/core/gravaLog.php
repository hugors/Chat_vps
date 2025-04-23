<?php
date_default_timezone_set('America/Sao_Paulo');
$dataInput = date("Y-m-d H:i:s");

if(empty($numProtocolo)){
    $numProtocolo = null;
}
if(empty($ra)){
    $ra = null;
}
if(empty($nomeCoordenador)){
    $nomeCoordenador = null;
}



$conexao = conectar("SPROTOCOLOS");;
/* AQUI GRAVA OS DADOS NO BANCO DE DADOS */
                   
    $gravaLog = "insert into  [dbo].[log]
                            ([numProtocolo]
                            ,[ra]
                            ,[nomeCoodenador]
                            ,[datainput]
                            ,[erro]
                            ,[numErro]
                            ,[paginaErro])
    
                      values(
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?       
                        )
                        ";

 
            $stmt = $conexao ->prepare( $gravaLog, array( PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY, PDO::SQLSRV_ATTR_QUERY_TIMEOUT => 1  ) );
            $stmt->execute( array( $numProtocolo, $ra, $nomeCoordenador, $dataInput, $erro, $numErro, $paginaErro ) );
            $resultado = $stmt->rowCount();
  
          if ($resultado==1){
          //AQUI RESULTADO OK PARA INSERT DOS DADOS
           // echo "gravou log";
             // Aqui caso o erro seja na abertura do Protocolo, email para ADM
                if(($numErro == "A01") and ($numErro == "A02")){
                        include("enviaAlertaErro.php");
                    }


            }else{
             // echo "erro grava Log";

              }


?>
