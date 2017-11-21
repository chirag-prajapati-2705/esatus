$(document).ready(function() {
        $('.header').scrollToFixed();
        $('.header').bind('fixed.ScrollToFixed', function() { $(this).css('color', ''); });
        $('.header').bind('unfixed.ScrollToFixed', function() { $(this).css('color', ''); });

        $('.footer').scrollToFixed( {
            //bottom: 0,
            limit: $('.footer').offset().top,
            preFixed: function() { $(this).css('color', ''); },
            postFixed: function() { $(this).css('color', ''); },
        });

        // Order matters here because we are dependent on the state of the footer above for
        // our limit.  The footer must be set first; otherwise, we will not be in the right
        // position on a window refresh, if the limit is supposed to be invoked.
        $('#summary').scrollToFixed({
            marginTop: $('.header').outerHeight(true) + 10,
            limit: function() {
                var limit = $('.footer').offset().top - $('#summary').outerHeight(true) - 10;
                return limit;
            },
            minWidth: 1000,
            zIndex: 999,
            fixed: function() {  },
            dontCheckForPositionFixedSupport: true
        });

        $('#summary').bind('unfixed.ScrollToFixed', function() {
            if (window.console) console.log('summary preUnfixed');
        });
        $('#summary').bind('unfixed.ScrollToFixed', function() {
            if (window.console) console.log('summary unfixed');
            $(this).css('color', '');
            $('.header').trigger('unfixed.ScrollToFixed');
        });
        $('#summary').bind('fixed.ScrollToFixed', function() {
            if (window.console) console.log('summary fixed');
            $(this).css('color', '');
            $('.header').trigger('fixed.ScrollToFixed');
        });
        $('#vertical-ticker').totemticker({
				row_height	:	'100px',
				next		:	'#ticker-next',
				previous	:	'#ticker-previous',
				stop		:	'#stop',
				start		:	'#start',
				mousestop	:	true,
			});
    });