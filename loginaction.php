<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email= $_POST["email"];
    $password = $_POST["password"];

    $lines = file('users.txt');
    foreach ($lines as $line) {
        $user = json_decode($line, true);
        if ($user['email'] == $email && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
                exit;
            } else {
                header("Location: user_dashboard.php");
                exit;
            }
        }
    }


    header("Location: login.php?error=1");
    exit;
}
?>