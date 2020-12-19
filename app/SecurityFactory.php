<?php
namespace App;
class Security
{
	public $ciphering;
	public $iv_length;
	public $options;
	public $encryption_iv;
	public $decryption_iv;

    public function __construct()
    {
		/* For encryption and decryption starts here */
		// Store cipher method 
		$this->ciphering = "AES-128-CTR"; 
		  
		// Use OpenSSl encryption method 
		$this->iv_length = openssl_cipher_iv_length($this->ciphering); 
		$this->options = 0; 
		  
		// Non-NULL Initialization Vector for encryption
		$this->encryption_iv = '1234567891011121'; 

		// Non-NULL Initialization Vector for decryption  
		$this->decryption_iv = '1234567891011121'; 	
		/* For encryption and decryption ends here */
    }

	// Encryption of text
	public function cn_encryption($req_txt){
		// Store a string into the variable which 
		// need to be Encrypted 
		$simple_string = $req_txt;
		  	  
		// Alternatively, we can use any 16 digit 
		// characters or numeric for iv 
		$encryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
		  
		// Encryption of string process starts 
		$encryption = openssl_encrypt($simple_string, $this->ciphering, $encryption_key, $this->options, $this->encryption_iv);

		return $encryption;
	}


	// Decryption of text
 	public function cn_decryption($req_txt){
	  
		// Store the decryption key 
		$decryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
		  
		// Descrypt the string 
		$decryption = openssl_decrypt ($req_txt, $this->ciphering, $decryption_key, $this->options, $this->encryption_iv);
		return $decryption;		
	}
}

class SecurityFactory
{
    public static function create()
    {
        return new Security();
    }
}

// have the factory create the Security object
$encryption_decryption = SecurityFactory::create();
echo "<pre>";
echo "<br/>";
echo "Encrypted text - ";
print_r($encryption_decryption->cn_encryption("Test"));
echo "<br/>";
echo "Decrypted text - ";
print_r($encryption_decryption->cn_decryption("PMPMGg=="));