<?php
require(dirname(__FILE__)."/../include/common.inc.php");
include_once("mail.inc.php");

$mailto=$cfg_adminmail;//收件人信箱
$mailsubject="【味蕾留言板】来自".$_POST["name"]."的网站留言";
$mailfrom=$_POST["name"];
$mailbody="姓名：".$_POST["name"]."<br>";
	$mailbody=$mailbody."公司：".$_POST["firm"]."<br>";
	$mailbody=$mailbody."地址：".$_POST["addr"]."<br>";
	$mailbody=$mailbody."電話：".$_POST["phone"]."<br>";
	$mailbody=$mailbody."傳真：".$_POST["fax"]."<br>";
	$mailbody=$mailbody."郵編：".$_POST["code"]."<br>";
	$mailbody=$mailbody."電郵：".$_POST["mail"]."<br>";
	$mailbody=$mailbody."内容：".$_POST["content"]."<br>";
//其他的表单项目以此类推
$mailtype 		= 	"HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
$mailsubject 	= 	'=?UTF-8?B?'.base64_encode($mailsubject).'?=';//邮件主题
$mailfrom  	= 	'=?UTF-8?B?'.base64_encode($mailfrom).'?=';//发件人
if($cfg_sendmail_bysmtp == 'Y' && !empty($cfg_smtp_server))
	{
$smtp = new smtp($cfg_smtp_server,$cfg_smtp_port,true,$cfg_smtp_usermail,$cfg_smtp_password,$cfg_smtp_usermail);//发件人信箱信息
$smtp->debug = false;//是否显示发送的调试信息 FALSE or TRUE
$smtp->sendmail($mailto, $mailfrom, $mailsubject, $mailbody, $mailtype);
echo "<script language=\"JavaScript\">alert(\"您的留言已成功发送，请按确认键返回留言板.\"); location.replace(document.referrer); </script>"; exit();}
else
	{
		echo "<script language=\"JavaScript\">alert(\"网站暂时没有开启留言功能，您的信息失败.\"); location.replace(document.referrer); </script>"; exit();}
		
?>  
