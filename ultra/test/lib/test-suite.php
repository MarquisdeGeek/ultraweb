<?php
namespace Ultra\Test;

class TestSuite {
	var $testList;

	public function __construct() {
		$this->testList = array();
	}

	public function addTest($test) {
		array_push($this->testList, $test);
	}

	public function test() {
		$passed = 0;
		foreach($this->testList as $test) {
			$passed += $test->invoke();
		}

		print PHP_EOL;
		print "Passed $passed out of " . count($this->testList);
		print PHP_EOL;

		return $passed;
	}
}

