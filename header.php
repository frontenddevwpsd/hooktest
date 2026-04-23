<?php

/**
 * The header for our theme *
 * This is the template that displays all of the <head> section and everything up until <div id="content"> *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials *
 * @package Contractor_Starter_Theme
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta name="google-site-verification" content="mHeEan4dKv08KyXU-9v6j0KC5Fowtiwn9ZUoFriqNL4" />
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<?php
function get_text_color($hex, $dark = '#000000', $light = '#ffffff')
{
	$hex = str_replace('#', '', $hex);
	$r = hexdec(substr($hex, 0, 2));
	$g = hexdec(substr($hex, 2, 2));
	$b = hexdec(substr($hex, 4, 2));
	// Calculate brightness (perceived luminance)
	$brightness = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
	// If bright → use black text, else white text
	return ($brightness > 155) ? $dark : $light;
}

$theme_corners = get_field('theme_corners', 'option');
$headerLogo = get_field('header_logo_option', 'option');
$header_bg = get_field('header_background_colors', 'option');
$topBar = get_field('display_top_bar', 'option');
$color_primary = get_field('color_primary', 'option');
$color_secondary = get_field('color_secondary', 'option');
$color_tertiary = get_field('color_tertiary', 'option');
$color_dark = get_field('color_dark', 'option');
$color_light = get_field('color_light', 'option');
$color_dark_ui = get_field('color_dark_ui', 'option');
$color_light_ui = get_field('color_light_ui', 'option');
$text_primary   = get_text_color($color_primary, $color_dark, $color_light);
$text_secondary = get_text_color($color_secondary, $color_dark, $color_light);
$text_tertiary = get_text_color($color_tertiary, $color_dark, $color_light);
?>
<style>
	:root {
		--color-primary: <?php echo $color_primary ?>;
		--color-primary-text: <?php echo $text_primary; ?>;
		--color-secondary: <?php echo $color_secondary; ?>;
		--color-secondary-text: <?php echo $text_secondary; ?>;
		--color-tertiary: <?php echo $color_tertiary; ?>;
		--color-tertiary-text: <?php echo $text_tertiary; ?>;
		--color-dark: <?php echo $color_dark; ?>;
		--color-light: <?php echo $color_light; ?>;
		--color-ui-dark: <?php echo $color_dark_ui; ?>;
		--color-ui-light: <?php echo $color_light_ui; ?>;
	}
</style>

<body <?php body_class($theme_corners); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site <?php echo esc_attr($topBar); ?>">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'contractor_starter'); ?></a>
		<header id="masthead" class="site-header">
			<?php if ($topBar === 'top-bar-yes') : ?>
				<div class="header-top-bar">
					<div class="container">
						<div class="d-flex topbar-row row">
							<?php
							$display_flag = get_field('display_flag', 'option');
							$top_bar_link = get_field('top_bar_link', 'option');
							$topbar_link_style = get_field('topbar_link_style', 'option');
							$top_bar_long_message = get_field('top_bar_long_message', 'option');
							?>
							<?php if ($display_flag === 'top-bar-flag-no') : ?> <!-- Checks if flag is disabled -->
								<div class="col-auto col-xl-12">
									<div class="tb-main-message">
										<?php if ($topbar_link_style == "link") : ?>
											<?php if ($top_bar_link) : ?>
												<a href="<?php echo esc_url($top_bar_link['url']); ?>" target="<?php echo esc_attr($top_bar_link['target']); ?>">
													<?php if ($top_bar_long_message) : ?>
														<p><?php echo esc_html($top_bar_long_message); ?></p>
													<?php endif; ?>
													<button class="btn btn--text btn--text-tertiary"><span><?php echo esc_attr($top_bar_link['title']); ?></span></button>
												</a>
											<?php endif; ?>
										<?php else : ?>
											<?php if ($top_bar_long_message) : ?>
												<p><?php echo esc_html($top_bar_long_message); ?></p>
											<?php endif; ?>
											<?php $phone_number = get_field('phone_number', 'option');
											if ($phone_number): ?>
												<a aria-label="Call us" href="<?php echo esc_url($phone_number['url']); ?>" target="<?php echo esc_attr($phone_number['target'] ? $phone_number['target'] : '_self'); ?>" class="btn btn--secondary-white"><?php echo esc_html($phone_number['title']); ?></a>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>
							<?php else : ?> <!-- If flag is enabled -->
								<div class="col-9">
									<div class="tb-main-message">
										<?php
										$top_bar_link = get_field('top_bar_link', 'option');
										$topbar_link_style = get_field('topbar_link_style', 'option');
										$top_bar_long_message = get_field('top_bar_long_message', 'option');
										?>
										<?php if ($top_bar_link) : ?>
											<a href="<?php echo esc_url($top_bar_link['url']); ?>" target="<?php echo esc_attr($top_bar_link['target']); ?>">
												<?php if ($top_bar_long_message) : ?>
													<p><?php echo esc_html($top_bar_long_message); ?></p>
												<?php endif; ?>
												<button class="btn btn--text btn--text-tertiary"><span><?php echo esc_attr($top_bar_link['title']); ?></span></button>
											</a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-3">
									<div class="tb-contact-message">
										<p><?php echo get_field('top_bar_small', 'option'); ?></p>
										<?php if // This hides nav element on the PPC page template.
										(!is_page_template('page-ppc.php')): ?>
											<div class="d-flex">
												<?php $phone_number = get_field('phone_number', 'option');
												if ($phone_number): ?>
													<a aria-label="Call us" href="<?php echo esc_url($phone_number['url']); ?>" target="<?php echo esc_attr($phone_number['target'] ? $phone_number['target'] : '_self'); ?>" class=""><?php echo esc_html($phone_number['title']); ?></a>
												<?php endif; ?>
											</div>
										<?php else :
											// PPC template specific header items here 
										?>
											<?php $ppc_number = get_field('ppc_phone');
											if ($ppc_number): ?>
												<a aria-label="Call us" href="<?php echo esc_url($ppc_number['url']); ?>" target="<?php echo esc_attr($ppc_number['target'] ? $ppc_number['target'] : '_self'); ?>" class=""><?php echo esc_html($ppc_number['title']); ?></a>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="header-bottom <?php echo esc_attr($header_bg); ?>">
				<div class="site-header__inner d-flex justify-content-between align-items-center">
					<div class="site-header__logo-nav">
						<?php if ($headerLogo === 'header-logo-normal') : //Displays normal logo
						?>
							<div class="site-header__inner__branding">
								<?php if (!is_page_template('page-ppc.php')) : ?>
									<?php if (get_custom_logo()) :
										the_custom_logo();
									else : ?>
										<a aria-label="Back to the home page" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
									<?php endif; ?>
								<?php else : ?>
									<?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full'); ?>
								<?php endif; ?>
							</div><!-- END .site-branding -->
						<?php else : // Displays logo as a Flag
						?>
							<div class="site-header__inner__branding">
								<div class="logo-flag-box">
									<?php if (!is_page_template('page-ppc.php')) : ?>
										<?php if (get_custom_logo()) :
											the_custom_logo();
										else : ?>
											<a aria-label="Back to the home page" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
										<?php endif; ?>
									<?php else : ?>
										<?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full'); ?>
									<?php endif; ?>
								</div>
							</div><!-- END .site-branding -->
						<?php endif; ?>
						<?php // Displays Meganav
						get_template_part('header', 'meganav');
						?>
					</div>
					<div class="site-header__contact d-flex align-items-center">
						<?php $headerButton = get_field('header_button', 'option');  ?>
						<?php if // This hides nav element on the PPC page template.
						(!is_page_template('page-ppc.php')): ?>
							<div class="d-flex">
								<?php if ($headerButton === 'header-button-phone') : // Displays Phone or CTA 
								?>
									<?php $phone_number = get_field('phone_number', 'option');
									if ($phone_number): ?>
										<a aria-label="Call us" href="<?php echo esc_url($phone_number['url']); ?>" target="<?php echo esc_attr($phone_number['target'] ? $phone_number['target'] : '_self'); ?>" class=""><?php echo esc_html($phone_number['title']); ?></a>
									<?php endif; ?>
								<?php else : ?>
									<?php $primary_cta = get_field('primary_cta', 'option');
									if ($primary_cta): ?>
										<a aria-label="Call Us" href="<?php echo esc_url($primary_cta['url']); ?>" target="<?php echo esc_attr($primary_cta['target'] ? $primary_cta['target'] : '_self'); ?>" class="btn btn--primary d-none d-md-inline-flex ms-3"><span><?php echo esc_html($primary_cta['title']); ?></span></a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						<?php else :
							// PPC template specific header items here 
						?>
							<?php $ppc_number = get_field('ppc_phone');
							if ($ppc_number): ?>
								<div class="ppc-btn_wrap d-none d-lg-flex align-items-center col-gap-3">
									<?php
									$top_bar_long_message = get_field('top_bar_long_message', 'option');
									if ($top_bar_long_message) : ?>
										<p><?php echo esc_html($top_bar_long_message); ?></p>
									<?php endif; ?>
									<a aria-label="Call us" href="<?php echo esc_url($ppc_number['url']); ?>" target="<?php echo esc_attr($ppc_number['target'] ? $ppc_number['target'] : '_self'); ?>" class="btn d-none d-md-inline-flex col-gap-12 btn--ppc-phone">
										<i class="fa-sharp fa-solid fa-phone-volume"></i>
										<span><?php echo esc_html($ppc_number['title']); ?></span>
									</a>
								</div>
							<?php endif; ?>
							<?php /* $ppc_cta = get_field('ppc_cta');
							if ($ppc_cta): ?>
								<a aria-label="Call us" href="#ppc-hero-form" target="_self" class="btn d-none d-md-block btn--primary"><span><?php echo esc_html($ppc_cta['title']); ?></span></a>
							<?php endif; */ ?>
						<?php endif; ?>
					</div> <!-- END .site-header__inner_nav -->
				</div> <!-- END .site-header__inner -->
			</div> <!-- END .header-bottom -->
		</header><!-- END #masthead -->
		<?php if // This hides mobile nav elements on the PPC page template.
		(!is_page_template('page-ppc.php')): ?>
			<!-- Mobile handler is active to 'lg' breakpoint -->
			<?php $mobileHandler = get_field('mobile_handler', 'option');
			if ($mobileHandler === 'mh-1') : // Displays Normal Mobile handler 
			?>
				<div id="mobile-handler" class="justify-content-between  p-3">
					<?php $phone_number = get_field('phone_number', 'option'); ?>
					<?php if ($phone_number) : ?>
						<a aria-label="Call us" href="<?php echo esc_url($phone_number['url']); ?>" target="<?php echo esc_attr($phone_number['target']); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/inc/img/phone-call-red.svg" alt="">
							<?php echo esc_html($phone_number['title']); ?>
						</a>
					<?php endif; ?>
					<button class="menu-toggle" aria-controls="mobile-menu"><?php esc_html_e('Mobile Menu', 'contractor_starter'); ?></button>
				</div>
			<?php else :  // Displays the Mobile Handler with Chat Bot
			?>
				<div id="mobile-handler" class="justify-content-between  p-3">
					<button class="menu-toggle" aria-controls="mobile-menu"><?php esc_html_e('Mobile Menu', 'contractor_starter'); ?></button>
					<?php $phone_number = get_field('phone_number', 'option'); ?>
					<?php if ($phone_number) : ?>
						<a class="mb-btn-large" aria-label="Call us" href="<?php echo esc_url($phone_number['url']); ?>" target="<?php echo esc_attr($phone_number['target']); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/inc/img/icon-phone-solid-white.svg" alt="">
						</a>
					<?php endif; ?>
					<div class="chat-bot-placeholder"></div>
				</div>
			<?php endif; ?>
			<div id="mobile-navigation" class="responsive-navigation" aria-expanded="false">
				<nav id="mobile-nav">
					<?php // Container class assigned in this menu array is targeted in 'responsive-nav.js'
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_class'        => 'menu-panel__nav',
							'container_class' 	 => 'menu-panel'
						)
					); ?>
				</nav><!-- END #mobile-navigation -->
			</div>
		<?php else : ?>
			<div id="mobile-call" class="d-flex d-lg-none justify-content-center p-3">
				<?php $ppc_number = get_field('ppc_phone');
				if ($ppc_number): ?>
					<a aria-label="Call us" href="<?php echo esc_url($ppc_number['url']); ?>" target="<?php echo esc_attr($ppc_number['target'] ? $ppc_number['target'] : '_self'); ?>" class="btn btn--ppc-phone btn--large">
						<span><?php echo esc_html($ppc_number['title']); ?></span>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>