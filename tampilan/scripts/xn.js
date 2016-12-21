if (typeof(console) == 'undefined') {
    window.console = console = {
        log: function() {},
        info: function() {},
        warn: function() {},
        error: function() {}
    };
}

var dateFormat = function () {
    var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
    timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
    timezoneClip = /[^-+\dA-Z]/g,
    pad = function (val, len) {
        val = String(val);
        len = len || 2;
        while (val.length < len) val = "0" + val;
        return val;
    };

    // Regexes and supporting functions are cached through closure
    return function (date, mask, utc) {
        var dF = dateFormat;

        // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
        if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
            mask = date;
            date = undefined;
        }

        // Passing date through Date applies Date.parse, if necessary
        date = date ? new Date(date) : new Date;
        if (isNaN(date)) throw SyntaxError("invalid date");

        mask = String(dF.masks[mask] || mask || dF.masks["default"]);

        // Allow setting the utc argument via the mask
        if (mask.slice(0, 4) == "UTC:") {
            mask = mask.slice(4);
            utc = true;
        }

        var	_ = utc ? "getUTC" : "get",
        d = date[_ + "Date"](),
        D = date[_ + "Day"](),
        m = date[_ + "Month"](),
        y = date[_ + "FullYear"](),
        H = date[_ + "Hours"](),
        M = date[_ + "Minutes"](),
        s = date[_ + "Seconds"](),
        L = date[_ + "Milliseconds"](),
        o = utc ? 0 : date.getTimezoneOffset(),
        flags = {
            d:    d,
            dd:   pad(d),
            ddd:  dF.i18n.dayNames[D],
            dddd: dF.i18n.dayNames[D + 7],
            m:    m + 1,
            mm:   pad(m + 1),
            mmm:  dF.i18n.monthNames[m],
            mmmm: dF.i18n.monthNames[m + 12],
            yy:   String(y).slice(2),
            yyyy: y,
            h:    H % 12 || 12,
            hh:   pad(H % 12 || 12),
            H:    H,
            HH:   pad(H),
            M:    M,
            MM:   pad(M),
            s:    s,
            ss:   pad(s),
            l:    pad(L, 3),
            L:    pad(L > 99 ? Math.round(L / 10) : L),
            t:    H < 12 ? "a"  : "p",
            tt:   H < 12 ? "am" : "pm",
            T:    H < 12 ? "A"  : "P",
            TT:   H < 12 ? "AM" : "PM",
            Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
            o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
            S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
        };

        return mask.replace(token, function ($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });
    };
}();

// Some common format strings
dateFormat.masks = {
    "default":      "ddd mmm dd yyyy HH:MM:ss",
    shortDate:      "m/d/yy",
    mediumDate:     "mmm d, yyyy",
    longDate:       "mmmm d, yyyy",
    fullDate:       "dddd, mmmm d, yyyy",
    shortTime:      "h:MM TT",
    mediumTime:     "h:MM:ss TT",
    longTime:       "h:MM:ss TT Z",
    isoDate:        "yyyy-mm-dd",
    isoTime:        "HH:MM:ss",
    isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
    isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
    dayNames: [
    "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
    "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
    ],
    monthNames: [
    "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
    ]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
    return dateFormat(this, mask, utc);
};

jQuery.fn.clippy = function(url, target) {
    return jQuery(this).embedflash({
        width: 14,
        height: 14,
        url: url,
        vars: {
            text: jQuery(this).html(),
            target: target
        }
    });
};

jQuery.fn.embedflash = function(options) {
    var vars = (function() {
        var result = [], _vars = options.vars || {}, k;
        for (k in _vars) {
            if (!_vars.hasOwnProperty(k)) continue;
            result.push("" + (escape(k)) + "=" + (escape(_vars[k])));
        }
        return result;
    })().join("&");
    return jQuery(this).html("<object id=\"clippy_swf_"+options.vars.target+"\" classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" width=\"" + (options.width) + "\" height=\"" + (options.height) + "\"> <param name=\"movie\" value=\"" + (escape(options.url)) + "\"/> <param name=\"allowScriptAccess\" value=\"always\" /> <param name=\"quality\" value=\"high\" /> <param name=\"wmode\" value=\"transparent\"/> <param name=\"scale\" value=\"noscale\" /> <param name=\"FlashVars\" value=\"" + (vars) + "\"> <embed src=\"" + (escape(options.url)) + "\" width=\"" + (options.width) + "\" height=\"" + (options.height) + "\" quality=\"high\" allowScriptAccess=\"always\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" FlashVars=\"" + (vars) + "\" wmode=\"transparent\" /> </object>");
};

