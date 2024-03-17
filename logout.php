<!-- Group members:
Aswin Kizhuppully Santhosh     :041098900
SAVIO GOPURAN BABU             :041098027
session                        :320
Lab: Assignment 2 -->
<?php
session_start();
session_unset();
session_destroy();

header("Location: login.html");
exit();
?>
