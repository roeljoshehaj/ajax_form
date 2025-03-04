<?php
$host = "localhost";
$port = "5432"; // PostgreSQL default port
$dbname = "myDatabase";
$user = "postgres";
$password = "lewis1919";

try {
    // Create PDO connection with port
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die(json_encode(["status" => "error", "message" => "Databaza nuk u lidh: " . $e->getMessage()]));
}

try {
    // Fetch users from the 'users' table
    $stmt = $pdo->query("SELECT id, first_name, last_name, city, address FROM users ORDER BY id DESC");
    $users = $stmt->fetchAll();

    // Return JSON response
    echo json_encode(["status" => "success", "users" => $users]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Gabim gjatë marrjes së përdoruesve: " . $e->getMessage()]);
}
?>