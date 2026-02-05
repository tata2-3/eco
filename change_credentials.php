<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.html');
    exit();
}

$creds = include 'credentials.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    if ($newUsername && $newPassword) {
        $content = "<?php\nreturn [\n    'username' => '" . addslashes($newUsername) . "',\n    'password' => '" . addslashes($newPassword) . "'\n];";
        file_put_contents('credentials.php', $content);
        $message = "Username and password updated successfully!";
    } else {
        $message = "Please fill in both fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Credentials | ECO-NET</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #3e7c2b, #b5dc7a);
        }
        .container {
            background: rgba(0, 0, 0, 0.25);
            padding: 40px;
            border-radius: 16px;
            width: 360px;
            text-align: center;
            color: #e0f2d5;
        }
        h2 {
            color: #fff;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 2px solid #7fb34d;
            background: rgba(255,255,255,0.1);
            color: #fff;
        }
        input::placeholder {
            color: #e0f2d5;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 8px;
            background: #7fb34d;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #4e8b2e;
        }
        .message {
            color: #fff;
            margin-bottom: 10px;
        }
        a {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Admin Username & Password</h2>
        <?php if ($message) echo "<p class='message'>$message</p>"; ?>
        <form method="POST">
            <input type="text" name="new_username" placeholder="New Username" required><br>
            <input type="password" name="new_password" placeholder="New Password" required><br>
            <button type="submit">Update</button>
        </form>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
