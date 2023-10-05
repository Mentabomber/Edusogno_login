<?php
include('auth_session.php');
include('functions.php');
include('get_eventi.php');

$events = getEventi($_SESSION['email']);

if (!isAdmin()) {
    session_destroy();
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form">
        <h1>Admin Dashboard</h1>
        <h2>Gestisci Eventi</h2>
        <?php 
        // messaggio ricevuto se non ci sono eventi disponibili
        if (count($events) < 1) { ?>
            <h3>Non ci sono eventi disponibili al momento.</h3>
        <?php } 
        else { ?>
               <?php  
                foreach ($events as $event) { ?>
                    <div class='card-evento' value="<?php echo $event['id']; ?>">
                        <h3><?php echo $event['nome_evento']; ?></h3><br/>
                        <span><?php echo $event['data_evento']; ?></span><br/>
                        <span><?php echo $event['id']; ?></span><br/>
                        <button>Modifica</button>
                        <button>Elimina</button>
                    </div>
        <?php   } ?>
<?php   } ?>
        <br/>
        <p><a href="create_event.php">Crea Nuovo Evento</a></p>
        <br/>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>