<?php

// This is really crap, like really crap, but this works for this demo.

// Include this page anytime database access is required.

//$path = realpath(dirname(__FILE__));
$path = "/var/www/ddev.im/projects";

try{
    // Connect to the SQLite Database
    $db = new PDO("sqlite:$path/passwordDB.sqlite", null, null, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ));
}
catch(PDOException $e){
    echo $e->getMessage();
}


// Install the Database if required.
if(isset($_GET['action'])){
    switch ($_GET['action']){
        case "install";
            echo "Installing Database...<br />";
            dbinstall($db);
            break;
        case "showTables":
            dbShowTables();
            break;
        default:
            echo "Action not found!";
            break;
    }
}


function dbinstall($db){
    // Install the database  

    // Create the users table
    $db->exec("CREATE TABLE IF NOT EXISTS users(
        id integer primary key,
        username text,
        publicKey text,
        privateKey text
    )");
    
    // Create the passwords table
    $db->exec("CREATE TABLE IF NOT EXISTS passwords(
        id INTEGER PRIMARY KEY,
        title TEXT,
        encryptedPass BLOB
    )");

    // Create the passwordKeys table to store the encryptedKey used to decrypt the password, key is encrypted using users public key
    $db->exec("CREATE TABLE IF NOT EXISTS passwordKeys(
        passwordID INTEGER,
        userID INTEGER,
        encryptedKey BLOB
    )");
}

function dbShowTables(){
    // List all the tables in the database

}
