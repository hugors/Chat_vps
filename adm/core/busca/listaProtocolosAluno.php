<?php

$queryListProtocolos = $conexao->prepare(" 
    SELECT           
         [numProtocolo]
        ,[dataAbertura]
        ,[ra]
        ,[curso]
        ,[nomeCoordenador]
        ,[status]
        ,[tipoProtocolo]
        ,[idSetor]
       
    FROM [SPROTOCOLOS].[dbo].[PROTOCOLOS]
    where (1=1)
    AND [ra] = '$ra'
    
        ");
