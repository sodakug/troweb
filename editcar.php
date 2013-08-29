<?php require_once('Connections/datacar.php'); ?>
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
  $updateSQL = sprintf("UPDATE datacar SET idcus=%s, numcar=%s, cag=%s, brand=%s, color=%s, nummec=%s, numgas=%s WHERE idcar=%s",
                       GetSQLValueString($_POST['idcus'], "int"),
                       GetSQLValueString($_POST['numcar'], "text"),
                       GetSQLValueString($_POST['cag'], "text"),
                       GetSQLValueString($_POST['brand'], "text"),
                       GetSQLValueString($_POST['color'], "text"),
                       GetSQLValueString($_POST['nummec'], "int"),
                       GetSQLValueString($_POST['numgas'], "int"),
                       GetSQLValueString($_POST['idcar'], "int"));

  mysql_select_db($database_datacar, $datacar);
  $Result1 = mysql_query($updateSQL, $datacar) or die(mysql_error());

  $updateGoTo = "datacar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_datacar, $datacar);
$idcar=$_GET['idcar'];

$query_datacar = "SELECT * FROM datacar WHERE idcar=".$idcar;
$datacar = mysql_query($query_datacar, $datacar) or die(mysql_error());
$row_datacar = mysql_fetch_assoc($datacar);
$totalRows_datacar = mysql_num_rows($datacar);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แก้ไขข้อมูลรถยนต์</title>
</head>

<body>
<h1 align="center">แก้ไขข้อมูลรถยนต์</h1>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">รหัสรถยนต์:</td>
      <td><?php echo $row_datacar['idcar']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">รหัสลูกค้า:</td>
      <td><input type="text" name="idcus" value="<?php echo htmlentities($row_datacar['idcus'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">เลขทะเบียนรถ:</td>
      <td><input type="text" name="numcar" value="<?php echo htmlentities($row_datacar['numcar'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ประเภทรถยนต์:</td>
      <td><input type="text" name="cag" value="<?php echo htmlentities($row_datacar['cag'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ยี่ห้อรถยนต์:</td>
      <td><input type="text" name="brand" value="<?php echo htmlentities($row_datacar['brand'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">สี:</td>
      <td><input type="text" name="color" value="<?php echo htmlentities($row_datacar['color'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">เลขเครื่องยนต์:</td>
      <td><input type="text" name="nummec" value="<?php echo htmlentities($row_datacar['nummec'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">เลขถังแก๊ส:</td>
      <td><input type="text" name="numgas" value="<?php echo htmlentities($row_datacar['numgas'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="แก้ไขข้อมูล" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="idcar" value="<?php echo $row_datacar['idcar']; ?>" />
</form>
<p>&nbsp;</p><br /><br /><tr>
  <td align="right" width="20%"><a href="datacar.php">กลับไปหน้า ข้อมูลรถยนต์</a></td></tr>
</body>
</html>
<?php
mysql_free_result($datacar);
?>
