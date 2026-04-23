<?php
   /**
 * The template for displaying the footer *
 * Contains the closing of the #content div and all content after. *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials *
 * @package Contractor_Starter_Theme
 */
// Custom field vars
   $address = get_field('address', 'option');
$full_address = get_field('full_address', 'option');
$phone_number = get_field('phone_number', 'option');
$email = get_field('email_address', 'option');
$map_image = get_field('map_image', 'option');
$map_size = 'medium';
$facebook_url = get_field('facebook_url', 'option');
$instagram_url = get_field('instagram_url', 'option');
$twitter_url = get_field('twitter_url', 'option');
$linkedin_url = get_field('linkedin_url', 'option');
$companycam_script = get_field('companycam_script', 'option');
$footer_bg = get_field('footer_background_color', 'option');
$footer_locations = get_field('footer_locations', 'option');
$footer_layout = get_field('footer_layout', 'option');
   ?>
   <?php wp_footer(); ?>
   <footer id="colophon" class="site-footer">
	<div class="footer-top <?php echo $footer_bg; ?>">
		<div class="container">
			<div class="row row-footer-top">
				<div class="col-lg-3">
					<div class="footer-logo-wrapper">
						<a href="/" class="footer-logo-link">
							<img class="footer-logo" src="<?php echo get_theme_mod('contractor_starter_footer_logo'); ?>" alt="">
						</a>
					</div>
					<?php if (have_rows('social_media_links', 'option')) : ?>
						<div class="footer-social">
							<?php while (have_rows('social_media_links', 'option')) : the_row();
								$font_icon = get_sub_field('font_icon_1');
								$link      = get_sub_field('link');
								if (! empty($font_icon) && ! empty($link['url'])) : ?>
									<a href="<?php echo $link['url']; ?>" <?php if (! empty($link['target'])) : ?> target="<?php echo $link['target']; ?>" <?php endif; ?>>
										<i class="<?php echo $font_icon; ?>" aria-hidden="true"></i>
									</a>
							<?php endif;
							endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-lg-9 d-none d-lg-block">
					<div class="footer-nav-wrapper">
						<nav aria-label="footer navigation ">
							<?php wp_nav_menu(
								array(
									'theme_location' => 'menu-3',
									'menu_class' => 'footer-nav',
									'items_wrap'	 => '<ul id="%1$s" class="%2$s d-flex ">%3$s</ul>',
									'container' 	 => ''
								)
							); ?>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom <?php if ($footer_layout == 'single-location') { ?>single-location<?php } ?>">
		<?php if ($footer_layout == 'single-location') { ?>
			<div class="container">
				<div class="row row-footer-bottom">
					<?php if (wp_is_mobile()) : ?>
						<!-- Display mobile specific here  -->
						<div class="col-lg-12 d-lg-block">
							<div class="row g-4">
								<?php if ($footer_locations) : ?>
									<?php foreach ($footer_locations as $post) : ?>
										<?php setup_postdata($post);
										$email      = get_field('loc_email'); ?>
										<div class="col-md-6 col-lg-3">
											<div class="footer-info-contact">
												<h4><?php the_title(); ?></h4>
												<p class="contact-box">
													<i class="fa-solid fa-phone-volume"></i>
													<a href="tel:<?php the_field('loc_phone'); ?>"><?php the_field('loc_phone'); ?></a>
												</p>
												<?php if (!empty($email)) : ?>
													<p class="contact-box">
														<i class="fa-solid fa-envelope"></i>
														<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
													</p>
												<?php endif; ?>
												<p class="contact-box">
													<i class="fa-solid fa-location-dot"></i>
													<a target="_blank" href="<?php the_field('google_map_link'); ?>"><?php the_field('loc_address_line_1'); ?><br>
														<?php the_field('loc_address_line_2'); ?>
													</a>
												</p>
												<p class="contact-box"><?php the_field('license_number'); ?></p>
											</div>
										</div>
									<?php endforeach;
									wp_reset_postdata(); ?>
								<?php endif; ?>
							</div>
						</div>
					<?php else : ?>
						<!-- Display desktop  here -->
						<div class="col-lg-12 d-lg-block">
							<div class="row g-4">
								<?php if ($footer_locations) : ?>
									<?php foreach ($footer_locations as $post) : ?>
										<?php setup_postdata($post);
										$email      = get_field('loc_email'); ?>
										<div class="col-md-6 col-lg-3">
											<div class="footer-info-contact">
												<h4><?php the_title(); ?></h4>
												<p class="contact-box">
													<i class="fa-solid fa-phone-volume"></i>
													<a href="tel:<?php the_field('loc_phone'); ?>"><?php the_field('loc_phone'); ?></a>
												</p>
												<?php if (!empty($email)) : ?>
													<p class="contact-box">
														<i class="fa-solid fa-envelope"></i>
														<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
													</p>
												<?php endif; ?>
												<p class="contact-box">
													<i class="fa-solid fa-location-dot"></i>
													<a target="_blank" href="<?php the_field('google_map_link'); ?>"><?php the_field('loc_address_line_1'); ?><br>
														<?php the_field('loc_address_line_2'); ?>
													</a>
												</p>
												<p class="contact-box"><?php the_field('license_number'); ?></p>
											</div>
										</div>
									<?php endforeach;
									wp_reset_postdata(); ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php } else { ?>
			<?php if (have_rows('locations_tab', 'option')) : ?>
				<?php if (wp_is_mobile()) : ?>
					<!-- Display mobile specific here  -->
					<div class="location-accordion-wrapper">
						<div class="container p-0">
							<?php
							if (have_rows('locations_tab', 'option')) :
								$index = 0;
								while (have_rows('locations_tab', 'option')) : the_row();
									$tab_title = get_sub_field('location_tab_title');
									$select_location = get_sub_field('select_location');
									if (!empty($tab_title)) :
							?>
										<div class="location-accordion-item <?php echo $index === 0 ? 'active' : ''; ?>">
											<h4 class="accordion-header">
												<button type="button" class="accordion-toggle">
													<?php echo esc_html($tab_title); ?>
													<span class="accordion-icon"><i class="fa-solid fa-chevron-down"></i></span>
												</button>
											</h4>
											<div class="accordion-content" <?php echo $index === 0 ? 'style="display:block;"' : ''; ?>>
												<div class="row g-4">
													<?php
													if ($select_location) :
														foreach ($select_location as $post) :
															setup_postdata($post);
															$title      = get_the_title();
															$phone      = get_field('loc_phone');
															$email      = get_field('loc_email');
															$map_link   = get_field('google_map_link');
															$address_1  = get_field('loc_address_line_1');
															$address_2  = get_field('loc_address_line_2');
															$license_no = get_field('license_number');
													?>
															<div class="col-lg-4 col-md-6">
																<div class="footer-info-contact d-flex flex-column align-items-start">
																	<?php if (!empty($title)) : ?>
																		<h4><?php echo esc_html($title); ?></h4>
																	<?php endif; ?>
																	<?php if (!empty($phone)) : ?>
																		<p class="contact-box">
																			<i class="fa-solid fa-phone-volume"></i>
																			<a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
																		</p>
																	<?php endif; ?>
																	<?php if (!empty($email)) : ?>
																		<p class="contact-box">
																			<i class="fa-solid fa-envelope"></i>
																			<a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
																		</p>
																	<?php endif; ?>
																	<?php if (!empty($map_link) && (!empty($address_1) || !empty($address_2))) : ?>
																		<p class="contact-box">
																			<i class="fa-solid fa-location-dot"></i>
																			<a target="_blank" href="<?php echo esc_url($map_link); ?>">
																				<?php echo esc_html(trim($address_1 . ' ' . $address_2)); ?>
																			</a>
																		</p>
																	<?php endif; ?>
																	<?php if (!empty($license_no)) : ?>
																		<p class="contact-box"><?php echo esc_html($license_no); ?></p>
																	<?php endif; ?>
																</div>
															</div>
													<?php
														endforeach;
														wp_reset_postdata();
													endif;
													?>
												</div>
											</div>
										</div>
							<?php
									endif;
									$index++;
								endwhile;
							endif;
							?>
						</div>
					</div>
				<?php else : ?>
					<!-- Display desktop  here -->
					<div class="location-tabs-wrapper">
						<div class="location-tab">
							<div class="container">
								<ul class="location-tab-nav m-0">
									<?php
									$index = 0;
									while (have_rows('locations_tab', 'option')) : the_row();
										$tab_title = get_sub_field('location_tab_title');
										if (!empty($tab_title)) : ?>
											<li class="loc-tab-btn m-0 <?php echo $index === 0 ? 'active' : ''; ?>" data-tab="tab-<?php echo $index; ?>">
												<?php echo $tab_title; ?>
											</li>
									<?php
										endif;
										$index++;
									endwhile;
									?>
								</ul>
							</div>
						</div>
						<div class="location-tab-content">
							<?php
							$content_index = 0;
							reset_rows();
							while (have_rows('locations_tab', 'option')) : the_row();
								$select_location = get_sub_field('select_location');
							?>
								<div class="location-tab-panel <?php echo $content_index === 0 ? 'active' : ''; ?>" id="tab-<?php echo $content_index; ?>">
									<div class="container">
										<div class="row g-4">
											<?php
											if ($select_location) :
												foreach ($select_location as $post) :
													setup_postdata($post);
													$title      = get_the_title();
													$phone      = get_field('loc_phone');
													$email      = get_field('loc_email');
													$map_link   = get_field('google_map_link');
													$address_1  = get_field('loc_address_line_1');
													$address_2  = get_field('loc_address_line_2');
													$license_no = get_field('license_number'); ?>
													<div class="col-lg-4 col-md-6">
														<div class="footer-info-contact d-flex flex-column align-items-start">
															<?php if (!empty($title)) : ?>
																<h4><?php echo $title; ?></h4>
															<?php endif; ?>
															<?php if (!empty($phone)) : ?>
																<p class="contact-box">
																	<i class="fa-solid fa-phone-volume"></i>
																	<a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
																</p>
															<?php endif; ?>
															<?php if (!empty($email)) : ?>
																<p class="contact-box">
																	<i class="fa-solid fa-envelope"></i>
																	<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
																</p>
															<?php endif; ?>
															<?php if (!empty($map_link) && (!empty($address_1) || !empty($address_2))) : ?>
																<p class="contact-box">
																	<i class="fa-solid fa-location-dot"></i>
																	<a target="_blank" href="<?php echo $map_link; ?>">
																		<?php if (!empty($address_1)) : ?>
																			<?php echo $address_1; ?>
																		<?php endif; ?>
																		<?php if (!empty($address_2)) : ?>
																			<?php echo ' ' . $address_2; ?>
																		<?php endif; ?>
																	</a>
																</p>
															<?php endif; ?>
															<?php if (!empty($license_no)) : ?>
																<p class="contact-box"><?php echo $license_no; ?></p>
															<?php endif; ?>
														</div>
													</div>
											<?php
												endforeach;
												wp_reset_postdata();
											endif;
											?>
										</div>
									</div>
								</div>
							<?php
								$content_index++;
							endwhile;
							?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php } ?>
	</div>
	<div class="footer-copy">
		<div class="container">
			<?php
			$footer_links = get_field('footer_links', 'option');
			$footer_copyright_links = get_field('footer_copyright_links', 'option');
			$company_license = get_field('company_license', 'option');
			?>
			<p>&copy; &nbsp;<?php echo date('Y'); ?>&nbsp;<?php echo get_bloginfo(); ?>. All Rights Reserved. <?php echo $company_license; ?>.
				<?php echo $footer_copyright_links; ?>
				<?php if (!empty($footer_links['privacy_policy'])) :
					$privacy_page = $footer_links['privacy_policy'];
				?>
					<a href="<?php echo esc_url(get_permalink($privacy_page->ID)); ?>">
						<?php echo esc_html(get_the_title($privacy_page->ID)); ?>
					</a>
				<?php endif; ?>
				<?php if (!empty($footer_links['privacy_choices'])) :
					$privacy_choices = $footer_links['privacy_choices'];
				?>
					|
					<a href="<?php echo esc_url(get_permalink($privacy_choices->ID)); ?>">
						<?php echo esc_html(get_the_title($privacy_choices->ID)); ?>
					</a>
				<?php endif; ?>
				<?php if (!empty($footer_links['terms'])) :
					$terms = $footer_links['terms'];
				?>
					|
					<a href="<?php echo esc_url(get_permalink($terms->ID)); ?>">
						<?php echo esc_html(get_the_title($terms->ID)); ?>
					</a>
				<?php endif; ?>
				<?php if (!empty($footer_links['accessibility'])) :
					$accessibility = $footer_links['accessibility'];
				?>
					|
					<a href="<?php echo esc_url(get_permalink($accessibility->ID)); ?>">
						<?php echo esc_html(get_the_title($accessibility->ID)); ?>
					</a>
				<?php endif; ?>
			</p>
		</div>
	</div>
</footer>
</div><!-- #page -->
<?php if (is_page_template('page-ppc.php')) : ?>
	<script>
		jQuery(function($) {
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
   <?php edit_post_link('Quick Edit'); ?>
   </body>
   </html>