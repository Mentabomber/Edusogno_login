<?php
    session_start();
    
    // $name = stripslashes($_REQUEST['name']);
    
    // $_SESSION['name'] = $name;
    // $result = $conn->query($query);
    // $row = $result->fetch_assoc();

    // $risultato = mysqli_query($con, $query);
    // $prova = mysqli_fetch_array($risultato);
    // $nome = mysqli_fetch_row($prova);
    
    // $risposta = mysqli_result($risultato);
    if(!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }
    
?>