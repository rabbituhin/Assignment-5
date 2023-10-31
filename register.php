<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $user = [
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'role' => 'user'
    ];

    file_put_contents('users.txt', json_encode($user) ."\n", FILE_APPEND);
    header("Location: login.php");
}
?>