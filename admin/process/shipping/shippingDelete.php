<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
$id=base64_decode($_REQUEST['id']);
include("../../../process/connect.php");
//เช็คข้อมูล ต้องมีอย่างน้อย 1 เรคคอร์ด
$sql="SELECT * FROM shipping";
$result=mysql_query($sql)or die(mysql_error());
$num=mysql_num_rows($result);
if($num==1){echo"<script>alert('ไม่สามารถลบได้ ต้องมีอย่างน้อย 1 รายการ');history.back();</script>";exit;}
//ลบ
$sqlDelete="DELETE FROM shipping WHERE id=$id";
mysql_query($sqlDelete)or die(mysql_error());
echo"<script>document.location=document.referrer;</script>";
?>
</body>
</html>