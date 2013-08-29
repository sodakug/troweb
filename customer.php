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

mysql_select_db($database_customer, $customer);
$query_customer = "SELECT * FROM customer";
$customer = mysql_query($query_customer, $customer) or die(mysql_error());
$row_customer = mysql_fetch_assoc($customer);
$totalRows_customer = mysql_num_rows($customer);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลลูกค้า</title>
</head>

<body>
<h1 align="center">ตารางข้อมูลลูกค้า</h1>
<table border="1" width="80%" align="center">
  <tr align="center">
    <td width="105">รหัสลูกค้า</td>
    <td width="110">ชื่อ</td>
    <td width="109">นามสกุล</td>
    <td width="126">เลขที่บัตร</td>
    <td width="88">เบอร์โทรศัพท์</td>
    <td width="105">e-mail</td>
    <td width="97">ที่อยู่</td>
    <td width="68">การจัดการ</td>
  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_customer['idcus']; ?></td>
      <td><?php echo $row_customer['fname']; ?></td>
      <td><?php echo $row_customer['lname']; ?></td>
      <td><?php echo $row_customer['numcard']; ?></td>
      <td><?php echo $row_customer['tel']; ?></td>
      <td><?php echo $row_customer['email']; ?></td>
      <td><?php echo $row_customer['add']; ?></td>
      <td><a href="incus.php">เพิ่ม</a> <a href="editcus.php?idcus=<?php echo $row_customer['idcus']; ?>">แก้ไข</a> <a href="delcus.php?idcus=<?php echo $row_customer['idcus']; ?>">ลบ</a></td>
    </tr>
    <?php } while ($row_customer = mysql_fetch_assoc($customer)); ?>
</table><br /><br />

<tr>
  <td align="right" width="20%"><a href="index.html">กลับไปหน้าหลัก</a></td></tr>

</body>
</html>
<?php
mysql_free_result($customer);
?>
