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
if($_FILES['favicon']['name']==""){echo"<script>alert('ยังไม่เลือกรูปภาพ');history.back();</script>";exit;}
//รับค่า
$favicon=time().'-'.$_FILES['favicon']['name'];
//เชื่อต่อฐานข้อมูล
include("../../../process/connect.php");
//ลบภาพในโฟลเดอร์
$sqlDelete="SELECT * FROM decoration";
$resultDelete=mysql_query($sqlDelete)or die(mysql_error());
$rowDelete=mysql_fetch_array($resultDelete);
unlink("../../../image/".$rowDelete['favicon']);
//อัพเดทข้อมูล
$sqlUpdate="UPDATE decoration SET favicon='$favicon'";
mysql_query($sqlUpdate) or die(mysql_error());
//อัพโหลดภาพ
if(move_uploaded_file($_FILES['favicon']['tmp_name'],"../../../image/".$favicon)){
  $error="";
}
//ถ้าอัพโหลดไม่ได้
  else{
  $error="alert('เกิดการผิดพลาดในการอัพโหลดไฟล์ภาพ กรุณาทำการอัพโหลดใหม่');";
  }
echo"<script>$error;document.location=document.referrer;</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>