<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Contractor_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		
		<?php if ( have_posts() ) : ?>
		
			<section class="hero archive" aria-label="posts archive page">
				<header class="page-header">
					<div class="container"><div class="row justify-content-center">
						<div class="col">
							
							<?php
							the_archive_title( '<h1 class="page-title"> ', '</h1>' );
							// the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</div>
					</div></div>
				</header><!-- .page-header -->
			</section>
			
			<div class="container"><div class="row">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					
					/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
					?>
						<div class="col-lg-4 col-md-6">
							<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
						</div>
						
				<?php endwhile;
				
				the_posts_navigation();
				
		else : 
			
				get_template_part( 'template-parts/content', 'none' ); ?>
				
			</div></div>
			
		<?php endif;?>
			
	</main><!-- #main -->

<?php
get_footer();
