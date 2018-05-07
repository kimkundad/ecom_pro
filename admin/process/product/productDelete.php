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
//เชื่อมต่อฐานข้อมูล
include('../../../process/connect.php');
//หาภาพหลัก
$sql="SELECT * FROM product WHERE id=$id";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
//ลบภาพสินค้าในโฟลเดอร์
unlink("../../../product/".$row['image']);
//ลบข้อมูลสินค้า
$sql="DELETE FROM product WHERE id=$id";
mysql_query($sql)or die(mysql_error());
//หาภาพประกอบ
$sql="SELECT * FROM product_image WHERE product_id=$id";
$result=mysql_query($sql)or die(mysql_error());
$num=mysql_num_rows($result);
for($i=1;$i<=$num;$i++){
  $row=mysql_fetch_array($result);
  $image=$row['image'];
  //ลบในโฟลเดอร์
  unlink("../../../product/".$image);
  //ลบในฐานข้อมูล
  mysql_query("DELETE FROM product_image WHERE image='$image'")or die(mysql_error());
}
//ลบแบบ
$sql="DELETE FROM product_option WHERE product_id=$id";
mysql_query($sql)or die(mysql_error());
//กลับ
echo"<script>document.location=document.referrer;</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>