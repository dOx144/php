<?php
session_start();
session_destroy();
header("Location: evolve.php"); 
exit();
?>
