 <?php
    $site_name = "Quiz erstellen";
    include("header.php");
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { //Wenn ein Formular gesendet wurde
    $quizid = $_POST["quizid"];
    $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM quizzes WHERE `id` = '" . $quizid . "'"));
    $authorofquiz = $data["author"];
    if($authorofquiz == $_SESSION["username"] or $rank = "admin"){ // Wenn das Quiz einem auch gehört
        //Grundlegendes auslesen
        $author = $authorofquiz;
        $quizname = $_POST["quizname"];
        $style = $_POST["style"];
        $questions = array();
        //Kategorien auslesen
        $categories = array();
        foreach($config["categories"] as $key => $value){
            if ($_POST["category_" . $key] == "on"){
                $categories[] = $key;
            }
        }
        //Fragen auslesen
        for ($i = 1; $i <= $_POST["numberofquestions"]; $i++) {
            $questionarray = array(); // Frage und Typ speichern
            $questionarray["name"] = $_POST[$i . "_question"];
            $questionarray["type"] = $_POST[$i . "_type"];
            $questionarray["answers"] = array();
            switch($_POST[$i . "_type"]) { //Prüfen, um welche Frage es sich handelt
                case "multiplechoice":
                    for ($j = 1; $j <= 5; $j++) {
                        $questionarray["answers"][$_POST[$i . "_" . $j]] = $_POST[$i . "_" . $j . "_correct"];
                    }
                    break;
                case "truefalse":
                    $questionarray["answers"]["true"] = $_POST[$i . "_true"];
                    $questionarray["answers"]["false"] = $_POST[$i . "_" . $j . "_false"];
                    break;
                case "onechoice":
                    for ($j = 1; $j <= 5; $j++) {
                        $questionarray["answers"][$_POST[$i . "_" . $j]] = $_POST[$i . "_" . $j . "_correct"];
                    }
                    break;
            }
            $questions[$i] = $questionarray;
        }
        // Zuerst altes Quiz löschen
        mysqli_query($connection, "DELETE FROM `quizzes` WHERE `id` = '" . $quizid . "'");
        // Dann mit neuen Daten überschreiben
        $sql =  "INSERT INTO `quizzes` (`id`, `author`, `quizname`, `questions`, `categories`, `style`) VALUES ('" . $quizid . "', '" . $author . "', '" . $quizname . "', '" . json_encode($questions) . "', '" . json_encode($categories) . "', '" . $style . "');";
        if (mysqli_query($connection, $sql)) {
            echo "<br>Quiz wurde erfolgreich bearbeitet! Du kannst das Quiz jetzt unter " . $config["server"]["url"] . "/play.php?q=" . $quizid;
            echo "<br> Deine Quizid ist: $quizid";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    } else {
        echo "<br>Fehler: Dieses Quiz gehört dir nicht";
    }
} else {
    echo "<br>Fehler: Kein Formular gesendet";
}
?>

<?php
    include("footer.php");
?>
