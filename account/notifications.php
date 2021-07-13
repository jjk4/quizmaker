<?php
    $site_name = "Benachrichtigungen";
    include("header.php");
    if(isset($_GET["del"])){
        $receiver = mysqli_fetch_assoc(mysqli_query($connection, "SELECT `receiver` FROM notifications WHERE `id` = '" . $_GET["del"] . "'"))["receiver"];// Empfänger der Nachricht abfragen
        if($receiver == $_SESSION["username"] or $receiver == "group_" . $rank){
            mysqli_query($connection, "DELETE FROM `notifications` WHERE `id` = '" . $_GET["del"] . "'");
        }
    }
?><br>
<div class="accountmanagement">
    <table class="accountbox">
        <tr>
            <?php include("menu.php") ?>
            <td valign="top" class="accountcontent">
                <h1 style="text-align: center;">Benachrichtigungen</h1>
                <table id="notifications">
                    <?php
                        $sql = "SELECT * FROM notifications WHERE `receiver` = '" . $_SESSION["username"] . "' OR `receiver` = 'group_" . $rank . "'";
                        $result = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                switch ($row["type"]){
                                    case "forgotpassword":
                                        $text = $row["content"] . " hätte gerne ein neues Passwort!";
                                        break;
                                }
                                echo "
                                    <tr>
                                        <td>$text</td>
                                        <td>" . $row["date"] . "</td>
                                        <td><a href=\"?del=" . $row["id"] . "\"><i class=\"fas fa-times-circle\"></i></a></td>
                                    </tr>
                                ";
                            } 
                        } else {
                            echo "Keine Benachrichtigungen!";
                        }
                    ?>
                </table>
                
</td>
        </tr>
</table>
</div>
<script>
    $('.notifications').attr('id', 'selected');
</script>
<?php
    include("footer.php");
?>