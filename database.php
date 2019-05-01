<?php

$mysql_host='localhost';
$mysql_user='root';
$mysql_password='';

$mysql_db='tronix_inductions';

$connection=new mysqli($mysql_host,$mysql_user,$mysql_password,$mysql_db);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
?>