<?php

// This is really crap, like really crap, but this works for this demo.

// Include this page anytime database access is required.

//$path = realpath(dirname(__FILE__));
$path = "/var/www/ddev.im/projects";

try{
    // Connect to the SQLite Database
    $db = new PDO("sqlite:$path/passwordDB.sqlite");
}
catch(PDOException $e){
    echo $e->getMessage();
}

// Install the Database if required.
if(isset($_GET['action']){
    switch $_GET['action']{
        case "install";
            dbinstall();
            break;
        case "showTables":
            dbShowTables();
            break;
        case default:
            echo "Action not found!";
            break;
    }
}


function dbinstall(){
    // Install the database  

    // Create the users table
    $db->exec("CREATE TABLE IF NOT EXISTS users(
        id integer primary key,
        username text,
        publicKey text,
        privateKey text
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS passwords(
        id INTEGER PRIMARY KEY,
        title TEXT,
        password BLOB
    )");
}

function dbShowTables(){
    // List all the tables in the database

}
