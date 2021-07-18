<?php
    include("header.php");
    $quizid = $_GET["q"];
    $action = $_GET["a"];
    if(isset($_SESSION["username"])){
        switch ($action) {
            case "like":
                echo "like";
                $sql = "SELECT * FROM quizzes WHERE `id` = '" . $quizid . "'";
                $result = mysqli_query($connection, $sql);
                $likes = mysqli_fetch_assoc($result)["likes"];
                $new = json_decode($likes, true);
                if(in_array($_SESSION["username"], $new)){ // Wenn das Quiz schon geliket wurde, like entfernen
                    $key = array_search($_SESSION["username"], $new);
                    unset($new[$key]);
                } else {
                    $new[] = $_SESSION["username"]; // Wenn das Quiz noch nicht geliket wurde, like hinzufügen
                }
                $sql = "UPDATE `quizzes` SET `likes` = '" . json_encode($new) . "' WHERE `quizzes`.`id` = '" . $quizid . "'";
                mysqli_query($connection, $sql);
                break;
            case "dislike":
                $sql = "SELECT * FROM quizzes WHERE `id` = '" . $quizid . "'";
                $result = mysqli_query($connection, $sql);
                $dislikes = mysqli_fetch_assoc($result)["dislikes"];
                $new = json_decode($dislikes, true);
                if(in_array($_SESSION["username"], $new)){ // Wenn das Quiz schon geliket wurde, like entfernen
                    $key = array_search($_SESSION["username"], $new);
                    unset($new[$key]);
                } else {
                    $new[] = $_SESSION["username"]; // Wenn das Quiz noch nicht geliket wurde, like hinzufügen
                }
                $sql = "UPDATE `quizzes` SET `dislikes` = '" . json_encode($new) . "' WHERE `quizzes`.`id` = '" . $quizid . "'";
                mysqli_query($connection, $sql);
                break;
            case "report":
                $sql = "INSERT INTO `notifications` (`type`, `content`, `receiver`) VALUES ('reportquiz', '" . $quizid . "', 'group_admin')";
                mysqli_query($connection, $sql);
                break;
        }
        header("Location: play.php?q=" . $quizid);
    } else {
        echo "<br>Du musst dich anmelden, um ein Quiz zu liken/disliken/melden";
    }
    
?>