<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

use App\Core\Database;

$db = Database::getConnection();

// Data Admin Pertama
$username = 'adminco';
$password = 'notsecret111';
$hashed   = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)";
$stmt = $db->prepare($sql);

try {
    $stmt->execute([$username, $hashed, 'Super Administrator', 'SuperAdmin']);
    echo "--- SEEDING SUCCESS ---\n";
    echo "User: $username\nPass: $password\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
