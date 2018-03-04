<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>KV Mobile For Wordpress by howwant.com</title>
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
	
	/* setup navigation, content boxes, etc... */
	Administry.setup();
	
	/* progress bar animations - setting initial values */
	Administry.progress("#progress1", <?php echo @$_GET["step"];?>, 6);
	


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
				
			</div>
			<!-- End of Top navigation -->
			<!-- Main navigation -->
			<nav id="menu">
				<ul class="sf-menu">
					<li><a HREF="index.php">控制面板</a></li>
					<li class="current"><a HREF="install.php">安装</a></li>	
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
			<h1>KV Mobile For Wordpress by howwant.com</h1>
			<!-- Quick search box -->
			<form action="http://search.howwant.com/" method="get"><input class="" type="text" id="q" name="q" /><input type="hidden" name="type" value="Web" id="type"/></form>
		</div>
	</div>
	<!-- End of Page title -->
	
	<!-- Page content -->
	<div id="page">
		<!-- Wrapper -->
		<div class="wrapper">
			
		<h3>安装进度</h3>
					
					<h5>下面的进度条是您的安装进度：</h5>
					<div id="progress1" class="progress full progress-green"><span><b></b></span></div>		
				
<?php
$kvdb = new SaeKV();
// 初始化KVClient对象
$kvdb->init();
if($kvdb == true){
if($kvdb->get('sys_install')){
   echo "<fieldset><legend>出错啦！</legend><div class=\"box box-error\">您已经安装了系统,若想重新安装，请重新建立KVBD。详情请咨询http://www.howwant.com/。</div></fieldset>";
}else{
    if(@$_GET["action"] == "set"){

      if(@$_GET["step"] == "1"){
?>
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
			}
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
			}
			
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
	
   
	});
   </script>	  
   <section class="column width6 first">

   <form action="?action=set&step=2" method="post" id="sampleform">
   
   <fieldset>
   <p>
   <label class="required" for="username" >用户名</label><br/>
   <input type="text" name="username" id="username" class="half">
   </p>
   <p>
   <label class="required" for="password" >密码</label><br/>
   <input type="password" name="password" id="password" class="half">
   </p>
   <p>
   <label class="required" for="confirm_password" >确认密码</label><br/>
   <input type="password" name="confirm_password" id="confirm_password" class="half">
   </p>
   <p class="box">
   <input type="submit" class="btn btn-green big" value="下一步">
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
							<q>请认真填写用户名和密码，这将用于系统登录。
							</q>							
						</section>
					</div>
				</aside>
