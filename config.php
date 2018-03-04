<?php 
$kvdb = new SaeKV();
// 初始化KVClient对象
$kvdb->init();
$keys = array();     
array_push($keys, 'sys_domain');
array_push($keys, 'sys_sitename');
array_push($keys, 'sys_theme');
array_push($keys, 'sys_barTheme');
array_push($keys, 'sys_num');
$set = $kvdb->mget($keys); 

?>


// ! WordPress Mobi Reader  by  regou.me//
var WpMobiReader={};
WpMobiReader.rssurl="xml.php"; 
WpMobiReader.head="<?php echo $set["sys_sitename"];?>";
WpMobiReader.homeurl="<?php echo $set["sys_domain"];?>"; 
/*
Set your WordPress RSS URL 
if you want Cross Domain,
Add this to .htaccess file of your blog:

		Header set Access-Control-Allow-Origin *
	
*/
WpMobiReader.theme="<?php echo $set["sys_theme"];?>"; 
WpMobiReader.barTheme="<?php echo $set["sys_barTheme"];?>"; 
// Set your App theme (a~z)
// issue :   Change not effect Header&Footer

WpMobiReader.itemsperpage=<?php echo $set["sys_num"];?>; 
//Set your App that How many items you want to show  in every single Page

WpMobiReader.backbutton="后退";
//Back Button Text

WpMobiReader.commentbutton="评论";
//Comment Button Text

WpMobiReader.fullview="阅读全文";
//Read  article button Text

WpMobiReader.author="作者";
// Article Author  Text

WpMobiReader.comnum=" 个评论";
//Article Comments Number Text

WpMobiReader.nextPg="下一页";
WpMobiReader.prePg="上一页";
