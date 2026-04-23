<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Contractor_Starter_Theme
 */
  get_header();
?>
  	<main id="primary" class="site-main">
  	<section class="hero hero--basic hero--error error-404 not-found " aria-label="not found">
  		<div class="container">
  			<div class="hero-content tac ta-c">
  				<h5 class="micro"><?php the_field( 'error_404_micro_title', 'option' ); ?></h5>
  				<h2><?php the_field( 'error_404_main_title', 'option' ); ?></h2>
  				<?php $cta_link = get_field( 'cta_link', 'option' ); ?>
  				<?php if ( $cta_link ) : ?>
  					<a class="btn btn--text btn--text-light" href="<?php echo esc_url( $cta_link['url'] ); ?>" target="<?php echo esc_attr( $cta_link['target'] ); ?>">
  						<span><?php echo esc_html( $cta_link['title'] ); ?></span>
  					</a>
  				<?php endif; ?>
  			</div>
  		</div>
  	</section>
  	<section class="services services-error">
  		<div class="container">
  			<div class="row justify-content-center">
  				<div class="col-lg-10">
  					<h2 class="jumbo">Our Services</h2> 
  					<?php $select_services = get_field( 'select_services', 'option' ); ?>
  					<?php if ( $select_services ) : ?>
  						<div class="row g-4">
  						<?php foreach ( $select_services as $post ) : ?>
  							<?php setup_postdata ( $post ); ?>
  								<div class="col-md-4">
  									<div class="error-card--service-blocks">
  										<a aria-label="Read about <?php the_title(); ?>" href="<?php the_permalink(); ?>" class="card--block-link">
  											<h3><?php the_title(); ?></h3>
  											<button class="btn btn--text btn--text-primary" ><span>Learn More</span></button>
  										</a>
  									</div>
  								</div>
  						<?php endforeach; ?>
  						</div>
  						<?php wp_reset_postdata(); ?>
  					<?php endif; ?>
  				</div>
  			</div>
  		</div>
  	</section>
  	<section class="error-recent-articles">
  		<div class="container">
  			<div class="row justify-content-center"> 
  				<div class="col-lg-10">
  					<div class="section-top">
  							<div class="section-header">
  								<h3 class="jumbo"><h2 class="jumbo">Our Information Center</h2></h3>
  							</div>
  							<div class="btn-wrap">
  								<a 
  								class="btn btn--primary" 
  								href="/blogvices/" 
  								aria-label="Open Link"
  								>
  								<span>See All Articles</span>
  								</a>
  							</div>
  						</div>
  				</div>
  				<div class="col-lg-10">
  					<?php
  					$args = array(    
  						'post_type' => 'post',          
  						'posts_per_page' => 3, 
  						'post__not_in' => get_option( 'sticky_posts' ),
  						'orderby' => 'date', 
  						'order'   => 'DESC', 
  						);
  					;?> 
  					<?php 
  					$the_query = new WP_Query($args); ?>
  					<?php if($the_query->have_posts()) : ?> 
  						<div class="row g-4">
  							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  							<div class="col-12 col-lg-4">
  								<div class="rec-art__item card">
  									<a href="<?php the_permalink(); ?>" class="rec-art-link">
  									<?php if ( has_post_thumbnail() ) : ?>
  										<picture>
  											<?php the_post_thumbnail('medium', array('class' => '')); ?>
  										</picture>
  									<?php endif; ?>
  									<?php
  									$authorid = $post->post_author; // Grabs Author ID
  									$author_acf_prefix = 'user_'; // WP User  Prefix
  									$author_id_prefixed = $author_acf_prefix . $authorid; // Concats Prefix to ID ex: 'user_2'
  									$author_photo = get_field( 'author_photo', $author_id_prefixed ); // Retrieves ACF User Photo Field
  									?>
  									<?php if ( $author_photo ) : ?>
  										<picture class="rec-art__author-photo">
  											<img src="<?php echo esc_url( $author_photo['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $author_photo['alt'] ); ?>" />
  										</picture>
  									<?php endif; ?>
  									<div class="rec-art--info">
  										<p class="post-meta"><?php echo reading_time($post); ?> | Posted: <?php the_time( 'm.d.y' );?></p>
  										<h3><?php the_title(); ?></h3>
  										<p><?php echo wp_trim_words( get_the_content(), 12 ); ?></p>
  										<button aria-label="Read more about <?php the_title();?>" href="<?php the_permalink(); ?>" class="btn btn--text btn--text-primary"><span>Keep Reading</span></button>
  									</div>
  									</a>
  								</div>
  							</div>
  							<?php endwhile; ?>
  							<?php wp_reset_postdata(); ?>
  							<?php wp_reset_query(); ?>
  						</div>
  					<?php endif; ?>
  				</div>
  			</div>
  		</div>
  	</section>
  	<?php get_template_part( 'page-builder/_partials/page-options', 'cta-banner' ); ?>
  	</main><!-- #main -->
<?php
  get_footer();