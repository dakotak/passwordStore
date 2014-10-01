<?php

// Check to see if required POST variables exist
if(!isset($_POST['username'])){
    die("Form not submitted!");
}

// User the database
include 'db.php';

// Generate new public and private key pair for user.
// For this demo we will store the privatekey unencrypted

$res = openssl_pkey_new(array(
    'digest_alg' => 'sha512',
    'private_key_bits' => 1024,
    'private_key_type' => OPENSSL_KEYTYPE_RSA
    ));

// Get the public and private key
openssl_pkey_export($res, $privateKey);
$publicKey = openssl_pkey_get_details($res);
$publicKey = $publicKey['key'];

echo "<h3>Public Key</h3>$publicKey<br />";
echo "<h3>Private Key</h3>$privateKey<br />";

echo "Adding user to database.";

$stm = $db->prepare("INSERT INTO users (username, publicKey, privateKey) VALUES (:un, :pub, :pri)");
$status = $stm->execute(array(':un' => $_POST['username'], ':pub' => $publicKey, ':pri' => $privateKey));

if($status){
    echo "Insert was okay.";
}else{
    echo "Insert Failed.";
}

?>
<a href="index.php">Home</a>
