<?php
require_once("../vendor/autoload.php");


use Mpwarfw\Utils\Request;
use Mpwarfw\Utils\Session;
use Mpwarfw\Component\Bootstrap;

echo "Estoy en modo Pro \n";

$bootstrap = new Bootstrap('dev', new Request(new Session()));
$response = $bootstrap->execute();
$response->send();

