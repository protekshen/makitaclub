var $table = jQuery('#dataCenters')
$table.show()
$table.find('tbody tr').hide()
$table.find('tbody tr[data-region=' + 1 + ']').show()

function onServiceCenterSelected (el) {
  if (el.value != '0') {
    var $table = jQuery('#dataCenters')
    $table.show()
    $table.find('tbody tr').hide()
    $table.find('tbody tr[data-region=' + el.value + ']').show()
  } else {
    hideServiceCentersTable()
  }
}

function hideServiceCentersTable () {
  jQuery('#dataCenters').hide()
}

jQuery(function (a) {
  /*SHOPPING CART*/

  var $checkout_form = jQuery('form.checkout'),
    $address_field = jQuery('#billing_address_1_field')
  $pos_field = jQuery('#billing_pos_field')

  $checkout_form.on('change', 'select.shipping_method', function () {
    adjustAddressVisibility()
  })

  function adjustAddressVisibility () {
    if (jQuery('select.shipping_method').val() === 'local_delivery') {
      $address_field.show()
      $pos_field.hide()
    } else {
      $address_field.hide()
      $pos_field.show()
    }
  }

  $address_field.change(validateAddress)

  function validateAddress () {
    $address_field.removeClass('custom-validated')
    $address_field.removeClass('custom-invalid')

    if (!$address_field.find('input.input-text').val()) {
      $address_field.addClass('custom-invalid')
    } else {
      $address_field.addClass('custom-validated')
    }
  }

  adjustAddressVisibility()
  validateAddress()
})

function hideFree () {
  jQuery('.amount:contains("Бесплатно")').css('display', 'none')
}

hideFree()

jQuery(document).ready(function () {
  jQuery('.options').addClass('active')
  jQuery('#optionsTab').click(function () {
    jQuery('.options').addClass('active')
    jQuery('.description').removeClass('active')
    jQuery('.docs').removeClass('active')
  })
  jQuery('#descriptionTab').click(function () {
    jQuery('.options').removeClass('active')
    jQuery('.description').addClass('active')
    jQuery('.docs').removeClass('active')
  })
  jQuery('#docsTab').click(function () {
    jQuery('.options').removeClass('active')
    jQuery('.description').removeClass('active')
    jQuery('.docs').addClass('active')
  })
})


/* Kupi-makita */

// Scroll top
function fixedMenu () {
  jQuery(document).ready(function () {
    var heightHeader = jQuery('#masthead').height(),
      heightHeaderBottom = jQuery('.primary-navigation').height(),
      _top = heightHeader - heightHeaderBottom,
      allGoods = 'РљР°С‚Р°Р»РѕРі С‚РѕРІР°СЂРѕРІ'
    if (jQuery(document).scrollTop() > _top) {
      jQuery('.header').addClass('fixed-menu')
    }


    jQuery(document).scroll(function () {
      var heightWpadminbar = jQuery('#wpadminbar').height()
      heightHeader = jQuery('#masthead').height() + jQuery('.header').height(),
      heightHeaderBottom = jQuery('.primary-navigation').height(),
      _top = heightHeader - heightHeaderBottom

      if (jQuery(document).scrollTop() > _top) {
        jQuery('.header').addClass('fixed-menu')
      }

      var scrolltop = jQuery(this).scrollTop()

      if (scrolltop > _top) {
        jQuery('.header').addClass('fixed-menu')
        if (heightWpadminbar) {
          jQuery('.header').css('top', '32px')
        }
      }else {
        jQuery('.header').removeClass('fixed-menu')
        jQuery('.header').css('top', '0')
      }
    })
  })
}
fixedMenu()

function flyToElement(flyer, flyingTo) {
    var $func = jQuery(this);
    var divider = 3;
    var flyerClone = jQuery(flyer).clone();
    jQuery(flyerClone).css({position: 'absolute', top: jQuery(flyer).offset().top + "px", left: jQuery(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
    jQuery('body').append(jQuery(flyerClone));
    var gotoX = jQuery(flyingTo).offset().left + (jQuery(flyingTo).width() / 2) - (jQuery(flyer).width()/divider)/2;
    var gotoY = jQuery(flyingTo).offset().top + (jQuery(flyingTo).height() / 2) - (jQuery(flyer).height()/divider)/2;
     
    jQuery(flyerClone).animate({
        opacity: 0.4,
        left: gotoX,
        top: gotoY,
        width: jQuery(flyer).width()/divider,
        height: jQuery(flyer).height()/divider
    }, 700,
    function () {
        jQuery(flyingTo).fadeOut('fast', function () {
            jQuery(flyingTo).fadeIn('fast', function () {
                jQuery(flyerClone).fadeOut('fast', function () {
                    jQuery(flyerClone).remove();
                });
            });
        });
    });
}

jQuery(document).ready(function(){
    jQuery('.add_to_cart_button').on('click',function(){
        jQuery('html, body').animate({
            'scrollTop' : jQuery(".cart-content__section .icon").position().top
        });
        var itemImg = jQuery(this).parent().parent().parent().parent().find('.product-card__thumbnail').find('img').eq(0);
        flyToElement(jQuery(itemImg), jQuery('.products-cart'));
    });
});

jQuery(document).ready(function(){
  jQuery('.add_to_cart_button').click(function() {
    var quantity = jQuery(this).parent().find('.quantity_to_cart').val();
    jQuery(this).data("quantity", quantity);
    //console.log(jQuery(this).data());
  });
});

//Update Cart Realtime
jQuery(document).ready(function($) {
    var upd_cart_btn = $(".woocommerce-cart input[name='update_cart']");
    //upd_cart_btn.hide();
    $(".cart_item").find(".qty").on("change", function(){ 
          upd_cart_btn.trigger("click"); 
    }); 
});

// Override behavior parent link of top menu
jQuery(document).ready(function($) {
  $('.top-menu').hover(
    function() {
      $(this).children('li').children('.is-accordion-submenu').removeAttr("style");
      $(this).children('.is-accordion-submenu-parent').attr("aria-expanded", "true");
    },
    function() {
      $(this).children('li').children('.is-accordion-submenu').css("display","none");
      $(this).children('.is-accordion-submenu-parent').attr("aria-expanded", "false");         
    }
    
  )


  

});


