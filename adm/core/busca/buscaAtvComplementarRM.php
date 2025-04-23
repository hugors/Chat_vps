<?php

$queryATVRM = $conexao->prepare(" 
                        select 
                                    CODCOLIGADA,
                                    IDATIVIDADE,
                                    IDHABILITACAOFILIAL,
                                    RA,
                                    IDPERLET,
                                    CODCOMPONENTE,
                                    CODMODALIDADE,
                                    RECCREATEDON

                        from 
                                    SATIVIDADEALUNO
                        where(1=1)
                                    AND SATIVIDADEALUNO.RA = '$ra'
                                    AND IDHABILITACAOFILIAL = '$idHabilitacaoOfficial'
                                    AND CODCOLIGADA = '$codColigada'
                                    AND CODCOMPONENTE = '$codComponente'
                                    AND CODMODALIDADE = '$codModalidade'
                    ");

    ?>