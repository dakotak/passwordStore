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
$ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
$iv = mcrypt_create_iv($ivSize);
echo "Initilization Vector: " . base64_encode($iv) . "<br />";
echo "Initilization Vector Lenght: "  . strlen(base64_encode($iv)) . "<br />";
echo "IV Size: $ivSize<br />";

$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $password, MCRYPT_MODE_CBC, $iv);

echo "Encrypted Password: " . base64_encode($encrypted) . "<br />";
echo "Encrypted Password Lenght: " . strlen(base64_encode($encrypted)) . "<br />";
echo "No Encode Encrypted Password Length: " . strlen($encrypted) . "<br />";

// Combine the IV and the encrypted password togetther for storage, the IV is okay to store with the encrypted data.
//$encryptedPassword = base64_encode($iv) . base64_encode($encrypted);
//echo "End Result Encrypted Password: $encryptedPassword - Lenght: " . strlen($encryptedPassword) . "<br />";
$encrypted = $iv . $encrypted;

echo "<hr>";

// Create new key pair
$config = array(
    'digers_alg' => 'sha512',
    'private_key_bits' => 1024,
    'private_key_type' => OPENSSL_KEYTYPE_RSA
);

$res = openssl_pkey_new($config);

// Get Public Key for pair
openssl_pkey_export($res, $privateKey);
$publicKey = openssl_pkey_get_details($res);
$publicKey = $publicKey['key'];
echo "<pre>";
echo "Public Key: $publicKey<br />";
echo "Private Key: $privateKey<br />";
echo "</pre>";

echo "<hr>";
// Encrypt the key for the password encryption with the public key.
openssl_public_encrypt($key, $encryptedKey, $publicKey);

echo "Encrypted Encryption Key: " . base64_encode($encryptedKey) . "<br />";

echo "<hr>";
// Decrypt the encrypted decryption key
openssl_private_decrypt($encryptedKey, $decryptedKey, $privateKey);

// decryptedKey should match $key
if($decryptedKey = $key){
    echo "They match!<br />";
}else{
    echo "Error:<br />";
    echo base64_encode($decryptedKey);
    echo base64_encode($key);
}

// Split the ecrypted password into the ecrypted data and the IV
$iv = substr($encrypted, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
$encryptedPass = substr($encrypted, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

echo "IV: " . base64_encode($iv) . "<br />";
echo "Encrypted Password: " . base64_encode($encryptedPass) . "<br />";
// Use the decrypted key to decrypt the password
$decryptedPass = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $decryptedKey, $encryptedPass, MCRYPT_MODE_CBC, $iv);

echo "Decrypted Password: $decryptedPass<br />";
