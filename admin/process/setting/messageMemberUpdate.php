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
$news_subject_member=$_REQUEST['news_subject_member'];
$news_detail_member=$_REQUEST['news_detail_member'];
//เชื่อต่อฐานข้อมูล
include('../../../process/connect.php');
//อัพเดทข้อมูล
$sql="UPDATE setting SET news_subject_member=\"$news_subject_member\", news_detail_member='$news_detail_member', last_update=now()";
mysql_query($sql)or die(mysql_error());
echo"<script>document.location=document.referrer;</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>