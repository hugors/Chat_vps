<?php

$querydiscIsenta = $conexao->prepare(" 
                  SELECT 
                        [id]
                        ,[numProtocolo]
                        ,[codColigada]
                        ,[ra]
                        ,[codFilial]
                        ,[idHabilitacaoFilial]
                        ,[periodoLetivo]
                        ,[codComponente]
                        ,[nomeComponente]
                        ,[codModalidade]
                        ,[nomeModalidade]
                        ,[cargaHoraria]
                        ,[creditos]
                        ,[descricao]
                        ,[dataInicio]
                        ,[dataFim]
                        ,[curso]
                        ,[grade]
                        ,[ativofertada]
                        ,[tipoparticipacao]
                        ,[instituicao]
                        ,[local]
                        ,[convenio]
                        ,[inscricaoconfirmada]
                        ,[cumpriuatividade]
                        ,[docentregue]
                        ,[usercadastro]
                        ,[datainsert]
                        ,[status]
                        ,[dataifecha]
                        ,[descricaofechado]
                    FROM 
                          [SPROTOCOLOS].[dbo].[ACOMPLEMENTAR]
                    WHERE
                          (1=1)
                          AND numProtocolo = '$numProtocolo'
                    ");

    ?>