
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.moment = require('moment');
require('fullcalendar');
window.swal = require('sweetalert');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });
//
// if (process.env.MIX_APP_ENV === 'production') {
//     Vue.config.devtools = false;
//     Vue.config.debug = false;
//     Vue.config.silent = true;
// }

// THIS COULD BE USED TO NORMALIZE CAROUSEL HEIGHTS
// function normalizeSizesAllCarousels()
// {
//     //we loop all the present carousels
//     jQuery('.carousel.slide').each(function()
//     {
//         normalizeSizesOneCarousel('#' + jQuery(this).attr('id'));
//     });
// }
//
// function normalizeSizesOneCarousel(idSelectorCarousel)
// {
//     var images = jQuery(idSelectorCarousel +  ' .carousel-inner .item img');
//     var availableWidth = jQuery(idSelectorCarousel).innerWidth();
//     var maxHeight = 0;
//     var imageHeight = 0;
//     var aspectRatio = 1; // width/height
//     images.each(function(){
//         aspectRatio = calcImgWidth(this)/calcImgHeight(this);
//         imageHeight = availableWidth / aspectRatio;
//         if (imageHeight > maxHeight)
//             maxHeight = imageHeight;
//     });
//     jQuery (idSelectorCarousel).height(maxHeight);
// }
// function calcImgWidth(img)
// {
//     var width=img.width;
//     if (width>0)
//         return width;
//     else
//     {
//         jQuery('body').append('<div id="tempContainer" style="visibility:hidden;position:absolute"></div>');
//         jQuery('#tempContainer').append(img.clone().attr('id',false));
//         width= jQuery('#tempContainer img').width;
//         jQuery('#tempContainer').remove();
//         return width;
//     }
// }
//
// function calcImgHeight(img)
// {
//     var height = img.height;
//     if (height>0)
//         return height;
//     else
//     {
//         jQuery('body').append('<div id="tempContainer" style="visibility:hidden;position:absolute"></div>');
//         jQuery('#tempContainer').append(img.clone().attr('id',false));
//         height= jQuery('#tempContainer img').height;
//         jQuery('#tempContainer').remove();
//         return height;
//     }
// }
//
// jQuery(document).ready(function(){normalizeSizesAllCarousels();});
// jQuery(window).on('resize orientationchange', function () {normalizeSizesAllCarousels();});
