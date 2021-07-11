<?php
    $site_name = "Logout";
    include("header.php");
    session_destroy();
?><br>
Logout erfolgreich! Du wirst weitergeleitet!

<?php
    header("Location: index.php");
    include("footer.php");
?>