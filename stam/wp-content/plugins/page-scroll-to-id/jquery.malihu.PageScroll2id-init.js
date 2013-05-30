(function($){
	$(window).load(function(){
		$(malihuPageScroll2idInitParams.sel).mPageScroll2id({
			scrollSpeed:parseInt(malihuPageScroll2idInitParams.scrollSpeed),
			autoScrollSpeed:malihuPageScroll2idInitParams.autoScrollSpeed == "true" ? true : false,
			scrollEasing:malihuPageScroll2idInitParams.scrollEasing,
			scrollingEasing:malihuPageScroll2idInitParams.scrollingEasing,
			pageEndSmoothScroll:malihuPageScroll2idInitParams.pageEndSmoothScroll == "true" ? true : false,
			layout:malihuPageScroll2idInitParams.layout
		});
	});
})(jQuery);