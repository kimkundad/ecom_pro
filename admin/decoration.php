<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/back.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน - ตกแต่ง</title>
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
$sql="SELECT * FROM decoration";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
?>
<table class="data" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header" colspan="2" >แก้ไขโลโก้</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/decoration/logoUpdate.php" method="post" enctype="multipart/form-data" name="logo">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="100">รูปภาพ</td>
    <td><img src="../image/<?=$row['logo']?>" style="max-width:120px;max-height:120px;margin-bottom:10px; border:solid 1px #dfdfdf;"/><br/><input name="logo" type="file" id="logo"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="บันทึก"/></td>
  </tr>
</table>
</form>  
    </td>
  </tr>
</table>
<table class="data" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header" colspan="2" >แก้ไขพื้นหลัง</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/decoration/backgroundUpdate.php" method="post" enctype="multipart/form-data" name="background">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="120">Background Color</td>
    <td><input type="text" name="background_color" value="<?=$row['background_color']?>" style="width:50px;"/></td>
  </tr>
  <tr>
    <td>Repeat</td>
    <td><select name="repeat">
      <option value="no-repeat" <? if($row['repeat']=='no-repeat'){echo"selected='selected'";}?>>ไม่ต้องเรียงภาพซ้ำ</option>
      <option value="repeat" <? if($row['repeat']=='repeat'){echo"selected='selected'";}?>>เรียงภาพซ้ำทั้งแนวตั้งและแนวนอน</option>
      <option value="repeat-x" <? if($row['repeat']=='repeat-x'){echo"selected='selected'";}?>>เรียงภาพซ้ำในแนวนอนเพียงแถวเดียว</option>
      <option value="repeat-y" <? if($row['repeat']=='repeat-y'){echo"selected='selected'";}?>>เรียงภาพซ้ำในแนวตั้งเพียงคอลัมน์เดียว</option>
    </select></td>
  </tr>
  <tr>
    <td>Attachment</td>
    <td><select name="attachment">
      <option value="fixed" <? if($row['attachment']=='fixed'){echo"selected='selected'";}?>>คงที่อยู่เสมอ</option>
      <option value="scroll" <? if($row['attachment']=='scroll'){echo"selected='selected'";}?>>เลื่อนไปพร้อมกับเนื้อหาอื่นๆ</option>
    </select></td>
  </tr>
  <tr>
    <td>Horizontal Position</td>
    <td><select name="horizontal_position">
      <option value="left" <? if($row['horizontal_position']=='left'){echo"selected='selected'";}?>>ซ้าย</option>
      <option value="center" <? if($row['horizontal_position']=='center'){echo"selected='selected'";}?>>กลาง</option>
      <option value="right" <? if($row['horizontal_position']=='right'){echo"selected='selected'";}?>>ขวา</option>
    </select></td>
  </tr>
  <tr>
    <td>Vertial Position</td>
    <td><select name="vertical_position">
      <option value="top" <? if($row['vertical_position']=='top'){echo"selected='selected'";}?>>บน</option>
      <option value="center" <? if($row['vertical_position']=='center'){echo"selected='selected'";}?>>กลาง</option>
      <option value="bottom" <? if($row['vertical_position']=='bottom'){echo"selected='selected'";}?>>ล่าง</option>
    </select></td>
  </tr>
  <tr>
    <td>Background Iimage</td>
    <td>
    <? 
	if($row['background_image']!=""){?>
      <img src="../image/<?=$row['background_image']?>" style="max-width:120px;max-height:120px;margin-bottom:10px; border:solid 1px #dfdfdf;"/><br />  
    <? 
	}
	?>   
      <input name="background" type="file" style="width:200px;"/><br/>
    <? 
	if($row['background_image']!=""){?>
      <input name="del" type="checkbox" value="yes"/> ไม่ใช้ภาพพื้นหลัง
    <? 
	} 
	?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" value="บันทึก" /></td>
  </tr>
</table>
</form>  
    </td>
  </tr>
</table>
<table class="data" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header" colspan="2" >แก้ไข favicon</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/decoration/favIconUpdate.php" method="post" enctype="multipart/form-data" name="favicon">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="100">รูปภาพ</td>
    <td><img src="../image/<?=$row['favicon']?>" style="max-width:120px;max-height:120px;margin-bottom:10px; border:solid 1px #dfdfdf;"/><br /><input name="favicon" type="file" id="favicon"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="บันทึก"/></td>
  </tr>
</table>
</form>  
    </td>
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