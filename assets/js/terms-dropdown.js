/**--------------------------------------------------------------------
 *                     Categories widget
/*--------------------------------------------------------------------*/
;(function ($) {
  "use strict";

  var termsDropdown = function termsDropdown($scop, $) {
    $('.toggle-category').each(function () {
      $(this).next('.anony-dropdown').attr('id', $(this).attr('rel-id'));
      $(this).css( 'height', $(this).prev( 'a' ).outerHeight() );
    });

    $(document).on('click', '.toggle-category', function () {
      var clicked = $(this);
      var targetID = clicked.attr('rel-id');
      var ul_parents = clicked.parents('ul');

      if(!$('#' + targetID ).hasClass('anony-show')){
        $('#' + targetID ).slideDown('slow');
        $('#' + targetID ).addClass('anony-show');
        clicked.hide();
        clicked.next().show();
      }else{
        $('#' + targetID ).slideUp('slow');
        $('#' + targetID ).removeClass('anony-show');
        clicked.hide();
        clicked.prev().show();
      }

      ul_parents.each(function (k) {
        var currentParent = $(this);

        if (k === 0) {
          var prv_dropdowns = currentParent.find('.anony-dropdown');
          prv_dropdowns.each(function () {
            if($(this).attr('id') !== targetID){
              $(this).removeClass('anony-show');
              $(this).parent('li').find('.toggle-category-opened').hide();
              $(this).parent('li').find('.toggle-category-closed').show();
              $(this).slideUp('slow');
            }
          });
        }
      }); //Close all dropdowns when click on any place in the document
      //And this clicked place is not of toggle elements

      $(document).click(function (e) {
        if(!$(e.target.offsetParent).is('.toggle-category') && !$(e.target).is('.toggle-category') && !$(e.target.parentElement).is('.toggle-category')){
          $('.anony-dropdown').slideUp('slow');
          $('.anony-dropdown').removeClass('anony-show');
          $('.toggle-category-closed').show();
          $('.toggle-category-opened').hide();
        }
      });
    });
  };

  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/terms-dropdown.default', termsDropdown);
  });
})(jQuery);