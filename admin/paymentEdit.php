<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/back.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>ระบบหลังร้าน - แจ้งชำระเงิน</title>
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
<div style="width:962px; margin:20px auto 0 auto;text-align:right;">
  <input type="button" value="กลับ" onclick="window.location='payment.php'"/>
</div>
<?
$id=base64_decode($_REQUEST['id']);
$sql="SELECT * FROM payment WHERE id=$id";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
$num=mysql_num_rows($result);
if($num==0){echo"<script>window.location='payment.php';</script>";exit;}
?>
<table style="margin-top:10px;" class="data" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header" colspan="2" >รหัสคำสั่งซื้อที่แจ้งมา <?=$row['order_id']?></th>
  </tr>
  <tr>
    <td colspan="2">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="order">
  <tr>
    <td width="100">ชื่อ - สกุล</td>
    <td><?=$row['fullname']?></td>
  </tr>
  <tr>
    <td>อีเมล</td>
    <td><?=$row['email']?></td>
  </tr>
  <tr>
    <td>เบอร์ติดต่อ</td>
    <td><?=$row['tel']?></td>
  </tr>
  <tr>
    <td>จำนวนเงิน</td>
    <td><?=number_format($row['money'],2)?> บาท</td>
  </tr>
  <tr>
    <td>ธนาคาร</td>
    <td><?=$row['bank']?></td>
  </tr>
  <tr>
    <td>วันที่แจ้งโอน</td>
    <td><?=substr($row['payment_date'],0,16)?></td>
  </tr>
  <tr>
    <td>วันที่แจ้ง</td>
    <td><?=substr($row['insert_date'],0,16)?></td>
  </tr>
  <tr>
    <td>หมายเหตุ</td>
    <td><? if($row['note']==""){$row['note']="-";}?><?=$row['note']?></td>
  </tr>
</table> 
    </td>
  </tr>
</table>

<table class="data" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th class="header">
      แก้ไขสถานะการแจ้งชำระเงิน
<div style="float:right;">
  <a href="process/payment/paymentDelete.php?id=<?=base64_encode($row['id'])?>" onclick="return confirm('ลบรายการแจ้งชำระเงินของคุณ <?=$row['fullname']?> ?')"><img src="image/icon-bin.png"class="action" title="ลบ"/></a>
</div>
    </th>
  </tr>
  <tr>
    <td colspan="2">
<form action="process/payment/paymentUpdate.php" method="post" name="order">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="100">สถานะ</td>
    <td>
      <select name="status">
      <?
      $statusList=array('รอตรวจสอบ','อนุมัติ','ปฏิเสธ');
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
    <td><input name="id" type="hidden" value="<?=base64_encode($id)?>"/></td>
    <td><input type="submit" value="บันทึก"/></td>
  </tr>
</table>
</form>  
    </td>
  </tr>
</table>

<?
$sqlOrder="SELECT * FROM `order` WHERE id=$row[order_id] ORDER BY id DESC";
$resultOrder=mysql_query($sqlOrder)or die(mysql_error());
$numOrder=mysql_num_rows($resultOrder);
?>
<table class="list" align="center" cellpadding="10" cellspacing="0" >
  <tr>
    <th width="50" class="header">รหัส</th>
    <th class="header">ชื่อ - นามสกุล</th>
    <th width="100" class="header">จำนวนเงิน</th>
    <th width="120" class="header">สถานะ</th>
    <th width="120" class="header">วันที่สั่งซื้อ</th>
    <th width="150" class="header">จัดการ</th>
  </tr>
<?
if($numOrder>0){
  for($i=1;$i<=$numOrder;$i++){$rowOrder=mysql_fetch_array($resultOrder);
?>
  <tr>
    <td align="center"><?=$rowOrder['id']?></td>
    <td align="center">
	  <?=$rowOrder['fullname']?><br/>
	  <? if($rowOrder['member_id']!=0){?>
        <a href='memberEdit.php?id=<?=base64_encode($rowOrder['member_id'])?>' class="member" target="_blank">สมาชิก</a>
	  <? }?>
    </td>
    <td align="center"><?=number_format($rowOrder['total'],2)?></td>
    <td align="center"><?=$rowOrder['status']?></td>
    <td align="center"><?=substr($rowOrder['insert_date'],0,16)?></td>
    <td align="center" style="background:#f9f9f9">
      <a href="orderEdit.php?id=<?=base64_encode($rowOrder['id'])?>" target="_blank"><img src="image/icon-view-list.png" class="action" title="ดูรายละเอียด"/></a>
      <a href="process/order/orderUpdate.php?id=<?=base64_encode($rowOrder['id'])?>&ems=<?=$rowOrder['ems']?>&status=ชำระเงินแล้ว&keyword=<?=$keyword?>&page=<?=$page?>"><img src="image/icon-money.png" class="action" title="ชำระเงินแล้ว"/></a>
      <a href="process/order/orderUpdate.php?id=<?=base64_encode($rowOrder['id'])?>&ems=<?=$rowOrder['ems']?>&status=จัดส่งแล้ว&keyword=<?=$keyword?>&page=<?=$page?>"><img src="image/icon-truck.png" class="action" title="จัดส่งแล้ว"/></a>
      <a href="process/order/orderDelete.php?id=<?=base64_encode($rowOrder['id'])?>&status=จัดส่งแล้ว&keyword=<?=$keyword?>&page=<?=$page?>" onclick="return confirm('ลบรหัสคำสั่งซื้อ <?=$rowOrder['id']?> ?')"><img src="image/icon-bin.png"class="action" title="ลบ"/></a>    
    </td>
  </tr>
<?
  }
}
else if($numOrder==0){
?>
  <tr>
    <td colspan="6" align="center">ไม่มีข้อมูล</td>
  </tr>
<?
}
?>
  <tr>
    <th class="footer" colspan="7">จำนวน : <?=$numOrder?></th>
  </tr>
</table>
<div style="width:962px; margin:10px auto 0 auto;text-align:left;">
  <input type="button" value="กลับ" onclick="window.location='payment.php'"/>
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