<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($fullname) && !empty($email) && !empty($password)) {
        try {
            // Hubi haddii email-kan horay loo isticmaalay
            $checkEmail = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $checkEmail->execute([':email' => $email]);
            
            if ($checkEmail->rowCount() > 0) {
                echo "<script>alert('Email-kan horay ayaa u jiray!'); window.location.href='register.php';</script>";
            } else {
                // Codeey password-ka si nidaamku u noqdo mid ammaan ah
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Ku rido database-ka
                $sql = "INSERT INTO users (fullname, email, password, role) VALUES (:fullname, :email, :password, 'admin')";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    ':fullname' => $fullname,
                    ':email' => $email,
                    ':password' => $hashed_password
                ]);

                echo "<script>alert('Diiwangelintu waa guul! Hada waad gali kartaa.'); window.location.href='login.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Fadlan buuxi meelaha bannaan!'); window.location.href='register.php';</script>";
    }
}
?>