<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/back.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน - รูปภาพ</title>
<!-- InstanceEndEditable -->
<link href="css/design.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
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
    <li><a href="<?=$rowSetting['website_name']."/"?>" target="_blank"><img src="image/store-icon.png"/><br/>หน้าร้าน</a></li>
    <li><a href="user.php"><img src="image/admin-icon.png"/><br/>ผู้ใช้</a></li>
    <!--<li><a href="../admin/member.php"><img src="../admin/image/user-icon.png"/><br/>สมาชิก</a></li>-->
    <li><a href="image.php"><img src="image/photos-icon.png"/><br/>รูปภาพ</a></li>
    <li><a href="category.php"><img src="image/file-cabinet-icon.png"/><br/>หมวดหมู่</a></li>
    <li><a href="product.php"><img src="image/packaging-icon.png"/><br/>สินค้า</a></li>
    <li><a href="order.php"><img src="image/shopping-icon.png"/><br/>คำสั่งซื้อ</a></li>
    <li><a href="payment.php"><img src="image/money-icon.png"/><br/>ชำระเงิน</a></li>
    <li><a href="bank.php"><img src="image/visa-icon.png"/><br/>การเงิน</a></li>
    <li><a href="shipping.php"><img src="image/shipping-icon.png"/><br/>จัดส่ง</a></li>
    <!--<li><a href="../admin/message.php"><img src="../admin/image/email-icon.png"/><br/>ข้อความ</a></li>--> 
    <li><a href="webboard.php"><img src="image/chat-icon.png"/><br/>เว็บบอร์ด</a></li>
    <!--<li><a href="../admin/article.php"><img src="../admin/image/news-icon.png"/><br/>บทความ</a></li>-->
    <li><a href="tag.php"><img src="image/tag-icon.png"/><br/>แท็ก</a></li>
    <li><a href="decoration.php"><img src="image/apple-appstore-icon.png"/><br/>ตกแต่ง</a></li>
    <li><a href="setting.php"><img src="image/contact-info-icon.png"/><br/>ข้อมูลร้าน</a></li>  
    <li><a href="plus.php"><img src="image/shopping-bag-icon.png"/><br/>ส่วนเสริม</a></li> 
     
    <li><a href="process/logout.php"><img src="image/security-icon.png"/><br/>ออก</a></li>
  </ul>
  <div style="clear:both;"></div>
</div>
<!-- InstanceBeginEditable name="EditRegion" -->
<?
$id=base64_decode($_REQUEST['id']);
$sql="SELECT * FROM image WHERE id=$id";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
$num=mysql_num_rows($result);
if($num==0){echo"<script>window.location='slideshow.php';</script>";exit;}
?>
<div style="width:962px;margin:20px auto 0 auto;text-align:right;">
  <input type="button" value="กลับ" onclick="window.location='image.php'"/>
</div>
<table class="data" style="margin-top:10px;" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header">แก้ไขรูปภาพ
      <div style="float:right;">
  <a href="process/image/imageDelete.php?id=<?=base64_encode($row['id'])?>" onclick="return confirm('ลบภาพนี้ ?')"><img src="image/icon-bin.png"class="action" title="ลบ"/></a>
</div>
    </th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/image/imageUpdate.php" method="post" enctype="multipart/form-data" name="image">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="100">ชื่อภาพ</td>
    <td><input name="name" type="text" value="<?=$row['name']?>" style="width:250px;"/></td>
  </tr>
  <tr>
    <td>ที่อยู่ภาพ</td>
    <td><input name="link" type="text" value="<?=$rowSetting['website_name']."/upload/".$row['image']?>" readonly="readonly" style="background:#fafafa;width:350px;"/></td>
  </tr>
  <tr>
    <td>ภาพ</td>
    <td>
      <img src="../upload/<?=$row['image']?>" class="slideshow" title="<?=$row['title']?>"/></td>
  </tr>
  <tr>
    <td>วันที่เพิ่ม</td>
    <td><input name="insert_date" type="text" value="<?=substr($row['insert_date'],0,16)?>" style="background:#fafafa;"/></td>
  </tr>
  <tr>
    <td>แก้ไขล่าสุด</td>
    <td><input name="last_update" type="text" value="<?=substr($row['last_update'],0,16)?>" style="background:#fafafa;"/></td>
  </tr>
  <tr>
    <td><input type="hidden" name="id" value="<?=base64_encode($id)?>"/></td>
    <td><input type="submit" value="บันทึก"/></td>
  </tr>
</table>
</form>  
    </td>
  </tr>
</table>
<div style="width:962px;margin:10px auto 0 auto;text-align:left;">
  <input type="button" value="กลับ" onclick="window.location='image.php'"/>
</div>
<!-- InstanceEndEditable -->
<?
function rewrite_url($url="url"){
  $url=strtolower(str_replace(" ","_",$url));
  $url=preg_replace('~[^a-z0-9ก-๙\.\-\_]~iu','',$url);
  return $url;
}
mysql_close($conn);
?>
</body>
<!-- InstanceEnd --></html>
<script type="text/javascript">
document.image.name.focus();
</script>