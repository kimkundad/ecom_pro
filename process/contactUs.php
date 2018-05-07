<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
//กันสแปม
if($_REQUEST['topic']!=""||$_REQUEST['name']!=""){echo"<script>document.location=document.referrer;</script>";exit;}
//เช็คค่า
if($_REQUEST['subject']==""||$_REQUEST['detail']==""||$_REQUEST['email']==""||$_REQUEST['username']==""){
  echo"<script>alert('ยังกรอกข้อมูลไม่ครบ');history.back();</script>";exit;
}
else if(!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)){echo"<script>alert('รูปแบบอีเมลล์ผิด');history.back();</script>";exit();}
//รับค่า
$subject=$_REQUEST['subject'];
$detail=$_REQUEST['detail'];
$email=$_REQUEST['email'];
$username=$_REQUEST['username'];
//เชื่อมต่อฐานข้อมููล
include('connect.php');
//ข้อมูลร้าน
$sql="SELECT * FROM setting";
$result=mysql_query($sql)or die(mysql_error());
$row=mysql_fetch_array($result);
//ข้อความ
$header="MIME-Version: 1.0\r\n";  
$header.="Content-type: text/html; charset=utf-8\r\n";
$header.="From: $username <$email>\r\n";
$header.="Reply-To: $email";
$topic="มีข้อความจากร้าน $row[shop_name]";
$message="<br/><br/>
<table bgcolor='#e5e5e5' width='100%' border='0' align='center' cellpadding='5' cellspacing='1'>
  <tr>
    <th width='150' align='left' bgcolor='#fafafa'>เรื่อง</th>
    <td align='left' bgcolor='#fff'>$subject</td>
  </tr>
  <tr>
    <th align='left' bgcolor='#fafafa'>รายละเอียด</th>
    <td align='left' bgcolor='#fff'>$detail</td>
  </tr>
  <tr>
    <th align='left' bgcolor='#fafafa'>จากคุณ</th>
    <td align='left' bgcolor='#fff'>$username</td>
  </tr>
</table>
<br/><br/>";
//ส่งเมล์
mail($row['email'], $topic, $message, $header);
echo"<script>alert('รับข้อมูลเรียบร้อย');document.location=document.referrer;</script>";
?>
</body>
</html>