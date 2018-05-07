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
$id=base64_decode($_REQUEST['id']);
$title=$_REQUEST['title'];
$link=$_REQUEST['link'];
//เชื่อมต่อฐานข้อมูล
include('../../../process/connect.php');
//ถ้าไม่แก้ไขรูปภาพ
if($_FILES['slideshow']['name']==""){
  //อัพเดทข้อมูล
  $sql="UPDATE slideshow SET title='$title', link='$link', last_update=now() WHERE id=$id";
  mysql_query($sql)or die(mysql_error());    
  echo"<script>window.location='../../slideshowEdit.php?id=$_REQUEST[id]';</script>";
  exit;
}
//ถ้าแก้ไขรูปภาพ
if($_FILES['slideshow']['name']!=""){
  //ลบภาพเก่า
  $sqlDelete="SELECT * FROM slideshow WHERE id=$id";
  $resultDelete=mysql_query($sqlDelete)or die(mysql_error());
  $rowDelete=mysql_fetch_array($resultDelete);
  unlink("../../../slideshow/".$rowDelete['image']);
  //เปลี่ยนชื่อภาพ
  $slideshow=time().'-'.$_FILES['slideshow']['name'];
  //อัพโหลดรูปภาพ
  if(move_uploaded_file($_FILES['slideshow']['tmp_name'],"../../../slideshow/".$slideshow)){
    $error="";
  }
  //ถ้าอัพโหลดไม่ได้
  else{
  $error="alert('เกิดการผิดพลาดในการอัพโหลดไฟล์ภาพ กรุณาทำการอัพโหลดใหม่');";
  }
  //อัพเดทข้อมูล
  $sqlUpdate="UPDATE slideshow SET title='$title', link='$link', image='$slideshow', last_update=now() WHERE id=$id";
  mysql_query($sqlUpdate)or die(mysql_error()); 
}
echo"<script>window.location='../../slideshowEdit.php?id=$_REQUEST[id]';</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>