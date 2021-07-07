<?php
    $site_name = "Suche";
    include("header.php");
?><br>
<?php
    if ($_GET["search"]){
        $search = $_GET["search"];
        echo "<h2> Quizze, die \"$search\" enthalten: </h2>";
        $result = mysqli_query($connection, "SELECT DISTINCT * FROM quizzes WHERE content LIKE '%" . $search . "%'");
        echo "<h3><ul>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<li><a href=\"play.php?q=" . $row["ID"] . "\">" . json_decode($row["content"], true)["quizname"] . "</a></li>";
        }
        echo "</ul></h3>";
        echo "<h2> Weiteren Suchbegriff eingeben:</h2>";
    } else {
        echo "<h2> Suche:</h2>";
    }
?>
<form action="search.php" method="get" style="text-align:center">
    <input type="text" name="search" placeholder="Suchbegriff eingeben" style="width: 40%"><br>
    <input type="submit">
</form>

<?php
    include("footer.php");
?>