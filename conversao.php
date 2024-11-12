<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Conversor de Dólar Automático</title>
</head>
<body>
    <header>
        <h1> Conversor de Dólar Automático </h1>
    </header>

    <section>
        <?php 
            // Cotação vinda da API do Banco Central
            $urlBCB = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao=%2711-12-2024%27&$top=100&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

            $numReal = $_POST['numReal'] ?? 0;

            $dados = json_decode(file_get_contents($urlBCB), true);

            $cotacao = $dados["value"][0]["cotacaoCompra"];

            $dolar = $numReal / $cotacao;

            $padrao = numfmt_create("pt-BR", NumberFormatter::CURRENCY);

            echo "<p> Seus: " . numfmt_format_currency($padrao, $numReal, "BRL") . " equivalem a " . numfmt_format_currency($padrao, $dolar, "USD");
        ?>

        <p> <button onclick="javascript:history.go(-1)" id="btnVoltar"> Voltar </button> </p>
    </section>
</body>
</html>