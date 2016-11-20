<?php
namespace Ultra\Test;



class TestPass extends Test {
	public function __construct() {
		parent::__construct("Always passes", function() { return true; }, null);
	}
}

