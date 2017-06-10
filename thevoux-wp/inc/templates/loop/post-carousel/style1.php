<?php
	$vars = $wp_query->query_vars;
	$thb_style = array_key_exists('thb_style', $vars) ? $vars['thb_style'] : 'featured-style4';
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-style1';
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,$thb_image_size);
?>
<article <?php post_class('post cover-image '. $thb_style); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<div class="thb-placeholder" style="background-image: url(<?php echo esc_url($image_url[0]); ?>);"></div>
	<div class="featured-title">
		<?php do_action('thb_categories'); ?>
		<div class="post-title">
			<h3 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		</div>
		<div class="post-excerpt">
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more"><?php _e('Read More &rarr;', 'thevoux' ); ?></a>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>