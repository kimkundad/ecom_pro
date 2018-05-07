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
$category_id=$_REQUEST['category_id'];
$name=$_REQUEST['name'];
$detail=$_REQUEST['detail'];
$normal_price=$_REQUEST['normal_price'];
if($normal_price==""){$normal_price=0;}
$discount=$_REQUEST['discount'];
if($discount==""){$discount=0;}
$price=$_REQUEST['price'];
if(!is_numeric($price)){echo"<script>alert('จำนวนเงินไม่เป็นตัวเลข');history.back();</script>";exit();}
$status= $_REQUEST['status'];
$keyword=$_REQUEST['keyword'];
//เชื่อมต่อฐานข้อมูล
include('../../../process/connect.php');
//เปลี่ยนแปลงแบบ
if(!empty($_REQUEST['option_id'])){
  for($i=0;$i<count($_REQUEST['option_id']);$i++){
    if($_REQUEST['option'][$i]!=""){
	  $option=$_REQUEST['option'][$i];
	  $option_id=$_REQUEST['option_id'][$i];
      $sqlOption="UPDATE product_option SET name=\"$option\", last_update=now() WHERE id=$option_id";
      mysql_query($sqlOption)or die(mysql_error());
    }
  }
}
//เพิ่มแบบ
if(!empty($_REQUEST['option_insert'])){
  for($i=0;$i<count($_REQUEST['option_insert']);$i++){
    if($_REQUEST['option_insert'][$i]!=""){
	  $option_insert=$_REQUEST['option_insert'][$i];
      $sqlOption="INSERT INTO product_option(product_id, name, insert_date, last_update) VALUES($id, \"$option_insert\", now(), now())";
      mysql_query($sqlOption)or die(mysql_error());
    }
  }
}
//ถ้าไม่แก้ไขรูปภาพ
if($_FILES['image']['name']==""){
  //อัพเดทข้อมูล
  $sql="UPDATE product SET category_id=$category_id, name=\"$name\", detail='$detail', normal_price=$normal_price, price=$price, discount=$discount, keyword=\"$keyword\", status='$status', last_update=now() WHERE id=$id";
  mysql_query($sql)or die(mysql_error());   
  //เพิ่มภาพประกอบ
  for($i=0;$i<count($_FILES['product_image']['name']);$i++){
    if($_FILES['product_image']['name'][$i]!=""){
	  $product_image=time().'-'.$_FILES['product_image']['name'][$i];
      if(move_uploaded_file($_FILES['product_image']['tmp_name'][$i],"../../../product/".$product_image)){
        $sqlImage="INSERT INTO product_image(product_id, image, insert_date) VALUES($id, '$product_image', now())";
        mysql_query($sqlImage)or die(mysql_error());
	  }
    }
  } 
  echo"<script>window.location='../../productEdit.php?id=$_REQUEST[id]';</script>";exit;
}
//ถ้าแก้ไขรูปภาพ
if($_FILES['image']['name']!=""){
  //ลบภาพเก่า
  $sqlDelete="SELECT * FROM product WHERE id=$id";
  $resultDelete=mysql_query($sqlDelete)or die(mysql_error());
  $rowDelete=mysql_fetch_array($resultDelete);
  unlink("../../../product/".$rowDelete['image']);
  //เปลี่ยนชื่อภาพ
  $image=time().'-'.$_FILES['image']['name'];
  //อัพโหลดรูปภาพ
  if(move_uploaded_file($_FILES['image']['tmp_name'],"../../../product/".$image)){
    $error="";
  }
  //ถ้าอัพโหลดไม่ได้
  else{
  $error="alert('เกิดการผิดพลาดในการอัพโหลดไฟล์ภาพ กรุณาทำการอัพโหลดใหม่');";
  }
  //อัพเดทตารางสินค้า
  $sqlUpdate="UPDATE product SET category_id=$category_id, name=\"$name\", detail='$detail', normal_price=$normal_price, price=$price, discount=$discount, image='$image', keyword='$keyword', status='$status', last_update=now() WHERE id=$id";
  mysql_query($sqlUpdate)or die(mysql_error());
  //อัพเดทตารางสคำสั่งซื้อ
  $sqlUpdate="UPDATE order_detail SET product_image='$image' WHERE product_image='$rowDelete[image]'";
  mysql_query($sqlUpdate)or die(mysql_error());
  //เพิ่มภาพประกอบ
  for($i=0;$i<count($_FILES['product_image']['name']);$i++){
    if($_FILES['product_image']['name'][$i]!=""){
	  $product_image=time().'-'.$_FILES['product_image']['name'][$i];
      if(move_uploaded_file($_FILES['product_image']['tmp_name'][$i],"../../../product/".$product_image)){
        $sqlImage="INSERT INTO product_image(product_id, image, insert_date) VALUES($id, '$product_image', now())";
        mysql_query($sqlImage)or die(mysql_error());
	  }
    }
  }  
}
echo"<script>$error;window.location='../../productEdit.php?id=$_REQUEST[id]';</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>