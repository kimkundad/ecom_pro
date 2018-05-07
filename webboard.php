<?
session_start();
include('process/connect.php');
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
<title>เว็บบอร์ด | <?=$rowSetting['title']?></title>
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
<?
//กำหนดแถวและคอลัมน์
$num_col=1;
$num_row=15;
//เรคคอร์ดที่สิ้นสุด
$page_size=$num_col*$num_row;
//กำหนดค่าเริ่มต้น
$page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
$page=$page-1;
//หาจำนวนหน้า
$sql="SELECT COUNT(*) FROM webboard_post";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
$num=$row['COUNT(*)'];
//หมายเลขหน้า
$num_page=ceil($num/$page_size);
//เรคคอร์ดที่เริ่ม
$start_record=$page*$page_size;
//เลือกข้อมูล
$sql="SELECT webboard_post.id AS id, webboard_post.subject AS subject, webboard_post.username AS username, webboard_post.email AS email,  webboard_post.insert_date AS insert_date, webboard_reply.post_id AS post_id, COUNT(webboard_reply.post_id) AS num_reply FROM webboard_post LEFT JOIN webboard_reply ON webboard_post.id = webboard_reply.post_id GROUP BY webboard_post.id ORDER BY webboard_post.id DESC LIMIT $start_record, $page_size";
$result=mysql_query($sql)or die(mysql_error());
$num=mysql_num_rows($result);
?>
<table class="box" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th class="header" style="text-align:left;">เว็บบอร์ด</th>
  </tr>
  <tr>
    <td>  
<table class="list" align="center" cellpadding="5" cellspacing="1" >
  <tr>
    <th class="list">หัวข้อ</th>
    <th class="list" width="80">ตอบ</th>
    <th class="list" width="100">ผู้โพสต์</th>
    <th class="list" width="120">วันที่โพสต์</th>
  </tr>
<?
if($num==0){
?>
    <td align="center" colspan="5">ไม่มีข้อมูล</td>
<?
}
for($i=0;$row=mysql_fetch_array($result);$i++){ 
  if($i%$num_col==0){
?>
  <tr>
<?
    }		
?>
    <td valign="middle" class="list"><a href="เว็บบอร์ด-<?=$row['id']."-".rewrite_url($row['subject'])?>.html"><?=$row['subject']?></a></td>
    <td align="center" valign="middle"><?=number_format($row['num_reply'])?></td>
    <td align="center" valign="middle"><?=$row['username']?></td>
    <td align="center" valign="middle"><?=substr($row['insert_date'],0,16)?></td>
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
  <td colspan="5" align="center">โค้ดหรือข้อความเมื่อเหลือพื้นที่แสดง</td>
<? 
  }
}
if($i%$num_col!=0){
?>
  </tr>
<?
}
?>
</table>

    </td>
  </tr>
</table>
<!-- InstanceEndEditable -->
  </div> 
<!-- InstanceBeginEditable name="EditRegion_2" -->
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="EditRegion_3" -->
  <div id="page">
<hr/>
<?
if($page>0){
?>
  <input type="button" value="ก่อนหน้า" onclick="window.location='เว็บบอร์ด-<?=$page?>.html'"/>
<? 
}  
for($i=0;$i<$num_page;$i++){ 
  if($i==$page){
?>
  <span class="number-selected"><?=$i+1?></span>
<?  
} 
  else{ 
?>
    <a href="เว็บบอร์ด-<?=$i+1?>.html" class="number"><?=$i+1?></a>
<?   
  }
}
if($page<$num_page-1){
?>
  <input type="button" value="ถัดไป" onclick="window.location='เว็บบอร์ด-<?=$page+2?>.html'"/>
<? 
}
?>
<hr/>
  </div>
  <div id="section">
<?
if(isset($_SESSION['member'])){
  $sqlMember="SELECT * FROM member WHERE username='$member'";
  $resultMember=mysql_query($sqlMember)or die(mysql_error());
  $rowMember=mysql_fetch_array($resultMember);
  $username=$rowMember['username'];
  $email=$rowMember['email'];
}
else{
  $username="";
  $email=""; 
}
?>
<table class="box" style="margin-top:10px;" width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <th class="header" style="text-align:left;">ตั้งหัวข้อใหม่</th>
  </tr>
  <tr>
    <td>
<form name="webboard" method="post" action="process/post.php">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="100">หัวข้อ</td>
    <td>
      <input type="text" name="subject" required style="width:485px;"/>
      <input type="text" name="topic" style="display:none;"/>
    </td>
  </tr>
  <tr>
    <td>รายละเอียด</td>
    <td>
      <div style="overflow:inherit;width:620px;">
        <textarea name="detail"></textarea>
      </div>
    </td>
  </tr>
  <tr>
    <td>อีเมล์</td>
    <td><input type="text" name="email" value="<?=$email?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <td>ชื่อ</td>
    <td>
      <input type="text" name="username" required value="<?=$username?>" style="width:200px;"/>
      <input type="text" name="name" style="display:none;"/>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="ส่งข้อมูล" /></td>
  </tr>
</table>
</form>  
    </td>
  </tr>
</table>
  </div>
<!-- InstanceEndEditable -->
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

<script type="text/javascript">
CKEDITOR.replace('detail',{   
  skin:'kama',width:'500',height:'100',enterMode:Number(2),toolbar:[
    ['Bold','Italic','Underline'],,
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink'],
    ['Image','Smiley'],
    ['TextColor','BGColor'],
  ]		
});
document.webboard.subject.focus();
</script>