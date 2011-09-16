		$(function () {
			$(".sliderbox .slider .title").click(function () {
				var $this = $(this);
				var status = $this.parent().attr('status');
				if (!status || status == "close")
				{
					var openSlider = $(".sliderbox .slider[status=open]");
					openSlider.find(".title .left").removeClass("open");
					openSlider.find(".content").hide();
					//.animate({height: 0, paddingTop: 0, paddingBottom: 0}, 1000, function () {
					//	$(this).hide();
					//});
					openSlider.attr("status", "close");
					$this.find(".left").addClass("open");
					$this.parent().find(".content")
						//.height(0)
						//.css("padding-top", 0)
						//.css("padding-bottom", 0)
						.show();
						//.animate({height: "100%", paddingTop: 5, paddingBottom: 5}, 1000);
					$this.parent().attr("status", "open");
				}
			});
		});