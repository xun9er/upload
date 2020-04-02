//导航下拉菜单效果
function navshow(){
	$("#nav>li").each(function(){
		$(this).hover(
		function(){
			$(this).find("div").show();
			$(this).find("img").css("height",$(this).find("img").parent().prev().height()+"px")
		},
		function () {
			$(this).find("div").hide();
		}
		);
	});
}
//调整页面左右两边等高
function SetLeftHeight()
{
	if($("#colr").height() > $("#coll").height())
		$("#bompic").css("marginTop",$("#colr").height()-(($("#submenu").length > 0 ?$("#submenu").height():25)+$("#bompic").height()+53)+"px");
    else
        $("#colr").css("height",$("#coll").height()+"px");
}
//左边菜单展示效果
function ShowSubmenu(n)
{
   if($("#submenu")) 
   {
	   $("#submenu>ul>li").each(function(i){
			if(i==0) return true;
			if(i==n){
				$(this).addClass("cur");
			}else {
				$(this).bind("mouseover",function(){
					$(this).addClass("cur");
				}),
				$(this).bind("mouseout",function(){
					$(this).removeClass("cur");
				})
			}						 
		});
   }
   else return;
}
//列表菜单展示效果
function ShowListmenu(id,n)
{
   var tempttl;
   var sttl = $("#page_title").text();
   $("#"+id+">li").each(function(){
		tempttl=$(this).text();
		if(tempttl.indexOf(sttl)>=0)
		{
			$(this).addClass("cur");
			$(this).prev().find("a").length > 0 ? $("#prev_page").attr("href",$(this).prev().find("a").attr("href")):$("#prev_page").removeAttr("href");;
			$(this).next().find("a").length > 0 ? $("#next_page").attr("href",$(this).next().find("a").attr("href")):$("#next_page").removeAttr("href");
			return;
		}
	});
}