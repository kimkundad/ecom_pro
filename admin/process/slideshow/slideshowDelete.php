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
$id=base64_decode($_REQUEST['id']);
include("../../../process/connect.php");
//ลบภาพในโฟลเดอร์
$sql="SELECT * FROM slideshow WHERE id=$id";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
unlink("../../../slideshow/".$row['image']);
//ลบในฐานข้อมูล
$sql="DELETE FROM slideshow WHERE id=$id";
mysql_query($sql)or die(mysql_error());
echo"<script>window.location='../../slideshow.php';</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>