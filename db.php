<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "civil_registry_db";

// Isku xirka database-ka nidaamka PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Habka khaladaadka loo qabto
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Isku xirka database-ka waa uu guuldareystay: " . $e->getMessage());
}
?>