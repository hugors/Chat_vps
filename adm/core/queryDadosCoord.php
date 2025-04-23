<?php

$dadosCoord = $conexao->prepare(" 
			SELECT 
				[nome]
				,[email]
				
			FROM [dbo].[PERFIL]
			WHERE (1=1)
				AND [codCurso] like '%$codCurso%'
				AND [campus] like '%$campusRm%' 
    ");
    ?>