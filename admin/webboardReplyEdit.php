<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/back.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน - เว็บบอร์ด</title>
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
<?
$id=base64_decode($_REQUEST['id']);
$sql="SELECT * FROM webboard_reply WHERE id=$id";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
?>
<div style="width:962px;margin:20px auto 0 auto;text-align:right;">
  <input type="button" value="กลับ" onclick="window.location='webboardEdit.php?id=<?=$_REQUEST['id']?>'"/>
</div>
<table class="data" style="margin-top:10px;" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">แก้ไขหัวข้อ</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/webboard/replyUpdate.php" method="post" name="webboard" >
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">รายละเอียด</td>
    <td><textarea name="detail"><?=$row['detail']?></textarea></td>
  </tr>
  <tr>
    <td>ผู้โพส</td>
    <td><input name="username" type="text" style="width:100px;background:#fafafa;" value="<?=$row['username']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>วันที่โพส</td>
    <td><input name="insert_date" type="text" style="width:100px;background:#fafafa;" value="<?=substr($row['insert_date'],0,16)?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>แก้ไขล่าสุด</td>
    <td><input name="last_update" type="text" id="last_update" style="width:100px;background:#fafafa;" value="<?=substr($row['last_update'],0,16)?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td><input name="id" type="hidden" value="<?=base64_encode($id)?>"/><input name="post_id" type="hidden" value="<?=$row['post_id']?>"/></td>
    <td><input type="submit" value="แก้ไข"/></td>
  </tr>
</table>
</form>   
    </td>
  </tr>
</table>
<div style="width:962px;margin:10px auto 0 auto;text-align:left;">
  <input type="button" value="กลับ" onclick="window.location='webboardEdit.php?id=<?=$_REQUEST['id']?>'"/>
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
CKEDITOR.replace('detail',{   
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
document.webboard.detail.focus();
</script>