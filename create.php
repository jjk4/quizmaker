<?php
    $site_name = "Quiz erstellen";
    include("header.php");
?>
<script src="create.js"></script>

<h1>Quiz erstellen</h1>
<form action="submitquiz.php" method="post">
    Name des Quiz: <input name="quizname" type="text" style="width: 40%;"><br>
    Autor (dein Name): <input name="author" type="text"><br>
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
<?php
    include("footer.php");
?>
