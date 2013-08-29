<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_datacar = "localhost";
$database_datacar = "Car";
$username_datacar = "root";
$password_datacar = "";
$datacar = mysql_pconnect($hostname_datacar, $username_datacar, $password_datacar) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_query("SET NAMES utf8");
?>