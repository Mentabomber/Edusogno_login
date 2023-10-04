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
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        
        // Check user is exist in the database
        $query = "SELECT * FROM `utenti` WHERE email='$email'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {
            // Fetch the stored hashed password
            $userData = mysqli_fetch_assoc($result);
            $hashedPassword = $userData['password'];

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Password is correct
                // Fetch additional user details
                $queryNome = "SELECT nome FROM `utenti` WHERE email='$email'";
                $queryCognome = "SELECT cognome FROM `utenti` WHERE email='$email'";

                $risultatoNome = mysqli_query($con, $queryNome) or die(mysql_error());
                $nome = mysqli_fetch_assoc($risultatoNome);

                $risultatoCognome = mysqli_query($con, $queryCognome) or die(mysql_error());
                $cognome = mysqli_fetch_assoc($risultatoCognome);

                // Set session variables
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $nome;
                $_SESSION['cognome'] = $cognome;

                // Redirect to user dashboard page
                header("Location: dashboard.php");
            } else {
                // Password is incorrect
                echo "<div class='form'>
                      <h3>Incorrect Email/password.</h3><br/>
                      <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                      </div>";
            }
        } else {
            // User does not exist
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
        <p class="link">Non hai ancora un profilo? <a href="registration.php">Registrati</a></p>
  </form>
<?php
    }
?>
</body>
</html>
