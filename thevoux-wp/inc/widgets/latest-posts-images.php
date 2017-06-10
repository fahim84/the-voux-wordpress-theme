<?php
// thb latest Posts w/ Images
class widget_latestimages extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_latestimages',
			'description' => __('Display latest posts with images','thevoux')
		);
		
		parent::__construct(
			'thb_latestimages_widget',
			__( 'Fuel Themes - Latest Posts with Images' , 'thevoux' ),
			$widget_ops
		);
				
		$this->defaults = array( 'title' => 'Latest Posts', 'show' => '3' );
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$show = $instance['show'];
		
		$args = array(
			'post_type'=>'post', 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => 1,
			'no_found_rows' => true,
			'showposts' => $show
		);
		$posts = new WP_Query( $args );
		
		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');
		echo '<ul>';
		while  ($posts->have_posts()) : $posts->the_post();
			set_query_var('thb_counts', false);
			set_query_var('thb_class', false);
			set_query_var('thb_imagesize', false);
			set_query_var( 'thb_shares', false );
			get_template_part('inc/templates/loop/listing');
		endwhile;
		echo '</ul>';
		echo $after_widget;
		
		wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show'] = strip_tags( $new_instance['show'] );
		
		return $instance;
	}
	function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>">Number of Posts:</label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'show' ); ?>" value="<?php echo $instance['show']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}
function widget_latestimages_init() {
	register_widget('widget_latestimages');
}
add_action('widgets_init', 'widget_latestimages_init');