	var fixedPanel = function(element, onDown, onTop) {
		element = $(element);
		var pos = element.offset();
		element.data("top", pos.top);
		element.data("left", pos.left);

		$(window).scroll(function(){
			var scrollTop = $(window).scrollTop();

			if(element.data("top") < scrollTop) {
				if(!element.data("onDown")) {
					element.data("onDown", 1);
					onDown(element);	
				}
			} else {
				if(element.data("onDown")) {
					element.data("onDown", 0);
					onTop(element);	
				}
			}
		});
	} 

	$(document).ready(function(){
	 	// $("#mainmenudiv a").css("color","red");
	 	//	.scrollTop();

	 	fixedPanel("#mainmenudiv", function(elem) {
	 		elem.addClass("floatmenu");

	 		elem.css({
	 			"width" : "1002px",
	 			"margin-left": "0px",
	 		}).stop().animate({
	 			"width": "1030px",
	 			"margin-left" : "-15px"
	 		}, 1000);
	 	}, function (elem) {
	 		elem.removeClass("floatmenu");
	 	});
  	});