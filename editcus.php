<?php require_once('Connections/customer.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE customer SET fname=%s, lname=%s, numcard=%s, tel=%s, email=%s, `add`=%s WHERE idcus=%s",
                       GetSQLValueString($_POST['fname'], "text"),
                       GetSQLValueString($_POST['lname'], "text"),
                       GetSQLValueString($_POST['numcard'], "int"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['add'], "text"),
                       GetSQLValueString($_POST['idcus'], "int"));

  mysql_select_db($database_customer, $customer);
  $Result1 = mysql_query($updateSQL, $customer) or die(mysql_error());

  $updateGoTo = "customer.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_customer, $customer);
$idcus=$_GET['idcus'];
$query_customer = "SELECT * FROM customer WHERE idcus=".$idcus;
$customer = mysql_query($query_customer, $customer) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แก้ไขข้อมูลลูกค้า</title>
</head>

<body>
<h1 align="center">แก้ไขข้อมูลลูกค้า</h1>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">รหัสลูกค้า:</td>
      <td><?php echo $row_customer['idcus']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ชื่อ:</td>
      <td><input type="text" name="fname" value="<?php echo htmlentities($row_customer['fname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">นามสกุล:</td>
      <td><input type="text" name="lname" value="<?php echo htmlentities($row_customer['lname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">เลขที่บัตร:</td>
      <td><input type="text" name="numcard" value="<?php echo htmlentities($row_customer['numcard'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">เบอร์โทรศัพท์:</td>
      <td><input type="text" name="tel" value="<?php echo htmlentities($row_customer['tel'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">E-mail:</td>
      <td><input type="text" name="email" value="<?php echo htmlentities($row_customer['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ที่อยู่:</td>
      <td><input type="text" name="add" value="<?php echo htmlentities($row_customer['add'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="แก้ไขข้อมูล" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idcus" value="<?php echo $row_customer['idcus']; ?>" />
</form>
<p>&nbsp;</p><br /><br />
<tr>
  <td align="right" width="20%"><a href="customer.php">กลับไปหน้า ข้อมูลลูกค้า</a></td></tr>
</body>
</html>
<?php
mysql_free_result($customer);
?>
