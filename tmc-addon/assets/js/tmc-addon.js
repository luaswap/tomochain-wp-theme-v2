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
            // autoplay: true,
            // autoplaySpeed: 5000,
            speed: 1000,
            arrows: false,
            // prevArrow:'<i class="fas fa-angle-double-up"></i>',
            // nextArrow: '<i class="fas fa-angle-double-down"></i>'
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
        });
    };
    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {

        // elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-post-layout.default', TMCCarousel );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-event.default', EventSlick );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/tmc-press.default', PressSlick );
    } );
})( jQuery );