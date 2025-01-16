<?php
// save.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['floating_first_name'] ?? 'Unknown';
    $lastName = $_POST['floating_last_name'] ?? 'Unknown';
    $city = $_POST['floating_city'] ?? 'Unknown';
    $address = $_POST['floating_adress'] ?? 'Unknown';

    // Example response
    echo "Received: $firstName, $lastName, $city, $address";
} else {
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method.";
}
?>
