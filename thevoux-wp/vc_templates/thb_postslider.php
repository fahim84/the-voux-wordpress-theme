<?php function thb_postslider( $atts, $content = null ) {
	$source = '';
  $atts = vc_map_get_attributes( 'thb_postslider', $atts );
  extract( $atts );
  
  $source .= '|offset:'.$offset;
 	$source_data = VcLoopSettings::parseData( $source );
 	$query_builder = new ThbLoopQueryBuilder( $source_data );
 	$posts = $query_builder->build();
 	$posts = $posts[1];	
 	
 	$rand = mt_rand(10, 99);
 	
 	$pagi = ($pagination == 'true' ? 'true' : 'false');
 	$nav = ($navigation == 'true' ? 'true' : 'false');
 		
 	ob_start();
 	$classes[] = 'slick';
 	$classes[] = $style;
 	$classes[] = ($style == 'featured-style3' || $style == 'featured-style9') ? 'dark-pagination' : '';
 	$classes[] = $style == 'featured-style10' ? 'fly-nav' : false;
 	$classes[] = in_array($style, array('featured-style9', 'featured-style9 offset')) ? 'center-arrows' : false;
 	
 	if ( $posts->have_posts() ) { ?>
	<div class="<?php echo implode(' ', $classes); ?>" data-columns="1" data-pagination="<?php echo esc_attr($pagi); ?>" data-navigation="<?php echo esc_attr($nav); ?>">
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<div>
			<?php 
				if ($style !== 'featured-style11') {
					set_query_var( 'thb_style', $style );
					get_template_part('inc/templates/loop/post-slider'); 
				} else {
					get_template_part('inc/templates/loop/post-slider-full'); 
				}
			?>
			</div>
		<?php endwhile; ?>
	</div>
	<?php }
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
  return $out;
}
thb_add_short('thb_postslider', 'thb_postslider');