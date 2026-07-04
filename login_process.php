<?php
// Bilaabi Session-ka si nidaamku u xasuusnaado qofka galay
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        try {
            // Ka raadi user-ka database-ka nidaamka SQL
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Haddii user-ka la helo, hubi password-ka la codeeyey (Hashed)
            if ($user && password_verify($password, $user['password'])) {
                
                // Kaydi xogta muhiimka ah ee Session-ka
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['fullname'];
                $_SESSION['user_role'] = $user['role'];

                // U wareeji Dashboard-ka weyn
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<script>alert('Email ama Password khalad ah!'); window.location.href='login.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Khalad: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Fadlan buuxi meelaha bannaan!'); window.location.href='login.php';</script>";
    }
}
?>