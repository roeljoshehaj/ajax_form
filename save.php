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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Trim and validate input data
    $first_name = trim($_POST["floating_first_name"] ?? "");
    $last_name = trim($_POST["floating_last_name"] ?? "");
    $city = trim($_POST["floating_city"] ?? "");
    $address = trim($_POST["floating_adress"] ?? "");

    if (!$first_name || !$last_name || !$city || !$address) {
        die(json_encode(["status" => "error", "message" => "Error: Të gjitha fushat janë të detyruara!"]));
    }

    try {
        // Prepare and execute insert statement
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, city, address) VALUES (:first_name, :last_name, :city, :address)");
        $stmt->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':city' => $city,
            ':address' => $address
        ]);

        echo json_encode(["status" => "success", "message" => "Regjistrimi u shtua me sukses!"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Gabim gjatë regjistrimit: " . $e->getMessage()]);
    }
}
?>