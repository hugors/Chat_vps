<?php

$conexao = conectar("SPROTOCOLOS");
$bId = $conexao->prepare(" 
            select MAX([id]) as maxId 
            FROM [INOTAS].[dbo].[PROTOCOLOS]
                    ");

$bId->execute();
$resultadoBuscaId = $bId->fetchAll();
if(!$resultadoBuscaId){
    // echo "vazio";
        //echo "dados n!ao encontrado";
}else{
    //   echo "encontrei";
        $numMaxId       =  $resultadoBuscaId['0']['0'];
}

unset($bId);
?>