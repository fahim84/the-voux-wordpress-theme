<?php
	$photo_id = get_post_thumbnail_id();
	$image = wp_get_attachment_image_src( $photo_id, 'full' );
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-slider featured-style11 light-title'); ?>>
	<div class="featured-title row align-center">
		<div class="small-12 medium-10 large-8 columns">
			<?php do_action('thb_categories'); ?>
			<div class="post-title">
				<h1 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			</div>
			<aside class="post-author">
				<em><?php _e('by', 'thevoux'); ?></em> <?php the_author_posts_link(); ?>
			</aside>
		</div>
	</div>
	<div class="parallax_bg" 
				data-center-bottom="transform: translate3d(0px, -5%, 0px);"
				data-center-top="transform: translate3d(0px, 5%, 0px);" style="background-image: url('<?php echo esc_attr($image[0]); ?>');"></div>
	<?php do_action('thb_PostMeta'); ?>
</article>