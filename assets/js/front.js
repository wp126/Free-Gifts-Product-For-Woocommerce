jQuery(document).ready(function() {
    //console.log(FGWWdata.showslider_item_desktop);
    jQuery('body').on('click', '.fgw_gift_btn', function() {

        if (jQuery(".fgw_gift_div").length > 0) {
            jQuery('html, body').animate({scrollTop: jQuery('.fgw_gift_div').offset().top - 100}, 'fast');
        } else {
            jQuery('body').addClass("fgw_body_gift");
            jQuery('#fgw_gifts_popup').css('display', 'block');
            jQuery('.fgw_gifts_popup_overlay').css("display", "block");
        }
        
        return false;
    });

    jQuery('body').on('click', '.fgw_gifts_popup_close', function() {
        jQuery("#fgw_gifts_popup").css("display", "none");
        jQuery('.fgw_gifts_popup_overlay').css("display", "none");
        jQuery('body').removeClass("fgw_body_gift");
    });

    jQuery('body').on('click', '.fgw_gifts_popup_overlay', function() {
        jQuery("#fgw_gifts_popup").css("display", "none");
        jQuery('.fgw_gifts_popup_overlay').css("display", "none");
        jQuery('body').removeClass("fgw_body_gift");
    });

    if (jQuery(window).width() < 768) {


          if(FGWWdata.showslider_autoplay_or_not_mob == "yes"){

                var slider_true = true;

            }else{
                var slider_true = false;
            }
           

    }else{

         if(FGWWdata.showslider_autoplay_or_not == "yes"){

            var slider_true = true;

        }else{
            var slider_true = false;
        }

    }

   

  

    setInterval(function() {
        jQuery('.fgw_gift_slider').owlCarousel({
            loop:false,
            margin:10,
            nav:true,
            dots: true,
            autoplay:slider_true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:FGWWdata.showslider_item_mobile
                },
                600:{
                    items:FGWWdata.showslider_item_tablet
                },
                1000:{
                    items:FGWWdata.showslider_item_desktop
                }
            }
        })
    }, 1000);

    setInterval(function() {
        jQuery('.fgw_gift_slider_pp').owlCarousel({
            loop:false,
            margin:10,
            nav:true,
            dots: true,
            autoplay:slider_true,
            autoplayTimeout:2000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:FGWWdata.showslider_item_mobile
                },
                600:{
                    items:FGWWdata.showslider_item_tablet
                },
                1000:{
                    items:FGWWdata.showslider_item_desktop
                }
            }
        })
    }, 1000);
    
});