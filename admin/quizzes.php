<?php
    $site_name = "Quizze - Adminpanel";
    include("header.php");
    if(isset($_SESSION["username"])){
        if($rank == "admin"){
?><br>
<div class="accountmanagement">
    <table class="accountbox">
        <tr>
            <?php include("menu.php") ?>
            <td valign="top" class="accountcontent">
                <h1 style="text-align: center;">Alle Quizze</h1>
                <table id="myquizzes">
                    <?php
                        $sql = "SELECT * FROM quizzes";
                        $result = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                    <tr>
                                        <td>" . $row["quizname"] . "</td>
                                        <td>" . $row["author"] . "</td>
                                        <td><a href=\"../play.php?q=" . $row["id"] . "\"><i class=\"fas fa-eye\"></i></a></td>
                                        <td><a href=\"../quizedit/edit.php?q=" . $row["id"] . "\"><i class=\"fas fa-pencil-alt\"></i></a></td>
                                        <td><a href=\"../quizedit/delete.php?q=" . $row["id"] . "\"><i class=\"fas fa-trash-alt\"></i></a></td>
                                    </tr>
                                ";
                            }
                        } else {
                            echo "Es gibt noch keine Quizze!";
                        }
                    ?>
                </table>
                
</td>
        </tr>
</table>
</div>
<script>
    $('.quizzes').attr('id', 'selected');
</script>
<?php
        } else {
            echo "<br>Du hast keinen Zugriff auf diese Seite!";
        }
    } else {
        echo "<br>Du hast keinen Zugriff auf diese Seite!";
    }
    include("footer.php");
?>