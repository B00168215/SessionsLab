<?php
require_once('db.php');
session_start();
$message = '';

if (isset($_POST['Submit'])) {
    $username = trim($_POST['Username']);
    $password = trim($_POST['Password']);

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['password'] === $password) {
            $_SESSION['Username'] = $username;
            $_SESSION['Active'] = true;
            header("location:index.php");
            exit;
        } else {
            $message = "Incorrect Username or Password.";
        }
    } catch (PDOException $e) {
        $message = "Database error: " . $e->getMessage();
    }
}
?>

<?php require_once('../template/header.php'); ?>
<link rel="stylesheet" type="text/css" href="../css/signin.css">
<link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
<title>Sign in</title>
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
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername">Username</label>
        <input name="Username" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>

    <?php if (!empty($message)) echo "<p><strong>$message</strong></p>"; ?>
  </div>
</div>
</body>
</html>
