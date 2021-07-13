<?php
    $site_name = "Quiz erstellen";
    include("header.php");
?>
<link rel="stylesheet" id="quizsheet" href="styles/quizmaker_orange.css">
<script src="create.js"></script>

<h1>Quiz erstellen</h1>
<form action="submitquiz.php" method="post" autocomplete="off">
    Name des Quiz: <input name="quizname" type="text" style="width: 40%;"><br>
    Aussehen: <select id="styleselector" name="style">
                <?php 
                    foreach($config["styles"] as $key=>$value){
                        echo "<option value=\"" . $key . "\">" . $value . "</option>";
                    }
                ?>
            </select>    
    
    <br>
    <?php
    if(isset($_SESSION['userid'])) {
        echo "Autor: " . $_SESSION['username'] . "<input name=\"author\" type=\"hidden\" value=\"" . $_SESSION['username'] . "\"><br><br>";
    } else {
        echo "Autor: Logge dich jetzt ein, um deinen Namen im Quiz zu sehen!<input name=\"author\" type=\"hidden\" value=\"unknown\"><br>";
    }
    ?>
    Kategorien:<br>
    <?php
        foreach($config["categories"] as $name => $content) {
            echo("<input type=\"checkbox\" name=category_" . $name . "><i class=\"" . $content["icon"] . "\"></i> " . $content["name"] . "<br>");
        }
    ?>
    <input name="numberofquestions" type="hidden" value="0">
    <div id="questions">

    </div>
    <h3>Frage hinzufügen:</h3>
    <button id="multiplechoice" type="button">Multiple Choice</button>
    <button id="truefalse" type="button">Wahr/Falsch</button>
    <button id="onechoice" type="button">Eine Auswahl</button><br>
    <h3>Absenden:</h3>
    <input type="submit">
</form>
<script>
    let sel_selector = document.getElementById('styleselector');
    sel_selector.addEventListener ('change', function () {
        document.getElementById("quizsheet").setAttribute("href", "styles/" + this.value + ".css");
    });
</script>
<?php
    include("footer.php");
?>
