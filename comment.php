<?php
    include("header.php");
    $quizid = $_GET["q"];
    $action = $_GET["a"];
    $commentid = $_GET["c"];
    echo $action . $quizid . $commentid;
    if(isset($_SESSION["username"])){
        switch ($action) {
            case "like":
                $sql = "SELECT * FROM comments WHERE `id` = '" . $commentid . "'";
                $result = mysqli_query($connection, $sql);
                $likes = mysqli_fetch_assoc($result)["likes"];
                $new = json_decode($likes, true);
                if(in_array($_SESSION["username"], $new)){ // Wenn das Quiz schon geliket wurde, like entfernen
                    $key = array_search($_SESSION["username"], $new);
                    unset($new[$key]);
                } else {
                    $new[] = $_SESSION["username"]; // Wenn das Quiz noch nicht geliket wurde, like hinzufügen
                }
                var_dump($new);
                $sql = "UPDATE `comments` SET `likes` = '" . json_encode($new) . "' WHERE `comments`.`id` = " . $commentid;
                mysqli_query($connection, $sql);
                break;
            case "dislike":
                $sql = "SELECT * FROM comments WHERE `id` = '" . $commentid . "'";
                $result = mysqli_query($connection, $sql);
                $dislikes = mysqli_fetch_assoc($result)["dislikes"];
                $new = json_decode($dislikes, true);
                if(in_array($_SESSION["username"], $new)){ // Wenn das Quiz schon geliket wurde, like entfernen
                    $key = array_search($_SESSION["username"], $new);
                    unset($new[$key]);
                } else {
                    $new[] = $_SESSION["username"]; // Wenn das Quiz noch nicht geliket wurde, like hinzufügen
                }
                var_dump($new);
                $sql = "UPDATE `comments` SET `dislikes` = '" . json_encode($new) . "' WHERE `comments`.`id` = " . $commentid;
                mysqli_query($connection, $sql);
                break;
            case "report":
                $sql = "INSERT INTO `notifications` (`type`, `content`, `receiver`) VALUES ('reportcomment', '" . $commentid . "', 'group_admin')";
                mysqli_query($connection, $sql);
                break;
            case "delete":
                //Zuerst prüfen, ob man Besitzer des Kommentars ist
                $sql = "SELECT * FROM comments WHERE `id` = '" . $commentid . "'";
                $author = mysqli_fetch_assoc(mysqli_query($connection, $sql))["author"];
                if($author == $_SESSION["username"]){
                    mysqli_query($connection, "DELETE FROM `comments` WHERE `id` = '" . $commentid . "'");
                } else {
                    // Prüfen, ob man Admin oder Mod ist
                    if($rank == "admin" or $rank == "mod"){
                        mysqli_query($connection, "DELETE FROM `comments` WHERE `id` = '" . $commentid . "'");
                    }
                }
                break;
            case "edit":
                //Zuerst prüfen, ob man Besitzer des Kommentars ist
                $sql = "SELECT * FROM comments WHERE `id` = '" . $commentid . "'";
                $author = mysqli_fetch_assoc(mysqli_query($connection, $sql))["author"];
                if($author == $_SESSION["username"]){
                    if(isset($_POST["comment"])){
                        mysqli_query($connection, "UPDATE `comments` SET `content` = '" . $_POST["comment"] . "' WHERE `comments`.`id` = " . $commentid . "");
                    }
                } else {
                    // Prüfen, ob man Admin oder Mod ist
                    if($rank == "admin" or $rank == "mod"){
                        if(isset($_POST["comment"])){
                            mysqli_query($connection, "UPDATE `comments` SET `content` = '" . $_POST["comment"] . "' WHERE `comments`.`id` = " . $commentid . "");
                        }
                    }
                }
                break;
        }
    }
    header("Location: play.php?q=" . $quizid);
?>