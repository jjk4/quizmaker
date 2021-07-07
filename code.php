<?php
    $site_name = "Code eingeben";
    include("header.php");
?><br>
<input type="text" placeholder="Code eingeben" id="code_input"><br>
<button type="button" id="code_button" onclick="openquiz()">Zum Quiz</button>
<script>
    function openquiz(){
        quizid = document.getElementById('code_input').value
        window.location.replace("play.php?q=" + quizid);
    }
</script>
<?php
    include("footer.php");
?>