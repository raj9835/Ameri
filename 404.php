<?php
/**
 * 404 template.
 *
 * @package Neve
 */

get_header();
//do_action( 'neve_do_404' );
echo do_shortcode("[hfe_template id='867']");
get_footer();