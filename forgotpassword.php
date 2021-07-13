<?php
    $site_name = "Passwort vergessen";
    include("header.php");
    echo "<br><h1>Passwort vergessen?</h1>";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $sql = "SELECT * FROM users WHERE email = '" . $email . "'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) != 0) {
            $sql = "INSERT INTO `notifications` (`type`, `content`, `receiver`) VALUES ('forgotpassword', '" . $email . "', 'group_admin')";
            mysqli_query($connection, $sql);
        }
        echo "Wenn die Emailadresse schonmal registriert wurde, wurde jetzt der Admin benachrichtigt. Er wird sich um dein Problem kümmern. Dies kann mehrere Tage dauern.";
    } else {

?>
Gib hier deine Emailadresse ein, wenn du ein neues Passwort haben möchtest!
<form method="POST" action="forgotpassword.php">
    <label> Email Adresse: 
        <input type="email" name="email">
        <input type="submit">
    </label>
</form>
<?php
    } //Ende von else

    include("footer.php");
?>