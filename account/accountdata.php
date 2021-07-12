<?php
    $site_name = "Meine Quizze";
    include("header.php");
?><br>
<div class="accountmanagement">
    <table class="accountbox">
        <tr>
            <?php include("menu.php") ?>
            <td valign="top" class="accountcontent">
                <h1 style="text-align: center;">Accountdaten</h1>
                
</td>
        </tr>
</table>
</div>
<script>
    $('.accountdata').attr('id', 'selected');
</script>
<?php
    include("footer.php");
?>