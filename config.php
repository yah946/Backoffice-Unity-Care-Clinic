<?php
$host = 'localhost';
$username = 'root';
$passwd = '';
$dbname = 'Backoffice Unity CC';
$conn = mysqli_connect($host, $username, $passwd, $dbname);
if(!$conn){
    die("Connection Failed". mysqli_connect_error());
}
?>