<?php

require 'lib/ultra-test.php';


$api = new \Ultra\Test\API("http://marquisdegeek.com/api/tube/");

$testing = new \Ultra\Test\TestSuite();
$testing->addTest($api->makeGetTest("Find closest tube", "?sortby=distance&limit=1", null, function($result) {
	return count($result) == 1 && $result[0]->name == "Abbey Road"? true : false;
}));

$testing->addTest(new \Ultra\Test\TestPass());
$testing->addTest(new \Ultra\Test\TestFail());

$testing->test();

