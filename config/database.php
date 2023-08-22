<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'campanhas';

/**
 * Conexão com o banco de dados
 */
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}