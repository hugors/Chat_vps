
<?php

   $queryUpdateProtocolo = $conexao->prepare(" 
                  UPDATE [dbo].[PROTOCOLOS]
                     SET 
                        [descicaoCoordenador] = ''
                        ,[status] = ''
                        ,[dataAvaliaCoordenador] = ''
                     
                  WHERE 
                     (1=1)
                     AND [numProtocolo] = '$numProtocolo'
      ");

 ?>