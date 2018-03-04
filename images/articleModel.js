/* 
 * 整理数据成Model和Collection
 */
/*Users should NOT Change this file*/
var atcSort=function(x,callback){
	//获取该文章的ID
	var getGuid=function(link){
		var pos=link.indexOf('?p=');
		var id=link.substring(pos+3,link.length); 
		return id;
	}

	var atcModel = Backbone.Model.extend({//文章模型
		defaults: {
			index:0,
			title: "未知标题",
			pubDate: "未知日期",
			author:"未知作者",
			commentsNum:"0",
			fullText:"全文内容未获取到",
			guidLink:null,
			goComm:"javascript:;"
		} 
	});
	
	var atcsModel=Backbone.Collection.extend({ //文章集合模型
		model:atcModel		
	});
	
	
	
	//var articles=new Backbone.Collection;
	var arr=[];
	for(var i=0;i<x.length;i++){
		var o=$(x[i]);	
		var parameter={
			index:i,
			title:o.find("title").text(),
			pubDate:o.find("pubDate").text(),
			author:o.find("creator").text(),
			fullText:o.find("encoded").text(),
			guidLink:getGuid(o.find("guid").text())
		}
		var commentO=o.find("comments");
		for(var c=0;c<commentO.length;c++){
			var t=commentO[c].childNodes[0].nodeValue;
			if(t.indexOf(":")>=0){
				parameter.gocomments=t
			}else{
				parameter.commentsNum=t
			}
		}
	arr.push(parameter)			
	};	
	var articles=new atcsModel(arr,{silent : true});
	if(callback && typeof(callback)==="function"){callback(articles)}
}
