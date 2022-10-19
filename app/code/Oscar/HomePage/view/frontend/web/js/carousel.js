 define([
    "jquery",
    "bizkickowlcarousel"
], function($){
    return function (config, elem) {
        $(elem).addClass('owl-carousel');
        $(elem).owlCarousel(config);
        $(".home-slider li").show();
    }
});