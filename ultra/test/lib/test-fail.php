<?php
namespace Ultra\Test;


class TestFail extends Test {
	public function __construct() {
		parent::__construct("Always fails", function() { return false; }, null);
	}
}

