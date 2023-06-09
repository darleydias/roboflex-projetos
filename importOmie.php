                                                                   
<?php

$link = "curl -s https://app.omie.com.br/api/v1/produtos/op/";
$link = $link . " -H 'Content-type: application/json' -d";
$link = $link . " '{\"call\":\"ListarOrdemProducao\",\"app_key\":\"38333295000\",";
$link = $link . " \"app_secret\":\"fed2163e2e8dccb53ff914ce9e2f1258\",\"param\":[{\"pagina\":1,\"registros_por_pagina\":20}]}'";
//echo($link."\n");
$ch = curl_init($link);
$arquivo = 'dados_omie.txt';
$handle = fopen( $arquivo, 'w' );
$ler = fread( $handle, filesize($arquivo) );
echo($ler)
?>

