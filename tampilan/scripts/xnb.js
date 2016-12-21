$.fn.disableSelection = function() {
    $(this).attr('unselectable', 'on')
    .css('-moz-user-select', 'none')
    .each(function() { 
        this.onselectstart = function() {
            return false;
        };
    });
};

var xn = {};

xn.config = {};

xn.helper = {
        
    createUrl: function(uri) {
        return xn.config.baseUrl + 'index.php/' + uri;
    },
    
    dataUrl: function(uri) {
        return xn.config.baseUrl + 'data/' + uri;
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
        $(selector).find("input:file").addClass("file");

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
        $(selector).find("input[type='text'], input[type='password'], input[type='checkbox'], input[type='radio'], textarea").uniform();

        $(selector).find("a[title!=''], img[title!=''], div[title!='']").tooltip({
            //            tip:'.tooltips'
            effect:'fade'
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
        
        $(selector).find('input.phone_number').keypress(function(evt, a) {
            if (!(evt.charCode >= 48 && evt.charCode <= 57) && evt.charCode != 13 &&evt.charCode != 43) {
                evt.preventDefault();
            }
        });
        
        $(selector).find('input.regex-val').keypress(function(evt, a) {
            s = evt.which | evt.charCode | evt.keyCode;
            console.log(s);
            if (s == 8 || s == 46 || s == 37 || s == 38 || s == 39 || s == 40 || s == 9) {
                return true;
            }
            var str = $(this).val() + String.fromCharCode(evt.charCode);
            var reg = new RegExp($(this).attr('data-regex'));
            var s = str.search(reg);
            console.log(s);
            if (s == -1) {
                evt.preventDefault();
                return false;
            }
            
            
        });

        $(selector).find('.cancel').click(function(evt) {
            if ($(this).parents('#fancybox-inner').length) {
                
                evt.preventDefault();
                $.fancybox.close();
                return false;
            }
        });
        
        $(selector).find('a.mass-action').each(function() {
            $(this).attr('data-href', $(this).attr('href'))
        }).click(function(evt) {
            var href = $(this).attr('data-href');
            
            var selectedList = [];
            $('table.grid').find('tr.grid_row *[checked]').parents('tr').each(function(index, node) {
                console.log($(node));
                if (selectedList[0] != $(node).attr('data-ref')) {
                    selectedList.push($(node).attr('data-ref'));
                }
            });
            
            $(this).attr('data-selected', selectedList.join(','));
            $(this).attr('href', href + '/' + selectedList.join(','));
            
            if ($(this).hasClass('msgbox')) {
                evt.preventDefault();
                return false;
            }
        });
        
        $(selector).find("a.msgbox").fancybox ({
            'transitionIn'      : 'elastic',
            'transitionOut'     : 'elastic',
            'autoDimensions'	: true,
            'autoScale'		: false,
            'centerOnScroll'	: true,
            'overlayOpacity'	: 0.5,
            'overlayColor'	: '#000',
            'showNavArrows'	: false,
            //            'width'		: 'auto',
            //            'height'		: 'auto',
            //            'padding'		: 20,
            'modal'		: true,
            'onStart'           : function() {
                $('#fancybox-close').show();
            }
        });
		
        $(".fancybox").fancybox({
            'padding'           : 0,
            'transitionIn'      : 'elastic',
            'transitionOut'     : 'elastic',
            'overlayOpacity'    : 0.5,
            'overlayColor'      : '#000',
            'autoScale'         : true
        //            'width'             : 857,
        //            'height'            : 600
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
        "width"     :"100%",
        "height"    :"100%"
    });

    xn.helper.form_resizer ();
    $(window).resize(function () {
        xn.helper.form_resizer ();
    });

});
