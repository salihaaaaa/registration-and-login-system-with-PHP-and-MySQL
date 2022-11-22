<?php
$servername = 'localhost';
$usernameDB = 'root';
$passwordDB = '';
$database = 'registration';

$conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

if ($conn->connect_error) {
    die("Connection to database failed " .$conn->connect_error);
}
?>