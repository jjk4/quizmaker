 <?php
    $site_name = "Quiz erstellen";
    include("header.php");
?>
<?php
function get_ids($connection) {
    $ids = array();
    $result = mysqli_query($connection, "SELECT id FROM quizzes");
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $ids[] = $row["id"];
        }

    }

    return $ids;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") { //Wenn ein Formular gesendet wurde
    // zufällige ID erstellen
    $idok = false;
    while ($idok == false) {
        //ID generieren
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $quizid = '';
        for ($i = 0; $i < 10; $i++) {
            $quizid .= $characters[rand(0, $charactersLength - 1)];
        }
        //prüfen, ob ID schon existiert
        $ids = get_ids($connection);
        var_dump($ids);
        if (in_array($quizid, $ids)) {
            $idok = false;
        } else {
            $idok = true;
        }

    }
    //Grundlegendes auslesen
    $author = $_POST["author"];
    $quizname = $_POST["quizname"];
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
    $sql = "INSERT INTO `quizzes` (`id`, `author`, `quizname`, `questions`, `categories`) VALUES ('" . $quizid . "', '" . $author . "', '" . $quizname . "', '" . json_encode($questions) . "', '" . json_encode($categories) . "');";
    if (mysqli_query($connection, $sql)) {
        echo "<br>Quiz wurde erfolgreich gespeichert! Du kannst das Quiz jetzt unter " . $config["server"]["url"] . "/play.php?q=" . $quizid;
        echo "<br> Deine Quizid ist: $quizid";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
} else {
    echo "<br>Fehler: Kein Formular gesendet";
}
?>

<?php
    include("footer.php");
?>
