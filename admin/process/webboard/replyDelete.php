<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
if($_REQUEST['id']==""){echo"<script>history.back();</script>";exit;}
$id=base64_decode($_REQUEST['id']);
include('../../../process/connect.php');
$sql="DELETE FROM webboard_reply WHERE id=$id";
mysql_query($sql)or die(mysql_error());
echo"<script>document.location=document.referrer;</script>";
?>
</body>
</html>