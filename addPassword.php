<?php

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
$key = oppenssl_random_pseudo_bytes(256);

echo "Encrypting password with key: $key<br />";



