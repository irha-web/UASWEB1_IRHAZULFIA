<?php
session_start();
include "koneksi.php";

$error = "";

/* ======================
   PROSES LOGIN
====================== */
if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt  = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // LOGIN SEDERHANA (password masih polos)
        if ($password === $row['password']) {
            $_SESSION['login'] = true;
            $_SESSION['email'] = $row['email'];
            $_SESSION['name']  = $row['name'];
            $_SESSION['role']  = $row['role'];
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }
}

/* ======================
   JIKA BELUM LOGIN
====================== */
if (!isset($_SESSION['login'])) {
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
        h2 { text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
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
        .btn-reset { background: #f44336; }
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

    <?php if ($error != "") echo "<div class='error'>$error</div>"; ?>

    <form method="post">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn">Login</button>
        <button type="reset" class="btn btn-reset">Batal</button>
    </form>

    <div class="footer">© 2026 POLGAN MART</div>
</div>

</body>
</html>
<?php
exit;
}

/* ======================
   DASHBOARD
====================== */
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f5f5f5; }
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background: #2c3e50;
            color: white;
            position: fixed;
        }
        .sidebar a {
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover { background: #34495e; }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center mt-3">Dashboard</h4>
    <a href="index.php?page=dashboard">Home</a>
    <a href="index.php?page=listproducts">List Produk</a>
    <a href="index.php?page=customer">Customer</a>
    <a href="index.php?page=transaksi">Transaksi</a>
    <a href="index.php?page=laporan">Laporan</a>
    <a href="index.php?page=profile">Profile</a>
    <a href="logout.php" class="text-danger">Logout</a>
</div>

<div class="content">
    <?php
    if ($page == "dashboard") {
        include "dashboard.php";
    } elseif ($page == "listproducts") {
        include "listproducts.php";
    } elseif ($page == "profile") {
        include "profile.php";
    }
    ?>
</div>

</body>
</html>