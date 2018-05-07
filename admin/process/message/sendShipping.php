<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/backProcess.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<?
//เช็คล็อกอิน
if(isset($_SESSION['username'])){$username=$_SESSION['username'];}
else if(!isset($_SESSION['username'])){echo"<script>alert('ยังไม่เข้าสู่ระบบ');window.location='../../../admin/index.php';</script>";exit;}
?>
<!-- InstanceBeginEditable name="EditRegion" -->
<?
$id=base64_decode($_REQUEST['id']);
include('../../../process/connect.php');
//ข้อมูลร้าน
$sqlSetting="SELECT * FROM setting";
$resultSetting=mysql_query($sqlSetting)or die(mysql_error());
$rowSetting=mysql_fetch_array($resultSetting);
//คำสั่งซื้อ
$sql="SELECT * FROM `order` WHERE id=$id";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
if($row['ems']==""){echo"<script>alert('ยังไม่มีหมายเลขพัสดุ');history.back();</script>";exit;}
if($row['email']==''){echo"<script>alert('คำสั่งซื้อไม่ได้ระบุอีเมล์');history.back();</script>";exit;}
if($row['member_id']!=0){
  $sqlMember="SELECT * FROM member WHERE id=$row[member_id]";
  $resultMember=mysql_query($sqlMember)or die(mysql_error());
  $rowMember=mysql_fetch_array($resultMember);
  $fullname=$rowMember['fullname'];
}
else if($row['member_id']==0){
  $fullname=$row['fullname'];	
}
//ข้อความ
$header="MIME-Version: 1.0\r\n";  
$header.="Content-type: text/html; charset=utf-8\r\n";
$header.="From: $rowSetting[shop_name] <$rowSetting[email]>\r\n";
$header.="Reply-To: $rowSetting[email]";
$subject="แจ้งหมายเลขพัสดุ (รหัสคำสั่งซื้อ $row[id])";
$message="เรียนคุณ $fullname<br/>";
$message.="แจ้งหมายเลขพัสดุ โดยมีรายละเอียดดังนี้<br/><br/>";
$message.="
<table bgcolor='#e5e5e5' width='100%' border='0' align='center' cellpadding='5' cellspacing='1'>
  <tr>
    <th width='150' align='left' bgcolor='#fafafa'>รหัสคำสั่งซื้อ</th>
    <td align='left' bgcolor='#fff'>$row[id]</td>
  </tr>
  <tr>
    <th align='left' bgcolor='#fafafa'>หมายเลขพัสดุ</th>
    <td align='left' bgcolor='#fff'>$row[ems]</td>
  </tr>
</table><br/><br/>  
";
$message.="ตรวจสอบสถานะการจัดส่งของได้ <a href='http://track.thailandpost.co.th/trackinternet/Default.aspx'>คลิกที่นี่</a><br/><br/>";
$message.="ขอขอบคุณที่อุดหนุนและใช้บริการกับเรา<br/>";
$message.="$rowSetting[shop_name]";
//ส่งเมล์
if(mail($row['email'], $subject, $message, $header)){$error="alert('ส่งอีเมล์เรียบร้อย');";}
else{$error="alert('ส่งอีเมล์ผิดพลาด กรุณาทำการส่งใหม่');";}
echo"<script>$error;document.location=document.referrer;</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>