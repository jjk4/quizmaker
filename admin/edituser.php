<?php
    $site_name = "Useredit - Adminpanel";
    include("header.php");
    if(isset($_SESSION["username"])){
        if($rank == "admin"){
            if (isset($_POST["action"])){ // Wenn ein Formular abgeschickt wurde
                switch($_POST["action"]){
                    case "email":
                        mysqli_query($connection, "UPDATE `users` SET `email` = '" . $_POST["email"] . "' WHERE `users`.`id` = " . $_POST["id"]);
                        header("Location: accounts.php");
                        break;
                    case "password":
                        $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                        mysqli_query($connection, "UPDATE `users` SET `password` = '" . $hashed_password . "' WHERE `users`.`id` = " . $_POST["id"]);
                        header("Location: accounts.php");
                        break;
                }
            } else {
                if(isset($_GET["a"])){
                    $sql = "SELECT * FROM users WHERE `id` = '" . $_GET["id"] . "'";
                    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
                    switch($_GET["a"]){
                        case "email":
                            $email = $result["email"];
                            ?>
                            <br><form method="POST">
                                <input type="hidden" name="action" value="email">
                                <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
                                Neue Email: <input name="email" type="email" value="<?php echo $email;?>">
                                <input type="submit">
                            </form>
                            <?php
                            break;
                        case "password":
                            ?>
                            <br><form method="POST">
                                <input type="hidden" name="action" value="password">
                                <input type="hidden" name="id" value="<?php echo $_GET["id"];?>">
                                Neues Passwort: <input name="password" type="password"><br><br>
                                <input type="submit">
                            </form>
                            <?php
                            break;
                    }
                }
            }
