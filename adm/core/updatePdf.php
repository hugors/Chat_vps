<?php


$dir = "pdf/";
$dir3 = $dir . '/' . $numProtolo ;

if (!file_exists($dir3)) {
    mkdir($dir3, 0777, true);
}


$diretorio = $dir . $numProtolo;
$diretorio = $dir . $numProtolo ;
$arquivo = isset($_FILES['arquivo']) ? $_FILES['arquivo'] : FALSE;

//loop para ler as imagens
for ($controle = 0; $controle < count($arquivo['name']); $controle++) {

    $destino = $diretorio . "/" . $arquivo['name'][$controle];
    //valida extensão do arquivo
    $type = strtolower(pathinfo($destino, PATHINFO_EXTENSION));
    if ($type != "pdf") {
        ?><script type="text/javascript">window.alert("Erro! Enviar Somente Arquivo como PDF")</script><?
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=requisicaoNota.php'>";
    }else{

            $novonome = $pasta;
            //move_uploaded_file — Move um arquivo enviado para uma nova localização
            if (move_uploaded_file($arquivo['tmp_name'][$controle], $destino)) {
                echo  "Ärquivo gravado";
             
            } else {
               echo "Erro, o arquivo n&atilde;o pode ser enviado.";
            }
    }
}
?>