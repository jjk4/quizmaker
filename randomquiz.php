<?php
    $site_name = "Zufälliges Quiz";
    include("header.php");
?>
<!-- SELECT id FROM quizzes ORDER BY RAND() LIMIT 1 -->
<h1>Zufälliges Quiz</h1>
Dein Zufälliges Quiz ist:
<?php
    $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM quizzes ORDER BY RAND() LIMIT 1"));
    echo "<h2>\"" . $data["quizname"] . "\" von \"" . $data["author"] . "\"</h2>";
    echo "<h3><a href=\"play.php?q=" . $data["id"] . "\">Jetzt spielen!</a></h3>";
?>
<?php
    include("footer.php");
?>