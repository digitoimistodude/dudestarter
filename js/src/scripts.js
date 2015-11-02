$(document).ready(function(){

    $(".menu").flexNav({
        'hover': true,
        'hoverIntent': false,
        'hoverIntentTimeout': 0,
        'animationOpenSpeed': 1000,
        'animationCloseSpeed': 100,
        'animationCloseEffect': 'easeOutSine',
        'animationOpenEffect': 'easeOutBounce',
        'transitionOpacity': true,
        'calcItemWidths': false,
        'transitionOpacity': false
    });

});

$(window).load(function() {
    // $('.col').equalHeights();
});