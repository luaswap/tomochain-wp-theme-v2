!function(e){"use strict";var t=function(e,t){var s=e.find(".tmc-event-dots").data("item");e.find(".tmc-event-dots").slick({vertical:!0,focusOnSelect:!0,asNavFor:".tmc-event-content",slidesToShow:""!=s?parseInt(s):4,slidesToScroll:1,verticalSwiping:!0,speed:1e3,arrows:!1,responsive:[{breakpoint:768,settings:{verticalSwiping:!1,slidesToShow:1,centerMode:!0,arrows:!0,vertical:!1,prevArrow:'<div class="event-arrows-back fas fa-chevron-left"></div>',nextArrow:'<div class="event-arrows-next fas fa-chevron-right"></div>'}}]}),e.find(".tmc-event-content").slick({dots:!1,asNavFor:".tmc-event-dots",speed:1e3,fade:!0,arrows:!1,slidesToShow:1,slidesToScroll:1});var i=e.find(".tmc-event-dots .slick-slide");i.removeClass("slick-active"),i.eq(0).addClass("slick-active"),e.find(".tmc-event-content").on("beforeChange",function(e,t,s,n){var o=n;i.removeClass("slick-active"),i.eq(o).addClass("slick-active")})},s=function(e,t){e.find(".tmc-press-content").slick({rows:2,dots:!0,slidesToShow:2,slidesToScroll:2,speed:1e3,arrows:!1,customPaging:function(e,t){return'<span class="dot"></span>'},responsive:[{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}}]})};e(window).on("elementor/frontend/init",function(){elementorFrontend.hooks.addAction("frontend/element_ready/tmc-event.default",t),elementorFrontend.hooks.addAction("frontend/element_ready/tmc-press.default",s)})}(jQuery);
//# sourceMappingURL=tmc-addon-dist.js.map