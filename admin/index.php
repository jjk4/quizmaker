<?php
    $site_name = "Übersicht - Adminpanel";
    include("header.php");
    if(isset($_SESSION["username"])){
        if($rank == "admin"){


?><br>
<div class="accountmanagement">
    <table class="accountbox">
        <tr>
            <?php include("menu.php") ?>
            <td valign="top" class="accountcontent">
                <h1 style="text-align: center;">Übersicht - Adminpanel</h1>
                
</td>
        </tr>
</table>
</div>
<script>
    $('.index').attr('id', 'selected');
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