<?php
	  }elseif(@$_GET["step"] == "2"){
	  $kvdb->add('sys_username', htmlspecialchars($_POST["username"]));
      $kvdb->add('sys_userpass', md5($_POST["password"]));
?>
   <script type="text/javascript">
   $(document).ready(function(){
   	// validate form on keyup and submit
	var validator = $("#sampleform").validate({
		rules: {
			
			domain: {
				required: true,
				url: true
			}
		},
		messages: {
			domain: {
				required: "请输入正确网址",
				minlength: "请输入正确网址"
			}
			
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
	
   
	});
   </script>
   <section class="column width6 first">
   <form action="?action=set&step=3" method="post" id="sampleform">
   <p>
   <label class="required" for="domain" >主站域名</label><br/>
   <input type="text" name="domain" id="domain" class="half">
   </p>
   <p class="box">
   <input type="submit" class="btn btn-green big" value="下一步">
   </p>
   </form>
   </section>
   <aside class="column width2">
					<div class="content-box">
						<header>
							<h3>提示信息</h3>
						</header>
						<section>
							<q>域名用于获取主站上的数据，请保证该域名能给访问。<cite>如：http://www.howwant.com/blog</cite>
							</q>							
						</section>
					</div>
				</aside> 

<?php	  
	  }elseif(@$_GET["step"] == "3"){
	  $kvdb->add('sys_domain', $_POST["domain"]);
?>
   <script type="text/javascript">
   $(document).ready(function(){
   	// validate form on keyup and submit
	var validator = $("#sampleform").validate({
		rules: {
			
			sitename: "required"
		},
		messages: {
			sitename: "请输入网站名称"
			
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
	
   
	});
   </script>	  
   <section class="column width6 first">
   <form action="?action=set&step=4" method="post" id="sampleform">
   <p>
   <label class="required" for="sitename" >本站名称</label><br/>
   <input type="text" name="sitename" id="sitename" class="half">
   </p>
   <p class="box">
   <input type="submit" class="btn btn-green big" value="下一步">
   </p>
   </form>
   </section>
   <aside class="column width2">
					<div class="content-box">
						<header>
							<h3>提示信息</h3>
						</header>
						<section>
							<q>名称用于移动站点的标题显示
							</q>							
						</section>
					</div>
				</aside>
<?php   
	  }elseif(@$_GET["step"] == "4"){
	  $kvdb->add('sys_sitename', $_POST["sitename"]);
?>
   <section class="column width6 first">
   <form action="?action=set&step=5" method="post" id="sampleform">
   <p>
   <label class="required" for="theme" >模板选择</label><br/>
   <select name="theme" class="half">
     <option style="color: #FFFFFF; background-color: #353535" value ="a" >a:#353535</option>
	 <option style="color: #FFFFFF; background-color: #518AB7" value ="b" >b:#518AB7</option>
	 <option style="color: #000000; background-color: #FAFAFA" value ="c" >c:#FAFAFA</option>
	 <option style="color: #000000; background-color: #F9F9F9" value ="d" >d:#F9F9F9</option>
	 <option style="color: #000000; background-color: #FFE87F" value ="e" >e:#FFE87F</option>
   </select>
   </p>
   <p>
   <label class="required" for="barTheme" >导航选择</label><br/>
   <select name="barTheme" class="half">
     <option style="color: #FFFFFF; background-color: #1E1E1E" value ="a" >a:#1E1E1E</option>
	 <option style="color: #FFFFFF; background-color: #588FBE" value ="b" >b:#588FBE</option>
	 <option style="color: #FFFFFF; background-color: #E7E7E7" value ="c" >c:#E7E7E7</option>
	 <option style="color: #FFFFFF; background-color: #C7C7C7" value ="d" >d:#C7C7C7</option>
	 <option style="color: #000000; background-color: #FBEE8B" value ="e" >e:#FBEE8B</option>
   </select>
   </p>
   <p>
   <label class="required" for="num" >每页显示文章数</label><br/>
   <select name="num" class="half">
     <option value ="5" >5</option>
	 <option value ="7" >7</option>
	 <option value ="10" >10</option>
	 <option value ="15" >15</option>
	 <option value ="20" >20</option>
   </select>
   </p>
   <p class="box">
   <input type="submit"  class="btn btn-green big" value="下一步">
   </p>
   </form>
   </section>
   <aside class="column width2">
					<div class="content-box">
						<header>
							<h3>提示信息</h3>
						</header>
						<section>
							<q>请仔细设计您的模版，以便达到很好的视觉效果。
							</q>							
						</section>
					</div>
				</aside>
<?php   
	  }elseif(@$_GET["step"] == "5"){
	  $kvdb->add('sys_theme', $_POST["theme"]);
      $kvdb->add('sys_barTheme', $_POST["barTheme"]);
	  $kvdb->add('sys_num', $_POST["num"]);
?>
	<section class="column width6 first">
	<form action="?action=set&step=6" method="post" id="sampleform">
	<input type="hidden" name="install" value="1">
	<p>
	<fieldset><legend>温馨提示</legend><div class="box box-info">如果您刚才输入的信息有勿，还可以<a href="?action=uninstall">重新安装</a>哦~</div></fieldset>
	
	<p>
   <label class="required" for="uptime" >更新频率</label><br/>
   <select name="uptime" class="half">
     <option value ="1">1小时</option>
	 <option value ="3">3小时</option>
	 <option value ="6">6小时</option>
	 <option value ="12">12小时</option>
	 <option value ="24">1天</option>
	 <option value ="168">1个星期</option>
	 <option value ="720">1个月</option>
   </select>
   </p>
	</p>
	<p class="box">
	<input type="submit" class="btn btn-green big" value="下一步">
	</p>
    </form>
	</section>
    <aside class="column width2">
					<div class="content-box">
						<header>
							<h3>提示信息</h3>
						</header>
						<section>
							<q>系统采集数据按照您选择的频率进行更新，根据您主站的更新速度，设定该系统可以提高资源利用率。
							</q>							
						</section>
					</div>
				</aside>
<?php	
	  }elseif(@$_GET["step"] == "6"){
	  $kvdb->add('sys_install', $_POST["install"]);
	  $kvdb->add('sys_xml', '');
	  $kvdb->add('sys_addtime', '');
	  $kvdb->add('sys_uptime', $_POST["uptime"]);
?>
      <form action="index.php">
	  <p>
	  <fieldset><legend>向导结束</legend><div class="box box-info">恭喜您，系统已经安装完毕。</div></fieldset>
	  </p>
	  <p class="box">
	  <input type="submit"  class="btn btn-red big" value="完成">
	  </P>
	  </form>
<?php	  
	  }
      
    }elseif(@$_GET["action"] == "uninstall"){
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
	 echo " <Script Language=\"JavaScript\"> alert(\"初始化成功\");window.location.href=\"install.php\"; </Script>";
	}
	else{
?>
                        <fieldset>
							<legend>KV Mobile For Wordpress</legend>
							<div class="box box-info">安装协议</div>
							<div class="box box-info-msg">
								<ol>
									<li>版权所有 (c)2014，howwant.com 保留所有权利。 </li>
				<li>感谢您选择基于新浪KVDB和XML的WORDPRESS手机转换程序（以下简称KVMWP），KVMWP是稳定的wordpress手机网站建设解决方案之一，基于 PHP + KVDB   的技术开发，全部源码开放。</li>
				<li>KVWPM的官方网址是： <a href="http://www.howwant.com" target="_blank">www.howwant.com</a> 微博交流：<a href="http://weibo.com/howwant" target="_blank"> @昊网</a></li>
				<li>为了使您正确并合法的使用本软件，请你在使用前务必阅读清楚下面的协议条款：</li>
			<strong>一、本授权协议适用且仅适用于 KVMWP 1.x.x 版本，昊网官方对本授权协议的最终解释权。</strong>
			<strong>二、协议许可的权利 </strong>
				<li>1、您可以在完全遵守本最终用户授权协议的基础上，将本软件应用于非商业用途，而不必支付软件版权授权费用。</li>
				<li>2、您可以在协议规定的约束和限制范围内修改KVMWP源代码或界面风格以适应您的网站要求。 </li>
				<li>3、您拥有使用本软件构建的网站全部内容所有权，并独立承担与这些内容的相关法律义务。 </li>
				<li>4、获得商业授权之后，您可以将本软件应用于商业用途，同时依据所购买的授权类型中确定的技术支持内容，自购买时刻起，在技术支持期限内拥有通过指定的方式获得指定范围内的技术支持服务。商业授权用户享有反映和提出意见的权力，相关意见将被作为首要考虑，但没有一定被采纳的承诺或保证。 </li>
			<strong>二、协议规定的约束和限制 </strong>
				<li>1、未获商业授权之前，不得将本软件用于商业用途（包括但不限于企业网站、经营性网站、以营利为目的或实现盈利的网站）。</li>
				<li>2、未经官方许可，不得对本软件或与之关联的商业授权进行出租、出售、抵押或发放子许可证。</li>
				<li>3、不管你的网站是否整体使用KVMWP，还是部份栏目使用KVMWP，在你使用了KVMWP的网站主页上必须加上KVMWP官方网址(<a href="http://www.howwant.com" target="_blank">www.howwant.com</a>)的链接。</li>
				<li>4、未经官方许可，禁止在KVMWP的整体或任何部分基础上以发展任何派生版本、修改版本或第三方版本用于重新分发。</li>
				<li>5、如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回，并承担相应法律责任。 </li>
			<strong>三、有限担保和免责声明 </strong>
				<li>1、本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。 </li>
				<li>2、用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。 </li>
				<li>3、电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始确认本协议并安装   KVMWP，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。</li>
				<li>4、如果本软件带有其它软件的整合API示范例子包，这些文件版权不属于本软件官方，并且这些文件是没经过授权发布的，请参考相关软件的使用许可合法的使用。</li>
				<li><b>协议发布时间：</b> 2014年1月1日</li>
				<li><b>版本最新更新：</b> 2014年2月12日</li>
								</ol>
							</div>
						</fieldset>
				<form action="?action=set&step=1" method="post">
                <p class="box">				
				<input type="submit" class="btn btn-green big" value="下一步">
				</p>
				</form>
<?php	
	}
   }
  
}else{echo "<fieldset><legend>出错啦！</legend><div class=\"box box-error\">KVDB初始化失败，请启用KVDB服务。</div></fieldset>";}
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
