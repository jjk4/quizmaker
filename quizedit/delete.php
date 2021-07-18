<?php
    $site_name = "Quiz Löschen";
    include("header.php");
    echo "<br><h1>Quiz löschen</h1>";
    if(isset($_SESSION['userid'])){ // Zuerst prüfen, ob Nutzer überhaupt angemeldet ist
        $quizid = $_GET["q"];
        $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM quizzes WHERE `id` = '" . $quizid . "'"));
        $authorofquiz = $data["author"];
        if($authorofquiz == $_SESSION["username"] or $rank == "admin"){ // Wenn das Quiz einem auch gehört
            if(isset($_GET["y"])){ //Wenn schon das OK zum löschen gegeben wurde, dass löschen
                mysqli_query($connection, "DELETE FROM `quizzes` WHERE `id` = '" . $quizid . "'");
                mysqli_query($connection, "DELETE FROM `comments` WHERE `quizid` = '" . $quizid . "'");
                echo "Das Quiz wurde gelöscht!";
            } else {
            ?>
                <span style="color: red;">Bist du dir zu 100% sicher, dass du das Quiz <span style="font-size: 2em;">"<?php echo $data["quizname"];?>"</span> LÖSCHEN möchtest?</span><br>
                Es wird eine nacher keine Möglichkeit mehr geben, dass Quiz wiederherzustellen!<br><br>
                <a href="?q=<?php echo $data["id"];?>&y=ok" class="button">Ja, ich bin mir ganz sicher! Das Quiz soll gelöscht werden!</a>
            <?php
            }
        } else {
            echo "Fehler: Dieses Quiz gehört dir nicht, du kannst es nicht löschen!";
        }
    } else {
        echo "Fehler: Du musst dich anmelden, um ein Quiz zu löschen";
    }
    
?><br>

<?php
    include("footer.php");
?>