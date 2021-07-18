<?php
    $site_name = "Accountdaten";
    include("header.php");
    $accountdata = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM users WHERE `username` = '" . $_SESSION["username"] . "'"));
    if(isset($_SESSION["username"])){
?><br>
<div class="accountmanagement">
    <table class="accountbox">
        <tr>
            <?php include("menu.php") ?>
            <td valign="top" class="accountcontent">
            <h1 style="text-align: center;">Accountdaten</h1>
            <?php
                if(isset($_GET["a"])){
                    switch($_GET["a"]){
                        case "changepassword":
                            $user = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM users WHERE `username` = '" . $_SESSION["username"] . "'"));
                            if (password_verify($_POST["oldpassword"], $user['password'])) {
                                if($_POST["newpassword1"] == $_POST["newpassword2"]){
                                    $password_hash = password_hash($_POST["newpassword1"], PASSWORD_DEFAULT);
                                    $sql = "UPDATE `users` SET `password` = '" . $password_hash . "' WHERE `users`.`username` = '" . $_SESSION["username"] . "'";
                                    mysqli_query($connection, $sql);
                                    echo "Das Passwort wurde geändert!";
                                } else {
                                    echo "Die Passwörter müssen identisch sein!";
                                }
                            } else {
                                echo "Falsches Passwort!";
                            }
                            break;
                    }
                } else {
            ?>
                <h3>Email</h3>
                Deine Emailadresse: <?php echo $accountdata["email"];?><br>
                <h3>Passwort</h3>
                Passwort ändern:<br>
                <form action="?a=changepassword" method="POST" autocomplete="off">
                    Altes Passwort:<input type="password" name="oldpassword"><br>
                    Neues Passwort:<input type="password" name="newpassword1"><br>
                    Neues Passwort:<input type="password" name="newpassword2"><br>
                    <input type="submit">
                </form>

            <?php
                }
            ?>
            </td>
        </tr>
</table>
</div>
<script>
    $('.accountdata').attr('id', 'selected');
</script>
<?php
    } else {
        echo "Du hast keinen Zugriff auf diese Seite";
    }
    include("footer.php");
?>