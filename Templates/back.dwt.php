<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน</title>
<!-- TemplateEndEditable -->
<link href="../admin/css/design.css" rel="stylesheet" type="text/css" />
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<?
include('../process/connect.php');
if(isset($_SESSION['username'])){$username=$_SESSION['username'];}
else if(!isset($_SESSION['username'])){echo"<script>alert('ยังไม่เข้าสู่ระบบ');window.location='index.php';</script>";exit;}
//ข้อมูลร้าน
$sqlSetting="SELECT * FROM setting";
$resultSetting=mysql_query($sqlSetting)or die(mysql_error());
$rowSetting=mysql_fetch_array($resultSetting);
?>
<body>
<div id="menu">
  <div class="welcome">ยินดีต้อนรับคุณ <?=$username?></div>
  <ul class="menu">
    <li><a href="<?=$rowSetting['website_name']."/"?>" target="_blank"><img src="../admin/image/store-icon.png"/><br/>หน้าร้าน</a></li>
    <li><a href="../admin/user.php"><img src="../admin/image/admin-icon.png"/><br/>ผู้ใช้</a></li>
    <!--<li><a href="../admin/member.php"><img src="../admin/image/user-icon.png"/><br/>สมาชิก</a></li>-->
    <li><a href="../admin/image.php"><img src="../admin/image/photos-icon.png"/><br/>รูปภาพ</a></li>
    <li><a href="../admin/category.php"><img src="../admin/image/file-cabinet-icon.png"/><br/>หมวดหมู่</a></li>
    <li><a href="../admin/product.php"><img src="../admin/image/packaging-icon.png"/><br/>สินค้า</a></li>
    <li><a href="../admin/order.php"><img src="../admin/image/shopping-icon.png"/><br/>คำสั่งซื้อ</a></li>
    <li><a href="../admin/payment.php"><img src="../admin/image/money-icon.png"/><br/>ชำระเงิน</a></li>
    <li><a href="../admin/bank.php"><img src="../admin/image/visa-icon.png"/><br/>การเงิน</a></li>
    <li><a href="../admin/shipping.php"><img src="../admin/image/shipping-icon.png"/><br/>จัดส่ง</a></li>
    <!--<li><a href="../admin/message.php"><img src="../admin/image/email-icon.png"/><br/>ข้อความ</a></li>--> 
    <li><a href="../admin/webboard.php"><img src="../admin/image/chat-icon.png"/><br/>เว็บบอร์ด</a></li>
    <!--<li><a href="../admin/article.php"><img src="../admin/image/news-icon.png"/><br/>บทความ</a></li>-->
    <li><a href="../admin/tag.php"><img src="../admin/image/tag-icon.png"/><br/>แท็ก</a></li>
    <li><a href="../admin/decoration.php"><img src="../admin/image/apple-appstore-icon.png"/><br/>ตกแต่ง</a></li>
    <li><a href="../admin/setting.php"><img src="../admin/image/contact-info-icon.png"/><br/>ข้อมูลร้าน</a></li>  
    <li><a href="../admin/plus.php"><img src="../admin/image/shopping-bag-icon.png"/><br/>ส่วนเสริม</a></li> 
    <li><a href="http://www.nuningshop.com" target="_blank"><img src="../admin/image/support-icon.png"/><br/>ช่วยเหลือ</a></li> 
    <li><a href="../admin/process/logout.php"><img src="../admin/image/security-icon.png"/><br/>ออก</a></li>
  </ul>
  <div style="clear:both;"></div>
</div>
<!-- TemplateBeginEditable name="EditRegion" -->EditRegion<!-- TemplateEndEditable -->
<?
function rewrite_url($url="url"){
  $url=strtolower(str_replace(" ","_",$url));
  $url=preg_replace('~[^a-z0-9ก-๙\.\-\_]~iu','',$url);
  return $url;
}
mysql_close($conn);
?>
</body>
</html>