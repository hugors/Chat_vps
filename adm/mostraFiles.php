<?php
// Define o diretório onde os arquivos estão localizados


$numProtocolos =  '../'.$dir . '/' . $numProtocolo . '/boleto/'; // Altere para o caminho correto da sua pasta


if (!file_exists($numProtocolos)) {
    //throw new RuntimeException("Diretório não encontrado: " . htmlspecialchars($diretorio));
  //  echo "Arquivo inexistente...";
   ?> <button class="btn btn-secondary" type="button" data-toggle="tooltip" data-placement="left"
    title="Busca Boleto Pagamento" disabled><i class="fas fa-donate"></i>
</button> <?php
} else {
    // Função para listar arquivos PDF em uma pasta e suas subpastas
    function listarArquivos($diretorio)
    {
        $arquivosPdf = [];

        // Escaneia o diretório
        $itens = scandir($diretorio);

        foreach ($itens as $item) {
            // Ignora "." e ".."
            if ($item == '.' || $item == '..') continue;

            $caminhoItem = $diretorio . DIRECTORY_SEPARATOR . $item;

            // Se for uma pasta, chama a função recursivamente
            if (is_dir($caminhoItem)) {
                // Recursão para subpastas
                $arquivosPdf = array_merge($arquivosPdf, listarArquivos($caminhoItem));
            } elseif (is_file($caminhoItem) && strtolower(pathinfo($item, PATHINFO_EXTENSION)) == 'pdf') {
                // Se for um arquivo PDF, adiciona ao array
                $arquivosPdf[] = $caminhoItem;
            }
        }

        return $arquivosPdf;
    }

    // Lista os arquivos PDF
    $arquivosPdf = listarArquivos($numProtocolos);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php if (count($arquivosPdf) > 0): ?>
    <?php foreach ($arquivosPdf as $arquivo): ?>
    <!-- Nome do arquivo -->
    <a href="<?php echo $arquivo; ?>" download>
        <button class="btn btn-primary" type="button" data-toggle="tooltip" data-placement="left"
            title="Busca Boleto Pagamento"><i class="fas fa-donate"></i>
        </button></a>


    <?php endforeach; ?>

    <?php else: ?>
    <p>Não há arquivos PDF disponíveis.</p>
    <?php endif; ?>

</body>

</html>
<?php
}

?>