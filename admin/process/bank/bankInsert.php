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
if($_REQUEST['name']==""||$_REQUEST['account_number']==""||$_REQUEST['account_name']==""||$_REQUEST['branch']==""){echo"<script>alert('ยังกรอกข้อมูลไม่ครบ');history.back();</script>";exit();}
$name=$_REQUEST['name'];
$account_number=$_REQUEST['account_number'];
$account_name=$_REQUEST['account_name'];
$branch=$_REQUEST['branch'];
include('../../../process/connect.php');
$sql="INSERT INTO bank(name, account_number, account_name, branch, insert_date, last_update) VALUES(\"$name\", '$account_number', \"$account_name\", \"$branch\", now(), now())";
mysql_query($sql)or die(mysql_error());
echo"<script>document.location=document.referrer;</script>";
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>