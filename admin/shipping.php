<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/back.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน - จัดส่ง</title>
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
<table class="data" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header" colspan="2" >เพิ่มวิธีการจัดส่งใหม่</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/shipping/shippingInsert.php" method="post" name="shipping">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="100">วิธีการจัดส่ง</td>
    <td><input type="text" name="option" style="width:300px;"/></td>
  </tr>
  <tr>
    <td>ราคา</td>
    <td><input name="price" type="text" style="width:80px;"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="เพิ่ม"/></td>
  </tr>
</table>
</form>  
    </td>
  </tr>
</table>
<?
$sql="SELECT * FROM shipping ORDER BY id";
$result=mysql_query($sql)or die(mysql_error());
$num=mysql_num_rows($result);
?>
<table class="list" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header">ชื่อวิธีการจัดส่ง</th>
    <th width="120" class="header">ราคา</th>
    <th width="120" class="header">วันที่เพิ่ม</th>
    <th width="120" class="header">แก้ไขล่าสุด</th>
    <th width="150" class="header">จัดการ</th>
  </tr>
<?
if($num>0){
  for($i=1;$i<=$num;$i++){$row=mysql_fetch_array($result);
?>
  <tr>
    <td><?=$row['option']?></td>
    <td align="center"><?=number_format($row['price'],2)?></td>
    <td align="center"><?=substr($row['insert_date'],0,16)?></td>
    <td align="center"><?=substr($row['last_update'],0,16)?></td>
    <td align="center" style="background:#f9f9f9">
      <a href="shippingEdit.php?id=<?=base64_encode($row['id'])?>"><img src="image/icon-pencil.png" class="action" title="แก้ไข"/></a>
      <a href="process/shipping/shippingDelete.php?id=<?=base64_encode($row['id'])?>" onclick="return confirm('ลบธนาคาร <?=$row['option']?> ?')"><img src="image/icon-bin.png"class="action" title="ลบ"/></a>
    </td>
  </tr>
<?
  }
}
else if($num==0){
?>
  <tr>
    <td colspan="5" align="center">ไม่มีข้อมูล</td>
  </tr>
<?
}
?>
  <tr>
    <th class="footer" colspan="5">จำนวน : <?=$num?></th>
  </tr>
</table>
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
document.shipping.option.focus();
</script>