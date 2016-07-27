<?php
/**
 * Connect to the mysql database.
 */
$conn = mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db('dargamin_dareborn', $conn) or die(mysql_error());
GLOBAL $conn;
?>
