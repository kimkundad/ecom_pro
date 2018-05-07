<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/back.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน - สินค้า</title>
<!-- InstanceEndEditable -->
<link href="css/design.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script language="javascript" src="js/createElement.js"></script>
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
  <input type="button" value="กลับ" onclick="window.location='product.php'"/>
</div>
<table class="data" style="margin-top:10px;" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header" colspan="2">เพิ่มสินค้าใหม่</th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/product/productInsert.php" method="post" enctype="multipart/form-data" name="product" >
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">หมวดสินค้าู่</td>
    <td>
      <select name="category_id">
        <option value="0">ไม่มีหมวดหมู่</option>
        <?
        $sqlCategory="SELECT * FROM category WHERE id!=0 ORDER BY name";
        $resultCategory=mysql_query($sqlCategory) or die(mysql_error());
        $numCategory=mysql_num_rows($resultCategory);
        for($i=1;$i<=$numCategory;$i++){$rowCategory=mysql_fetch_array($resultCategory); 
        ?>
        <option value="<?=$rowCategory['id']?>"><?=$rowCategory['name']?></option>
        <?
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>ชื่อสินค้า</td>
    <td><input type="text" name="name" style="width:300px;" required/></td>
  </tr>
  <tr>
    <td>รายละเอียด</td>
    <td><textarea name="detail"></textarea></td>
  </tr>
  <tr>
    <td>คีย์เวิร์ด</td>
    <td><input name="keyword" type="text" style="width:800px;"/></td>
  </tr>
  <tr>
    <td>สถานะ</td>
    <td>
      <select name="status" id="status">
      <?
      $status=array('ปกติ','ขายดี', 'หมด');
	  for($i=0;$i<sizeof($status);$i++){
	    echo"<option value='$status[$i]'>$status[$i]</option>";
	  }
	  ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>ราคาปกติ</td>
    <td><input type="text" name="normal_price" style="width:80px;"/> บาท</td>
  </tr>
  <tr>
    <td>ส่วนลด</td>
    <td><input name="discount" type="text" style="width:80px;"/> เปอร์เซนต์</td>
  </tr>
  <tr>
    <td>ราคาขายจริง</td>
    <td>
      <input type="text" name="price" style="width:80px;" required/> บาท
    </td>
  </tr>
  <tr>
    <td>แบบสินค้า</td>
    <td>	
	  <input type="text" name="option[]"/><span id="option"></span>
	  <input type="button" value="+" onClick="JavaScript:optionCreateElement();"/>
	</td>
  </tr>
  <tr>
    <td>ภาพหลัก</td>
    <td><input type="file" name="image"/></td>
  </tr>
  <tr>
    <td>ภาพประกอบ</td>
    <td>
      <input type="file" name="product_image[]"/><span id="product_image"></span>
	  <input type="button" value="+" onClick="JavaScript:product_imageCreateElement();"/>
    </td>
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
<div style="width:962px;margin:10px auto 0 auto;text-align:left;">
  <input type="button" value="กลับ" onclick="window.location='product.php'"/>
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
</script>