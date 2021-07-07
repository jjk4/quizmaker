<?php
    $site_name = "Auswertung";
    include("header.php");
    $quizid = $_POST["quizid"];
    $result = mysqli_query($connection, "SELECT content FROM quizzes WHERE id='" . $quizid . "'");
    $content = json_decode(mysqli_fetch_assoc($result)["content"], true);
    echo "<h1>Quiz \"" . $content["quizname"] . "\" von \"" . $content["author"] . "\" - Auswertung</h1>";
    foreach($content["questions"] as $key=>$value) {
        echo "<h2>". $value["name"] . "</h2>";
        $i = 0;
        switch($_POST[$key . "_type"]) { //Prüfen, um welche Frage es sich handelt
            case "multiplechoice":
                foreach($value["answers"] as $answer=>$sol){
                    $i++;
                    echo $answer;
                    if($_POST[$key . "_" . $i] == "on"){
                        echo "<input type=\"checkbox\" onclick=\"return false;\" checked>";
                    } else {
                        echo "<input type=\"checkbox\" onclick=\"return false;\">";
                    }
                    if($sol == $_POST[$key . "_" . $i]){
                        echo "<i class=\"fas fa-check-circle\"></i><br>";
                    } else {
                        echo "<i class=\"fas fa-times-circle\"></i><br>";
                    }
                }
                break;
            case "truefalse":
                if($_POST[$key . "_true"] == "on"){
                    echo "Wahr <input type=\"checkbox\" onclick=\"return false;\" checked>";
                    if($_POST[$key . "_true"] == $value["answers"]["true"]){
                        echo "<i class=\"fas fa-check-circle\"></i><br>";
                    } else {
                        echo "<i class=\"fas fa-times-circle\"></i><br>";
                    }
                } else {
                    echo "Wahr <input type=\"checkbox\" onclick=\"return false;\">";
                    if("on" == $value["answers"]["true"]){
                        echo "<i class=\"fas fa-times-circle\"></i><br>";
                    } else {
                        echo "<br>";
                    }
                }
                if($_POST[$key . "_false"] == "on"){
                    echo "Falsch <input type=\"checkbox\" onclick=\"return false;\" checked>";
                    if("on" == $value["answers"]["true"]){
                        echo "<i class=\"fas fa-check-circle\"></i><br>";
                    } else {
                        echo "<i class=\"fas fa-times-circle\"></i><br>";
                    }
                } else {
                    echo "Falsch <input type=\"checkbox\" onclick=\"return false;\">";
                    if("on" == $value["answers"]["false"]){
                        echo "<i class=\"fas fa-times-circle\"></i><br>";
                    } else {
                        echo "<br>";
                    }
                }
                break;
            case "onechoice":
                foreach($value["answers"] as $answer=>$sol){
                    $i++;
                    echo $answer;
                    // var_dump($value["answers"]);
                    if($_POST[$key . "_" . $i] == "on"){
                        echo "<input type=\"checkbox\" onclick=\"return false;\" checked>";
                        if("on" == $sol){
                            echo "<i class=\"fas fa-check-circle\"></i><br>";
                        } else {
                            echo "<i class=\"fas fa-times-circle\"></i><br>";
                        }
                    } else {
                        echo "<input type=\"checkbox\" onclick=\"return false;\">";
                        if("on" == $sol){
                            echo "<i class=\"fas fa-times-circle\"></i><br>";
                        } else {
                            echo "<br>";
                        }
                    }
                }
                break;
        }
        
    }
?><br><br>
<a href="play.php?q=<?php echo $quizid; ?>" class="button">Nochmal Spielen</a>
<?php
    include("footer.php");
?>