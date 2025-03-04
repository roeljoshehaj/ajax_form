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

// Check if user_id is provided in the query string
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    try {
        // Fetch a specific user by user_id
        $stmt = $pdo->prepare("SELECT id, first_name, last_name, city, address FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if user was found
        $user = $stmt->fetch();

        if ($user) {
            // Return JSON response with user data
            echo json_encode(["status" => "success", "user" => $user]);
        } else {
            // If user not found
            echo json_encode(["status" => "error", "message" => "Përdoruesi nuk u gjet"]);
        }

    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Gabim gjatë marrjes së përdoruesit: " . $e->getMessage()]);
    }
} else {
    // If no user_id is provided in the query string
    echo json_encode(["status" => "error", "message" => "Nuk është dhënë user_id"]);
}
?>