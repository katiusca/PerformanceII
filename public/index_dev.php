<?php
error_reporting(-1);
ini_set("display_errors",1);

require_once("../vendor/autoload.php");

use Mpwarfw\Utils\Request;
use Mpwarfw\Utils\Session;
use Mpwarfw\Component\Bootstrap;

header('Content-Type: text/html; charset=UTF-8');

$request = new Request(new Session());
$bootstrap = new Bootstrap('dev', $request);
$response = $bootstrap->execute();
$response->send();

//var_dump(get_included_files());



