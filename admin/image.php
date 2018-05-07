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
<div style="width:962px;margin:20px auto 0 auto;text-align:right;">
  <input type="button" value="รูปภาพ" onclick="window.location='image.php'"/>
  <input type="button" value="สไลด์โชว์" onclick="window.location='slideshow.php'"/>
</div>
<table class="data" style="margin-top:10px;" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header">เพิ่มรูปภาพใหม่</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/image/imageInsert.php" method="post" enctype="multipart/form-data" name="image">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="100">ชื่อภาพ</td>
    <td><input name="name" type="text" style="width:250px;"/></td>
  </tr>
  <tr>
    <td>ภาพ</td>
    <td><input name="image" type="file"/></td>
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
//กำหนดแถวและคอลัมน์
$num_col=1;
$num_row=15;
//เรคคอร์ดที่สิ้นสุด
$page_size=$num_col*$num_row;
//กำหนดค่าเริ่มต้น
$page=isset($_REQUEST['page'])?$_REQUEST['page']:0;
$keyword=isset($_REQUEST['keyword'])?$_REQUEST['keyword']:'';
//หาจำนวนหน้า
$sql="SELECT COUNT(*) FROM image WHERE name LIKE '%$keyword%'";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
$num=$row['COUNT(*)'];
$numAll=$num;
//หมายเลขหน้า
$num_page=ceil($num/$page_size);
//เรคคอร์ดที่เริ่ม
$start_record=$page*$page_size;
//เลือกข้อมูล
$sql="SELECT * FROM image WHERE name LIKE '%$keyword%' ORDER BY id DESC LIMIT $start_record, $page_size";
$result=mysql_query($sql)or die(mysql_error());
$num=mysql_num_rows($result);
?>
<div style="width:962px;margin:10px auto 0 auto;text-align:right;">
<form action="image.php" method="post" name="search"> 
  <input name="keyword" type="text" id="keyword" value="<?=$keyword?>"/>
  <input type="submit" value="ค้นหา"/>
</form>
</div>
<table class="list" style="margin-top:10px;" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th width="60" class="header">รูปภาพ</th>
    <th width="200" class="header">ชื่อภาพ</th>
    <th class="header">URL รูปภาพ</th>
    <th width="150" class="header">จัดการ</th>
  </tr>
<?
if($num==0){
?>
    <td align="center" colspan="4">ไม่มีข้อมูล</td>
<?
}
for($i=0;$row=mysql_fetch_array($result);$i++){ 
  if($i%$num_col==0){
?>
  <tr>
<?
    }		
?>
    <td><div class="product"><img src="../upload/<?=$row['image']?>"/></div></td>
    <td align="center"><?=$row['name']?></td>
    <td align="center"><?=$rowSetting['website_name']."/upload/".$row['image']?></td>
    <td align="center" style="background:#f9f9f9"><a href="imageEdit.php?id=<?=base64_encode($row['id'])?>"><img src="image/icon-pencil.png" class="action" title="แก้ไข"/></a>
      <a href="process/image/imageDelete.php?id=<?=base64_encode($row['id'])?>" onclick="return confirm('ลบภาพ<?=$row['name']?> ?')"><img src="image/icon-bin.png" class="action" title="ลบ"/></a>    
    </td>
<?
  if($i%$num_col==$num_col-1){
?>
  </tr>
<?
  }
}
if ($i>$num_col){
  for($j=$i;$j%$num_col!=0;$j++){
?>
  <td colspan="4" align="center">โค้ดหรือข้อความเมื่อเหลือพื้นที่แสดง</td>
<? 
  }
}
if($i%$num_col!=0){
?>
  </tr>
<?
}
?>
  <tr>
    <th class="footer" colspan="4">
    <div class="num">จำนวน : <?=$numAll?></div>
    <div class="page">
    <? 
    if($page>0){
    ?>
      <a href="" class="page">ก่อนหน้า</a>
      <? 
	}  
	for($i=0;$i<$num_page;$i++){ 
      if($i==$page){
    ?>
      <page><?=$i+1?></page>
    <?  
	  } 
	  else{ 
    ?>
      <a href="" class="page"><?=$i+1?></a>
    <?   
	  }
    }
	if($page<$num_page-1){
	?>
      <a href="" class="page">ถัดไป</a>
    <? 
 	} 
    ?> 
    </div>
    </th>
  </tr>
</table>
<div style="width:962px; margin:10px auto 0 auto; text-align:left;">
  <input type="button" value="กลับ" onclick="window.location='message.php'"/>
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