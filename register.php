<?php
    $site_name = "Registrieren";
    include("header.php");
    echo "<br><h1>Registrieren</h1>";
    $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
    
    if(isset($_GET['register'])) {
        $error = false;
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
            $error = true;
        }     
        if(strlen($password) == 0) {
            echo 'Bitte ein Passwort angeben<br>';
            $error = true;
        }
        if($password != $password2) {
            echo 'Die Passwörter müssen übereinstimmen<br>';
            $error = true;
        }
        
        //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
        if(!$error) { 
            $sql = "SELECT * FROM users WHERE email = '" . $email . "'";
            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) != 0) {
                echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
                $error = true;
            }
        }
        //Überprüfe, dass der Benutzername noch nicht registriert wurde
        if(!$error) { 
            $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) != 0) {
                echo 'Diesee Benutzername ist bereits vergeben<br>';
                $error = true;
            }
        }
        
        //Keine Fehler, wir können den Nutzer registrieren
        if(!$error) {    
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`email`, `username`, `password`) VALUES ('" . $email ."', '" . $username . "', '" . $password_hash . "')";
            if (mysqli_query($connection, $sql)) {
                echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
                $showFormular = false;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
        } 
    }
    
    if($showFormular) {
?>
 
<form action="?register=1" method="post">
    Benutzername:<br>
    <input type="text" size="40" maxlength="250" name="username"><br><br>

    Email (Zur Passwortwiederherstellung):<br>
    <input type="email" size="40" maxlength="250" name="email"><br><br>

    Dein Passwort:<br>
    <input type="password" size="40"  maxlength="250" name="password"><br>

    Passwort wiederholen:<br>
    <input type="password" size="40" maxlength="250" name="password2"><br><br>

<input type="submit" value="Abschicken">
</form>
<a href="login.php">Du hast schon ein Konto? Zum Einloggen!</a>

<?php
} //Ende von if($showFormular)
?>

<?php
    include("footer.php");
?>