<?php
    $site_name = "Meine Quizze";
    include("header.php");
?><br>
<div class="accountmanagement">
    <table class="accountbox">
        <tr>
            <?php include("menu.php") ?>
            <td valign="top" class="accountcontent">
                <h1 style="text-align: center;">Meine Quizze</h1>
                <table id="myquizzes">
                    <?php
                        $sql = "SELECT * FROM quizzes WHERE `author` = '" . $_SESSION["username"] . "'";
                        $result = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                    <tr>
                                        <td>" . $row["quizname"] . "</td>
                                        <td><a href=\"../play.php?q=" . $row["id"] . "\"><i class=\"fas fa-eye\"></i></a></td>
                                        <td><a href=\"../quizedit/edit.php?q=" . $row["id"] . "\"><i class=\"fas fa-pencil-alt\"></i></a></td>
                                        <td><a href=\"../quizedit/delete.php?q=" . $row["id"] . "\"><i class=\"fas fa-trash-alt\"></i></a></td>
                                    </tr>
                                ";
                            }
                        }
                    ?>
                </table>
                
</td>
        </tr>
</table>
</div>
<script>
    $('.myquizzes').attr('id', 'selected');
</script>
<?php
    include("footer.php");
?>