// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function() {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

// Place any jQuery/helper plugins in here.
jQuery(document).ready(function($) {
    jQuery('.slick-providerfdsa').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: false,
        cssEase: 'linear',
        adaptiveHeight: true,
    });
    jQuery('.hero-slide').slick({
        dots: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        speed: 3000,
        fade: true,
        cssEase: 'linear',
        adaptiveHeight: true,
    });
});