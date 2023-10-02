<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['email'])) {
        $email = stripslashes($_REQUEST['email']);    // removes backslashes
        $email = mysqli_real_escape_string($con, $email);
        // $name = stripslashes($_REQUEST['name']);
        // $name = mysqli_real_escape_string($con, $name);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query = "SELECT * FROM `users` WHERE email='$email'
                    AND password='" . md5($password) . "'";
        $nameQuery = "SELECT name FROM `users` WHERE email='$email'
                        AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $resultName = mysqli_query($con, $nameQuery) or die(mysql_error());
        $name = mysqli_fetch_assoc($resultName); 
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            // Redirect to user dashboard page
            header("Location: dashboard.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Email/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="email" placeholder="Email" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">Crea un nuovo account</a></p>
  </form>
<?php
    }
?>
</body>
</html>