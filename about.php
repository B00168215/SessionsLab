<?php require_once '../template/header.php';?>
<?php session_start();
// Handles when logout button is clicked
if (isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']); // reloads this page
    exit;
}
?>
  
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
        <h3 class="text-muted">PHP Login exercise - About page</h3>
      </div>

        <div class="mainarea">
            <h1><?php
            if (isset($_SESSION['Username'])) {
    echo "Status: You are logged in as " . $_SESSION['Username'];
} else {
    echo "Status: You are NOT logged in";
}
?></h1>
            <p class="lead">This is where we will put the logout button</p>

            <form action="" method="post" name="Logout_Form" class="form-signin">
                <button name="logout" class="button" type="submit">Log out</button>
            </form>
        </div>

      <div class="row marketing">
        <div>
          <h4>About page</h4>
          <p>Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. Some content goes here. </p>

       </div>

          <?php require_once '../template/footer.php';?>
