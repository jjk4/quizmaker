<?php
    if(isset($_SESSION['username'])){
?>
<form method="POST" autocomplete="off">
    <h4>Kommentar schreiben:</h4>
    <input type="text" name="comment">
    <input type="submit">
</form>
<?php
    } else {
        echo "Du musst angemeldet sein, um Kommentare zu senden!<br><br><br>";
    }
    if(isset($_POST["comment"])){
        if(isset($_SESSION['username'])){
            $sql = "INSERT INTO `comments` (`quizid`, `author`, `content`) VALUES ('" . $quizid . "', '" . $_SESSION["username"] . "', '" . $_POST["comment"] . "')";
            mysqli_query($connection, $sql);
        }
    }
    $sql = "SELECT * FROM comments WHERE `quizid` = '" . $quizid . "'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // Likes auswerten
            $likes = json_decode($row["likes"], true);
            $i = 0;
            foreach($likes as $key=>$value){
                $i++;
            }
            $numberoflikes = $i;
            // Dislikes auswerten
            $dislikes = json_decode($row["dislikes"], true);
            $i = 0;
            foreach($dislikes as $key=>$value){
                $i++;
            }
            $numberofdislikes = $i;
            //Kommentare anzeigen
            echo "<b>" . $row["author"] . "</b>";
            //Kommentar liken
            echo "<a href=\"comment.php?a=like&q=$quizid&c=" . $row["id"] . "\"><i class=\"fas fa-thumbs-up\" style=\"color: ";
            if(in_array($_SESSION["username"], $likes)){
                echo "green";
            } else {
                echo "black";
            }
            echo ";\"></i></a> "; 
            echo "(" . $numberoflikes . ")";
            //Kommentar disliken
            echo "<a href=\"comment.php?a=dislike&q=$quizid&c=" . $row["id"] . "\"><i class=\"fas fa-thumbs-down\" style=\"color: ";
            if(in_array($_SESSION["username"], $dislikes)){
                echo "green";
            } else {
                echo "black";
            }
            echo ";\"></i></a> "; 
            echo "(" . $numberofdislikes . ")"; 
            //Kommentar melden
            echo "<a href=\"comment.php?a=report&q=$quizid&c=" . $row["id"] . "\"><i class=\"fas fa-flag\" style=\"color: red;\"></i></a> "; 
            //Kommentar löschen
            if($row["author"] == $_SESSION["username"]){
                echo "<a href=\"comment.php?a=delete&q=$quizid&c=" . $row["id"] . "\"><i class=\"fas fa-times-circle\" style=\"color: red;\"></i></a> "; 
            } else {
                // Prüfen, ob man Admin oder Mod ist
                if($rank == "admin" or $rank == "mod"){
                    echo "<a href=\"comment.php?a=delete&q=$quizid&c=" . $row["id"] . "\"><i class=\"fas fa-times-circle\" style=\"color: red;\"></i></a> "; 
                }
            }
            //Kommentar bearbeiten
            if($row["author"] == $_SESSION["username"]){
                echo "<span onclick=\"edit(" . $row["id"] . ")\" style=\"cursor: pointer;\"><i class=\"fas fa-pencil-alt\"></i></span>"; 
            } else {
                // Prüfen, ob man Admin oder Mod ist
                if($rank == "admin" or $rank == "mod"){
                    echo "<span onclick=\"edit(" . $row["id"] . ")\" style=\"cursor: pointer;\"><i class=\"fas fa-pencil-alt\"></i></span>"; 
                }
            }
            echo "<br><span class=\"time\">" . $row["created"] . "</span>";
            echo "<br><div id=\"comment"  . $row["id"]  . "\">" . $row["content"] . "</div><br><br>";
        }
    }
    
?>
<script>
    function edit(c){
        var content = $("#comment" + c).text();
        var form = "<form method=\"POST\" action=\"comment.php?a=edit&q=<?php echo $quizid;?>&c=" + c + "\" autocomplete=\"off\"><input type=\"text\" name=\"comment\" value=\"" + content + "\"><input type=\"submit\"></form>";
        $("#comment" + c).html(form);
    }
</script>