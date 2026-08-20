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
$data = json_decode(file_get_contents("php://input"), true) ?? [];
$name = trim($data["name"] ?? "");
$email = strtolower(trim($data["email"] ?? ""));
$password = $data["password"] ?? "";

if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Name, a valid email and an 8-character password are required"]);
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO auth_users (name, email, password_hash) VALUES (?, ?, ?)");

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "The auth_users table is missing. Run auth-schema.sql first."
    ]);
    $conn->close();
    exit;
}

$stmt->bind_param("sss", $name, $email, $passwordHash);

if (!$stmt->execute()) {
    $isDuplicate = $stmt->errno === 1062;
    http_response_code($isDuplicate ? 409 : 500);
    echo json_encode(["success" => false, "message" => $isDuplicate ? "An account with that email already exists" : "Unable to create account"]);
    exit;
}

echo json_encode(["success" => true, "user" => ["id" => $stmt->insert_id, "name" => $name, "email" => $email]]);
$stmt->close();
$conn->close();
