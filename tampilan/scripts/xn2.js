var xn = {};

xn.config = {};

xn.helper = {
        
	createUrl: function(uri) {
		return xn.config.baseUrl + 'index.php/' + uri;
	},

	stylize: function(selector) {
		if (typeof(selector) == 'undefined') {
			selector = 'body';
		}

		/* Add common odd, even, first, last and hover */
		$(selector).find("*").hover(function () {
			$(this).addClass("hover");
		}, function () {
			$(this).removeClass("hover");
		}).focus(function() {
			$(this).addClass('focus');
		}).blur(function() {
			$(this).removeClass('focus');
		});

		$(selector).find(".tab a:first-child").addClass("first");
		$(selector).find(".tab a:last-child").addClass("last");

		$(selector).find("input:text").addClass("text");
		$(selector).find("input:password").addClass("password");
		$(selector).find("input:reset").addClass("reset");
		$(selector).find("input:submit").addClass("submit");
		$(selector).find("input:button").addClass("button");
		$(selector).find("input:radio").addClass("radio");

		$(selector).find("table > tr:nth-child(odd),ul > li:nth-child(odd), ol > li:nth-child(odd), .list > .comment:nth-child(odd)").addClass("odd");
		$(selector).find("table > tr:nth-child(even),ul > li:nth-child(even), ol > li:nth-child(even), .list > .comment:nth-child(even)").addClass("even");
		$(selector).find("ul > li:first-child, ol > li:first-child, .list > .comment:first-child").addClass("first");
		$(selector).find("ul > li:last-child, ol > li:last-child, .list > .comment:last-child").addClass("last");
		$(selector).find("td, th").wrapInner ("<div><div></div></div>");

		$(selector).find("[class^=blocks_] > div.block:first-child").addClass("first");
		$(selector).find("[class^=blocks_] > div.block:last-child").addClass("last");

		$(selector).find("[class^=grid] tr").removeClass("first last even odd");
		$(selector).find("[class^=grid] tr:first-child").addClass ("first");
		$(selector).find("[class^=grid] tr:last-child").addClass ("last");
		$(selector).find("[class^=grid] tr:nth-child(odd)").addClass ("even");
		$(selector).find("[class^=grid] tr:nth-child(even)").addClass ("odd");

		$(selector).find("[class^=grid] tr:first-child td:first-child").addClass ("first");
		$(selector).find("[class^=grid] tr:first-child td:last-child").addClass ("last");
		$(selector).find("[class^=grid] tr:first-child td:nth-child(odd)").addClass ("even");
		$(selector).find("[class^=grid] tr:first-child td:nth-child(even)").addClass ("odd");

		$(selector).find("a.msgbox").fancybox ({
			'transitionIn'      : 'elastic',
			'transitionOut'     : 'elastic',
			'autoDimensions'	: false,
			'autoScale'			: false,
			'centerOnScroll'	: true,
			'overlayOpacity'	: 0.5,
			'overlayColor'		: '#000',
			'showNavArrows'	: false,
			'width'				: 300,
			'height'				: 'auto',
			'padding'			: 20,
			'modal'				: true
		});

       	$(selector).find('input.date').dateinput({
            lang: 'id',
            format: 'dd-mm-yyyy',
            selectors: true,
            min: '1970-01-01',
            yearRange: [-50, 50],
            offset: [3, 0],
            speed: 'fast'
        });

		$(selector).find('input.number').keypress(function(evt, a) {
            if (!(evt.charCode >= 48 && evt.charCode <= 57) && evt.charCode != 13) {
                evt.preventDefault();
            }
        });
		
		$(".fancybox").fancybox({
			'padding'           : 0,
			'transitionIn'      : 'elastic',
			'transitionOut'     : 'elastic',
			'overlayOpacity'	  : 0.5,
			'overlayColor'		  : '#000',
			'autoScale'         : true,
			'width'				  : 857,
			'height'				  : 600
		});

		$.fancybox.resize ();
	},

	labelize: function(selector) {
		if (typeof(selector) == 'undefined') {
			selector = 'body';
		}

		var width = 0;

		$(selector).find('label').each(function() {
			if (width < $(this).width()) {
				width = $(this).width();
			}
		});
		$(selector).find('label').width(width);
	},
	
	form_resizer: function () {
		$(".toolbar .middle").css ({
			"width"	: ($("body").width () - 40) + "px"
		});

		$("fieldset.two > div").css ({
			"width"	: ((($("fieldset.two").innerWidth () - 80) / 2)) + "px"
		});

		$("fieldset.three > div").css ({
			"width"	: ((($("fieldset.three").innerWidth () - 80) / 3)) + "px"
		});

		$("fieldset.three > div textarea").css ({
			"width"	: ($("fieldset.three > div").innerWidth () - 40) + "px"
		});

		$("fieldset.three .an label").css ({
			"width"	: ($("fieldset.three .an").innerWidth () - 50) + "px"
		});

		$("fieldset.two > div input[type='text'], fieldset.two > div textarea, fieldset.two > div select").css ({
			"width"	: ($("fieldset.two > div").innerWidth () - 40) + "px"
		});
		
		$("fieldset.three > div label, fieldset.three > div input[type='text'], fieldset.three > div select").css ({
			"width"	: ($("fieldset.three > div").innerWidth () - 40) + "px"
		});
		
		$("fieldset.three > div .an label, fieldset.three > div .an input[type='text'], fieldset.three > div .an select").css ({
			"width"	: ($("fieldset.three > div").innerWidth () - 80) + "px"
		});
	}
};

$.tools.dateinput.localize("id", {
    months: 'Januari,Februari,Maret,April,May,June,July,August,September,October,November,December',
    shortMonths:  'Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec',
    days:         'Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
    shortDays:    'Mgg,Sen,Sel,Rab,Kam,Jum,Sab'
});

$(function() {
	$('script[data-xn-config]').each(function() {
		var x = '[{' + $(this).attr('data-xn-config') + '}]';
		$.extend(xn.config, eval(x)[0]);
	});

	xn.helper.stylize('body');
	$("#fader").fadeIn ("fast"); 
	
	$("#fader").css({
		"width"					:"100%",
		"height"					:"100%"
	});

	xn.helper.form_resizer ();
	$(window).resize(function () {
		xn.helper.form_resizer ();
	});

});
