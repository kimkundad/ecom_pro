<?
if(empty($_REQUEST['id'])){echo"<script>window.location='product.php';</script>";exit;}
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<<!-- InstanceBegin template="/Templates/back.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<<!-- InstanceBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน - สินค้า</title>
<<!-- InstanceEndEditable -->
<link href="css/design.css" rel="stylesheet" type="text/css" />
<<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script language="javascript" src="js/createElement.js"></script>
<<!-- InstanceEndEditable -->
</head>
<?
include('process2/connect.php');
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
<<!-- InstanceBeginEditable name="EditRegion" -->
<div style="width:962px;margin:20px auto 0 auto;text-align:right;">
    <input type="button" value="เพิ่มสินค้าใหม่" onclick="window.location='productInsert.php'"/>
  <input type="button" value="กลับ" onclick="window.location='product.php';"/>
</div>
<?
$id=base64_decode($_REQUEST['id']);
$sql="SELECT * FROM product WHERE id=$id";
$result=mysql_query($sql)or die(mysql_error());
$num=mysql_num_rows($result);
if($num==0){echo"<script>window.location='product.php';</script>";exit;}
$row=mysql_fetch_array($result);
?>
<table style="margin-top:10px;" class="data" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <th class="header">แก้ไขสินค้า่
<div style="float:right;">
  <a href="../สินค้า-<?=$row['id']."-".rewrite_url($row['name'])?>.html" target="_blank"><img src="image/icon-view-product.png" class="action" title="ดูบนหน้าร้าน"/></a>
  <a href="process/product/productDelete.php?id=<?=base64_encode($row['id'])?>" onclick="return confirm('ลบ ?')"><img src="image/icon-bin.png"class="action" title="ลบ"/></a>
