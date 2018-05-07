<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
//กันสแปม
if($_REQUEST['topic']!=""||$_REQUEST['name']!=""){echo"<script>document.location=document.referrer;</script>";exit();}
//เช็คค่า
if($_REQUEST['username']==""){echo"<script>alert('ยังไม่กรอกชื่อผู้โพสต์');history.back();</script>";exit();}
else if($_REQUEST['detail']==""){echo"<script>alert('ยังไม่กรอกรายละเอียด');history.back();</script>";exit();}
//เชื่อต่อฐานข้อมูล
include('connect.php');
$username=$_REQUEST['username'];
$detail=$_REQUEST['detail'];
$post_id=$_REQUEST['post_id'];
//เพิ่มลงฐานข้อมูล
$sql="INSERT INTO webboard_reply(post_id, detail, username, insert_date, last_update) VALUES($post_id, '$detail', '$username', now(), now())";
mysql_query($sql)or die(mysql_error());
echo"<script>document.location=document.referrer;</script>";
?>
</body>
</html>