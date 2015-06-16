window.onload=function() {
//go to top
$(document).ready(function(){
	var gotoph;
	$('#costom a').click(function(){
		gotoph = $(window).scrollTop();
		top();
	});
	function top(){
		var totop = setTimeout(top,20);
		if(gotoph>0){
			gotoph-=300;
		}else{
			clearTimeout(totop);
		}
		$(window).scrollTop(gotoph);	
	}
});	

// menu
$(document).ready(function(){
  $(".menu a").click(function(){
  $("#nav").toggle();
  });
});

// show
jQuery(".show").slide({ titCell:".num li", mainCell:".pic",effect:"fold", autoPlay:true,trigger:"click",	
startFun:function(i){ // startFun代码用于控制文字上下切换	 
jQuery(".show .txt li").eq(i).animate({"bottom":0}).siblings().animate({"bottom":-36});	
}});

// sidebar
$(document).ready(function(){
	$("#suspend div.bar").hover(function(){
			$(this).children(".hides").show();
			$(this).children(".shows").hide();
			$(this).children(".hides").animate({marginLeft:'0px'},'slow'); 
			$(this).find(".hides").stop(true,true)
	},function(){
		$(this).children(".hides").animate({marginLeft:'-168px'},'slow',function(){
			$(this).hide();
			$(this).next(".shows").show();
			});
	});
});

}