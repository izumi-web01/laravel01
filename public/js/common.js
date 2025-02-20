'use strict';
console.log('こんにちは');
window.alert('こんにちは');
$(function(){
// ノークリックのモーダル
var $target = $('.mdl.js-noclick');

$(window).on('load', function(){
    $target.addClass('is-visible');
})
});
