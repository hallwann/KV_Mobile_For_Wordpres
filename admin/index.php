<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>KV Mobile For Wordpress by howwant.com</title>
<meta name="description" content="Administry - Admin Template by www.865171.cn" />
<meta name="keywords" content="Admin,Template" />
<!-- Favicons --> 
<link rel="shortcut icon" type="image/png" HREF="img/favicons/favicon.png"/>
<link rel="icon" type="image/png" HREF="img/favicons/favicon.png"/>
<link rel="apple-touch-icon" HREF="img/favicons/apple.png" />
<!-- Main Stylesheet --> 
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!-- Colour Schemes
Default colour scheme is blue. Uncomment prefered stylesheet to use it.
<link rel="stylesheet" href="css/brown.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/gray.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/green.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/pink.css" type="text/css" media="screen" />  
<link rel="stylesheet" href="css/red.css" type="text/css" media="screen" />
-->
<!-- Your Custom Stylesheet --> 
<link rel="stylesheet" href="css/custom.css" type="text/css" />
<!--swfobject - needed only if you require <video> tag support for older browsers -->
<script type="text/javascript" SRC="js/swfobject.js"></script>
<!-- jQuery with plugins -->
<script type="text/javascript" SRC="js/jquery-1.4.2.min.js"></script>
<!-- Could be loaded remotely from Google CDN : <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
<script type="text/javascript" SRC="js/jquery.ui.core.min.js"></script>
<script type="text/javascript" SRC="js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" SRC="js/jquery.ui.tabs.min.js"></script>
<!-- jQuery tooltips -->
<script type="text/javascript" SRC="js/jquery.tipTip.min.js"></script>
<!-- Superfish navigation -->
<script type="text/javascript" SRC="js/jquery.superfish.min.js"></script>
<script type="text/javascript" SRC="js/jquery.supersubs.min.js"></script>
<!-- jQuery popup box -->
<script type="text/javascript" SRC="js/jquery.nyroModal.pack.js"></script>
<!-- jQuery form validation -->
<script type="text/javascript" SRC="js/jquery.validate_pack.js"></script>
<!-- Internet Explorer Fixes --> 
<!--[if IE]>
<link rel="stylesheet" type="text/css" media="all" href="css/ie.css"/>
<script src="js/html5.js"></script>
<![endif]-->
<!--Upgrade MSIE5.5-7 to be compatible with MSIE8: http://ie7-js.googlecode.com/svn/version/2.1(beta3)/IE8.js -->
<!--[if lt IE 8]>
<script src="js/IE8.js"></script>
<![endif]-->
<script type="text/javascript">
$(document).ready(function(){

	
	// validate form on keyup and submit
	var validator = $("#sampleform").validate({
		rules: {
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},		
			domain: {
				required: true,
				url: true
			},
			sitename: "required",			
		},
		messages: {
			username: {
				required: "请输入用户名",
				minlength: jQuery.format("至少输入 {0} 个字符")
			},
			password: {
				required: "请输入密码",
				rangelength: jQuery.format("至少输入 {0} 个字符")
			},
			confirm_password: {
				required: "重新输入密码",
				minlength: jQuery.format("至少输入 {0} 个字符"),
				equalTo: "与原密码不一致"
			},
			domain: {
				required: "请输入正确网址",
				minlength: "请输入正确网址"
			},	
			sitename: "请输入网站名称",			
		},
		// the errorPlacement has to take the layout into account
		errorPlacement: function(error, element) {
			error.insertAfter(element.parent().find('label:first'));
		},

		// set new class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("ok");
		}
	});
	
	// propose username by combining first- and lastname
	$("#username").focus(function() {
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		if(firstname && lastname && !this.value) {
			this.value = firstname + "." + lastname;
		}
	});

});
</script>
</head>
<body>
	<!-- Header -->
	<header id="top">
		<div class="wrapper">
			<!-- Title/Logo - can use text instead of image -->
			<div id="title"><img SRC="img/logo.png" /></div>
			<!-- Top navigation -->
			<div id="topnav">
<?php 
if(!isset($_SESSION['username'])){
?>			
<small>您还没有登录请先登录。</small>
<?php 
}else{
?>
				<a><img class="avatar" SRC="img/user_32.png" alt="" /></a>
				您的角色： <b>管理员</b>
				<span>|</span> <a href="?action=logout">退出登录</a><br />
				<small>欢迎您，<?php echo $_SESSION['username'];?>。</small>

<?php
}
?>				
			</div>
			<!-- End of Top navigation -->
			<!-- Main navigation -->
			<nav id="menu">
				<ul class="sf-menu">
					<li  class="current"><a HREF="index.php">控制面板</a></li>
					<li><a HREF="install.php">安装</a></li>	
					<li><a HREF="?action=uninstall">卸载</a></li>
				</ul>
			</nav>
			<!-- End of Main navigation -->
			<!-- Aside links -->
			
			<!-- End of Aside links -->
		</div>
	</header>
	<!-- End of Header -->
	<!-- Page title -->
	<div id="pagetitle">
		<div class="wrapper">
			<h1><?php if(!isset($_SESSION['username'])){?>欢迎使用本系统。<?php }else{?>欢迎您，<?php echo $_SESSION['username'];?>。<?php }?></h1>
			<!-- Quick search box -->
			<form action="http://search.howwant.com/" method="get"><input class="" type="text" id="q" name="query" /><input type="hidden" name="type" value="Web" id="type"/></form>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">	
