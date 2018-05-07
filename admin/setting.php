<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/back.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน - ข้อมูลร้าน</title>
<!-- InstanceEndEditable -->
<link href="css/design.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
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
  <input type="button" value="เกี่ยวกับเรา" onclick="window.location='#aboutUs'"/>
  <input type="button" value="โปรโมชั่น" onclick="window.location='#promote'"/>
  <input type="button" value="วิธีการสั่งซื้อ" onclick="window.location='#how2order'"/>
  <input type="button" value="แจ้งการชำระเงิน" onclick="window.location='#pay'"/>
  <input type="button" value="ติดต่อเรา" onclick="window.location='#contactUs'"/>
</div>
<?
$sql="SELECT * FROM setting";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
?>
<table class="data" style="margin-top:10px;" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">แก้ไขข้อมูลร้าน</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/setting/infoUpdate.php" method="post" name="info" >
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">ชื่อร้่าน</td>
    <td><input name="shop_name" type="text" style="width:200px;" value="<?=$row['shop_name']?>"/></td>
  </tr>
  <tr>
    <td width="100">ชื่อเว็บไซต์</td>
    <td><input name="website_name" type="text" style="width:200px;" value="<?=$row['website_name']?>"/></td>
  </tr>
  <tr>
    <td>แฟนเพจ</td>
    <td><input name="facebook_fanpage" type="text" style="width:200px;" value="<?=$row['facebook_fanpage']?>"/></td>
  </tr>
  <tr>
    <td>อีเมล์</td>
    <td><input name="email" type="text" style="width:200px;" value="<?=$row['email']?>"/></td>
  </tr>
  <tr>
    <td>เบอร์ติดต่อ</td>
    <td><input name="tel" type="text" value="<?=$row['tel']?>"/></td>
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

<table class="data" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">แก้ไขแท็กเมตา</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/setting/metaTagUpdate.php" method="post" name="metaTag" >
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">Title</td>
    <td><input name="title" type="text" id="title" style="width:400px;" value="<?=$row['title']?>"/></td>
  </tr>
  <tr>
    <td>Description</td>
    <td><textarea name="description" rows="5" style="width:400px;"><?=$row['description']?></textarea></td>
  </tr>
  <tr>
    <td>Keyword</td>
    <td><textarea name="keyword" rows="5" style="width:400px;"><?=$row['keyword']?>
    </textarea></td>
  </tr>
  <tr>
    <td>Google Analytics</td>
    <td><textarea name="google_analytics" rows="1" style="width:400px;"><?=$row['google_analytics']?></textarea></td>
  </tr>
  <tr>
    <td>Author</td>
    <td><input name="author" type="text" id="author" style="width:120px;" value="<?=$row['author']?>"/></td>
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
<table class="data" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">ตัวเก็บสถิติ</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/setting/statsUpdate.php" method="post" name="stats" >
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">รหัส</td>
    <td><textarea name="stats_meta" rows="1" style="width:400px;"><?=$row['stats_meta']?></textarea></td>
  </tr>
  <tr>
    <td>โค้ด</td>
    <td><textarea name="stats_script" rows="4" style="width:400px;"><?=$row['stats_script']?></textarea></td>
  </tr>
  <tr>
    <td>แสดงผล</td>
    <td>
      <select name="stats_display">
        <option value="block" <? if($row['stats_display']=="block"){echo"selected='selected'";}?>>แสดงบนหน้าเว็บ</option>
        <option value="none" <? if($row['stats_display']=="none"){echo"selected='selected'";}?>>ซ่อนจากหน้าเว็บ</option>
      </select>
    </td>
  </tr>
  <tr>
    <td><script type="text/javascript" language="javascript1.1" src="http://tracker.stats.in.th/tracker.php?sid=44358"></script></td>
    <td><input type="submit" value="บันทึก"/></td>
  </tr>
</table>
</form>   
    </td>
  </tr>
</table>
<a name="aboutUs" id="aboutUs"></a>
<table class="data" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">เกี่ยวกับเรา</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/setting/aboutUsUpdate.php" method="post">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">โค้ดหรือข้อความ</td>
    <td><textarea name="about_us" id="about_us"><?=$row['about_us']?>
    </textarea></td>
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
<a name="promote" id="promote"></a>
<table class="data" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">โปรโมชั่น</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/setting/promotionUpdate.php" method="post">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">โค้ดหรือข้อความ</td>
    <td><textarea name="promotion" id="promotion"><?=$row['promotion']?>
    </textarea></td>
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
<a name="how2order" id="how2order"></a>
<table class="data" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">วิธีการสั่งซื้อ</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/setting/orderUpdate.php" method="post">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">โค้ดหรือข้อความ</td>
    <td><textarea name="order" id="order"><?=$row['order']?>
    </textarea></td>
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
<a name="pay" id="pay"></a>
<table class="data" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header">แจ้งการชำระเงิน</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/setting/paymentUpdate.php" method="post">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">โค้ดหรือข้อความ</td>
    <td><textarea name="payment" id="payment"><?=$row['payment']?></textarea></td>
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
<a name="contactUs" id="contactUs"></a>
<table class="data" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">ติดต่อเรา</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/setting/contactUsUpdate.php" method="post" name="contactUs" >
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">โค้ดหรือข้อความ</td>
    <td><textarea name="contact_us" id="contact_us"><?=$row['contact_us']?></textarea></td>
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
<div style="width:962px;margin:10px auto 0 auto;text-align:left;">
  <input type="button" value="เกี่ยวกับเรา" onclick="window.location='#aboutUs'"/>
  <input type="button" value="โปรโมชั่น" onclick="window.location='#promote'"/>
  <input type="button" value="วิธีการสั่งซื้อ" onclick="window.location='#how2order'"/>
  <input type="button" value="แจ้งการชำระเงิน" onclick="window.location='#pay'"/>
  <input type="button" value="ติดต่อเรา" onclick="window.location='#contactUs'"/>
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
<? 
$webpage=array('about_us', 'promotion', 'order', 'payment', 'contact_us');
for($i=0;$i<sizeof($webpage);$i++){
?>
CKEDITOR.replace('<?=$webpage[$i]?>',{   
  skin:'kama',width:'810',height:'300',enterMode:Number(2),toolbar:[
    ['Source','-'/*,'Save'*/,'NewPage','Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
    /*'/',*/
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor'],
    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    /*'/',*/
    ['Styles','Format','Font','FontSize'],
    ['TextColor','BGColor'],
    ['Maximize', 'ShowBlocks','-','About']
  ]		
});
<?
}
?>
</script>