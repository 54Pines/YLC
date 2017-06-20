<?php get_header( thelegalway_template_base() ); ?>

	<?php thelegalway_site_breadcrumbs(); ?>

	<div <?php thelegalway_content_wrap_class(); ?>>

		<div class="row">

			<div id="primary" <?php thelegalway_primary_content_class(); ?>>

				<main id="main" class="site-main" role="main">

					<?php include thelegalway_template_path(); ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- .container -->

<?php get_footer( thelegalway_template_base() ); ?>
