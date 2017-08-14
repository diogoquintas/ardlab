<?php

session_start();

session_destroy();

echo "<script>window.open('/arduinoLAB/index.php','_self')</script>";

?>