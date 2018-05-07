<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<? 
//เช็คค่า
if($_REQUEST['option']==""||$_REQUEST['price']<0||$_REQUEST['price']==""||!is_numeric($_REQUEST['price'])){
  echo"<script>alert('ข้อมูลไม่ถูกต้อง');history.back();</script>";exit;
}
//รับค่า
$id=base64_decode($_REQUEST['id']);
$option=$_REQUEST['option'];
$price=$_REQUEST['price'];
include('../../../process/connect.php');
//อัพเดท
$sql="UPDATE shipping SET `option`=\"$option\", price=$price, last_update=now() WHERE id=$id";
mysql_query($sql)or die(mysql_error());
echo"<script>document.location=document.referrer;</script>";
?>
</body>
</html>