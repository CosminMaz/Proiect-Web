<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'imobiliare';

$conn = new mysqli($host, $user, $pass, $db);
if($conn -> connect_error) {
    die("Conexiune esuata: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        echo "Utilizatorul deja exista."
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hash);
        if($stmt->execute()) {
            echo "Inregistrare cu succes!";
        } else {
            echo "Eroare: " . $stmt->error;
        }
    }

    $stmt->close();
}
$conn->close();
?>