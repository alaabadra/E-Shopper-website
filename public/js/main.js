// Open close dropdown on click
$("li.dropdown").click(function(){
	if($(this).hasClass("open")) {
		$(this).find(".dropdown-menu").slideUp("fast");
		$(this).removeClass("open");
	}
	else { 
		$(this).find(".dropdown-menu").slideDown("fast");
		$(this).toggleClass("open");
	}
});

// Close dropdown on mouseleave
$("li.dropdown").mouseleave(function(){
	$(this).find(".dropdown-menu").slideUp("fast");
	$(this).removeClass("open");
});

// Navbar toggle
$(".navbar-toggle").click(function(){
	$(".navbar-collapse").toggleClass("collapse").slideToggle("fast");
});

// Navbar colors
$("#nav-colors > .btn").click(function(){
	if($(this).is("#pink")) {
		$(".navbar").css("background","linear-gradient(to right, #ff5858, #f857a6)");
		$(".dropdown-menu").css("background","#ff5858");
	}
	else if($(this).is("#red")) {
		$(".navbar").css("background","linear-gradient(to right, #d31027, #ea384d)");
		$(".dropdown-menu").css("background","#d31027");
	}
	else if($(this).is("#purple")) {
		$(".navbar").css("background","linear-gradient(to right, #41295a, #2f0743)");
		$(".dropdown-menu").css("background","#41295a");
	}
	else if($(this).is("#blue")) {
		$(".navbar").css("background","linear-gradient(to right, #396afc, #2948ff)");
		$(".dropdown-menu").css("background","#396afc");
	}
	else if($(this).is("#green")) {
		$(".navbar").css("background","linear-gradient(to right, #add100, #7b920a)");
		$(".dropdown-menu").css("background","#add100");
	}
	else if($(this).is("#yellow")) {
		$(".navbar").css("background","linear-gradient(to right, #f7971e, #ffd200)");
		$(".dropdown-menu").css("background","#f7971e");
	}
	else if($(this).is("#orange")) {
		$(".navbar").css("background","linear-gradient(to right, #e43a15, #e65245)");
		$(".dropdown-menu").css("background","#e43a15");
	}
})

// Font colors
$("#font-colors > .btn").click(function(){
	if($(this).is("#white")) {
		$(".navbar .fa, .link, a").css("color","white");
		$(".icon-bar").css("background","white");
	}
	else if($(this).is("#black")) {
		$(".navbar .fa, .link, a").css("color","black");
		$(".icon-bar").css("background","black");
	}
})

// edges
$("#edges > .btn").click(function(){
	if($(this).is("#rounded")) {
		$(".navbar, .form-control").css("border-radius","8px");
		if($(window).width() > 768) {
			$(".dropdown-menu").css({
				"border-bottom-right-radius":"8px",
				"border-bottom-left-radius":"8px"
			});
		}
	}
	else if($(this).is("#square")) {
		$(".navbar, .form-control").css("border-radius","0");
		$(".dropdown-menu").css({
			"border-bottom-right-radius":"0",
			"border-bottom-left-radius":"0"
		});
	}
})


$(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1200) {
                incno = itemsSplit[3];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / incno;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / incno;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});

