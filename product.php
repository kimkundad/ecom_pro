<?
session_start();
include('process/connect.php');
//รับค่า
if(empty($_REQUEST['id'])){echo"<script>history.back();</script>";exit;}
$id=$_REQUEST['id'];
//เพิ่มจำนวนผู้เข้าชม
if(!isset($_SESSION['username'])){
  $sql="UPDATE product SET view=(view+1) WHERE id=$id";
  mysql_query($sql)or die(mysql_error());
}
//สินค้า
$sql="SELECT * FROM product WHERE id=$id";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
$num=mysql_num_rows($result);
$keyword=$row['keyword'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><<!-- InstanceBegin template="/Templates/font.dwt.php" codeOutsideHTMLIsLocked="false" -->
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
<? if($num==0){echo"<script>window.location='รายการสินค้า-1.html';</script>";exit;}?>
<title><?=$row['name']?> | <?=$rowSetting['shop_name']?></title>
<meta name="description" content="<?=mb_substr(strip_tags($row['detail']),0,200,'UTF-8')?>"/>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/imagepanner.js"></script>
<script type="text/javascript" src="js/sagscroller.js"></script>
<script>var sagscroller2=new sagscroller({id:'mysagscroller2', mode:'auto', pause:2500, animatespeed:400})</script>
<script type="text/javascript" src="js/featuredcontentglider.js"></script>
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
    <div style="width:502px;float:left;">
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th style="text-align:left;"><?=$row['name']?>&nbsp;</th>
    </tr>
  <tr>
    <td style="padding:0;">
<script type="text/javascript">
featuredcontentglider.init({
  gliderid:"canadaprovinces", //ID of main glider container
  contentclass:"glidecontent", //Shared CSS class name of each glider content
  togglerid:"p-select", //ID of toggler container
  remotecontent:"", //Get gliding contents from external file on server? "filename" or "" to disable
  selected:0, //Default selected content index (0=1st)
  persiststate: false, //Remember last content shown within browser session (true/false)?
  speed:300, //Glide animation duration (in milliseconds)
  direction:"leftright", //set direction of glide: "updown", "downup", "leftright", or "rightleft"
  autorotate: true, //Auto rotate contents (true/false)?
  autorotateconfig: [60000*3, 0] //if auto rotate enabled, set [milliseconds_btw_rotations, cycles_before_stopping]
})
</script>
<div id="canadaprovinces" class="glidecontentwrapper">
<?
//รูป
$sqlImage="SELECT * FROM product_image WHERE product_id=$id";
$resultImage=mysql_query($sqlImage)or die(mysql_error());
$numImage=mysql_num_rows($resultImage);
for($i=1;$i<=$numImage;$i++){$rowImage=mysql_fetch_array($resultImage);
?>
  <div class="glidecontent">
    <div class="pancontainer" data-orient="center" data-canzoom="yes" style="width:502px;height:502px;">
      <div id="move">เลื่อนดูรายละเอียดเพิ่มเติม</div> 
      <img src="product/<?=$rowImage['image']?>" alt="<?=$row['name']?>"/>
    </div>
  </div>
<?
}
?>
</div>
      </td>
    </tr>
</table>

<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th style="text-align:left;">รายละเอียดสินค้า</th>
    </tr>
  <tr>
    <td>
<?
//สั่งซื้อ
$sqlOrder="SELECT SUM(amount) AS sum_amount FROM order_detail WHERE product_id=$id";
$resultOrder=mysql_query($sqlOrder)or die(mysql_error());
$rowOrder=mysql_fetch_array($resultOrder);
?>      
<span style="display:block;font-size:13px;">
  เข้าชม : <?=$row['view']?> |  สั่งซื้อไปแล้ว : <? if($rowOrder['sum_amount']>0){echo $rowOrder['sum_amount'];}else{echo 0;}?>    
</span>
<hr/><?=$row['detail']?><hr/>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50731b6c38d134ba"></script>
<!-- AddThis Button END -->
<div style="line-height:24px;">
<? 
if($row['keyword']!=""){
  echo "<hr/>ป้ายกำกับ : ";
  $tag=explode(',', $row['keyword']);
  foreach($tag as $keyword){
    echo"<a href='ค้นหาสินค้า-".rewrite_url(trim($keyword))."-1.html' title='".$keyword."' class='tag'>".$keyword."</a>";
   }
}
?>
</div>
    </td>
  </tr>
</table> 

<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th style="text-align:left;">สอบถามหรือแสดงความคิดเห็น</th>
    </tr>
  <tr>
    <td>
<div class="fb-comments" data-href="<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>" data-num-posts="10" data-width="482"></div>
    </td>
    </tr>
</table> 
    </div>
    <div style="width:200px;float:right;">
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>ภาพสินค้า</th>
  </tr>
  <tr>
    <td>
<div id="p-select" class="glidecontenttoggler">
<?
//รูป
$sqlImage="SELECT * FROM product_image WHERE product_id=$id";
$resultImage=mysql_query($sqlImage)or die(mysql_error());
$numImage=mysql_num_rows($resultImage);
for($i=1;$i<=$numImage;$i++){$rowImage=mysql_fetch_array($resultImage);
?>
<a href="#" class="toc"><img src="product/<?=$rowImage['image']?>" alt="<?=$row['name']?>"/></a>
<?
}
?>
</div>
<?
      echo"<hr/>";
?>
<div style="text-align:center;position:relative;">        
  <? if($row['normal_price']>0){echo"<span class='discount'>".number_format($row['normal_price'])."</span><br/>";}?>
  <span class="price"><?=number_format($row['price'])?> บาท</span>
  <? 
  if($row['discount']>0){
    echo"<img src='image/ribbon-right.png' id='ribbon-product' alt='ลดราคา' title='ลดราคา'/>";
    echo"<span id='sale-product'>-$row[discount]%</span>";
  }
  ?>
  <hr/> 
  <? if($row['status']=='หมด'){echo"<span class='out-of-stock'>สินค้าหมดชั่วคราว</span>";}?>
<form action="process/cartInsert.php" method="post" <? if($row['status']=='หมด'){echo"style='display:none;'";}?> >  
<?
$sqlOption="SELECT * FROM `product_option` WHERE product_id=$id AND name!=''";
$resultOption=mysql_query($sqlOption)or die(mysql_error());
$numOption=mysql_num_rows($resultOption);
if($numOption>0){
?>
  เลือกแบบสินค้าที่ต้องการ<br/>
  <select name="option" style="width:100%">
<?
  for($i=1;$i<=$numOption;$i++){$rowOption=mysql_fetch_array($resultOption);
?>
    <option value="<?=$rowOption['id']?>"><?=$rowOption['name']?></option>
<?
  }
?>
  </select>
  <hr/>
<?
}
else if($numOption==0){
  $sqlOption="SELECT * FROM `product_option` WHERE product_id=$id";
  $resultOption=mysql_query($sqlOption)or die(mysql_error());
  $rowOption=mysql_fetch_array($resultOption);
  echo"<input name='option' type='hidden' value='$rowOption[id]'/>";
}
?>    
  <input name="amount" type="hidden" value="1"/>
  <input name="id" type="hidden" value="<?=$id?>"/>
  <input type="submit" value="เพิ่มลงตระกร้า" style="width:100%;"/>
</form>
</div>
    </td>
    </tr>
</table>
<?
$sqlRelate="SELECT * FROM product WHERE category_id=$row[category_id] AND status!='หมด' ORDER BY rand() LIMIT 0,9";
$resultRelate=mysql_query($sqlRelate)or die(mysql_error());
$numRelate=mysql_num_rows($resultRelate);
if($numRelate>=3){
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>สินค้าที่เกี่ยวข้อง</th>
    </tr>
  <tr>
    <td>
<div id="mysagscroller2" class="sagscroller">
  <ul>
<?
  for($i=1;$i<=$numRelate;$i++){$rowRelate=mysql_fetch_array($resultRelate);
?>  
    <li>
      <a href="สินค้า-<?=$rowRelate['id']."-".rewrite_url($rowRelate['name'])?>.html">
        <img src="<?=$rowSetting['website_name']."/"?>product/<?=$rowRelate['image']?>" alt="<?=$rowRelate['name']?>" title="<?=$rowRelate['name']?>"/>
        <strong><?=$rowRelate['name']?></strong>
        <? if($rowRelate['normal_price']>0){echo"<span class='discount'>".number_format($rowRelate['normal_price'])."</span>";}?> 
        <span class="price"><?=number_format($rowRelate['price'])?> บาท</span>
      </a>
      <hr/>
    </li>
<?
  }
?>
  </ul>
</div>
      </td>
    </tr>
</table>
<?
}
?>
    </div>   
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
<?
if(isset($_SESSION['username'])){
?>
<a href="admin/productEdit.php?id=<?=base64_encode($id)?>" id="edit" target="_blank" title="แก้ไข"><img src="admin/image/edit-icon.png"/></a>
<?	
}
?>
<script type="text/javascript">
(function(d,s,id){
  var js,fjs=d.getElementsByTagName(s)[0];
  if(d.getElementById(id))return;
  js=d.createElement(s);js.id=id;
  js.src="//connect.facebook.net/th_TH/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document,'script','facebook-jssdk'))
</script>