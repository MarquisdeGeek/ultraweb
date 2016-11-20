<?php
namespace Ultra\Test;

class API {
var $url;

	public function __construct($baseURL) {
		$this->url = $baseURL;
	}


	public function makePostTest($description, $testFunction, $cbPrepare, $cbSuccess) {
		
		$api = $this->url . $testFunction;

		$test = new TestAPI($description, $this->url, function($testargs) {
			$test = $testargs['self'];
			if ($test->prepare) {
				call_user_func($test->prepare, $test);
			}

			try {
				$ch = $test->makeCurlRequest(true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $test->getData());

				$response = curl_exec($ch);

				curl_close($ch);
			} catch (Exception $e) {
				// we failed :(		
				$response = '{}';
			}

			$success_callback = $testargs['success_callback'];
			$json = json_decode($response);

			return call_user_func($success_callback, $json);
		}, array('api' => $api, 'success_callback' => $cbSuccess));
	
		$test->setSelf($test);
		$test->prepare = $cbPrepare;

		return $test;
	}

	public function makeGetTest($description, $testFunction, $cbPrepare, $cbSuccess = null) {
		$api = $this->url . $testFunction;

		$test = new TestAPI($description, $this->url, function($testargs) {
			$test = $testargs['self'];
			if ($test->prepare) {
				call_user_func($test->prepare, $test);
			}

			$success_callback = $testargs['success_callback'];

			try {
				$ch = $test->makeCurlRequest(true);

				$response = curl_exec($ch);

				curl_close($ch);
			} catch (Exception $e) {
				// we failed :(	
				$response = '{}';			
			}

			$json = json_decode($response);

			return call_user_func($success_callback, $json);
		}, array('api' => $api, 'success_callback' => $cbSuccess));

		$test->setSelf($test);
		$test->prepare = $cbPrepare;

		return $test;
	}

}

