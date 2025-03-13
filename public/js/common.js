'use strict';
$(function(){
// ノークリックのモーダル
var $target = $('.mdl.js-noclick');

$(window).on('load', function(){
    $target.addClass('is-visible');
})
});