<?php
$kvdb = new SaeKV();
// 初始化KVClient对象
$kvdb->init();
$keys = array();   
array_push($keys, 'sys_install');
array_push($keys, 'sys_domain');
array_push($keys, 'sys_sitename');
array_push($keys, 'sys_theme');
array_push($keys, 'sys_barTheme');
array_push($keys, 'sys_username');
array_push($keys, 'sys_userpass');
array_push($keys, 'sys_uptime');
array_push($keys, 'sys_num');
$set = $kvdb->mget($keys);
if($set['sys_install'] == ""){
echo " <Script Language=\"JavaScript\"> alert(\"您还未完成安装，请安装系统。\");window.location.href=\"install.php\";</Script>";
}
if(!isset($_SESSION['username'])){
?>		<div class="wrapper-login">
         <section class="full">
		 <h3>管理员登录</h3>
		 <div class="box box-info">请输入您安装时的用户名和密码。</div>
			<form action="?action=login" method="post">
				<p>
				<label class="required" for="username">用户名:</label><br/>
				<input type="text" name="username" class="full" value="" />
				</P>
				<p>
				<label class="required" for="password">密码:</label><br/>
				<input type="password" name="password" class="full" value="" />
				</P>
				<p class="box">
				<input type="submit" name="submit"  class="btn btn-green big" value="登录" />
				</p>
			</form>
		  </section>
		</div>	
<?php
  if(@$_GET["action"]=="login") {
  $username = htmlspecialchars($_POST['username']);
  $password = md5($_POST['password']);
    if($set['sys_username']==$username && $set['sys_userpass']==$password ){
         //登录成功
		
        $_SESSION['username'] = $username;
  
         echo " <Script Language=\"JavaScript\"> alert(\"登录成功\");window.history.back(-1); </Script>";
     
	  
    } else {
      echo " <Script Language=\"JavaScript\"> alert(\"用户名或密码错误\");window.history.back(-1); </Script>";
	  
    }
		
  }
}else{



    if(@$_GET["action"]==""){
?>
   
   <section class="column width6 first">   
   <fieldset>
   <form action="?action=modify" method="post" id="sampleform">
   <p>
   <input type="hidden" name="install" value="1">
   <label class="required" for="username" >用户名</label><br/>
   <input type="text" name="username" id="username" value="<?php echo $set['sys_username']?>" class="half">
   </P>
   <p>
   <label class="required" for="password" >密码</label><br/>
   <input type="password" name="password" id="password" value="<?php echo $set['sys_userpass']?>" class="half">
   </P>
   <p>
   <label class="required" for="confirm_password" >确认密码</label><br/>
   <input type="password" name="confirm_password" id="confirm_password" class="half">
   </p>
   <p>
   <label class="required" for="domain" >主站域名</label><br/>
   <input type="text" name="domain" id="domain" value="<?php echo $set['sys_domain']?>" class="half">
   </p>
   <p>
   <label class="required" for="sitename" >本站名称</label><br/>
   <input type="text" name="sitename" id="sitename" value="<?php echo $set['sys_sitename']?>" class="half">
   </p>
   <p>
   <label class="required" for="theme" >模板选择</label><br/>
   <select name="theme" class="half">
     <option style="color: #FFFFFF; background-color: #353535" value ="a" <?php if($set['sys_theme'] =="a"){echo "selected";}?>>a:#353535</option>
	 <option style="color: #FFFFFF; background-color: #518AB7" value ="b" <?php if($set['sys_theme'] =="b"){echo "selected";}?>>b:#518AB7</option>
	 <option style="color: #000000; background-color: #FAFAFA" value ="c" <?php if($set['sys_theme'] =="c"){echo "selected";}?>>c:#FAFAFA</option>
	 <option style="color: #000000; background-color: #F9F9F9" value ="d" <?php if($set['sys_theme'] =="d"){echo "selected";}?>>d:#F9F9F9</option>
	 <option style="color: #000000; background-color: #FFE87F" value ="e" <?php if($set['sys_theme'] =="e"){echo "selected";}?>>e:#FFE87F</option>
   </select>
   </p>
   <p>
   <label class="required" for="barTheme" >导航选择</label><br/>
   <select name="barTheme" class="half">
     <option style="color: #FFFFFF; background-color: #1E1E1E" value ="a" <?php if($set['sys_barTheme'] =="a"){echo "selected";}?>>a:#1E1E1E</option>
	 <option style="color: #FFFFFF; background-color: #588FBE" value ="b" <?php if($set['sys_barTheme'] =="b"){echo "selected";}?>>b:#588FBE</option>
	 <option style="color: #000000; background-color: #E7E7E7" value ="c" <?php if($set['sys_barTheme'] =="c"){echo "selected";}?>>c:#E7E7E7</option>
	 <option style="color: #000000; background-color: #C7C7C7" value ="d" <?php if($set['sys_barTheme'] =="d"){echo "selected";}?>>d:#C7C7C7</option>
	 <option style="color: #000000; background-color: #FBEE8B" value ="e" <?php if($set['sys_barTheme'] =="e"){echo "selected";}?>>e:#FBEE8B</option>

   </select>
   </p>
   <p>
   <label class="required" for="uptime" >更新频率</label><br/>
   <select name="uptime" class="half">
     <option value ="1" <?php if($set['sys_uptime'] =="1"){echo "selected";}?>>1小时</option>
	 <option value ="3" <?php if($set['sys_uptime'] =="3"){echo "selected";}?>>3小时</option>
	 <option value ="6" <?php if($set['sys_uptime'] =="6"){echo "selected";}?>>6小时</option>
	 <option value ="12" <?php if($set['sys_uptime'] =="12"){echo "selected";}?>>12小时</option>
	 <option value ="24" <?php if($set['sys_uptime'] =="24"){echo "selected";}?>>1天</option>
	 <option value ="168" <?php if($set['sys_uptime'] =="168"){echo "selected";}?>>1个星期</option>
	 <option value ="720" <?php if($set['sys_uptime'] =="720"){echo "selected";}?>>1个月</option>
   </select>
   </p>
   <p>
   <label class="required" for="num" >每页显示文章数</label><br/>
   <select name="num" class="half">
     <option value ="5" <?php if($set['sys_num'] =="5"){echo "selected";}?>>5</option>
	 <option value ="7" <?php if($set['sys_num'] =="7"){echo "selected";}?>>7</option>
	 <option value ="10" <?php if($set['sys_num'] =="10"){echo "selected";}?>>10</option>
	 <option value ="15" <?php if($set['sys_num'] =="15"){echo "selected";}?>>15</option>
	 <option value ="20" <?php if($set['sys_num'] =="20"){echo "selected";}?>>20</option>
   </select>
   </p>
   <p class="box">
   <input type="submit" class="btn btn-red" value="提交">
   </p>
   </form>
   </fieldset>
   </section>
   <aside class="column width2">
					<div class="content-box">
						<header>
							<h3>提示信息</h3>
						</header>
						<section>
							<q>所有内容不可为空哦，请您认真监察，尤其是用户名密码，记不住可就登不进来了。
							</q>							
						</section>
					</div>
				</aside>
				 
<?php	




}elseif(@$_GET["action"]=="modify"){
   $kvdb->set('sys_install', $_POST["install"]);
   $kvdb->set('sys_domain', $_POST["domain"]);
   $kvdb->set('sys_sitename', $_POST["sitename"]);
   $kvdb->set('sys_theme', $_POST["theme"]);
   $kvdb->set('sys_barTheme', $_POST["barTheme"]);
   $kvdb->set('sys_username', htmlspecialchars($_POST["username"]));
   $kvdb->set('sys_userpass', md5($_POST["password"]));
   $kvdb->set('sys_uptime', $_POST["uptime"]);
   $kvdb->set('sys_num', $_POST["num"]);
   echo " <Script Language=\"JavaScript\"> alert(\"更新成功\");window.history.back(-1); </Script>";
}elseif(@$_GET["action"]=="logout"){
   session_destroy();
   echo " <Script Language=\"JavaScript\"> alert(\"注销成功\");window.history.back(-1); </Script>";
}elseif(@$_GET["action"]=="uninstall"){
   $kvdb->delete('sys_install');
   $kvdb->delete('sys_domain');
   $kvdb->delete('sys_sitename');
   $kvdb->delete('sys_theme');
   $kvdb->delete('sys_barTheme');
   $kvdb->delete('sys_username');
   $kvdb->delete('sys_userpass');
   $kvdb->delete('sys_xml');
   $kvdb->delete('sys_addtime');
   $kvdb->delete('sys_uptime');
   $kvdb->delete('sys_num');
   echo " <Script Language=\"JavaScript\"> alert(\"删除成功\");window.history.back(-1); </Script>";
   }
}
?>


		</div>
		<!-- End of Wrapper -->
	</div>
	<!-- End of Page content -->
	
	<!-- Page footer -->
	<footer id="bottom">
		<div class="wrapper">
			<nav>
				<a href="http://www.howwant.com/">昊网</a> &middot;
				<a href="http://www.howwant.cn/">移动昊网</a> &middot;
				<a href="http://search.howwant.com/">昊网搜索</a> &middot;
				<a href="http://weibo.com/howwant">微博</a> &middot;

			</nav>
			<p>Copyright &copy; 2014</p>
		</div>
	</footer>
	<!-- End of Page footer -->
	
	<!-- Animated footer -->

	<!-- End of Animated footer -->
	
	<!-- Scroll to top link -->
	<a href="#" id="totop">^ scroll to top</a>

<!-- User interface javascript load -->
<script type="text/javascript" SRC="js/administry.js"></script>
</body>
</html>