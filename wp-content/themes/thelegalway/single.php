<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Thelegalway
 */
while ( have_posts() ) : the_post();

	get_template_part( thelegalway_get_single_post_template_part_slug(), get_post_format() );

	get_template_part( 'template-parts/content', 'post-navigation' );

	thelegalway_related_posts();

	thelegalway_post_author_bio();

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
