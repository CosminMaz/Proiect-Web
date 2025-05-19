<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'imobiliare';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexiune esuata: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = $_POST['nume'] ?? '';
    $prenume = $_POST['prenume'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($password !== $password2) {
        echo "Parolele nu se potrivesc.";
        exit;
    }

    // Verifică dacă emailul există deja
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Un cont cu acest email există deja.";
        $stmt->close();
    } else {
        $stmt->close();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (nume, prenume, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nume, $prenume, $email, $hash);
        if ($stmt->execute()) {
            echo "Înregistrare realizată cu succes!";
        } else {
            echo "Eroare la înregistrare: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
