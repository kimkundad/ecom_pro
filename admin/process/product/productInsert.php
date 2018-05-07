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
// รับค่า
if($_FILES['image']['name']==""){echo"<script>alert('ยังไม่เลือกรูปภาพ');history.back();</script>";exit;}
if($_REQUEST['name']==""){echo"<script>alert('ยังไม่ใส่ชื่อสินค้า');history.back();</script>";exit;}
if($_REQUEST['price']==""){echo"<script>alert('ยังไม่ใส่ราคา');history.back();</script>";exit;}
if(!is_numeric($_REQUEST['price'])){echo"<script>alert('จำนวนเงินไม่เป็นตัวเลข');history.back();</script>";exit();}
$category_id=$_REQUEST['category_id'];
$name=$_REQUEST['name'];
$detail=$_REQUEST['detail'];
$status=$_REQUEST['status'];
$normal_price=$_REQUEST['normal_price'];
if($normal_price==""){$normal_price=0;}
$discount=$_REQUEST['discount'];
if($discount==""){$discount=0;}
$price=$_REQUEST['price'];
$keyword=$_REQUEST['keyword'];
//เปลี่ยนชื่อภาพ
$image=time().'-'.$_FILES['image']['name'];
include("../../../process/connect.php");
//เพิ่มข้อมูลสินค้า
$sql="INSERT INTO product(category_id, name, detail, price, normal_price, discount, image, keyword, status, view, insert_date, last_update) VALUES($category_id, \"$name\", '$detail', $price, $normal_price, $discount, '$image', \"$keyword\", '$status', 0, now(), now())";
mysql_query($sql)or die(mysql_error());
//คืนค่าไอดี
$product_id=mysql_insert_id();
//เพิ่มภาพหลัก
if(move_uploaded_file($_FILES['image']['tmp_name'],"../../../product/".$image)){
  $error="";
}
//ถ้าอัพโหลดไม่ได้
else {
  $error="alert('เกิดการผิดพลาดในการอัพโหลดไฟล์ภาพ กรุณาทำการอัพโหลดใหม่')";
}
//เพิ่มภาพประกอบ
for($i=0;$i<count($_FILES['product_image']['name']);$i++){
  if($_FILES['product_image']['name'][$i]!=""){
	$product_image=time().'-'.$_FILES['product_image']['name'][$i];
    if(move_uploaded_file($_FILES['product_image']['tmp_name'][$i],"../../../product/".$product_image)){
      $sqlImage="INSERT INTO product_image(product_id, image, insert_date) VALUES($product_id, '$product_image', now())";
      mysql_query($sqlImage)or die(mysql_error());
	}
  }
}
//แบบ
$sqlOption="INSERT INTO product_option(product_id, name, insert_date, last_update) VALUES($product_id, '', now(), now())";
mysql_query($sqlOption)or die(mysql_error());
//
for($i=0;$i<count($_REQUEST['option']);$i++){
  if($_REQUEST['option'][$i]!=""){
	$option=$_REQUEST['option'][$i];
    $sqlOption="INSERT INTO product_option(product_id, name, insert_date, last_update) VALUES($product_id, \"$option\", now(), now())";
    mysql_query($sqlOption)or die(mysql_error());
  }
}
//กลับ
$id=base64_encode($product_id);
echo"<script>$error;window.location='../../productEdit.php?id=$id';</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>