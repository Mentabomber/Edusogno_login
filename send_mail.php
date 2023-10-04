<?php

    // Prendo l'email della sessione attiva per definire chi è loggato
    $mail = $_SESSION['email'];

    // Definisco le variabili to, subject, message, e headers
    $to      = $mail;
    $subject = 'Reset Password';
    $message = 'Ciao clicka il link per resettare la tua password <a href="http://localhost/Progetto-Edusogno/Edusogno_login/reset_pswd.php">Qui</a>' ;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: simcictilen@gmail.com' . "\r\n";

    // Funzione per mandare l'email del reset della password
    function sendResetEmail($to, $subject, $message, $headers) {
  
        mail($to, $subject, $message, $headers);
    
    }
?>