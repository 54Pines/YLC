<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Thelegalway
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $utility = thelegalway_utility()->utility; ?>

	<header class="entry-header">

		<?php $utility->attributes->get_title( array(
				'class' => 'entry-title',
				'html'  => '<h3 %1$s>%4$s</h3>',
				'echo'  => true,
			) );
		?>

	</header><!-- .entry-header -->

	<?php get_template_part( 'template-parts/content-entry-meta-single' ); ?>

	<?php thelegalway_ads_post_before_content() ?>

	<div class="post-format-wrap">
		<?php $size = thelegalway_post_thumbnail_size(); ?>

		<?php do_action( 'cherry_post_format_image', array( 'size' => $size['size'] ) ); ?>
	</div><!-- .post-thumbnail -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links__title">' . esc_html__( 'Pages:', 'thelegalway' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-links__item">',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'thelegalway' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php thelegalway_share_buttons( 'single' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
