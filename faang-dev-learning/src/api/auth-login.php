<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit;
}

require_once "db.php";
$conn->query("CREATE TABLE IF NOT EXISTS auth_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

$data = json_decode(file_get_contents("php://input"), true) ?? [];
$email = strtolower(trim($data["email"] ?? ""));
$password = $data["password"] ?? "";

$stmt = $conn->prepare("SELECT id, name, email, password_hash FROM auth_users WHERE email = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !password_verify($password, $user["password_hash"])) {
    http_response_code(401);
    echo json_encode(["success" => false, "message" => "That email or password does not match"]);
    exit;
}

echo json_encode(["success" => true, "user" => ["id" => $user["id"], "name" => $user["name"], "email" => $user["email"]]]);
$stmt->close();
$conn->close();
