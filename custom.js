jQuery(document).ready(function () {
    jQuery(window).scroll(function () {
        if (jQuery(document).scrollTop() > 0) {
            jQuery(".header").addClass("sticky");
            jQuery(".btn-top").show();
        } else {
            jQuery(".header").removeClass("sticky");
            jQuery(".btn-top").hide();
        }
    });

    jQuery(".btn-top").click(function () {

        jQuery("html, body").animate({
            scrollTop: 0,
        },
            400
        );
        return false;
    });

    jQuery('.dropdown-content').hide();
    jQuery('.dropbtn').click(function () {
        jQuery('.dropdown-content').toggle();
    })

});

/*--------------hamberger menu----------*/
jQuery(document).ready(function () {

    jQuery('.hfe-nav-menu-icon').click(function () {
        jQuery('html').toggleClass('show-menu');
    });

});


jQuery(document).ready(function () {

    jQuery('.proposal-form-table-wrap input[type!="submit"],textarea,select').focusin(function () {
        jQuery(this).parent().parent().addClass('input_focus');
        jQuery('.submit-btn input').parent().parent().removeClass('input_focus');
    }).focusout(function () {
        jQuery(this).parent().parent().removeClass('input_focus');
    })

    jQuery('.proposal-form-table-wrap input[type!="submit"],textarea,select').change(function () {
        if (jQuery(this).val() != '') {
            jQuery(this).parent().parent().addClass('value_focus');
        } else {
            jQuery(this).parent().parent().removeClass('value_focus');
        }
    })
    jQuery('#block-10,#block-8').wrapAll('<div class="block-wrap"></div>');
});

// jQuery(document).ready(function() {
// jQuery('.wp-block-archives-list').hide();
// jQuery(".wp-block-heading").click(function() {
//     jQuery('.wp-block-archives-list').toggle();

// });

// });