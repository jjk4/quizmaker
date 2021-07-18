<?php
    $site_name = "Accounts - Adminpanel";
    include("header.php");
    if(isset($_SESSION["username"])){
        if($rank == "admin"){


?><br>
<div class="accountmanagement">
    <table class="accountbox">
        <tr>
            <?php include("menu.php") ?>
            <td valign="top" class="accountcontent">
                <h1 style="text-align: center;">Accounts - Adminpanel</h1>
                <table id="myquizzes">
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Name</b></td>
                        <td><b>Email</b></td>
                        <td><b>Passwort</b></td>
                        <td><b>Rang</b></td>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($connection, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                    <tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["username"] . "</td>
                                        <td>" . $row["email"] . "<a href=\"edituser.php?a=email&id=" . $row["id"] . "\"><i class=\"fas fa-pencil-alt\"></i></a></td>
                                        <td><a href=\"edituser.php?a=password&id=" . $row["id"] . "\"><i class=\"fas fa-pencil-alt\"></i></a></td>
                                        <td>" . $row["rank"] . "</td>
                                    </tr>
                                ";
                            }
                        } else {
                            echo "Fehler. Keine Nutzer gefunden";
                        }
                    ?>
                </table>
                
            </td>
        </tr>
</table>
</div>
<script>
    $('.accounts').attr('id', 'selected');
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