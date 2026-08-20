<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "Invalid request"
    ]);

    exit;
}

$firstName = $data["first_name"] ?? "";
$lastName = $data["last_name"] ?? "";
$email = $data["email"] ?? "";
$phone = $data["phone"] ?? "";
$address = $data["address"] ?? "";
$city = $data["city"] ?? "";
$province = $data["province"] ?? "";
$postalCode = $data["postal_code"] ?? "";
$message = $data["message"] ?? "";

if ($firstName === "" || $lastName === "" || $email === "") {
    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "First name, last name and email are required"
    ]);

    exit;
}

$sql = "
    INSERT INTO users (
        first_name,
        last_name,
        email,
        phone,
        address,
        city,
        province,
        postal_code,
        message
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssssss",
    $firstName,
    $lastName,
    $email,
    $phone,
    $address,
    $city,
    $province,
    $postalCode,
    $message
);

if ($stmt->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "User saved successfully",
        "id" => $stmt->insert_id
    ]);

} else {

    http_response_code(500);

    echo json_encode([
        "success" => false,
        "message" => "Failed to save user"
    ]);
}

$stmt->close();
$conn->close();