//javascript function
jQuery(function(){
   console.log("wordpressing matters");

    if(!jQuery('#myCanvas').tagcanvas({
        textColour: '#73F9DA',
        outlineColour: null,
        bgOutlineThickness: 0,
        reverse: true,
        depth: 0.6,
        maxSpeed: 0.05,
        noSelect: true,
    },'tags')) {
        // something went wrong, hide the canvas container
        jQuery('#myCanvasContainer').hide();
    }

    //Mobile Navigation Animation
    var mobile_menu = jQuery('.mobile-navigation-container');

    jQuery('.mobile-burger').on('click', function(){

        mobile_menu.toggleClass('mobile-nav');

        // if(mobile_menu.hasClass('mobile-nav')){
        //     console.log('yes ahs class');
        //     mobile_menu.removeClass('mobile-nav');
        //     mobile_menu.addClass('mobile-nav-reverse');
        // }else{
        //     console.log('adding class');
        //     mobile_menu.removeClass('mobile-nav-reverse');
        //     jQuery('.mobile-navigation-container').addClass('mobile-nav');
        // }

    });



});

