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
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Verifică dacă emailul există în baza de date
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "Emailul nu este înregistrat.";
        $stmt->close();
    } else {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verifică parola
        if (password_verify($password, $hashed_password)) {
            // Autentificare reușită - poți începe o sesiune aici
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['user_email'] = $email;
            echo "Autentificare reușită!";
        } else {
            echo "Parolă incorectă.";
        }
        $stmt->close();
    }
}
$conn->close();
?>