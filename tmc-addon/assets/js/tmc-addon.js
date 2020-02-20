( function( $ ) {
    "use strict";
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var EventSlick = function( $scope, $ ) {
        var items = $scope.find('.tmc-event-dots').data('item');
        $scope.find('.tmc-event-dots').slick({
            vertical: true,
            focusOnSelect: true,
            asNavFor: '.tmc-event-content',
            slidesToShow: items != '' ? parseInt(items) : 4,
            slidesToScroll: 1,
            verticalSwiping: true,
            infinite: false,
            centerMode: true,
            centerPadding: '0px',
            // autoplay: true,
            // autoplaySpeed: 5000,
            speed: 1000,
            arrows: false,
            // prevArrow:'<i class="fas fa-angle-double-up"></i>',
            // nextArrow: '<i class="fas fa-angle-double-down"></i>'
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        verticalSwiping: false,
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: '50px',
                        arrows: true,
                        vertical: false,
                        prevArrow:'<div class="event-arrows-back fas fa-chevron-left"></div>',
                        nextArrow: '<div class="event-arrows-next fas fa-chevron-right"></div>'
                    }
                }
            ]
        });
        $scope.find('.tmc-event-content').slick({
            dots: false,
            // autoplay: true,
            // autoplaySpeed: 5000,
            asNavFor: '.tmc-event-dots',
            speed: 1000,
            fade: true,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
        //remove active class from all thumbnail slides
        var $new_dot = $scope.find('.tmc-event-dots .slick-slide')
        $new_dot.removeClass('slick-active');

        //set active class to first thumbnail slides
        $new_dot.eq(0).addClass('slick-active');

         // On before slide change match active thumbnail to current slide
        $scope.find('.tmc-event-content').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var mySlideNumber = nextSlide;
            $new_dot.removeClass('slick-active');
            $new_dot.eq(mySlideNumber).addClass('slick-active');
        });
    };
    var PressSlick = function( $scope, $ ) {
        $scope.find('.tmc-press-content').slick({
            rows: 2,
            dots: true,
            slidesToShow: 2,
            slidesToScroll: 2,
            speed: 1000,
            arrows: false,
            customPaging: function(slider, i) {
              // this example would render "tabs" with titles
              return '<span class="dot"></span>';
            },
            // prevArrow:'<i class="fas fa-angle-double-up"></i>',
            // nextArrow: '<i class="fas fa-angle-double-down"></i>'
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    };
    var BuildSlick = function( $scope, $ ) {
        $scope.find('.tmc-build-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            speed: 1000,
            arrows: true,
            prevArrow:'<i class="fas fa-angle-left"></i>',
            nextArrow: '<i class="fas fa-angle-right"></i>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    };
    var AlphaTab   = function($scope, $ ){
        var controller = new ScrollMagic.Controller();
        var sections = document.querySelectorAll(".tmc-alpha-tab-content");
        var tl = new TimelineMax();
        var offset = window.innerHeight;
        var w = window.innerWidth;

        var tabs = document.querySelectorAll(".tmc-tab-item");
        tabs[0].classList.add("active");

        var slides = sections.length;


        // tl.to(sections[0], .5, { x: "-100%", ease: Linear.easeNone }, '-=.5')
        // for (var i = 0; i < slides - 1; i++) {
          tl.to('#tab-1', 1, { x: "-80%", onComplete:addActive,onCompleteParams:[1],onReverseComplete:addActive,onReverseCompleteParams:[0] });
          tl.to('#tab-2', 1, { x: "-80%", onComplete:addActive,onCompleteParams:[2],onReverseComplete:addActive,onReverseCompleteParams:[1] });
          tl.to('#tab-3', 1, { x: "-80%", onComplete:addActive,onCompleteParams:[3],onReverseComplete:addActive,onReverseCompleteParams:[2] });
        // }

        // console.log(sections[sections.length - 1])

        tl.to('#tab-4', .5, { x: "0%", onComplete:addActive,onCompleteParams:[3],onReverseComplete:addActive,onReverseCompleteParams:[2] });

        new ScrollMagic.Scene({
          triggerElement: "#pinContainer",
          triggerHook: "onLeave",
          duration: (w * (sections.length - 1))
        })
          .setPin("#pinContainer")
          .setTween(tl)
          .addTo(controller);

        $(".tmc-alpha-tab-content").each(function(i) {
            var target1 = $(this).find(".tmc-tab-left");
            var target2 = $(this).find(".tmc-tab-right");
            var tl = new TimelineMax();
            tl.staggerFrom(target1, 0.3, { ease: "bounce.inOut" });
            tl.staggerFrom(target2, 0.3, { ease: "bounce.inOut"});

          new ScrollMagic.Scene({
            triggerElement: "#pinContainer",
            triggerHook: 0,
            offset: i * w
          })
            .setTween(tl)
            .addTo(controller)
        });
    };
    function addActive(index){
        var sections = document.querySelectorAll(".tmc-alpha-tab-content");
        var tabs = document.querySelectorAll(".tmc-tab-item");
        for(var i = 0;i < sections.length;i++){     
            if(i === index) {
                tabs[i].classList.add("active");
            }else{
                tabs[i].classList.remove("active");
            }
        }
    }
    var SliderSwiper = function( $scope, $ ){
        new Swiper(".tmc-slider-widget", {
            loop: !0,
            effect: "fade",
            speed: 1e3,
            fadeEffect: {
                crossFade: !0
            },
            autoplay: {
                delay: 3e3
            },
            pagination: {
                el: ".swiper-pagination",
                type: "bullets",
                clickable: !0,
                renderBullet: function(e, t) {
                    var a = document.getElementById("tab-" + (e + 1));
                    return '<span class="' + t + '" style="color: ' + a.getAttribute("data-color") + ';"><span class="swiper-pagination-bg" style="background: ' + a.getAttribute("data-color") + '"></span><span class="swiper-pagination-letter">' + a.getAttribute("data-letter") + "</span></span>"
                }
            }
        });
        for (var e = document.querySelectorAll(".swiper-pagination-bullet"), t = 0; t < e.length; t++) e[t].addEventListener("click", (function() {
            this.classList.add("swiper-pagination-bullet-active-click")
        }));
    };    
    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {

        // elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-post-layout.default', TMCCarousel );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-event.default', EventSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-press.default', PressSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-build.default', BuildSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-slider.default', SliderSwiper );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc_alpha_tabs.default', AlphaTab );
    } );
})( jQuery );