<?php

/*
Funcao para codificar e decodificar
tipo =  0 ou 1 
    0 codifica
    1 decodifica
dados = dado a ser codificado ou decodificado
*/
    function Base64($tipo,$dados) {
        If ($tipo == 0 ){
            return base64_encode($dados);
        }IF ($tipo ==1){
            return base64_decode($dados);
        }
    
    }


?>