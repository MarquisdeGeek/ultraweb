<?php
namespace Ultra\Test;

class Test {
	
	public function __construct($description, $cbfn, $fnarguments = "") {
		$this->cbfn = $cbfn;
		$this->fnarguments = $fnarguments;
		$this->description = $description;
	}

	public function invoke() {
		print $this->description . "... ";
		$success = call_user_func($this->cbfn, $this->fnarguments);
		print $success ? "\033[0;32m Passed" : "\033[0;31m Failed";
		print "\033[0m " . PHP_EOL;

		return $success;
	}

	public function getArguments() {
		return $this->fnarguments;
	}

	public function setArguments($newargs) {
		$this->fnarguments = $newargs;
	}

}

