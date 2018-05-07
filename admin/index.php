<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ระบบหลังร้าน</title>
</head>
<body>
<form name="login" method="post" action="process/login.php">  
<table border="0" align="center" cellpadding="15" cellspacing="0" class="login">
  <tr>
    <td>
    
<table width="100%" border="0" align="center" cellpadding="8" cellspacing="0">
  <tr>
    <td>ชื่อผู้ใช้<br /><input name="username" type="text" required/></td>
  </tr>
  <tr>
    <td>รหัสผ่าน<br /><input name="password" type="password" required/></td>
  </tr>
  <tr>
    <td align="right"><input type="submit" value="เข้าสู่ระบบ" /></td>
  </tr>
</table>
</td>
  </tr>
</table>
</form>
<div class="link"><a href="#" target="_blank"></a></div>
</body>
</html>
<script type="text/javascript">
document.login.username.focus();
</script>
<style type="text/css">
body{ background:#fcfcfc;}
table.login{margin:150px auto 20px auto;background:#fff;color:#999;width:270px;
border:solid 1px #ebebeb;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;
box-shadow:0 5px 10px rgba(235,235,235,.9);
-moz-box-shadow:0 5px 10px rgba(235,235,235,.9);
-webkit-box-shadow:0 5px 10px rgba(235,235,235,.9);}
input[type="text"],input[type="password"]{font:normal 20px Tahoma;padding:5px;outline:0px;border:solid 1px #dfdfdf;width:245px;background:#fcfcfc;
-moz-border-radius:2px;-webkit-order-radius:2px;border-radius:2px;
box-shadow:0 0 3px rgba(235,235,235,0.9)inset;
-moz-box-shadow:0 0 3px rgba(235,235,235,0.9)inset;
-webkit-box-shadow:0 0 3px rgba(235,235,235,0.9)inset;}
input[type="text"]:focus ,input[type="password"]:focus{border:solid 1px #ccc;}
input[type="submit"], input[type="button"]{text-decoration:none;color:#333;font:normal 12px Tahoma;color:#333;padding:8px;border:solid 1px #dfdfdf;
-moz-border-radius:2px;-webkit-order-radius:2px;border-radius:2px;
background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
background:-moz-linear-gradient(top,#f9f9f9, #ececec);
filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9',endColorstr='#ececec');}
input[type="submit"]:hover, input[type="button"]:hover{border:solid 1px #ccc;cursor:pointer;}
input[type="submit"]:active, input[type="button"]:active{
background:-webkit-gradient(linear,left top,left bottom,from(#ececec),to(#f9f9f9));
background:-moz-linear-gradient(top,#ececec, #f9f9f9);
filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ececec',endColorstr='#f9f9f9');}
div.link{margin:auto;text-align:center;}
div.link a{font:normal 12px Tahoma;text-decoration:none;color:#ccc;}
div.link a:hover{color:#ddd;}
</style>