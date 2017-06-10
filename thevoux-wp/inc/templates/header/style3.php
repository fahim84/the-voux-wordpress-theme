<?php 
	$id = get_the_ID();
	$mobile_icon = ot_get_option('mobile_menu_icon', 'on');
	$header_boxed = ot_get_option('header_boxed', 'off');
	$header_menu_color = ot_get_option('header_menu_color', 'dark') == 'dark' ? '' : 'light-menu-color';
	
	$header_transparent = get_post_meta($id, 'header_transparent', true);
	$header_transparent_color = get_post_meta($id, 'header_transparent_color', true);
	$logo = ot_get_option('logo', THB_THEME_ROOT. '/assets/img/logo.png');
	
	$classes[] = 'header style3';
	$classes[] = $header_boxed === 'on' ? 'boxed' : '';
	
	$transparent_classes[] = 'header_holder';
	$transparent_classes[] = $header_transparent;
	$transparent_classes[] = $header_transparent_color;
	
	if ($header_transparent === 'on' && $header_transparent_color === 'light-transparent-header') {
		$logo = ot_get_option('logo_light', THB_THEME_ROOT. '/assets/img/logo_light.png');
	}
	
	$adv_headerstyle3 = ot_get_option('adv_headerstyle3');
?>

<!-- Start Header -->
<div class="<?php echo implode(' ', $transparent_classes); ?>">
<?php if ($header_boxed === 'on') { ?>
<div class="row">
	<div class="small-12 columns">
<?php } ?>
<header class="<?php echo implode(' ', $classes); ?>">
	<div class="header_top cf">
		<div class="row full-width-row">
			<div class="small-12 columns logo">
				<div class="toggle-holder">
					<a href="#" class="mobile-toggle <?php if ($mobile_icon !== 'on') { echo 'hide-for-large'; } ?>">
						<div>
							<span></span><span></span><span></span>
						</div>
					</a>
					<a href="<?php echo esc_url(home_url()); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
						<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
					</a>
				</div>
				<?php if ($adv_headerstyle3) { 
					echo '<aside class="thb_ad_header show-for-large">'.do_shortcode(wp_kses_post($adv_headerstyle3)).'</aside>';
					}
				?>
				<div class="social-holder hide-for-large <?php echo esc_attr($social_style = ot_get_option('header_socialstyle', 'style1')); ?>">
					<?php do_action( 'thb_social_header' ); ?>
					<?php do_action( 'thb_quick_search' ); ?>
					<?php do_action( 'thb_quick_cart' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php if (ot_get_option('full_menu', 'on') !== 'off') { ?>
	<div class="nav_holder show-for-large">
		<div class="row full-width-row">
			<div class="small-12 columns">
				
				<nav role="navigation" class="full-menu-container <?php echo esc_attr($header_menu_color); ?>">
					<?php if(has_nav_menu('nav-menu')) { ?>
					  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'full-menu nav', 'walker' => new thb_MegaMenu_tagandcat_Walker ) ); ?>
					<?php } else { ?>
						<ul class="full-menu">
							<li><a href="<?php echo get_admin_url().'nav-menus.php'; ?>">Please assign a menu from Appearance -> Menus</a></li>
						</ul>
					<?php } ?>
				</nav>
				
				<div class="social-holder <?php echo esc_attr($social_style = ot_get_option('header_socialstyle', 'style1')); ?>">
					<?php do_action( 'thb_social_header' ); ?>
					<?php do_action( 'thb_quick_search' ); ?>
					<?php do_action( 'thb_quick_cart' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</header>
<?php if ($header_boxed === 'on') { ?>
	</div>
</div>
<?php } ?>
</div>
<!-- End Header -->