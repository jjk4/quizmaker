<?php
    $config = include("../config.php");
    $connection = new mysqli($config["database"]["host"], $config["database"]["username"], $config["database"]["password"], $config["database"]["dbname"]);
    if (!$connection) {
        die("Fehler mit der Datenbank: " . mysqli_connect_error());
    }
    session_start()

?>
<html>
    <head>
        <title><?php echo $site_name; ?> - Quizmaker</title>
        <script src="https://kit.fontawesome.com/f54f800e80.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        <div class="header">
            <div class="links">
                <a href="../index.php"><i class="fas fa-home"></i> Startseite</a>
                <a href="../code.php"><i class="fas fa-qrcode"></i> Code eingeben</a>
                <a href="../search.php"><i class="fas fa-search"></i> Quiz suchen</a>
                <a href="../randomquiz.php"><i class="fas fa-dice"></i> Zufälliges Quiz</a>
                <a href="../category.php"><i class="fas fa-list-ul"></i> Kategorien</a>
                <a href="../create.php"><i class="fas fa-plus"></i> Quiz erstellen</a>
                <?php
                    if(!isset($_SESSION['userid'])) {
                        echo "<a href=\"../login.php\"><i class=\"fas fa-user\"></i> Einloggen</a>";
                    } else {
                        echo "<a href=\"../account\"><i class=\"fas fa-user\"></i> Mein Account</a>";
                    }
                ?>
            </div>
        </div>
        <div class="content">
        <br>
