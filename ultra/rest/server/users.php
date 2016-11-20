<?php

require_once 'config.php';
require_once 'base.php';
require_once 'ultra/ultra.php';

$api = new BasicAPI($_GET);
$api->connect($gConfigDB);

$u = new \Ultra\REST\BasicRecord("users", $api, new \Ultra\REST\Request());
$u->process();

?>
