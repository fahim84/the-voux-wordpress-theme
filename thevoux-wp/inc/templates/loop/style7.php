<?php 
	add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); 
	$vars = $wp_query->query_vars;
	$thb_offset_style = array_key_exists('thb_offset_style', $vars) ? $vars['thb_offset_style'] : '';
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-style1';	
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style7 '.$thb_offset_style); ?> id="post-<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery <?php do_action('thb_is_gallery'); ?><?php do_action('thb_is_review'); ?>">
		<?php do_action('thb_post_review_average'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail($thb_image_size); ?></a>
	</figure>
	<?php } ?>
	<div class="offset-title-container">
		<?php do_action('thb_categories'); ?>
		<aside class="post-author cf">
			<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
		</aside>
		<header class="post-title entry-header">
			<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="post-content">
			<?php if (!$thb_offset_style) { the_excerpt(); } ?>
			<?php get_template_part( 'inc/templates/postbits/post-links' ); ?>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>