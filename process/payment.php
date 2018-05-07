<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
//เช็คชื่อ-นามสกุล
if($_REQUEST['fullname']==""){echo"<script>alert(ยังไม่กรอกชื่อ-นามสกุล);history.back();</script>";exit();}
//เช็คอีเมล์
else if($_REQUEST['email']==""){echo"<script>alert(ยังไม่กรอกอีเมล์);history.back();</script>";exit();}
else if(!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)){echo"<script>alert('รูปแบบอีเมลล์ผิด');history.back();</script>";exit();}
//เช็คจำนวนเงิน
else if($_REQUEST['money']==""){echo"<script>alert('ยังไม่กรอกจำนวนเงิน');history.back();</script>";exit();}
else if(!is_numeric($_REQUEST['money'])){echo"<script>alert('รูปแบบจำนวนเงินไม่ถูกต้อง');history.back();</script>";exit();}
//แปลงค่า
$order_id=$_REQUEST['order_id'];
if($order_id==""){$order_id=0;}
$fullname=$_REQUEST['fullname']; 
$tel= $_REQUEST['tel'];
$email=$_REQUEST['email'];
$money=$_REQUEST['money'];
$bank=$_REQUEST['bank'];
$money_mail=number_format($money,2);
$payment_date=$_REQUEST['payment_date'].' '.$_REQUEST['hour'].':'.$_REQUEST['minute'].':00';
$note=$_REQUEST['note'];
//เชื่อมต่อฐานข้อมูล
include('connect.php'); 
//เพิ่มลงฐานข้อมูล
$sql="INSERT INTO payment(order_id, fullname, email, tel, money, bank, payment_date, status, note, insert_date, last_update) VALUES($order_id, \"$fullname\", '$email', \"$tel\", '$money', \"$bank\", '$payment_date', 'รอตรวจสอบ', \"$note\", now(), now())";
mysql_query($sql)or die(mysql_error());
//ข้อมูลร้าน
$sqlSetting="SELECT * FROM setting";
$resultSetting=mysql_query($sqlSetting)or die(mysql_error());
$rowSetting=mysql_fetch_array($resultSetting);
//ข้อความ
$header="MIME-Version: 1.0\r\n";  
$header.="Content-type: text/html; charset=utf-8\r\n";
$header.="From: $fullname <$email>\r\n";
$header.="Reply-To: $email";
$subject="มีรายการแจ้งชำระเงินใหม่จาก $rowSetting[shop_name]";
$message="มีรายการแจ้งชำระเงินจากคุณ $fullname โดยมีรายละเอียดดังนี้";
$message.="<br/><br/>
<table bgcolor='#e5e5e5' width='100%' border='0' align='center' cellpadding='5' cellspacing='1'>
  <tr>
    <th width='150' align='left' bgcolor='#fafafa'>รหัสคำสั่งซื้อ</th>
    <td align='left' bgcolor='#fff'>$order_id</td>
  </tr>
  <tr>
    <th align='left' bgcolor='#fafafa'>เบอร์ติดต่อ</th>
    <td align='left' bgcolor='#fff'>$tel</td>
  </tr>
  <tr>
    <th align='left' bgcolor='#fafafa'>จำนวนเงิน</th>
    <td align='left' bgcolor='#fff'>$money_mail บาท</td>
  </tr>
  <tr>
    <th align='left' bgcolor='#fafafa'>ธนาคารที่โอน</th>
    <td align='left' bgcolor='#fff'>$bank</td>
  </tr>
  <tr>
    <th align='left' bgcolor='#fafafa'>วันและเวลาที่โอน</th>
    <td align='left' bgcolor='#fff'>$payment_date</td>
  </tr>
  <tr>
    <th align='left' bgcolor='#fafafa'>หมายเหตุ</th>
    <td align='left' bgcolor='#fff'>$note</td>
  </tr>
</table>
<br/<br/>";
//ส่งเมล์
mail($rowSetting['email'], $subject, $message, $header);
echo"<script>alert('รับข้อมูลเรียบร้อย');document.location=document.referrer;</script>";
?>
</body>
</html>