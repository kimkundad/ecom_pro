<? 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
//เช็คค่า
if($_REQUEST['username']==""||$_REQUEST['password']==""){echo"<script>alert('ยังไม่กรอกชื่อผู้ใช้หรือรหัสผ่าน');history.back();</script>";exit();}
//รับค่า
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
include('../../process/connect.php');
//ตรวจสอบชื่อผู้ใช้และรหัสผ่าน
$sqlLogin="SELECT * FROM user WHERE username='$username'";
$resultLogin=mysql_query($sqlLogin)or die(mysql_error());
$rowLogin=mysql_fetch_array($resultLogin);
$username_id=$rowLogin['id'];
if(!$rowLogin){
  echo"<script>alert('ไม่พบชื่อผู้ใช้');history.back();</script>";exit();
}
else if($rowLogin['password']!= $password){
  echo"<script>alert('รหัสผ่านไม่ถูกต้อง');history.back();</script>";exit();
}
//เซสชัน
$_SESSION['username']=$username;	
echo"<script>window.location='../user.php';</script>";
?>
</body>
</html>