<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['email'])) {
        // removes backslashes
        $name = stripslashes($_REQUEST['name']);
        //escapes special characters in a string
        $name = mysqli_real_escape_string($con, $name);

        $surname = stripslashes($_REQUEST['surname']);
        $surname = mysqli_real_escape_string($con, $surname);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (email, password, name, surname, create_datetime)
                     VALUES ('$email', '" . md5($password) . "', '$name','$surname', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Crea il tuo account</h1>
        <label for="name">Inserisci il nome</label>
        <input type="text" class="login-input" name="name" placeholder="Mario" required />
        <label for="surname">Inserisci il cognome</label>
        <input type="text" class="login-input" name="surname" placeholder="Rossi" required />
        <label for="email">Inserisci l'email</label>
        <input type="text" class="login-input" name="email" placeholder="name@example.com">
        <label for="password">Inserisci la password</label>
        <input type="password" class="login-input" name="password" placeholder="Scrivila qui">
        <input type="submit" name="submit" value="REGISTRATI" class="login-button">
        <p class="link"><a href="login.php">Hai già un account? Accedi</a></p>
    </form>
<?php
    }
?>
</body>
</html>