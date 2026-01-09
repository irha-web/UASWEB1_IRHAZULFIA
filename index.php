<?php
session_start();
include "koneksi.php"; // pastikan file koneksi ada

$error = "";

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Query user berdasarkan email
    $query  = "SELECT * FROM users WHERE email = ?";
    $stmt   = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Cek password (password di database harus di-hash)
        if ($password === $row['password']) {
    $_SESSION['email'] = $row['email'];
    $_SESSION['name']  = $row['name'];
    $_SESSION['role']  = $row['role'];
    header("Location: dashboard.php");
    exit;
} else {
    $error = "Password salah.";
}

        
    } else {
        $error = "Email tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1e1e2f;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-card {
            background: #2b2b3c;
            padding: 25px;
            width: 320px;
            border-radius: 10px;
            color: white;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: none;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-reset {
            background: #f44336;
        }
        .error {
            background: #ff4d4d;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #ccc;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>POLGAN MART</h2>

    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn">Login</button>
        <button type="reset" class="btn btn-reset">Batal</button>
    </form>

    <div class="footer">
        <p>© 2026 POLGAN MART</p>
    </div>
</div>

</body>
</html>