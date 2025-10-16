<?php
$host = '127.0.0.1';
$db = 'sae203_oeuvres';
$user = 'root' ;
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host; dbname=$db; charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    return $pdo;
} catch (PDOException $e) {
    throw new PDOException ($e->getMessage(), (int)$e->getCode());
}
?>