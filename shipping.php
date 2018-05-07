<?
session_start();
//เช็คตะกร้า
include('process/connect.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<<!-- InstanceBegin template="/Templates/font.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?
//ตกแต่ง
$sqlDecoration="SELECT * FROM decoration";
$resultDecoration=mysql_query($sqlDecoration)or die(mysql_error());
$rowDecoration=mysql_fetch_array($resultDecoration);
//ข้อมูลร้าน
$sqlSetting="SELECT * FROM setting";
$resultSetting=mysql_query($sqlSetting)or die(mysql_error());
$rowSetting=mysql_fetch_array($resultSetting);
//ส่วนเสริม
$sqlPlus="SELECT * FROM plus";
$resultPlus=mysql_query($sqlPlus)or die(mysql_error());
$rowPlus=mysql_fetch_array($resultPlus);
?>
<link rel="shortcut icon" href="image/<?=$rowDecoration['favicon']?>"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta http-equiv="content-language" content="th"/>
<meta name="robots" content="noodp, noydir"/>
<?=$rowSetting['stats_meta']?>
<?=$rowSetting['google_analytics']?>
<<!-- InstanceBeginEditable name="doctitle" -->
<?
//เช็คตะกร้า
if(!isset($_SESSION['cart'])){echo"<script>window.location='ตะกร้าสินค้า.html';</script>";exit;}
?>
<title>ข้อมูลการจัดส่ง | <?=$rowSetting['title']?></title>
<meta name="description" content="<?=$rowSetting['description']?>"/>
<<!-- InstanceEndEditable -->
<? 
if(empty($keyword)){echo"<meta name='keywords' content='$rowSetting[keyword]'/>";}
else if(!empty($keyword)){echo"<meta name='keywords' content='$keyword'/>";}
?>
<meta name="author" content="<?=$rowSetting['author']?>"/>
<link href="css/design.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/scrolltopcontrol.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<<!-- InstanceBeginEditable name="head" -->
<<!-- InstanceEndEditable -->
<style type="text/css">
#background{<? if($rowDecoration['background_image']!=""){echo"background-image:url(image/$rowDecoration[background_image]);";}?>
background-color:<?=$rowDecoration['background_color']?>;
background-attachment:<?=$rowDecoration['attachment']?>;
background-repeat:<?=$rowDecoration['repeat']?>;
background-position:<?=$rowDecoration['horizontal_position']." ".$rowDecoration['vertical_position']?>;}
</style>
</head>
<body id="background">
<? if(isset($_SESSION['member'])){$member=$_SESSION['member'];}?>
<div id="nav">
  <div>
    <a href="<?=$rowSetting['website_name']?>" class="logo" title="<?=$rowSetting['title']?>"><img src="<?=$rowSetting['website_name']."/"?>image/<?=$rowDecoration['logo']?>" alt="<?=$rowSetting['title']?>" title="<?=$rowSetting['title']?>"/></a>
    <a href="ติดต่อเรา.html" title="ติดต่อเรา">ติดต่อเรา</a>
    <a href="เว็บบอร์ด-1.html" title="เว็บบอร์ด">เว็บบอร์ด</a>
    <a href="แจ้งการชำระเงิน.html" title="แจ้งการชำระเงิน">แจ้งการชำระเงิน</a>
    <a href="วิธีการสั่งซื้อ.html" title="วิธีการสั่งซื้อ">วิธีการสั่งซื้อ</a>
    <a href="โปรโมชั่น.html" title="โปรโมชั่น">โปรโมชั่น</a>
    <a href="ตะกร้าสินค้า.html" title="ตะกร้าสินค้า">ตะกร้าสินค้า</a>   
    <a href="รายการสินค้า-1.html" title="รายการสินค้า">รายการสินค้า</a>
    <a href="เกี่ยวกับเรา.html" title="เกี่ยวกับเรา">เกี่ยวกับเรา</a>
    <div style="clear:both;"></div>
  </div> 
</div>
<<!-- InstanceBeginEditable name="Slideshow" --><<!-- InstanceEndEditable -->
<div id="content">
  <div id="aside">
