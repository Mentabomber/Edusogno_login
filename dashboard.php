<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");

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
        <h1>Ciao <?php echo $_SESSION['nome']['nome'] . $_SESSION['cognome']['cognome']?> ecco i tuoi eventi</h1>
        <?php 
        // call axios necessaria per tirar fuori i dati degli eventi
            if ($result) {
                for ($i=0; $i < count($eventi); $i++) { 
                    echo "  <div class='card-evento'>
                                <h3>$eventi[$i]['nome_evento']</h3><br/>
                                <span>$eventi[$i]['data_evento']</span><br/>
                                <button>JOIN</button>
                            </div>
                         ";
                }
            } else {
                echo "
                      <h3>Non ci sono eventi disponibili al momento.</h3>
                     ";
            }
        ?>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>