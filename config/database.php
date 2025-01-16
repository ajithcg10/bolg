<?php
require_once __DIR__ . '/../vendor/autoload.php';

function getDatabaseConnection() {
    try {
        $dsn = "pgsql:host=localhost;port=5432;dbname=bolg";
        $username = "postgres";
        $password = "admin";
        $pdo = new PDO($dsn, $username, $password);

        // Set error mode to exception after PDO object creation
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Debugging: Print success message (optional)
        // echo "Connected successfully";

        // Return PDO object after setting error mode
        return $pdo;
    } catch (PDOException $e) {
        // If connection fails, echo error message
        echo "Database connection failed: " . $e->getMessage();
    }
}
