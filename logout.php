<?php

session_start();

session_unset();
session_destroy();

$projectPath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
header('Location: ' . ($projectPath ?: '') . '/index.php');

exit();

?>
