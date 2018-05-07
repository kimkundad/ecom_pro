<?php
session_start();
include('process/connect.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/font.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<?php
//ตกแต่ง
$sqlDecoration="SELECT * FROM decoration";
$resultDecoration = $mysqli->query($sqlDecoration);
$rowDecoration=$resultDecoration->fetch_assoc();

//ข้อมูลร้าน
$sqlSetting="SELECT * FROM setting";
$resultSetting = $mysqli->query($sqlSetting);
$rowSetting=$resultSetting->fetch_assoc();


//ส่วนเสริม
$sqlPlus="SELECT * FROM plus";
$resultPlus = $mysqli->query($sqlPlus);
$rowPlus=$resultPlus->fetch_assoc();
?>
<link rel="shortcut icon" href="image/<?php=$rowDecoration['favicon']?>"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta http-equiv="content-language" content="th"/>
<meta name="robots" content="noodp, noydir"/>
<?php=$rowSetting['stats_meta']?>
<?php=$rowSetting['google_analytics']?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>เกี่ยวกับเรา | <?php=$rowSetting['title']?></title>
<meta name="description" content="<?php=mb_substr(strip_tags($rowSetting['about_us']),0,200,'UTF-8')?>"/>
<!-- InstanceEndEditable -->
<?php
if(empty($keyword)){echo"<meta name='keywords' content='$rowSetting[keyword]'/>";}
else if(!empty($keyword)){echo"<meta name='keywords' content='$keyword'/>";}
?>
<meta name="author" content="<?php=$rowSetting['author']?>"/>
<link href="css/design.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/scrolltopcontrol.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
#background{<?php if($rowDecoration['background_image']!=""){echo"background-image:url(image/$rowDecoration[background_image]);";}?>
background-color:<?php=$rowDecoration['background_color']?>;
background-attachment:<?php=$rowDecoration['attachment']?>;
background-repeat:<?php=$rowDecoration['repeat']?>;
background-position:<?php=$rowDecoration['horizontal_position']." ".$rowDecoration['vertical_position']?>;}
</style>
</head>
<body id="background">
<?php if(isset($_SESSION['member'])){$member=$_SESSION['member'];}?>
<div id="nav">
  <div>
    <a href="<?php $rowSetting['website_name']?>" class="logo" title="<?php $rowSetting['title']?>"><img src="<?php $rowSetting['website_name']."/"?>image/<?php $rowDecoration['logo']?>" alt="<?php $rowSetting['title']?>" title="<?php $rowSetting['title']?>"/></a>
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
<!-- InstanceBeginEditable name="Slideshow" --><!-- InstanceEndEditable -->
<div id="content">
  <div id="aside">
<?php
//ทั้งหมด
$sqlAll="SELECT * FROM product";
$resultAll = $mysqli->query($sqlAll); // ทำการ query คำสั่ง sql
$numAll=$resultAll->num_rows;
//หมวดสินค้า
$sqlCategory="SELECT category.id AS id, category.name AS name, COUNT(product.id) AS num_product FROM category LEFT JOIN product ON category.id=product.category_id WHERE category.id!=0 GROUP BY category.id ORDER BY category.name";
$resultCategory = $mysqli->query($sqlCategory); // ทำการ query คำสั่ง sql
$numCategory=$resultCategory->num_rows;
if($numCategory>1){
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>หมวดสินค้า</th>
  </tr>
  <tr>
    <td>
      <a href="รายการสินค้า-1.html" title="ทั้งหมด" style="display:block;">ทั้งหมด (<?php=$numAll?>)</a><hr/>
<?php
  for($i=1;$i<=$numCategory;$i++){$rowCategory=mysql_fetch_array($resultCategory);
?>
      <a href="หมวดหมู่-<?php=$rowCategory['id']."-".rewrite_url($rowCategory['name'])."-1"?>.html" title="<?php=$rowCategory['name']?>" style="display:block;"><?php=$rowCategory['name']?> (<?php=$rowCategory['num_product']?>)</a>
      <?php if($i<$numCategory){echo"<hr/>";}?>
<?php
  }
  $sqlUncategory="SELECT * FROM product WHERE category_id=0";
  $resultUncategory=mysql_query($sqlUncategory)or die(mysql_error());
  $numUncategory=mysql_num_rows($resultUncategory);
  if($numUncategory>0){echo"<hr/><a href='หมวดหมู่-0-สินค้าไม่มีหมวดหมู่-1.html' title='สินค้าไม่ม่หมวดหมู่' style='display:block;'>สินค้าไม่มีหมวดหมู่ ($numUncategory)</a>";}
?>
    </td>
  </tr>
</table>
<?php
}
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>ตะกร้าสินค้าของคุณ</th>
  </tr>
  <tr>
    <td style="text-align:center;">