<? 
//ทั้งหมด
$sqlAll="SELECT * FROM product";
$resultAll=mysql_query($sqlAll)or die(mysql_error());
$numAll=mysql_num_rows($resultAll);
//หมวดสินค้า
$sqlCategory="SELECT category.id AS id, category.name AS name, COUNT(product.id) AS num_product FROM category LEFT JOIN product ON category.id=product.category_id WHERE category.id!=0 GROUP BY category.id ORDER BY category.name";
$resultCategory=mysql_query($sqlCategory)or die(mysql_error());
$numCategory=mysql_num_rows($resultCategory);
if($numCategory>1){
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>หมวดสินค้า</th>
  </tr>
  <tr>
    <td>
      <a href="รายการสินค้า-1.html" title="ทั้งหมด" style="display:block;">ทั้งหมด (<?=$numAll?>)</a><hr/>
<?
  for($i=1;$i<=$numCategory;$i++){$rowCategory=mysql_fetch_array($resultCategory);
?>
      <a href="หมวดหมู่-<?=$rowCategory['id']."-".rewrite_url($rowCategory['name'])."-1"?>.html" title="<?=$rowCategory['name']?>" style="display:block;"><?=$rowCategory['name']?> (<?=$rowCategory['num_product']?>)</a>
      <? if($i<$numCategory){echo"<hr/>";}?>
<?
  } 
  $sqlUncategory="SELECT * FROM product WHERE category_id=0";
  $resultUncategory=mysql_query($sqlUncategory)or die(mysql_error());
  $numUncategory=mysql_num_rows($resultUncategory);
  if($numUncategory>0){echo"<hr/><a href='หมวดหมู่-0-สินค้าไม่มีหมวดหมู่-1.html' title='สินค้าไม่ม่หมวดหมู่' style='display:block;'>สินค้าไม่มีหมวดหมู่ ($numUncategory)</a>";}
?> 
    </td>
  </tr>
</table>
<?
}
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>ตะกร้าสินค้าของคุณ</th>
  </tr>
  <tr>
    <td style="text-align:center;">
<? 
if(!empty($_SESSION['cart'])){$cart=$_SESSION['cart'];
  if(sizeof($cart)>0){  
    $sum=0;
    $quantity=0;
    foreach($cart as $cart_id=>$item){
    $sum+=$item['price']*$item['amount'];
    $quantity+=$item['amount'];
  } 
}
?>
      <?=$quantity?> ชิ้น ราคา <?=number_format($sum)?> บาท
      <input style="width:100%; margin-top:5px;" name="button" type="button" onclick="window.location='ตะกร้าสินค้า.html';" value="ดูรายละเอียด" />
<? 
} 
else{
?>
      ไม่มีสินค้าในตะกร้า
<? 
} 
?>
    </td>
  </tr>
</table>
<?
$sqlTop="SELECT * FROM product WHERE status='ขายดี' ORDER BY rand()  LIMIT 0,3";
$resultTop=mysql_query($sqlTop)or die(mysql_error());
$numTop=mysql_num_rows($resultTop);
if($numTop>0){
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>สินค้าขายดี</th>
  </tr>
  <tr>
    <td align="center">
<?
  for($i=1;$i<=$numTop;$i++){$rowTop=mysql_fetch_array($resultTop);
?>
<a href="สินค้า-<?=$rowTop['id']."-".rewrite_url($rowTop['name'])?>.html" class="top-seller">
  <img src="product/<?=$rowTop['image']?>" alt="<?=$rowTop['name']?>.html" title="<?=$rowTop['name']?>"/>
  <strong><?=mb_substr($rowTop['name'],0,35,'UTF-8')?></strong>
  <? if($rowTop['normal_price']>0){echo"<span class='discount'>".number_format($rowTop['normal_price'])."</span>";}?> 
  <span class="price"><?=number_format($rowTop['price'])?> บาท</span>
  <? 
  if($rowTop['discount']>0){
	echo"<img src='image/ribbon-left.png' class='ribbon-top-seller' alt='ลดราคา' title='ลดราคา'/>";
    echo"<span class='sale-top-seller'>-$rowTop[discount]%</span>";
  }
  ?>
</a>
<? if($i<$numTop){echo"<hr/>";}?>
      
<?
  }
?>
    </td>
  </tr>
</table>
<?
}
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>เฟสบุ๊ค</th>
  </tr>
  <tr>
    <td>
