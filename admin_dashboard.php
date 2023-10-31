<?php
session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['new_role']) && isset($_POST['username'])) {
        $newRole = $_POST['new_role'];
        $username = $_POST['username'];

        $lines = file('users.txt');
        $updatedUsers = [];

        foreach ($lines as $line) {
            $user = json_decode($line, true);
            if ($user['username'] === $username) {
                $user['role'] = $newRole;
            }
            $updatedUsers[] = $user;
        }

       
        file_put_contents('users.txt', '');
        foreach ($updatedUsers as $user) {
            file_put_contents('users.txt', json_encode($user) . "\n", FILE_APPEND);
        }
    }

    
    $lines = file('users.txt');
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid #ddd;
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }

            .change-role-btn {
                padding: 5px 10px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                cursor: pointer;
            }
            .delete-btn{
                padding: 5px 10px;
                background-color: #f44336;
                color: #fff;
                border: none;
                cursor: pointer;

            }
           

            .logout-btn {
                padding: 5px 10px;
                background-color: #f44336;
                color: #fff;
                border: none;
                cursor: pointer;
            }
        </style>
    </head>
    <body class="bg-gray-200">
        <div class="p-8">
            <h1 class="text-2xl font-semibold">Admin Dashboard</h1>
            <p>Welcome, <?php echo $_SESSION['email']; ?></p>
            
            <h2 class="text-xl font-semibold mt-8">Registered Users</h2>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($lines as $line) {
                    $user = json_decode($line, true);
                    echo "<tr>";
                    echo "<td>" . $user['username'] . "</td>";
                    echo "<td>" . $user['role'] . "</td>";
                    echo "<td>";
                    echo "<form action='admin_dashboard.php' method='post'>";
                    echo "<input type='hidden' name='username' value='" . $user['username'] . "'>";
                    echo "<select name='new_role'>";
                    echo "<option value='admin' " . ($user['role'] === 'admin' ? 'selected' : '') . ">Admin</option>";
                    echo "<option value='manager' " . ($user['role'] === 'manager' ? 'selected' : '') . ">Manager</option>";
                    echo "<option value='user' " . ($user['role'] === 'user' ? 'selected' : '') . ">User</option>";
                    echo "</select>";
                    echo "<button type='submit' class='change-role-btn'>Edit</button>";
                    echo "<input type='hidden' name='delete_username' value='" . $user['username'] . "'>";
                    echo "<button type='submit' class='delete-btn'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <form action="logout.php" method="post">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </body>
    </html>
    <?php
} else {
    
    header("Location: login.php");
}
?>