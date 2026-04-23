<?php
/**
 * The template for displaying the PPC footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Contractor_Starter_Theme
 */

// Custom field vars
$address = get_field( 'address', 'option' );
$full_address = get_field( 'full_address', 'option' );
$phone_number = get_field( 'phone_number', 'option' );
$email = get_field( 'email_address', 'option' );
$map_image = get_field( 'map_image', 'option' );
	$map_size = 'medium';
$facebook_url = get_field( 'facebook_url', 'option' );
$instagram_url = get_field( 'instagram_url', 'option' );
$twitter_url = get_field( 'twitter_url', 'option' );
$linkedin_url = get_field( 'linkedin_url', 'option' );
$companycam_script = get_field( 'companycam_script', 'option' );
$footer_bg = get_field( 'footer_background_color', 'option' );

?>

	<footer id="colophon" class="site-footer site-footer-ppc <?php echo $footer_bg; ?>">
		<div class="container">
			<div class="ppc-logo-wrap">
				<div class="ppc-footer-logo">
					<img class="footer-logo" src="<?php echo get_theme_mod( 'contractor_starter_footer_logo' ); ?>" alt="">
				</div>
			</div>
        </div>

	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<?php if ( is_page_template( 'page-ppc.php') ) : ?>
	<script>
		jQuery(function ($) {
			var callbar = $("#mobile-call");
			$(window).scroll(function() {    
				var scroll = $(window).scrollTop();
				if (scroll >= 60) {
					callbar.addClass("on-scroll");
				} else {
					callbar.removeClass("on-scroll");
				}
			})
		})
	</script>
<?php endif; ?>


<?php edit_post_link( 'Quick Edit' ); ?>

</body>
</html>
