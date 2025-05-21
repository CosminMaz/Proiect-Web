<?php
require_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

header('Content-Type: application/json');

$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    http_response_code(401);
    echo json_encode(["error" => "Token lipsă."]);
    exit;
}

$jwt = $matches[1];
$secretKey = 'secret';

try {
    $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));
    $user = $decoded->user;

    $host = 'localhost';
    $userDB = 'root';
    $passDB = '';
    $db = 'imobiliare';

    $conn = new mysqli($host, $userDB, $passDB, $db);
    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(["error" => "Conexiune esuata: " . $conn->connect_error]);
        exit;
    }

    $stmt = $conn->prepare("SELECT nume, prenume, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user->id);
    $stmt->execute();
    $stmt->bind_result($nume, $prenume, $email);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    // Raspuns cu datele utilizatorului
    echo json_encode([
        "id" => $user->id,
        "email" => $email,
        "nume" => $nume,
        "prenume" => $prenume
    ]);

} catch (Exception $e) {
    error_log("Authorization header: " . $authHeader);
    http_response_code(401);
    echo json_encode(["error" => "Token invalid."]);
    exit;
}
