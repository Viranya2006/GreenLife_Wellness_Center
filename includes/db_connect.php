<?php
// contains the details for connecting to the database.

// Database configuration variables.
$dbhost = 'localhost';
$dbuser = 'root'; 
$dbpass = '';
$dbname = 'greenlife_db';

// Establishes a connection to the MySQL database.
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Checks if the connection was successful. If not, it stops the script and shows an error.
if (!$conn) { 
   die('Could not connect to the database: ' . mysqli_connect_error());
}
?>