<div class="fb-like-box" data-href="<?=$rowSetting['facebook_fanpage']?>" data-width="187" data-height="300" data-show-faces="true" data-stream="false" data-header="false" data-border-color="#eee"></div> 
    </td>
  </tr>
</table> 
<?
$sqlTag="SELECT * FROM tag ORDER BY id DESC";
$resultTag=mysql_query($sqlTag)or die(mysql_error());
$numTag=mysql_num_rows($resultTag);
if($numTag>0){
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>แท็ก</th>
  </tr>
  <tr>
    <td style="padding-bottom:5px;line-height:28px;">
<?
for($i=1;$i<=$numTag;$i++){$rowTag=mysql_fetch_array($resultTag);
?>
  <a href="<?=$rowTag['link']?>" title="<?=$rowTag['name']?>" class="tag" style="font-size:14px;" target="_blank"><?=$rowTag['name']?></a>
<?
}
?>
    </td>
  </tr>
</table> 
<?
}
?>
  </div>

  <div id="section">
<<!-- InstanceBeginEditable name="EditRegion_1" -->
<form action="คำสั่งซื้อ.html" method="post" name="order"> 
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th style="text-align:left;">เลือกวิธีการจัดส่ง</th>
  </tr>
  <tr>
    <td>
<? 
$cart=$_SESSION['cart'];
?>
<table class="list" width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <th width="100" align="center">ภาพสินค้า</th>
    <th align="center">รายการสินค้า</th>
    <th width="65" align="center">ราคา</th>
    <th width="65" align="center">จำนวน</th>
    <th width="75" align="center">ราคารวม</th>
  </tr>
<? 
$i=0; 
$sum=0;
$quantity=0;
foreach($cart as $id=>$item){ 
?>
  <tr>
    <td align="center">
      <a href="สินค้า-<?=$item['id']."-".rewrite_url($item['name'])?>.html" target="_blank"><img src="product/<?=$item['image']?>" width="90" border="0"/></a>    </td>
    <td align="center"><?=$item['name']?><br/><?=$item['option']?></td>
    <td align="center"><?=number_format($item['price'])?></td>
    <td align="center"><?=$item['amount']?></td>
    <td align="right"><?=number_format($item["price"]*$item["amount"])?></td>
  </tr>
<? 	
$sum+=$item['price']*$item['amount'];
$quantity+=$item['amount'];
$i++;
}
?>
  <tr>
    <td colspan="4" align="right" style="background:#fafafa;">ราคารวม (บาท)</td>
    <td style="font-size:16px;background:#fafafa;" align="right"><input name="sum" type="hidden" value="<?=$sum?>"/><?=number_format($sum)?></td>
  </tr>
  <tr>
    <td colspan="5" align="right" style="background:#fafafa;">เลือกวิธีจัดส่ง
<select name="shipping">
<?
$sqlShipping="SELECT * FROM shipping";
$resultShipping=mysql_query($sqlShipping)or die(mysql_error());
$numShipping=mysql_num_rows($resultShipping);
for($i=1;$i<=$numShipping;$i++){$rowShipping=mysql_fetch_array($resultShipping);
?>
  <option value="<?=$rowShipping['id']?>"><?=$rowShipping['option']?> <? if($rowShipping['price']>0){echo $rowShipping['price'].'บาท';}?></option>
<?
}
?>
</select>
    </td>
  </tr>
</table>
<div align="center" style="padding:15px 0 0 0;">
  <input type="button"  onclick="window.location='ตะกร้าสินค้า.html'" value="กลับไปแก้ไข"/>
</div>
    </td>
  </tr>
