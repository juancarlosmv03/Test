<?php
/**
 * Home page.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/home/hero' );
get_template_part( 'template-parts/marquee' );
get_template_part( 'template-parts/home/why' );
get_template_part( 'template-parts/home/join' );
get_template_part( 'template-parts/home/classes' );
get_template_part( 'template-parts/prices' );
get_template_part( 'template-parts/home/inside' );
get_template_part( 'template-parts/news' );
get_template_part( 'template-parts/cta' );
get_template_part( 'template-parts/home/contact' );
get_template_part( 'template-parts/lightbox' );

get_footer();
