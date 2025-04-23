<?php

function resetSenha($id,$novaSenha)
{

    @include "conexao.php";

    $query = $conexao->prepare("UPDATE [dbo].[TB_PERFIL] SET senha = '$novaSenha' where id='$id' ");

    $query->execute();

    if($query->rowCount() > 0){
       // echo "Senha Atualizada na Função";
       
    }else{ ?>
            <script type="text/javascript">
                  window.alert("Erro ao Trocar Senha!")
            </script>
     <?php   die; }





}
?>