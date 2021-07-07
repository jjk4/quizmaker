<?php
    $site_name = "Zufälliges Quiz";
    include("header.php");
?>
<!-- SELECT id FROM quizzes ORDER BY RAND() LIMIT 1 -->
<h1>Zufälliges Quiz</h1>
Dein Zufälliges Quiz ist:
<?php
    $randomquiz = mysqli_fetch_assoc(mysqli_query($connection, "SELECT ID FROM quizzes ORDER BY RAND() LIMIT 1"))["ID"];
    $content = json_decode(mysqli_fetch_assoc(mysqli_query($connection, "SELECT content FROM quizzes WHERE id='" . $randomquiz . "'"))["content"], true);
    echo "<h2>\"" . $content["quizname"] . "\" von \"" . $content["author"] . "\"</h2>";
    echo "<h3><a href=\"play.php?q=" . $randomquiz . "\">Jetzt spielen!</a></h3>";
?>
<?php
    include("footer.php");
?>