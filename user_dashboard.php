<?php
session_start();

if (isset($_SESSION['role'])) {
    $username = $_SESSION['email'];

} else {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        .dashboard-container {
            background-color: #ffffff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .user-info-box {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-200">
    <div class="dashboard-container p-4">
        <h1 class="text-3xl font-semibold text-center text-blue-500 mb-4">User Dashboard</h1>

        <div class="user-info-box mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">Welcome, <?php echo $username; ?></h2>
            <p class="text-gray-600">Here's your user dashboard.</p>
        </div>

        <form action="logout.php" method="post" class="text-center">
            <button type="submit" class="button mt-8">Logout</button>
        </form>
    </div>
</body>
</html>