<?php 
	$footer_color = ot_get_option('footer_color', 'light');
	$logo = ot_get_option('logo', THB_THEME_ROOT. '/assets/img/logo.png');
	
	$classes[] = $footer_color;
	$classes[] = 'style2';
?>
<?php if (ot_get_option('footer', 'on') != 'off') { ?>
<!-- Start Footer -->
<!-- Please call pinit.js only once per page -->
<footer id="footer" role="contentinfo" class="<?php echo implode(' ', $classes); ?>">
  	<div class="row">
	    <div class="small-12 columns text-center">
	    	<a href="<?php echo esc_url(home_url('/')); ?>" class="logolink" title="<?php bloginfo('name'); ?>"><img src="<?php echo esc_url($logo); ?>" class="logo" alt="<?php bloginfo('name'); ?>"/></a>
	    	<?php if ($footer_menu = ot_get_option('footer_menu')) { ?>
	    		<?php wp_nav_menu( array( 'menu' => $footer_menu, 'depth' => 1, 'container' => false  ) ); ?>
	    	<?php } ?>
	    	<?php if ($footer_text = ot_get_option('footer_text')) { ?>
	    		<p><?php echo do_shortcode(ot_get_option('footer_text')); ?></p>
	    	<?php } ?>
	    </div>
    </div>
</footer>
<!-- End Footer -->
<?php } ?>