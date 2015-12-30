#!/usr/bin/env php
<?php
function printr($msg){
  echo $msg .PHP_EOL;
}
function printError($msg){
  file_put_contents('php://stderr', $msg .PHP_EOL);
}

printr ('*****************************************************************************');
printr ('Start check proxy.');
printr ('*****************************************************************************');

$url = "https://play.google.com/store/apps/collection/topselling_free?hl=en";

if (isset($argv[1]) && $argv[1]) {
  $inputFile = $argv[1];
}else{
  printError('Error : Check [ip:port File]');
  printError('php check_ssl_proxy.php [ip:port File] [check url]');
  exit(1);
}

if (!file_exists ( $inputFile )) {
  printError('Error : Check [ip:port File]');
  printError('File not found .');
  exit(1);
}

if (isset($argv[2]) && $argv[2]) {
  $url = $argv[2];
}else{
  printError('Error : Check [check url]');
  printError('php check_ssl_proxy.php [ip:port File] [check url]');
  exit(1);
}

printr ($inputFile);
printr ($url);
printr ('*****************************************************************************');

$proxyUrls = file_get_contents($inputFile);
$proxyUrls = explode("\n", $proxyUrls);

if (!$proxyUrls) {
  printError('File is Empty.');
  exit(1);
}

foreach ($proxyUrls as $proxyUrl) {
  printr ('------------------------------');
  printr($proxyUrl);

  if (empty($proxyUrl)) {
    printr('This line is NULL. So Skip.');
    continue;
  }
  if (substr($proxyUrl, 0 ,1) === '#') {
    printr('This line is #. So Skip.');
    continue;
  }

  $proxy = array(
    "http" => array(
      "proxy" => $proxyUrl,
      'request_fulluri' => true,
    ),
  );

  $proxyContext = stream_context_create($proxy);
  $getHtml = @file_get_contents($url,false,$proxyContext);

  if ($getHtml) {
    printr( "OK : This proxy is alive !");
  }else{
    printr( "NG : This proxy is fail !");
  }
}

printr ('------------------------------');
printr ('*****************************************************************************');
printr ('End check proxy.');
printr ('*****************************************************************************');
exit(0);
