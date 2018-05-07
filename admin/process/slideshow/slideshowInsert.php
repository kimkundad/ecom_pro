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
if($_FILES['slideshow']['name']==""){echo"<script>alert('ยังไม่เลือกรูปภาพ');history.back();</script>";exit;}
//รับค่า
$title=$_REQUEST['title'];
$slideshow=time().'-'.$_FILES['slideshow']['name'];
$link=$_REQUEST['link'];
//เชื่อมต่อฐานข้อมูล
include("../../../process/connect.php");
//เพิ่มข้อมูล
$sql="INSERT INTO slideshow(title, image, link, insert_date, last_update) VALUES('$title', '$slideshow', '$link', now(), now())";
mysql_query($sql)or die(mysql_error());
//อัพโหลดรูปภาพ
if(move_uploaded_file($_FILES['slideshow']['tmp_name'],"../../../slideshow/".$slideshow)){
  echo"<script>document.location=document.referrer;</script>";exit;
}
//ถ้าอัพโหลดไม่ได้
else{
  echo "<script>alert('เกิดการผิดพลาดในการอัพโหลดไฟล์ภาพ กรุณาทำการอัพโหลดใหม่');document.location=document.referrer;</script>";exit;}
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>