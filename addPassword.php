<?php

// Turn on warnings and erro reporting
ini_set('display_errors', true);
error_reporting(E_ALL);

// Check to make sure that a password has been submitted
if(!isset($_POST['password'])){
    die("No password submitted!");
}

$password = $_POST['password'];

echo "Password: $password<br />";

// First use symetric encryption to encrypt the password.
// Generate Encryption Kry



// Store the encrypted passowrd


// Use asymmetric encryption to encrypt the symetric key
// Generate a key to encrypt with
$key = openssl_random_pseudo_bytes(32, $strong);

echo "Key: " . base64_encode($key) . "<br />";
echo "Key Lenght: " . strlen($key) . "<br />";

//$key1 = hash('SHA256', $key, true);

//echo "New key: " . base64_encode($key) . "<br />";
//echo "New Key Length: " . strlen($key) . "<br />";

echo "Password is strong: $strong<br />";

// Creaste the Initilazation vector for encryption
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
echo "Initilization Vector: " . base64_encode($iv) . "<br />";

$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $password, MCRYPT_MODE_CBC, $iv);

echo "Encrypted Password: " . base64_encode($encrypted) . "<br />";

echo "<hr>";

// Create new key pair
$config = array(
    'digers_alg' => 'sha512',
    'private_key_bits' => 1024,
    'private_key_type' => OPENSSL_KEYTYPE_RSA
);

$res = openssl_pkey_new($config);
openssl_pkey_export($res, $privateKey);
$publicKey = openssl_pkey_get_details($res);

echo "<pre>";
print_r($publicKey);
echo "</pre>";

