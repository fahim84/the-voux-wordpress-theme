<?php
	$vars = $wp_query->query_vars;
	$thb_style = array_key_exists('thb_style', $vars) ? $vars['thb_style'] : 'featured-style4';
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-single';
?>
<article <?php post_class('post '. $thb_style); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<?php the_post_thumbnail($thb_image_size ); ?>
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