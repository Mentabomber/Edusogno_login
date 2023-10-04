<?php
    // ini_set("SMTP", "localhost");
    // ini_set("smtp_port", 25);
    //include auth_session.php file on all user panel pages
    include("auth_session.php");
    // chiedo i dati degli eventi al database
    require_once("get_eventi.php");
    // require_once("send_mail.php");
    $mail = $_SESSION['email'];
    $events = getEventi($mail);
    // Funzione per inviare l'email di reset password
function sendResetEmail($to, $subject, $message, $headers) {
    mail($to, $subject, $message, $headers);
}

// Se è stato fatto un clic sul pulsante di reset password
if (isset($_POST['reset_password'])) {
    // Definisci le variabili to, subject, message, e headers
  
    $to      = 'mavbafpcmq@hitbase.net';
    $subject = 'Reset Password';
    $message = 'Ciao clicka il link per resettare la tua password';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: simcictilen@gmail.com' . "\r\n"; 
    // . 'X-Mailer: PHP/' . phpversion();
    
    // Chiama la funzione per inviare l'email
    try {
        sendResetEmail($to, $subject, $message, $headers);
        echo "Email inviata con successo.";
    } catch (Exception $e) {
        echo "Errore nell'invio dell'email: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="form">
        <h1>Ciao <?php echo $_SESSION['nome']['nome'] . " " . $_SESSION['cognome']['cognome']?> ecco i tuoi eventi</h1>
        <?php 
        // messaggio ricevuto se non ci sono eventi disponibili
        if (count($events) < 1) { ?>
            <h3>Non ci sono eventi disponibili al momento.</h3>
        <?php } 
        else { ?>
               <?php  
                foreach ($events as $event) { ?>
                    <div class='card-evento'>
                        <h3><?php echo $event['nome_evento']; ?></h3><br/>
                        <span><?php echo $event['data_evento']; ?></span><br/>
                        <button>JOIN</button>
                    </div>
        <?php   } ?>
<?php   } ?>
        <br/>
        <form method="post">
            <p><button type="submit" name="reset_password">Resetta psw</button></p>
        </form>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>