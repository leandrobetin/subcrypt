<?php
class Subcrypt
{
	private $secret_key = "my_secret_key"; //max 56 characteres

	
	function __construct()
	{
		if(strlen($this->secret_key) > 56)
		{
			$this->secret_key = substr($this->secret_key, 0, 55);
		}
	}
	
	public function process($raw_cookie,$separator)
	{
		$values_json = array();

		$cookies = explode($separator, $raw_cookie);

		foreach ($cookies as $cookie)
		{
			if(!empty($cookie))
			{
				$temp = explode("=", $cookie);

				$values_json[] = array($temp[0] => (!empty($temp[1]))?$this->encode( ($temp[1]) ):'' );

			}
		}

		return json_encode($values_json);
	}


	public function encode($value)
	{
		return base64_encode(mcrypt_encrypt( MCRYPT_BLOWFISH, $this->secret_key , $value, MCRYPT_MODE_ECB ));

	}

	public function decode($value)
	{
		return mcrypt_decrypt( MCRYPT_BLOWFISH, $this->secret_key , base64_decode($value), MCRYPT_MODE_ECB );
	}
}
