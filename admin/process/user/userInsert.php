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
if($_REQUEST['username']==''||$_REQUEST['password']==''||$_REQUEST['confirm']==''){
  echo"<script> alert('ยังกรอกข้อมูลไม่ครบ');history.back();</script>";exit(); 
}
//รับค่า
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$confirm=$_REQUEST['confirm'];
//เชื่อมต่อฐานข้อมูล 
include('../../../process/connect.php');
//เช็คชื่อผู้ใช้
$sql="SELECT * FROM user WHERE username='$username'";
$result=mysql_query($sql)or die(mysql_error());
$num=mysql_num_rows($result);
if($num!=0){echo"<script>alert('ชื่อผู้ใช้ซ้ำ');history.back();</script>";exit();}
//เช็ครหัสผ่าน
if($password!=$confirm){echo"<script>alert('ยืนยันรหัสผ่านไม่ตรงกัน');history.back();</script>";exit();}
//เพิ่มข้อมูล	  
$sql="INSERT INTO user(username, password, insert_date, last_update) VALUES('$username', '$password', now(), now())";
mysql_query($sql)or die(mysql_error());	
echo"<script>document.location=document.referrer;</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>