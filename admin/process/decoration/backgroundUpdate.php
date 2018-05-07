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
$background_color=$_REQUEST['background_color'];
$repeat=$_REQUEST['repeat'];
$attachment=$_REQUEST['attachment'];
$horizontal_position=$_REQUEST['horizontal_position'];
$vertical_position=$_REQUEST['vertical_position'];
//เชื่อต่อฐานข้อมูล
include('../../../process/connect.php');
//ถ้าไม่แก้ไขภาพพื้นหลัง
if($_FILES['background']['name']==""){
  //อัพเดทข้อมูล
  $sqlUpdate="UPDATE decoration SET background_color='$background_color', `repeat`='$repeat', attachment='$attachment', horizontal_position='$horizontal_position',vertical_position='$vertical_position'";
  mysql_query($sqlUpdate)or die(mysql_error());
  echo"<script>document.location=document.referrer;</script>";
}
//ถ้าแก้ไขภาพพื้นหลัง
if($_FILES['background']['name']!=""){
  $background=time().'-'.$_FILES['background']['name'];
  //ลบภาพเก่า
  $sqlDelete="SELECT * FROM decoration";
  $resultDelete=mysql_query($sqlDelete)or die(mysql_error());
  $rowDelete=mysql_fetch_array($resultDelete);
  unlink("../../../image/".$rowDelete['background_image']);
  //อัพเดทภาพใหม่
  $sqlUpdate="UPDATE decoration SET background_image='$background', background_color='$background_color', `repeat`='$repeat', attachment='$attachment', horizontal_position='$horizontal_position',vertical_position='$vertical_position'";
  mysql_query($sqlUpdate)or die(mysql_error());
  //อัพโหลดภาพ
  if(move_uploaded_file($_FILES['background']['tmp_name'],"../../../image/".$background)){
    $error="";
  }
  //ถ้าอัพโหลดไม่ได้
  else{
  $error="alert('เกิดการผิดพลาดในการอัพโหลดไฟล์ภาพ กรุณาทำการอัพโหลดใหม่');";
  }
}
//ไม่ใช้ภาพพื้นหลัง
if($_REQUEST['del']=='yes'){
  $sqlDelete="SELECT * FROM decoration";
  $resultDelete=mysql_query($sqlDelete)or die(mysql_error());
  $rowDelete=mysql_fetch_array($resultDelete);
  unlink("../../../image/".$rowDelete['background_image']);
  $sqlUpdate="UPDATE decoration SET background_image=''";
  mysql_query($sqlUpdate)or die(mysql_error());
}
echo"<script>$error;document.location=document.referrer;</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>