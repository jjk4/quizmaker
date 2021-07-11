<?php
    $site_name = "Login";
    include("header.php");
    echo "<br><h1>Anmelden</h1>";
    if(isset($_GET['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['userid'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                die("Login erfolgreich! Du wirst weitergeleitet!");
            } else {
                $errorMessage = "Passwort falsch!<br>";
            }
        } else {
            $errorMessage = "Benutzername ungültig<br>";
        }
    }
?>

<?php 
if(isset($errorMessage)) {
    echo "<span style=\"color: #db4035;\">$errorMessage</span>";
}
?>
 
<form action="?login=1" method="post">
    Benutzername:<br>
    <input type="text" size="40" maxlength="250" name="username"><br><br>
    
    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="password"><br>
    
    <input type="submit" value="Abschicken">
</form> 
<a href="register.php">Noch kein Konto? Jetzt registrieren!</a><br>
<a href="forgotpassword.php">Passwort vergessen?</a>

<?php
    include("footer.php");
?>