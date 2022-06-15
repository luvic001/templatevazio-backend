<?php

/**
 * @author Lucas Victor
 */

namespace controller;

if (!defined('PATH'))
	exit;


class hashfier {

	const C_METHOD = 'BF-CBC',
				CLIENT_KEY = '$1$CvXy0',
				CLIENT_SECRET = '$1$10zA';

	var $key;

	public function __construct($key){
		$this->key = $key;
	}

	public function make($string){

		$options = 0;
		$encryption_iv = self::CLIENT_KEY;
		$encryption_key = self::CLIENT_SECRET;

		return openssl_encrypt($string, self::C_METHOD, $encryption_key, $options, $encryption_iv);

	}

	public function unmake($string){

		$decryption_iv = self::CLIENT_KEY;
		$decryption_key = self::CLIENT_SECRET;
		$options = 0;

		return openssl_decrypt($string, self::C_METHOD, $decryption_key, $options, $decryption_iv);
	}

}