<?php
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
      <?php=$quantity?> ชิ้น ราคา <?php=number_format($sum)?> บาท
      <input style="width:100%; margin-top:5px;" name="button" type="button" onclick="window.location='ตะกร้าสินค้า.html';" value="ดูรายละเอียด" />
<?php
}
else{
?>
      ไม่มีสินค้าในตะกร้า
<?php
}
?>
    </td>
  </tr>
</table>
<?php
$sqlTop="SELECT * FROM product WHERE status='ขายดี' ORDER BY rand()  LIMIT 0,3";
$resultTop = $mysqli->query($sqlTop);
$numTop=$resultTop->num_rows;
if($numTop>0){
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>สินค้าขายดี</th>
  </tr>
  <tr>
    <td align="center">
<?php
  for($i=1;$i<=$numTop;$i++){$rowTop=$resultTop->fetch_assoc();
?>
<a href="สินค้า-<?php=$rowTop['id']."-".rewrite_url($rowTop['name'])?>.html" class="top-seller">
  <img src="product/<?php=$rowTop['image']?>" alt="<?php=$rowTop['name']?>.html" title="<?php=$rowTop['name']?>"/>
  <strong><?php=mb_substr($rowTop['name'],0,35,'UTF-8')?></strong>
  <?php if($rowTop['normal_price']>0){echo"<span class='discount'>".number_format($rowTop['normal_price'])."</span>";}?>
  <span class="price"><?php=number_format($rowTop['price'])?> บาท</span>
  <?php
  if($rowTop['discount']>0){
	echo"<img src='image/ribbon-left.png' class='ribbon-top-seller' alt='ลดราคา' title='ลดราคา'/>";
    echo"<span class='sale-top-seller'>-$rowTop[discount]%</span>";
  }
  ?>
</a>
<?php if($i<$numTop){echo"<hr/>";}?>

<?php
  }
?>
    </td>
  </tr>
</table>
<?php
}
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>เฟสบุ๊ค</th>
  </tr>
  <tr>
    <td>
<div class="fb-like-box" data-href="<?php=$rowSetting['facebook_fanpage']?>" data-width="187" data-height="300" data-show-faces="true" data-stream="false" data-header="false" data-border-color="#eee"></div>
    </td>
  </tr>
</table>
<?php
$sqlTag="SELECT * FROM tag ORDER BY id DESC";
$resultTag = $mysqli->query($sqlTag);
$numTag=$resultTag->num_rows;
if($numTag>0){
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th>แท็ก</th>
  </tr>
  <tr>
    <td style="padding-bottom:5px;line-height:28px;">
<?php
for($i=1;$i<=$numTag;$i++){$rowTag=mysql_fetch_array($resultTag);
?>
  <a href="<?php=$rowTag['link']?>" title="<?php=$rowTag['name']?>" class="tag" style="font-size:14px;" target="_blank"><?php=$rowTag['name']?></a>
<?php
}
?>
    </td>
  </tr>
</table>
<?php
}
?>
  </div>

  <div id="section">
<!-- InstanceBeginEditable name="EditRegion_1" -->
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th class="header" style="text-align:left;">เกี่ยวกับเรา</th>
  </tr>
  <tr>
    <td><?php=$rowSetting['about_us']?></td>
  </tr>
</table>


<!-- InstanceEndEditable -->
  </div>
<!-- InstanceBeginEditable name="EditRegion_2" -->
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="EditRegion_3" -->
<!-- InstanceEndEditable -->
<?php
if($rowPlus['html_2']!=""){
?>
  <div id="section">
<div class="html2"><?php=$rowPlus['html_2']?></div>
  </div>
<?php
}
?>
  <div style="clear:both;"></div>
</div>

<div class="footer">
  <div style="float:left;">
    <h1><?php=$rowSetting['title']?></h1>
  </div>
  <div style="float:right;">
    <?php=$rowSetting['tel']?> <?php=$rowSetting['email']?>
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
  </div>
</div>
<div class="stats" style="display:<?php=$rowSetting['stats_display']?>;text-align:center">
  <?php=$rowSetting['stats_script']?>
</div>
<?php
function rewrite_url($url="url"){
  $url=strtolower(str_replace(" ","_",$url));
  $url=strtolower(preg_replace('~[^a-z0-9ก-๙\.\-\_]~iu','',$url));
  return $url;
}

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
