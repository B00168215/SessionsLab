<?php
session_start();
require_once('db.php');
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['newUsername']);
    $password = trim($_POST['newPassword']);

    if (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
        $message = "Invalid username format.";
    } else {
        // Save to MySQL database (not users.txt)
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute([
                'username' => $username,
                'password' => $password // plain text for now
            ]);
            $message = "Registration successful. You can now <a href='login.php'>log in</a>.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $message = "Username already taken.";
            } else {
                $message = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<?php require_once('../template/header.php'); ?>
<link rel="stylesheet" type="text/css" href="../css/signin.css">
<title>Register</title>
</head>
<body>
<div class="container">
  <div class="header clearfix">
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contacts.php">Contact</a></li>
      </ul>
    </nav>
    <h3 class="text-muted">PHP Login exercise - Home page</h3>
  </div>

  <div class="container">
    <form action="" method="post" class="form-signin">
        <h2 class="form-signin-heading">Register</h2>
        <label for="inputUsername">Username</label>
        <input name="newUsername" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="newPassword" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="button" type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Sign in</a></p>

    <?php if (!empty($message)) echo "<p><strong>$message</strong></p>"; ?>
  </div>
</div>
</body>
</html>