$.fn.shake = function(opt){
    opt=$.extend({
        times: 8,
        delay: 150,
        pixels: 20,
        name: 'margin-left'
    },opt||{});
                 
    $(this).each(function(){
        var mx = 0;
        var op = '+';
        var amount;
        var easing = 'jswing';
        var css;
        for (var i=0; i < opt.times; i++) {
            if (mx == 0) {
                amount = opt.pixels;
                mx = -1;
            //                easing = 'easeInBack';
            } else {
                amount = opt.pixels * 2;
                if (mx > 0) {
                    op = '+';
                //                    easing = 'easeOutBack';
                } else {
                    op = '-';
                //                    easing = 'easeInBack';
                }
                mx = -mx;
            }
            css = {};
            css[opt.name] = op + '=' + amount + 'px';
            $(this).animate(css, opt.delay, easing);
        }
                        
        amount = opt.pixels;
        if (mx > 0) {
            op = '+';
        //            easing = 'easeOutBack';
        } else {
            op = '-';
        //            easing = 'easeInBack';
        }
        css = {};
        css[opt.name] = op + '=' + amount + 'px';
        $(this).animate(css, opt.delay, easing);
                        
    });
                    
}

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

xn.config = {
    'fancyOptions': {
        'transitionIn'      : 'elastic',
        'transitionOut'     : 'elastic',
        'autoDimensions'    : true,
        'autoScale'         : false,
        'centerOnScroll'    : true,
        'overlayOpacity'    : 0.9,
        'overlayColor'      : '#000',
        'overlayShow'       : true,
        'scrolling'         : 'no',
        'showNavArrows'     : false,
        'height'            : 'auto',
        //            'padding'           : 20,
        'modal'             : true,
        'speedIn'           : 350,
        'speedOut'          : 350,
            
        'onStart'           : function(obj) {
            if ($(obj).attr('data-selected') == '') {
                return false;
            }
        },

        'onComplete'        : function() {
            $('#fancybox-close').show();
            xn.helper.stylize('#fancybox-inner');
            //                xn.helper.fancyformify('#fancybox-inner');
            $(document).unbind('keydown.fb').bind('keydown.fb', function(e) {
                if (e.keyCode == 27) {
                    e.preventDefault();
                    $.fancybox.close();

                } else if ((e.keyCode == 37 || e.keyCode == 39) && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    $.fancybox[ e.keyCode == 37 ? 'prev' : 'next']();
                }
            });
        },
            
        'onClosed'           : function(obj) {
            if ($(obj).hasClass('no-update')) {
            } else if ($(obj).hasClass('reload-update')) {
                location.href = location.href;
            //            } else {
            //                $('.grid-container').load(location.href, function() {
            //                    xn.helper.stylize($(this));
            //                });
            }
        }
    }
};

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
        $(selector).find("select").addClass("select");

        $(selector).find("table > tr:nth-child(odd),ul > li:nth-child(odd), ol > li:nth-child(odd), .list > .comment:nth-child(odd)").addClass("odd");
        $(selector).find("table > tr:nth-child(even),ul > li:nth-child(even), ol > li:nth-child(even), .list > .comment:nth-child(even)").addClass("even");
        $(selector).find("ul > li:first-child, ol > li:first-child, .list > .comment:first-child").addClass("first");
        $(selector).find("ul > li:last-child, ol > li:last-child, .list > .comment:last-child").addClass("last");
        //$(selector).find("th").wrapInner ("<div><div></div></div>");

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

        $(selector).find("a[title!=''], img[title!=''], div[title!='']").tooltip({
            //            tip:'.tooltips'
            effect:'fade'
        });

        $(selector).find('input.date').dateinput({
            lang: 'id',
            format: 'dd/mm/yyyy',
            selectors: true,
            min: '1980-01-01',
            yearRange: [-20, 80],
            offset: [3, 0],
            speed: 'fast',
            change: function(evt) {
                try {
                    var isoDate = this.getValue('yyyy-mm-dd');
                    var input = $(this.getInput());
                    var hidden = input.parent().find('.hidden-val');
                    hidden.val(isoDate);
                } catch(e) {}
            }
        });
        
        $(selector).find('input.number').keypress(function(evt, a) {
            if (!(evt.charCode >= 48 && evt.charCode <= 57) && evt.charCode != 13) {
                evt.preventDefault();
            }
        });
        
        $(selector).find('input.phone_number').keypress(function(evt, a) {
            if (!(evt.charCode >= 48 && evt.charCode <= 57) && evt.charCode != 13 && evt.charCode != 43) {
                evt.preventDefault();
            }
        });
        
        $(selector).find('input.regex-val').keypress(function(evt, a) {
            s = evt.which | evt.charCode | evt.keyCode;
            if (s == 8 || s == 46 || s == 37 || s == 38 || s == 39 || s == 40 || s == 9) {
                return true;
            }
            var str = $(this).val() + String.fromCharCode(evt.charCode);
            var reg = new RegExp($(this).attr('data-regex'));
            var s = str.search(reg);
            if (s == -1) {
                evt.preventDefault();
                return false;
            }
        });
        
        $(selector).find('.cancel').click(function(evt) {
            if ($(this).parents('#fancybox-inner').length > 0) {
                evt.preventDefault();
                $.fancybox.close();
                return false;
            }
        });

        try {
            $(selector).find('textarea.wysiwyg').wysiwyg({
                'css': xn.config.baseUrl + 'themes/default/css/global.wysiwyg.css'
            });
        } catch (e) {}
        
        $(selector).find('a.mass-action').each(function() {
            $(this).attr('data-href', $(this).attr('href'))
        }).click(function(evt) {
            var href = $(this).attr('data-href');
            
            var selectedList = [];
            $('table.grid').find('tr.grid_row *[checked]').parents('tr').each(function(index, node) {
                if (selectedList[0] != $(node).attr('data-ref')) {
                    selectedList.push($(node).attr('data-ref'));
                }
            });
            
            $(this).attr('data-selected', selectedList.join(','));
            $(this).attr('href', href + '/' + selectedList.join(','));
            if (selectedList.join(',') == '') {
                var fancyOptions = xn.config.fancyOptions;
                fancyOptions['autoDimensions']	= false;
                fancyOptions['width'] = 350;
                fancyOptions['height'] = 58;
                $.fancybox('<div class="error" style="width: 300px; height: auto;">Tidak ada data yang dipilih</div>', fancyOptions);
                evt.preventDefault();
                return false;
            }
            
            return true;
        });
        
        $(selector).find("a.msgbox").fancybox (xn.config.fancyOptions);

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

        $("fieldset.two > div input[type='text'], div input[type='file'], fieldset.two > div textarea, fieldset.two > div select").css ({
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
    
    var loading = $('<div id="loading"></div>');
    $('body').prepend(loading);
    loading.bind("ajaxStart", function(){
        $(this).css({
            'left': ($(window).width() - loading.width()) /  2,
            'top': ($(window).height() - loading.height()) /  2
        }).show();
    }).bind("ajaxStop", function(){
        $(this).hide();
    });

    xn.helper.stylize('body');
    
    var wResize = function() {
        try {
            var window_height = $('body').innerHeight();
            $('#layout-footer').css('height', 'auto');
            var layout_height = $('#fader').height();
            if (window_height > layout_height) {
                var footer_height =  window_height - layout_height + $('#layout-footer').height() - 1;
                $('#layout-footer').height(footer_height);
            }
        } catch (e) {}
    }
    
    wResize();
    xn.helper.form_resizer ();
    
    $(window).resize(function () {
        wResize();
        xn.helper.form_resizer ();
    });
    
});


var konami = "38,38,40,40,37,39,37,39,66,65".split(',');
var keyIndex = 0;
$(document).keydown(function(ev) {
    (konami[keyIndex] == ev.keyCode) ? keyIndex++:keyIndex = 0;
    if (keyIndex == konami.length) {
        $.fancybox('<div id="konamicode" style="width: 853px; height: 510px;"></div>', {
            'width': 853,
            'height': 510,
            'scrolling': 'none',
            'overlayColor': '#000000',
            'overlayOpacity': 0.75,
            'centerOnScroll': true,
            'onComplete': function() {
                $('#konamicode').load(xn.helper.createUrl('install'), function() {
                    xn.helper.stylize('#konamicode');
                    $.fancybox.resize();
                });
            },
            'onClosed': function () {
                $('.even').addClass ('rotate2');
                $('.odd').addClass ('rotate-2');
                $('#konamicode').remove ();
            }
        });
        keyIndex = 0;
    }
});
