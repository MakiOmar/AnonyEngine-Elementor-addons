jQuery(document).ready(function($) {
    $('.heapshot').heapshot({
        'indexStart'        : 100, // The z-index css property which is applied to the images, the count start from this option
        'rotation'          : 80, // The angle applied during easing
        'easing'            : function(x, t, b, c, d){return c*t/d + b;}, // An equation to calculate the easing
        'overflowparents'   : true, // Set all the parents overflow to visible if set to true
        'autostart'         : true, // Start automatically the flipping if set to true
        'animationdelay'    : 1500 // The time between flipping animations
    });
});