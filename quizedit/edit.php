<?php
    $site_name = "Quiz bearbeiten";
    include("header.php");
    echo "<br><h1>Quiz bearbeiten</h1>";
    if(isset($_SESSION['userid'])){ // Zuerst prüfen, ob Nutzer überhaupt angemeldet ist
        $quizid = $_GET["q"];
        $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM quizzes WHERE `id` = '" . $quizid . "'"));
        $authorofquiz = $data["author"];
        $questions = json_decode($data["questions"], true);
        $categories = json_decode($data["categories"], true);
        if($authorofquiz == $_SESSION["username"]){ // Wenn das Quiz einem auch gehört
            ?>
            <form action="submitquiz.php" method="post" autocomplete="off">
                <input name="quizid" type="hidden" value="<?php echo $quizid;?>">
                <?php $i = 0; foreach($questions as $key=>$value) {$i++;}?>
                <input name="numberofquestions" type="hidden" value="<?php echo $i;?>">
                Name des Quiz: <input name="quizname" type="text" style="width: 40%;" value="<?php echo $data["quizname"];?>"><br>
                Aussehen: <select id="styleselector" name="style">
                            <?php 
                                foreach($config["styles"] as $key=>$value){
                                    echo "<option value=\"" . $key . "\"";
                                    if($key ==$data["style"]){
                                        echo "selected";
                                    }
                                    echo ">" . $value . "</option>";
                                }
                            ?>
                        </select>    
                
                <br>
                Autor: <?php echo $_SESSION["username"];?><br>
                Kategorien:<br>
                <?php
                    foreach($config["categories"] as $name => $content) {
                        echo "<input type=\"checkbox\" name=\"category_" . $name . "\"";
                        if(in_array($name, $categories)){
                            echo " checked";
                        }
                        echo "><i class=\"" . $content["icon"] . "\"></i> " . $content["name"] . "<br>";
                    }
                    foreach($questions as $key=>$value) {
                        echo "<div class=\"question\">";
                        echo "Frage: <input name=\"" . $key . "_question\" type=\"text\" style=\"width: 40%;\" value=\"" . $value["name"] . "\"><br><br>";
                        switch($value["type"]){
                            case "multiplechoice":
                                echo "<input type=\"hidden\" name=\"" . $key . "_type\" value=\"multiplechoice\">";
                                $i = 0;
                                foreach($value["answers"] as $answer=>$sol){
                                    $i++;
                                    echo "Antwort: <input name=\"" . $key . "_" . $i . "\" type=\"text\" value=\"" . $answer . "\">";
                                    echo "Richtig? <input type=\"checkbox\" name=\"" . $key . "_" . $i . "_correct\"";
                                    if($sol == "on"){
                                        echo "checked";
                                    }
                                    echo "><br>";
                                }
                                break;
                            case "truefalse":
                                echo "<input type=\"hidden\" name=\"" . $key . "_type\" value=\"truefalse\">";
                                echo "Wahr <input type=\"checkbox\" name=\"" . $key . "_true\"";
                                if($value["answers"]["true"] == "on"){
                                    echo "checked";
                                }
                                echo "><br>";
                                echo "Falsch <input type=\"checkbox\" name=\"" . $key . "_false\"";
                                if($value["answers"]["false"] == "on"){
                                    echo "checked";
                                }
                                echo "><br>";
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
                                echo "<input type=\"hidden\" name=\"" . $key . "_type\" value=\"onechoice\">";
                                $i = 0;
                                foreach($value["answers"] as $answer=>$sol){
                                    $i++;
                                    echo "Antwort: <input name=\"" . $key . "_" . $i . "\" type=\"text\" value=\"" . $answer . "\">";
                                    echo "Richtig? <input type=\"checkbox\" name=\"" . $key . "_" . $i . "_correct\"";
                                    if($sol == "on"){
                                        echo "checked";
                                    }
                                    echo "><br>";
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
                ?>
                <input type="submit">
            </form>
            <?php
        } else {
            echo "Fehler: Dieses Quiz gehört dir nicht, du kannst es nicht bearbeiten!";
        }
    } else {
        echo "Fehler: Du musst dich anmelden, um ein Quiz zu bearbeiten";
    }
    
?><br>

<script>
    let sel_selector = document.getElementById('styleselector');
    sel_selector.addEventListener ('change', function () {
        document.getElementById("quizsheet").setAttribute("href", "../styles/" + this.value + ".css");
    });
</script>
<?php
    include("footer.php");
?>