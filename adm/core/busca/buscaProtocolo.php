<?php

$queryProtocolo = $conexao->prepare(" 
                            SELECT 
                                [numProtocolo]
                                ,[dataAbertura]
                                ,[ra]
                                ,[nomeAluno]
                                ,[emailAluno]
                                ,[curso]
                                ,[nomeCoordenador]
                                ,[emailCoordenador]
                                ,[descricaoAluno]
                                ,[descicaoCoordenador]
                                ,[status]
                                ,[turno]
                                ,[tipoProtocolo]
                                ,[grade]
                            FROM 
                            [SPROTOCOLOS].[dbo].[PROTOCOLOS]
                            WHERE
                                (1=1)
                                AND numProtocolo = '$numProtocolo'
                    ");

    ?>