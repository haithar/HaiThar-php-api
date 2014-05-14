<?php

class HaiThar {
	private $key;
	private $api = null;
	private $serviceId = null;
	private $host = 'haithar.net';

	function __construct($key, $api, $host = 'haithar.net') {
		$this->key = $key;
		$this->api = $api;
		$this->host = $host;

		if (!in_array('https', stream_get_wrappers()))
			throw new Exception('No https stream wrapper. OpenSSL is required to use the HaiThar API.');

		if (!function_exists('json_decode'))
			throw new Exception('No JSON decode. Update to PHP 5.2.0.');
	}

	function setServiceId($serviceId) {
		$this->serviceId = $serviceId;
	}

	function __call($command, $arguments) {
		$url = 'https://'.$this->host.'/api/'.$this->api.'/'.$command.'/'.$this->key;

		if (isset($arguments[0]) && is_array($arguments[0])) {
			$arguments = $arguments[0];
		} else
			$arguments = array();
		
		if ($this->serviceId !== null)
			$arguments['serviceId'] = $this->serviceId;

		$args = '';
		foreach ($arguments as $key => $value) {
			if ($args != '')
				$args .= '&';
			else
				$args = '?';

			if ($value === false)
				$value = 0;
			else if ($value === true)
				$value = 1;

			$args .= rawurlencode($key).'='.rawurlencode($value);
		}

		$out = file_get_contents($url.$args);
		return json_decode($out, true);
	}
}
