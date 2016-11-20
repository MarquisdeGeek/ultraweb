<?php
namespace Ultra\Test;


class TestAPI extends Test {
var $url;
var $token;
var $fnparams;

	public function __construct($description, $baseURL, $cbfn, $fnarguments = "") {
		$this->url = $baseURL;
		$this->fnparams = array();

		parent::__construct($description, $cbfn, $fnarguments);
	}


	public function setSelf($self) {
		$this->fnarguments['self'] = $self;
	}


	public function setURL($url) {
		$this->fnarguments['api'] = $this->url . $url;
	}

	public function setURLParameter($name, $value) {
		$this->fnparams[$name] = $value;
	}

	public function verifyWithToken($token) {
//		$this->fnparams['jwt_token'] = $token;
		$this->token = $token;
	}

	public function verifyAPI($token, $secret) {
		$this->fnparams['token'] = $token;
		$this->fnparams['secret'] = $secret;
	}

	public function getFullURL() {
		$url = $this->fnarguments['api'] . '?';
		$url.= http_build_query($this->fnparams);
		
		return $url;
	}

	public function setData($data) {
		$this->fnarguments['data'] = $data;
	}

	public function getData() {
		return $this->fnarguments['data'];
	}

	public function makeCurlRequest($isPost) {
		$url = $this->getFullURL();
		$ch = curl_init($url);

		$header = array('Content-Type: text/plain');
		if (isset($this->token)) {
			array_push($header, 'Auth: Bearer ' . $this->token);
		}

		curl_setopt($ch, CURLOPT_POST, $isPost ? 1 : 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		return $ch;
	}
}

?>
