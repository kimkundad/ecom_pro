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
//รับค่า
$shop_name=$_REQUEST['shop_name'];
$website_name=$_REQUEST['website_name'];
$tel=$_REQUEST['tel'];
$email=$_REQUEST['email'];
$facebook_fanpage=$_REQUEST['facebook_fanpage'];
//เชื่อต่อฐานข้อมูล
include('../../../process/connect.php');
//อัพเดทข้อมูล
$sql="UPDATE setting SET shop_name='$shop_name', website_name='$website_name', tel='$tel', email='$email', facebook_fanpage='$facebook_fanpage', last_update=now()";
mysql_query($sql)or die(mysql_error());
echo"<script>document.location=document.referrer;</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>