</div>  
    </th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/product/productUpdate.php" method="post" enctype="multipart/form-data" name="product" >
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">หมวดสินค้าู่</td>
    <td>
      <select name="category_id" id="category_id">
        <option value="0">ไม่มีหมวดหมู่</option>
        <?
        $sqlCategory="SELECT * FROM category WHERE id!=0 ORDER BY name";
        $resultCategory=mysql_query($sqlCategory) or die(mysql_error());
        $numCategory=mysql_num_rows($resultCategory);
        for($i=1;$i<=$numCategory;$i++){$rowCategory=mysql_fetch_array($resultCategory); 
        ?>
        <option value="<?=$rowCategory['id']?>" <? if($row['category_id']==$rowCategory['id']){echo"selected='selected'";}?>><?=$rowCategory['name']?></option>
        <?
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>ชื่อสินค้า</td>
    <td><input name="name" type="text" style="width:300px;" value="<?=$row['name']?>"/></td>
  </tr>
  <tr>
    <td>รายละเอียด</td>
    <td><textarea name="detail"><?=$row['detail']?></textarea></td>
  </tr>
  <tr>
    <td>คีย์เวิร์ด</td>
    <td><input name="keyword" type="text" style="width:800px;" value="<?=$row['keyword']?>"/></td>
  </tr>
  <tr>
  <tr>
    <td>สถานะ</td>
    <td>
      <select name="status">
      <?
      $statusList=array('ปกติ','ขายดี','หมด');
	  foreach($statusList as $status){
	    if($status==$row['status']){
	      echo"<option value='$status' selected='selected'>$status</option>";
		}
		else{
		  echo"<option value='$status'>$status</option>";
		}
	  }
	  ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>ราคาปกติ</td>
    <td><input name="normal_price" type="text" style="width:80px;" value="<?=$row['normal_price']?>"/> บาท</td>
  </tr>
  <tr>
  <tr>
    <td>ส่วนลด</td>
    <td><input name="discount" type="text" style="width:80px;" value="<?=$row['discount']?>"/> เปอร์เซนต์</td>
  </tr>
  <tr>
    <td>ราคาขายจริง</td>
    <td><input name="price" type="text" style="width:80px;" value="<?=$row['price']?>"/> บาท</td>
  </tr>
  <tr>
    <td>แบบสินค้า</td>
    <td>
<?
$sqlOption="SELECT * FROM product_option WHERE product_id=$id AND name!='' ORDER BY id";
$resultOption=mysql_query($sqlOption) or die(mysql_error());
$numOption=mysql_num_rows($resultOption);
if($numOption>0){
  for($i=1;$i<=$numOption;$i++){$rowOption=mysql_fetch_array($resultOption); 
?>
      <input name="option[]" type="text" value="<?=$rowOption['name']?>"/> 
      <input name="option_id[]" type="hidden" value="<?=$rowOption['id']?>"/>
<?
  }
}
else if($numOption==0){
?>
	  <input type="text" name="option_insert[]"/><span id="option_insert"></span>
<?
}
?>
      <span id="option_insert"></span>
	  <input type="button" value="+" onClick="JavaScript:option_insertCreateElement();"/>
	</td>
  </tr>
  <tr>
    <td>ภาพหลัก</td>
    <td><img src="../product/<?=$row['image']?>" style="max-width:120px;max-height:120px;margin-bottom:10px; border:solid 1px #dfdfdf;"/><br/><input type="file" name="image"/></td>
  </tr>
  <tr>
    <td>ภาพประกอบ</td>
    <td>
      <input type="file" name="product_image[]"><span id="product_image"></span>
	  <input type="button" value="+" onClick="JavaScript:product_imageCreateElement();">
    </td>
  </tr>
  <tr>
    <td>วันที่เพิ่ม</td>
    <td><input name="insert_date" type="text" value="<?=substr($row['insert_date'],0,16)?>" readonly="readonly" style="background:#fafafa;"/></td>
  </tr>
  <tr>
    <td>แก้ไขล่าสุด</td>
    <td> <input name="last_update" type="text" value="<?=substr($row['last_update'],0,16)?>" readonly="readonly" style="background:#fafafa;"/></td>
  </tr>
  <tr>
    <td><input name="id" type="hidden" id="id" value="<?=base64_encode($row['id'])?>"/></td>
    <td><input type="submit" value="บันทึก"/></td>
  </tr>
</table>
</form>   
    </td>
  </tr>
</table>
<?
$sqlOption="SELECT * from product_option WHERE product_id=$id AND name!='' ORDER BY id";
$resultOption=mysql_query($sqlOption)or die(mysql_error());
$numOption=mysql_num_rows($resultOption);
?>
<table class="list" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header">แบบสินค้า</th>
    <th width="120" class="header">วันที่เพิ่ม</th>
    <th width="150" class="header">จัดการ</th>
  </tr>
<?
if($numOption>0){
  for($i=1;$i<=$numOption;$i++){$rowOption=mysql_fetch_array($resultOption);
?>
  <tr>
    <td><?=$rowOption['name']?></td>
    <td align="center"><?=substr($rowOption['insert_date'],0,16)?></td>
    <td align="center" style="background:#f9f9f9"><a href="process/product/productOptionDelete.php?id=<?=base64_encode($rowOption['id'])?>" onclick="return confirm('ลบแบบสินค้า <?=$rowOption['name']?> ?')"><img src="image/icon-bin.png"class="action" title="ลบ"/></a>
    </td>
  </tr>
<?
  }
}
else if($numOption==0){
?>
  <tr>
    <td colspan="3" align="center">ไม่มีข้อมูล</td>
  </tr>
<?
}
?>
  <tr>
    <th class="footer" colspan="3">จำนวน : <?=$numOption?></th>
  </tr>
</table>
<?
$sqlImage="SELECT * from product_image WHERE product_id=$id ORDER BY id";
$resultImage=mysql_query($sqlImage)or die(mysql_error());
$numImage=mysql_num_rows($resultImage);
?>
<table class="list" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header">รูปภาพ</th>
    <th width="120" class="header">วันที่เพิ่ม</th>
    <th width="150" class="header">จัดการ</th>
  </tr>
<?
if($numImage>0){
  for($i=1;$i<=$numImage;$i++){$rowImage=mysql_fetch_array($resultImage);
?>
  <tr>
    <td><div class="product"><img src="../product/<?=$rowImage['image']?>"/></div></td>
    <td align="center"><?=substr($rowImage['insert_date'],0,16)?></td>
    <td align="center" style="background:#f9f9f9"><a href="process/product/productImageDelete.php?id=<?=base64_encode($rowImage['id'])?>" onclick="return confirm('ลบภาพ ?')"><img src="image/icon-bin.png"class="action" title="ลบ"/></a>
    </td>
  </tr>
<?
  }
}
else if($numImage==0){
?>
  <tr>
    <td colspan="3" align="center">ไม่มีข้อมูล</td>
  </tr>
<?
}
?>
  <tr>
    <th class="footer" colspan="3">จำนวน : <?=$numImage?></th>
  </tr>
</table>
<div style="width:962px;margin:10px auto 0 auto;text-align:left;">
  <input type="button" value="เพิ่มสินค้าใหม่" onclick="window.location='productInsert.php'"/>
  <input type="button" value="กลับ" onclick="window.location='product.php';"/>
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