</table>
<?
if(isset($_SESSION['member'])){
  $sqlMember="SELECT * FROM member WHERE username='$member'";
  $resultMember=mysql_query($sqlMember)or die(mysql_error());
  $rowMember=mysql_fetch_array($resultMember);
  $fullname=$rowMember['fullname'];
  $address=$rowMember['address'];
  $zipcode=$rowMember['zipcode'];
  $tel=$rowMember['tel'];
  $email=$rowMember['email'];
}
else{
  $fullname="";
  $address="";
  $tel="";
  $zipcode="";
  $email="";   
}
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th style="text-align:left;">ข้อมูลในการจัดส่ง</th>
  </tr>
  <tr>
    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="120">ชื่อ -นามสกุล ผู้รับ</td>
    <td><input type="text" name="fullname" required value="<?=$fullname?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <td>ที่อยู่</td>
    <td><textarea name="address" rows="5" required style="width:300px;max-width:500px;"><?=$address?></textarea></td>
  </tr>
  <tr>
    <td>รหัสไปรษณีย์</td>
    <td><input type="text" name="zipcode" required value="<?=$zipcode?>" style="width:60px;"/></td>
  </tr>
  <tr>
    <td>เบอร์ติดต่อ</td>
    <td><input type="text" name="tel" value="<?=$tel?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <td>อีเมล์</td>
    <td><input type="text" name="email" required value="<?=$email?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <td>หมายเหตุ</td>
    <td><textarea name="note" rows="5" style="width:300px;max-width:500px;"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="ยืนยันการสั่งซื้อ"/></td>
  </tr>
</table>
    </td>
  </tr>
</table>
</form>
<<!-- InstanceEndEditable -->
  </div> 
<!-- InstanceBeginEditable name="EditRegion_2" -->
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="EditRegion_3" -->
<<!-- InstanceEndEditable -->
<?
if($rowPlus['html_2']!=""){
?>
  <div id="section">
<div class="html2"><?=$rowPlus['html_2']?></div>
  </div>
<?
}
?>
  <div style="clear:both;"></div>
</div>

<div class="footer">
  <div style="float:left;">
    <h1><?=$rowSetting['title']?></h1>
  </div>
  <div style="float:right;">
    <?=$rowSetting['tel']?> <?=$rowSetting['email']?>
  </div>
  <br/>
  <hr/>
  <div>
    <a href="เกี่ยวกับเรา.html" title="เกี่ยวกับเรา">เกี่ยวกับเรา</a>&nbsp;    
    <a href="รายการสินค้า-1.html" title="รายการสินค้า">รายการสินค้า</a>&nbsp;
    <a href="โปรโมชั่น.html" title="โปรโมชั่น">โปรโมชั่น</a>&nbsp;
    <a href="ตะกร้าสินค้า.html" title="ตะกร้าสินค้า">ตะกร้าสินค้า</a>&nbsp;
    <a href="วิธีการสั่งซื้อ.html" title="วิธีการสั่งซื้อ">วิธีการสั่งซื้อ</a>&nbsp;   
    <a href="แจ้งการชำระเงิน.html" title="แจ้งการชำระเงิน">แจ้งการชำระเงิน</a>&nbsp;   
    <a href="บทความ-1.html" title="บทความ">บทความ</a>&nbsp;       
    <a href="เว็บบอร์ด-1.html" title="เว็บบอร์ด">เว็บบอร์ด</a>&nbsp;
    <a href="ติดต่อเรา.html" title="ติดต่อเรา">ติดต่อเรา</a>
    <a href="<?=$rowSetting['website_name']?>" title="<?=$rowSetting['title']?>"><img src="<?=$rowSetting['website_name']."/"?>image/<?=$rowDecoration['logo']?>" alt="<?=$rowSetting['title']?>" title="<?=$rowSetting['title']?>"/></a>
  </div>
</div>
<div class="stats" style="display:<?=$rowSetting['stats_display']?>;text-align:center">
  <?=$rowSetting['stats_script']?>
</div>
<?
function rewrite_url($url="url"){
  $url=strtolower(str_replace(" ","_",$url));
  $url=strtolower(preg_replace('~[^a-z0-9ก-๙\.\-\_]~iu','',$url));
  return $url;
}
mysql_close($conn);
?>
</body>
<!-- InstanceEnd --></html>
<script type="text/javascript">
(function(d,s,id){
  var js,fjs=d.getElementsByTagName(s)[0];
  if(d.getElementById(id))return;
  js=d.createElement(s);js.id=id;
  js.src="//connect.facebook.net/th_TH/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document,'script','facebook-jssdk'))
</script>