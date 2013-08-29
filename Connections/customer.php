<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_customer = "localhost";
$database_customer = "car";
$username_customer = "root";
$password_customer = "";
$customer = mysql_pconnect($hostname_customer, $username_customer, $password_customer) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES utf8");
?>