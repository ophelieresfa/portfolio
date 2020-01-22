<?php

// You need to replace the host value (localhost here) with the database host
// And the dbname value (your-database-name) with your database name
define('DB_DSN', 'mysql:host=localhost;dbname=your-database-name');

// You need to replace username with the user name of the database
define('DB_USER', 'username');

// You need to replace userpass with the user password of the database
define('DB_PASS', 'userpass');

// You don't need to change anything here : this array is for PDO options
define('DB_OPTIONS', array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// Then remove the '-example' from 'parameters-example.php' to get 'parameters.php'
