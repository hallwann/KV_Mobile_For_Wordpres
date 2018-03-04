<?php //抓取页面
header("Content-type: text/xml");
$kvdb = new SaeKV();
$init = $kvdb->init();
$url = $kvdb->get('sys_domain');
if($init== true){
  if($url !=""){	
   $update = time()-60*60*$kvdb->get('sys_uptime');
   if($kvdb->get('sys_addtime') <= $update){
	$fetchcontent = new SaeFetchurl();
    $fcontent = $fetchcontent->fetch($url."/?feed=rss2");
    if($fetchcontent->errno() != 0)  {$content= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<rss version=\"2.0\"
	xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"
	xmlns:wfw=\"http://wellformedweb.org/CommentAPI/\"
	xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
	xmlns:atom=\"http://www.w3.org/2005/Atom\"
	xmlns:sy=\"http://purl.org/rss/1.0/modules/syndication/\"
	xmlns:slash=\"http://purl.org/rss/1.0/modules/slash/\"
	>

<channel><item><title>Error</title><pubDate>".date("Y-m-d H:i:s", time())."</pubDate><link>?p=Error</link><guid isPermaLink=\"false\">?p=Error</guid><content:encoded><![CDATA[".$fetchcontent->errmsg()."]]></content:encoded></item></channel>
</rss>";}else{
       
	    $xml = str_replace("'","\'",$fcontent);
        $kvdb->set('sys_xml',$xml);
		$kvdb->set('sys_addtime',time());
	    $content = $kvdb->get('sys_xml');
	 }
	}else{$content = $kvdb->get('sys_xml');}
 }else{$content= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<rss version=\"2.0\"
	xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"
	xmlns:wfw=\"http://wellformedweb.org/CommentAPI/\"
	xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
	xmlns:atom=\"http://www.w3.org/2005/Atom\"
	xmlns:sy=\"http://purl.org/rss/1.0/modules/syndication/\"
	xmlns:slash=\"http://purl.org/rss/1.0/modules/slash/\"
	>

<channel><item><title>Error</title><pubDate>".date("Y-m-d H:i:s", time())."</pubDate><link>?p=InstallError</link><guid isPermaLink=\"false\">?p=InstallError</guid><content:encoded><![CDATA[主域名未设置，请初始化数据，并设定主域名。]]></content:encoded></item></channel>
</rss>";}
}else{
$content= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<rss version=\"2.0\"
	xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"
	xmlns:wfw=\"http://wellformedweb.org/CommentAPI/\"
	xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
	xmlns:atom=\"http://www.w3.org/2005/Atom\"
	xmlns:sy=\"http://purl.org/rss/1.0/modules/syndication/\"
	xmlns:slash=\"http://purl.org/rss/1.0/modules/slash/\"
	>

<channel><item><title>Error</title><pubDate>".date("Y-m-d H:i:s", time())."</pubDate><link>?p=DbError</link><guid isPermaLink=\"false\">?p=DbError</guid><content:encoded><![CDATA[数据库连接失败，请初始化KVDB，并从新安装程序。]]></content:encoded></item></channel>
</rss>";
}
echo $content;
?>

