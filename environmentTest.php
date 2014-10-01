<?php

//This page will test to make sure that the current environment support all the requirements of this application.
echo "PHP Version: " . phpversion() . "<br />";

// Test PHP Version, not sure what version I am requireing yet, Though my guess is PHP v5.3 or up

// Make sure that openSSL extentions are enabled.

// Make sure mcrypt extentions are enabled.

// PDO is required and PDO must support SQLite v3 or up
if(!extension_loaded("PDO")){
    echo "<b>PDO is not avalible.</b><br />";
}else{
    echo "PDO is avalible.<br />";
}
// Check SQLite support
echo "<ul>";
foreach (PDO::getAvailableDrivers() as $driver){
    echo "<li>$driver</li>";
}
echo "</ul>";

