<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
if($_REQUEST['subject']==""||$_REQUEST['detail']==""){echo"<script>alert('ยังกรอกข้อมูลไม่ครบ');history.back();</script>";exit;}
$subject=$_REQUEST['subject'];
$detail=$_REQUEST['detail'];
$email=$_REQUEST['email'];
$username=$_REQUEST['username'];
include('../../../process/connect.php');
$sql="INSERT INTO webboard_post(subject, detail, email, username, insert_date, last_update) VALUES('$subject', '$detail', '$email', '$username', now(), now())";
mysql_query($sql)or die(mysql_error());
$id=base64_encode(mysql_insert_id());
echo"<script>window.location='../../webboardEdit.php?id=$id';</script>";
?>
</body>
</html>