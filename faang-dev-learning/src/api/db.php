<?php

$host = getenv('DB_HOST') ?: getenv('VITE_DB_HOST');
$user = getenv('DB_USER') ?: getenv('VITE_DB_USER');
$password = getenv('DB_PASSWORD') ?: getenv('VITE_DB_PASSWORD');
$database = getenv('DB_NAME') ?: getenv('VITE_DB_NAME');
$port = getenv('DB_PORT') ?: getenv('VITE_DB_PORT') ?: 3306;

if (!$host || !$user || !$database) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database configuration is missing"
    ]);
    exit;
}

$conn = new mysqli(
    $host,
    $user,
    $password,
    $database,
    $port
);

if ($conn->connect_error) {
    http_response_code(500);

    echo json_encode([
        "success" => false,
        "message" => "Database connection failed"
    ]);

    exit;
}

$conn->set_charset("utf8mb4");