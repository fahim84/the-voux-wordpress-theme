<?php function thb_postgrid( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_postgrid', $atts );
  extract( $atts );
  global $wp_query;
  if ( get_query_var('paged') ) {
  	$paged = get_query_var('paged');
  } else if ( get_query_var('page') ) {
  	$paged = get_query_var('page');
  } else {
  	$paged = 1;
  }

  $featured_index = empty($featured_index) ? array() : explode(',',$featured_index);
	$source .= '|paged:'.$paged;
	$source .= '|offset:'.$offset;
	$source_data = VcLoopSettings::parseData( $source );
	$query_builder = new ThbLoopQueryBuilder( $source_data );
	$posts = $query_builder->build();
	$posts = $posts[1];	
	$temp_query = $wp_query;
	$wp_query = $posts;
 	ob_start();
	if ( $posts->have_posts() ) { ?>
		<?php switch($columns) {
			case 2:
				$col = 'medium-6 large-6';
				break;
			case 3:
				$col = 'medium-4 large-4';
				break;
			case 4:
				$col = 'medium-6 large-3';
				break;
			case 6:
				$col = 'medium-4 large-2';
				break;
		} ?>
		<?php if ($add_title === 'true') { ?>
			<div class="category_title <?php echo esc_attr($title_style); ?>">
				<h2><?php esc_html_e( $title ); ?></h2>
			</div>
		<?php } ?>
		<?php if ($style == 'style1') { ?>
			<div class="row posts <?php if ($pagination) { echo 'ajaxify-pagination'; } ?> <?php echo esc_attr('columns-'.$columns); ?>">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<div class="small-12 <?php echo esc_attr($col); ?> columns">
					
						<?php 
							set_query_var( 'disable_excerpts', $disable_excerpts );
							set_query_var( 'disable_postmeta', $disable_postmeta );
							get_template_part( 'inc/templates/loop/style6' ); 
						?>
					</div>
				<?php endwhile; // end of the loop. ?>
				<?php 
					if ($pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style4') { ?>
			<div class="row posts <?php if ($pagination) { echo 'ajaxify-pagination'; } ?> <?php echo esc_attr('columns-'.$columns); ?>">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<div class="small-12 <?php echo esc_attr($col); ?> columns">
					
						<?php 
							get_template_part( 'inc/templates/loop/style7' ); 
						?>
					</div>
				<?php endwhile; // end of the loop. ?>
				<?php 
					if ($pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style2') { ?>
			<div class="posts border <?php if ($pagination) { echo 'ajaxify-pagination'; } ?>">
				<?php $i = 1; while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<?php if (in_array($i, $featured_index )) { ?>
						<?php get_template_part( 'inc/templates/loop/style7' ); ?>
					<?php } else { ?>
						<?php get_template_part( 'inc/templates/loop/style1' ); ?>
					<?php } ?>
				<?php $i++; endwhile; // end of the loop. ?>
				<?php 
					if ($pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style2-alt') { ?>
			<div class="posts border <?php if ($pagination) { echo 'ajaxify-pagination'; } ?>">
				<?php $i = 1; while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<?php if (in_array($i, $featured_index )) { ?>
						<?php 
							set_query_var( 'thb_offset_style', 'offset-title' );
							get_template_part( 'inc/templates/loop/style7' );
							set_query_var( 'thb_offset_style', false );
						?>
					<?php } else { ?>
						<?php get_template_part( 'inc/templates/loop/style1' ); ?>
					<?php } ?>
				<?php $i++; endwhile; // end of the loop. ?>
				<?php 
					if ($pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style3') { ?>
			<div class="posts border-vertical <?php if ($pagination) { echo 'ajaxify-pagination'; } ?>">
				<div class="row no-padding full-width-row">
					<?php $i = 1; while ( $posts->have_posts() ) : $posts->the_post(); ?>
						<div class="small-12 large-6 columns <?php if ($i % 2 == 0) { ?>even<?php } ?>">
							<?php get_template_part( 'inc/templates/loop/style2' ); ?>
						</div>
					<?php $i++; endwhile; // end of the loop. ?>
				</div>
				<?php 
					if ($pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style5') { ?>
			<div class="posts border <?php if ($pagination) { echo 'ajaxify-pagination'; } ?>">
					<?php $i = 1; while ( $posts->have_posts() ) : $posts->the_post(); ?>
							<?php get_template_part( 'inc/templates/loop/style9' ); ?>
					<?php $i++; endwhile; // end of the loop. ?>
				<?php 
					if ($pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } else if ($style == 'style6') { ?>
			<div class="posts style6-posts <?php if ($pagination) { echo 'ajaxify-pagination'; } ?>">
					<?php $i = 1; while ( $posts->have_posts() ) : $posts->the_post(); ?>
							<?php 
								set_query_var( 'thb_image_size', 'thevoux-style1' );
								get_template_part( 'inc/templates/loop/style7' ); 
							?>
					<?php $i++; endwhile; // end of the loop. ?>
				<?php 
					if ($pagination == 'true') {
						the_posts_pagination(array(
							'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'thevoux' ).'</span>',
							'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'thevoux' ).'</span>',
							'mid_size'		=> 2
						));
					}
				?>
			</div>
		<?php } ?>
	<?php }
		
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   $wp_query = $temp_query;
   wp_reset_query();
   wp_reset_postdata();
     
  return $out;
}
thb_add_short('thb_postgrid', 'thb_postgrid');
