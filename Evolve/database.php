<?php
session_start();
$conn = new PDO('mysql:dbname=evolve;host=localhost', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>