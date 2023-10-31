<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_username'])) {
    $deleteUsername = $_POST['delete_username'];

    if ($_SESSION['role'] === 'admin') {
        $lines = file('users.txt');
        $updatedUsers = [];

        foreach ($lines as $line) {
            $user = json_decode($line, true);
            if ($user['username'] !== $deleteUsername) {
                $updatedUsers[] = $user; // Exclude the user to be deleted
            }
        }

        file_put_contents('users.txt', ''); // Clear the file

        foreach ($updatedUsers as $user) {
            file_put_contents('users.txt', json_encode($user) . "\n", FILE_APPEND); // Append updated user data
        }

        // Redirect back to the admin dashboard with a success message
        header("Location: admin_dashboard.php?success=user_deleted");
    } else {
        // Redirect unauthorized users to another page or display an error message
        header("Location: unauthorized.php");
    }
} else {
    // Handle invalid or missing POST request
    header("Location: admin_dashboard.php?error=delete_user_failed");
}
