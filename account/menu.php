<td valign="top" class="accountmenu">
    <div class="accountmenuitem index">
        <a href="index.php">Übersicht</a>
    </div>
    <div class="accountmenuitem myquizzes">
        <a href="quizzes.php">Meine Quizze</a>
    </div>
    <div class="accountmenuitem notifications">
        <a href="notifications.php">Benachrichtigungen</a>
    </div>
    <div class="accountmenuitem accountdata">
        <a href="accountdata.php">Accountdaten</a>
    </div>
    <?php
        $sql = "SELECT rank FROM users WHERE `username` = '" . $_SESSION["username"] . "'";
        $result = mysqli_query($connection, $sql);
        $rank = mysqli_fetch_assoc($result)["rank"];
        if($rank == "admin"){
            ?>
                <div class="accountmenuitem admin">
                    <a href="../admin">Adminbereich</a>
                </div>
            <?php
        }
    ?>
</td>