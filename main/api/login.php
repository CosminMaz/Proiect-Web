<?php
require_once '../../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

header('Content-Type: application/json');

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'imobiliare';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Conexiune esuata: " . $conn->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Verifica daca emailul exista in baza de date
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        http_response_code(401);
        echo json_encode(["error" => "Emailul nu este înregistrat."]);
        $stmt->close();
        $conn->close();
        exit;
    } else {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verifica parola
        if (password_verify($password, $hashed_password)) {
            // Creare token JWT
            $secretKey = 'secret';

            $issuedAt   = new DateTimeImmutable();
            $expire     = $issuedAt->modify('+ 12 hours')->getTimestamp();  // token valabil 12h
            $payload = [
                'iat'  => $issuedAt->getTimestamp(),
                'iss'  => 'localhost',
                'nbf'  => $issuedAt->getTimestamp(),
                'exp'  => $expire,
                'user' => [
                    'id' => $id,
                    'email' => $email,
                     ],
            ];
            $jwt = JWT::encode($payload, $secretKey, 'HS256');

            echo json_encode(['token' => $jwt]);
        } else {
            http_response_code(401);
            echo json_encode(["error" => "Parola incorecta."]);
        }
        $stmt->close();
    }
}
$conn->close();
?>