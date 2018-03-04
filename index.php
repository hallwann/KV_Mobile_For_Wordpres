<?php
$kvdb = new SaeKV();
$init = $kvdb->init();
$sitename = $kvdb->get('sys_sitename');
if(!$kvdb->get('sys_install')){echo " <Script Language=\"JavaScript\"> alert(\"您还进行成安装，请安装系统。\");window.location.href=\"admin/install.php\";</Script>";}
?>
<!DOCTYPE html> 
<html> 
    <head> 
        <meta charset="utf-8"/>
        <title><?php echo $sitename;?></title> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
	    <link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	    <script src="http://lib.sinaapp.com/js/jquery/1.8.2/jquery.min.js"></script>
	    <script src="http://lib.sinaapp.com/js/jquery-mobile/1.2.0/jquery.mobile-1.2.0.js"></script>       
        <link rel="stylesheet" href="images/style.css"/>
    </head>
    <body>       
<!--模板开始-->
<script type="text/template" id="pageTemp">
<header data-role="header" data-theme="<%=wpmr.conf.barTheme%>">
                <h1><%=wpmr.conf.headName%></h1>
                <a href="<%=wpmr.conf.homeurl%>" rel="external" target="_blank" data-icon="home" data-iconpos="notext" data-direction="reverse">
                        </a>
            </header>                
            <div data-role="content" id="wpmr_itemlist">
			<div data-role="collapsible-set" data-iconpos="right" data-theme="<%=wpmr.conf.theme%>">
				<% _.each(pData.list, function(o) { %>
				<div data-role="collapsible" >
					<h3><%= o.title %></h3>
					<div>
						<ul data-role="listview" data-mini="true">
							<li><a href="#a_<%=o.guidLink%>" class="fullview_click" data-transition="slideup"><%=wpmr.conf.lang_fullview%>...</a></li>
							<li><%=wpmr.conf.lang_author%>：<%= o.author%></li>
							<li><%= o.commentsNum%><%=wpmr.conf.lang_comnum%></li>
							<li><%= o.pubDate%></li>
						</ul>
					</div>
				</div>
				<% }); %>
			</div>				
            </div>    
             <footer data-role="footer" data-theme="<%=wpmr.conf.barTheme%>">
                <nav data-role="navbar">
                    <ul>
		<% if(pData.pageNum-1>=1){ %>
                        <li><a href="#page_<%=pData.pageNum-1%>" id="wpmr_prepage" data-transition="slide"><%=wpmr.conf.lang_prePg%></a></li>
                        <% } %>
						<% if(pData.endIdx<wpmr.x.length){ %>
						<li><a href="#page_<%=pData.pageNum+1%>" id="wpmr_nextpage"  data-transition="slide"><%=wpmr.conf.lang_nextPg%></a></li>
		   <% } %>
                    </ul>
                    </nav>
            </footer>
</script> 

<script type="text/template" id="articleTemp">
	
<header data-role="header" data-theme="<%=wpmr.conf.barTheme%>">
	<h1><%=pData.title%></h1>
	<a href="<%=wpmr.conf.homeurl%>" rel="external" target="_blank" data-icon="home" data-iconpos="notext" data-direction="reverse">
                         </a>
</header>
<section data-role="content">
<%=pData.fullText%>
</section>
<footer data-role="footer" data-position="fixed" data-theme="<%=wpmr.conf.barTheme%>">
	<nav data-role="navbar">
		<ul>
			<li><a href="#page_<%=pData.inPage%>" id="wpmr_back"  data-transition="slidedown" ><%=wpmr.conf.lang_back%></a></li>
			<li><a href="<%=pData.gocomments%>" id="wpmr_comm" rel="external" target="_blank" data-theme="e"><%=wpmr.conf.lang_comment%></a></li>
		</ul>
	</nav>
</footer>
</script>
<!--模板结束-->

        <section data-role="page" data-title="Dogeek" id="wpmr_main">  
	
        </section>

        <article data-role="page" id="wpmr_fullview">
            
        </article>

	<script src="images/underscore-min_1.4.3.js"></script>
	<script src="images/backbone-min_0.9.9.js"></script>
	<script src="config.php"></script>
	<script src="images/articleModel.js"></script>
          <script src="images/core2.js"></script>  
    </body>
</html>
