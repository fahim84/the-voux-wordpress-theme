<?php
// thb shared Posts w/ Images
class widget_sharedimages extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_sharedimages',
			'description' => __('Display most shared posts with images','thevoux')
		);
		
		parent::__construct(
			'thb_sharedimages_widget',
			__( 'Fuel Themes - Most Shared Posts with Images' , 'thevoux' ),
			$widget_ops
		);
				
		$this->defaults = array( 'title' => 'Most Shared', 'show' => '3', 'style' => 'style1' );
	}
	
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$show = $instance['show'];
		$style = isset($instance['style']) ? $instance['style'] : 'style1';
		$args = array( 
				'posts_per_page' => $show,
				'order' => 'DESC',
				'meta_key' => 'thb_pssc_counts',  
				'orderby' => 'meta_value_num'
			);
		$posts = new WP_Query( $args );
		$counts = 0;
		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');
		echo '<ul class="shared-'.esc_attr($style).'">';
		while  ($posts->have_posts()) : $posts->the_post(); 
		$counts ++;
		set_query_var('thb_shares', true);
		if ($style == 'style1') { 
			get_template_part('inc/templates/loop/listing');
		 } else if ($style == 'style2') {
		 	set_query_var('thb_class', 'panr');
		 	set_query_var('thb_counts', $counts);
		 	set_query_var('thb_imagesize', 'thevoux-widget');
		 	get_template_part('inc/templates/loop/listing');
		} else if ($style == 'style3') { 
			get_template_part('inc/templates/loop/listing-style2');
		} ?>
		<?php endwhile;
		echo '</ul>';
		echo $after_widget;
		
		wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show'] = strip_tags( $new_instance['show'] );
		$instance['style'] = strip_tags( $new_instance['style'] );
		return $instance;
	}
	function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$style = $instance['style'];?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('style1'); ?>">
			<input id="<?php echo $this->get_field_id('style1'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="radio" value="style1" <?php if($style === 'style1' || !$style){ echo 'checked="checked"'; } ?> /> Style 1
			</label><br>
			<label for="<?php echo $this->get_field_id('style2'); ?>">
			<input id="<?php echo $this->get_field_id('style2'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="radio" value="style2" <?php if($style === 'style2'){ echo 'checked="checked"'; } ?> /> Style 2
			</label><br>
			<label for="<?php echo $this->get_field_id('style3'); ?>">
			<input id="<?php echo $this->get_field_id('style3'); ?>" name="<?php echo $this->get_field_name('style'); ?>" type="radio" value="style3" <?php if($style === 'style3'){ echo 'checked="checked"'; } ?> /> Style 3
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>">Number of Posts:</label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $instance['show']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}
function widget_sharedimages_init()
{
       register_widget('widget_sharedimages');
}
add_action('widgets_init', 'widget_sharedimages_init');