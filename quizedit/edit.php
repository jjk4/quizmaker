<?php
    $site_name = "Quiz bearbeiten";
    include("header.php");
    echo "<br><h1>Quiz bearbeiten</h1>";
    if(isset($_SESSION['userid'])){ // Zuerst prüfen, ob Nutzer überhaupt angemeldet ist
        $quizid = $_GET["q"];
        $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM quizzes WHERE `id` = '" . $quizid . "'"));
        $authorofquiz = $data["author"];
        if($authorofquiz == $_SESSION["username"]){ // Wenn das Quiz einem auch gehört
            echo "Die Quizbearbeitungsfunktion (sehr langes Wort xD) ist leider noch nicht verfügbar!";
        } else {
            echo "Fehler: Dieses Quiz gehört dir nicht, du kannst es nicht bearbeiten!";
        }
    } else {
        echo "Fehler: Du musst dich anmelden, um ein Quiz zu bearbeiten";
    }
    
?><br>

<?php
    include("footer.php");
?>