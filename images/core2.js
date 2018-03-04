/*Users should NOT Change this file*/

// Prevent jQuery Mobile from handling hash changes
//$.mobile.hashListeningEnabled = false;
$.mobile.linkBindingEnabled = false;

var wpmr={
	conf:{
		headName:WpMobiReader.head || "移动昊网",
		url:WpMobiReader.rssurl || null,
		homeurl:WpMobiReader.homeurl || "http://howwant.com",
		theme:WpMobiReader.theme || "b",
		barTheme:WpMobiReader.barTheme || "a",
		itsPerPage:WpMobiReader.itemsperpage || 5,
		lang_back:WpMobiReader.backbutton || "Back",
		lang_comment:WpMobiReader.commentbutton || "Go Comment",
		lang_fullview:WpMobiReader.fullview || "Full Article",
		lang_author:WpMobiReader.author || "author",
		lang_comnum:WpMobiReader.comnum || "Comments",
		lang_prePg:WpMobiReader.prePg || "<<Pre",
		lang_nextPg:WpMobiReader.nextPg || "Next>>"
	},
	pageSection:$("#wpmr_main"),
	pageTemp:$("#pageTemp"),
	arti:$("#wpmr_fullview"),
	artiTemp:$("#articleTemp")
};


	wpmr.arti.live('pagehide', function (event, ui) {
		$(event.currentTarget).html(" ");
	});




wpmr.Route=Backbone.Router.extend({
	routes:{
		"a_:id":"articleID",
		"page_:Num": "pageNum",
		"*actions": "defaultRoute"
	}
});
wpmr.View=Backbone.View.extend({
	initialize: function(o){		
		$('body').addClass('ui-loading');
		this.contentO=o.contentObj;//传入内容数据
		this.render(this.contentO.temp);
		$('body').removeClass('ui-loading');
	},
	render:function(witchTemp){		
		var result=_.template(witchTemp.html(),{pData:this.contentO});
		$.mobile.changePage(this.$el, {changeHash:false});
		this.$el.html(result).page("destroy").page();
		//this.$el.html(result).trigger('create');
	}
})

wpmr.init=function(){
	wpmr.pageSection.data("title",wpmr.conf.headName);//改标题
	
	//页面route
	var pageRouter=new wpmr.Route;	
	pageRouter.on('route:pageNum',function(Num){		
		var n=parseInt(Num);if(n<1){n=1};		
		var getEndIdx=function(startIdx){
				var end=startIdx+wpmr.conf.itsPerPage;
				if(end>wpmr.x.length){
					end=wpmr.x.length
				}
				return end;
			}
			
		
		var contentObj={
			temp:wpmr.pageTemp,//使用什么模板
			pageNum:n,
			startIdx:(n-1)*wpmr.conf.itsPerPage,
			list:[]
		};
		contentObj.endIdx=getEndIdx(contentObj.startIdx);
		_.each( wpmr.x.models.slice(contentObj.startIdx,contentObj.endIdx), function(model) {
			contentObj.list.push(model.toJSON());			
		});		
		var pageView=new wpmr.View({
			el:wpmr.pageSection,
			contentObj:contentObj
		});
		delete pageView;
	});
	
	pageRouter.on('route:defaultRoute', function(actions) {		
		pageRouter.navigate("page_1", {trigger: true});
	})
	pageRouter.on('route:articleID', function(gridID) {		
		
		var artiObj= wpmr.x.where({guidLink:gridID})[0].toJSON();
		artiObj.inPage=Math.ceil((artiObj.index+1)/wpmr.conf.itsPerPage);//找出页数
		artiObj.temp=wpmr.artiTemp;//使用什么模板
		var artiView=new wpmr.View({
			el:wpmr.arti,
			contentObj:artiObj
		})		
	});
	delete pageRouter;
}


$(document).bind('pagecreate',function(){      //All Start Here
	
	if(wpmr.conf && !wpmr.x){    
		delete WpMobiReader;
		$.ajax({ //获取文章数据
			url:wpmr.conf.url, 
			dataType: 'xml',
			error: function(data){ 
				alert('Error loading XML document'+data); 
			}, 
			beforeSend: function(){  				
				$('body').addClass('ui-loading');
			},
			success: function(data){
				var x=data.getElementsByTagName("item");				
				atcSort(x,function(atcs){wpmr.x=atcs;});//整理出集合
				atcSort=null;				
			},
			complete: function(){
				$('body').removeClass('ui-loading'); 
				Backbone.history.start();
			}
		});
	}	
	wpmr.init();	
})
