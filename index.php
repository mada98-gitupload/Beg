<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<div id="MainFrame"></div>
<div id="Error"></div>
<script src="js/jquery.js"></script>
<script>
$( "#MainFrame" ).load( "Main/Core.php?Type=Module&Data=DataBase&Arguments=Login|test|test");
</script>