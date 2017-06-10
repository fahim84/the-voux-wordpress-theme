<?php function thb_postmasonry( $atts, $content = null ) {
	$source = '';
	$style = 'style1';
	$atts = vc_map_get_attributes( 'thb_postmasonry', $atts );
	extract( $atts );
	
	$source .= '|offset:'.$offset;
	$source_data = VcLoopSettings::parseData( $source );
	$query_builder = new ThbLoopQueryBuilder( $source_data );
	$posts = $query_builder->build();
	$posts = $posts[1];	
	
	$rand = mt_rand(10, 99);
	
 	ob_start();
 	
	if ( $posts->have_posts() ) { ?>
		<div class="row posts masonry" data-loadmore="#loadmore-<?php echo esc_attr($rand); ?>">
			<?php 
				while ( $posts->have_posts() ) : $posts->the_post();
				set_query_var( 'thb_columns', $columns );
				get_template_part( 'inc/templates/loop/masonry-'.$style ); 
				endwhile; // end of the loop. 
			?>
		</div>
		<?php if ($loadmore) { 
			wp_localize_script( 'thb-app', 'postajax', array( 
				'style' => $style,
				'count' => $source_data['size'],
				'columns' => $columns
			) );
		?>
		<div class="text-center">
			<a class="masonry_btn btn black small" href="#" id="loadmore-<?php echo esc_attr($rand); ?>"><?php _e( 'Load More', 'thevoux' ); ?></a>
		</div>
		<?php } ?>
	<?php }

   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
     
  return $out;
}
thb_add_short('thb_postmasonry', 'thb_postmasonry');
