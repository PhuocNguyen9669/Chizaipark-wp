/***************************************************************************
 *
 * SCRIPT JS
 *
 ***************************************************************************/

$(document).ready(function() {
    getMobileOperatingSystem();

    //Click event to scroll to top
    $('.scrollToTop a').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 800);
        return false;
    });

    // HAMBEGER BUTTON MENU SP CLICK
    $('.hamburger').click(function() {
        if ($(this).hasClass("open")) {
            $(this).removeClass('open');
            $(this).addClass('close');
        } else {
            $(this).removeClass('close');
            $(this).addClass('open');
        }

        if ($(window).width() <= 768) {
            $('#header .mainMenu').stop().slideToggle();
            $('body').toggleClass('fixed');
        } else {

        }
    });

    // FIX HEIGHT HEADER SP
    function fixedHeader() {
        var hHead = $('#header').outerHeight();
        $('#fixH').css('height', hHead);
    }
    
    $(window).resize(function(event) {
        fixedHeader();
    });

    $(window).load(function(event){
        fixedHeader();
    });


    //SCROLL TO TOP 
    $(window).scroll(function() {
        if ($(this).scrollTop() > 80) {
            $('.scrollToTop').fadeIn(400);
        } else {
            $('.scrollToTop').fadeOut(400);
        }
    });


    addDeviceClassInBody();
    function addDeviceClassInBody() {
        var userAgent = navigator.userAgent;
        if( userAgent.match( /iPhone/i ) ) {
            $('body').addClass('iPhone');
        }
    }

    // SCROLL ANCHOR
    $('.anchor a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                var target_offset = 0;
                if (target.attr('data-offset')) {
                    target_offset = target.attr('data-offset');
                    target_offset = parseInt(target_offset);
                }
                $('html,body').animate({
                    scrollTop: target.offset().top - 90 + target_offset
                }, 1000);
                return false;
            }
        }
    });

    function resizeHeaderScroll() {
        // FIX HEADER SCROLL
        if ($(window).width() < 1214) {
            $("#header").addClass('scrollX');
            $(window).scroll(function(event) {
                var x = -$(this).scrollLeft();

                $("#header.scrollX").css({
                    left: x
                });
            });
        } else {
            $("#header").removeClass('scrollX');
            $("#header").css('left', 0);
        }
    }

    $(window).resize(function(event) {
        resizeHeaderScroll();
    });

    // OBJECTFIT IMAGE ON IE
    var userAgent, ieReg, ie;
    userAgent = window.navigator.userAgent;
    ieReg = /msie|Trident.*rv[ :]*11\./gi;
    ie = ieReg.test(userAgent);

    if (ie) {
        $(".objfitIE").each(function() {
            var $container = $(this),
                imgUrl = $container.find("img").prop("src");
            if (imgUrl) {
                $container.css("backgroundImage", 'url(' + imgUrl + ')').addClass("custom-object-fit");
            }
        });
    }

});

/* js support in mobile + tablet + ipad */
function getMobileOperatingSystem() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;

    if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i) || userAgent.match(/iPod/i)) {
        /*=========================================*/

        window.addEventListener("orientationchange", function() {


        }, false);



    } else if (userAgent.match(/Android/i)) {

        /*=========================================*/

        window.addEventListener("orientationchange", function() {


        }, false);

        /*=================================================*/
    } else {
        return 'unknown';
    }

}