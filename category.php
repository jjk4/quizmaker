<?php
    $site_name = "Kategorien";
    include("header.php");
?>
<h1>Kategorien</h1>
<?php
    if ($_GET["category"]) { //Wenn eine Kategorie aufgerufen wurde
        $category = $_GET["category"];
        $sql = "SELECT * FROM quizzes WHERE categories LIKE '%" . $category . "%'";
        $result = mysqli_query($connection, $sql);
        echo "<a href=\"category.php\"><i class=\"fas fa-chevron-left\"></i>Zurück</a><br><h3><ul>";
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT quizname FROM quizzes WHERE id='" . $row["id"] . "'"));
                echo "<li><a href=\"play.php?q=" . $row["id"] . "\">" . $data["quizname"] . "</a></li>";
            }
            echo "</ul></h3>";
        } else {
            echo "Keine Ergebnisse";
        }

    } else{
        echo "<h3><ul>";
        foreach($config["categories"] as $key => $value) {
            echo("<li><a href=\"category.php?category=" . $key . "\" ><i class=\"" . $value["icon"] . "\"></i> " . $value["name"] . "</a></li>");
        }
        echo "</ul></h3>";
    }
?>
<?php
    include("footer.php");
?>
