<?php
    $site_name = "Quiz spielen";
    include("header.php");
?>
<?php
    if ($_GET["q"]) { // Wenn ein Quiz angegeben wurde
        $quizid = $_GET["q"];
        $result = mysqli_query($connection, "SELECT * FROM quizzes WHERE id='" . $quizid . "'");
        $data = mysqli_fetch_assoc($result);
        $questions = json_decode($data["questions"], true);
        if (mysqli_num_rows($result) > 0) { //Quiz existiert
            echo "<h1>Quiz \"" . $data["quizname"] . "\" von \"" . $data["author"] . "\"</h1><span class=\"time\">" . $data["created"] . "</span>";
            echo "<form action=\"submitsolution.php\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"quizid\" value=\"$quizid\">";
            foreach($questions as $key=>$value) {
                echo "<div class=\"question\">";
                echo "<h2>". $value["name"] . "</h2>";
                switch($value["type"]){
                    case "multiplechoice":
                        $i = 0;
                        foreach($value["answers"] as $answer=>$sol){
                            $i++;
                            echo $answer . "<input type=\"checkbox\" name=\"" . $key . "_" . $i . "\"><br>";
                        }
                        break;
                    case "truefalse":
                        echo "Wahr <input type=\"checkbox\" name=\"" . $key . "_true\"><br>";
                        echo "Falsch <input type=\"checkbox\" name=\"" . $key . "_false\"><br>";
                        echo "<script>
                        $(\"input[name='" . $key . "_true']\").click(function() {
                            if(this.checked) {
                                $(\"input[name='" . $key . "_false']\").prop('checked', false);
                            }
                
                        });
                        $(\"input[name='" . $key . "_false']\").click(function() {
                            if(this.checked) {
                                $(\"input[name='" . $key . "_true']\").prop('checked', false);
                            }
                
                        });
                    </script>";
                        break;
                    case "onechoice":
                        $i = 0;
                        foreach($value["answers"] as $answer=>$sol){
                            $i++;
                            echo $answer . "<input class=\"checkbox" . $key . "\" type=\"checkbox\" name=\"" . $key . "_" . $i . "\"><br>";
                            echo "<script>
                            $(\".checkbox$key\").click(function() {
                                if(this.checked) {
                                    $(\".checkbox$key\").prop('checked', false);
                                    $(this).prop('checked', true);
                                }
                    
                            });
                        </script>";
                        }
                        break;
                }
                echo "<input type=\"hidden\" name=\"" . $key . "_type\" value=\"" . $value["type"] . "\">";
                echo "</div>";
            }
            echo "<input type=\"submit\"></form>";
        } else {
            echo "<h3>Fehler: Quiz kann nicht gefunden werden</h3> Das Quiz, nach dem Du suchst, konnte leider nicht gefunden werden. Du kannst versuchen einen 
            <a href=\"code.php\">Code einzugeben</a>, ein <a href=\"search.php\">Quiz zu suchen</a> oder in einer <a href=\"category.php\">Kategorie zu suchen</a>.";
        }
        
    } else {
        echo "<h3>Fehler: Kein Quiz angegeben</h3> Das Quiz, nach dem Du suchst, konnte leider nicht gefunden werden. Du kannst versuchen einen 
        <a href=\"code.php\">Code einzugeben</a>, ein <a href=\"search.php\">Quiz zu suchen</a> oder in einer <a href=\"category.php\">Kategorie zu suchen</a>.";
    }
?>
<h2>Kommentare:</h2>

<?php //Kommentare anzeigen
    include("showcomments.php");
?>

<?php
    include("footer.php");
?>

