<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backProcess.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<?
//เช็คล็อกอิน
if(isset($_SESSION['username'])){$username=$_SESSION['username'];}
else if(!isset($_SESSION['username'])){echo"<script>alert('ยังไม่เข้าสู่ระบบ');window.location='../../../admin/index.php';</script>";exit;}
?>
<!-- InstanceBeginEditable name="EditRegion" -->
<? 
//เช็คค่า
if($_REQUEST['password']!=$_REQUEST['confirm']){echo"<script>alert('ยืนยันรหัสผ่านไม่ตรงกัน');history.back();</script>";exit();}
//รับค่า
$id=base64_decode($_REQUEST['id']);
$password=$_REQUEST['password'];
$confirm=$_REQUEST['confirm'];
//เชื่อต่อฐานข้อมูล
include('../../../process/connect.php');
//อัพเดท
$sql="UPDATE user SET password='$password', last_update=now() WHERE id=$id";
mysql_query($sql)or die(mysql_error());
echo"<script>window.location='../../userEdit.php?id=$_REQUEST[id]';</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>