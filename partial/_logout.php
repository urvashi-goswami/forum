<?php

session_start();

session_destroy();
header("location: /Project/Forum/index.php");
?>