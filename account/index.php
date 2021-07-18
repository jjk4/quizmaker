<?php
    $site_name = "Account";
    include("header.php");
    if(isset($_SESSION["username"])){
?><br>
<div class="accountmanagement">
    <table class="accountbox">
        <tr>
            <?php include("menu.php") ?>
            <td valign="top" class="accountcontent">
                <h1 style="text-align: center;">Übersicht - Mein Account</h1>
                Hallo, <?php echo $_SESSION['username'];?><br><br><br>
                <a href="../logout.php" class="button">Ausloggen</a>
</td>
        </tr>
</table>
</div>
<script>
    $('.index').attr('id', 'selected');
</script>
<?php
    } else {
        echo "Du hast keinen Zugriff auf diese Seite";
    }
    include("footer.php");
?>