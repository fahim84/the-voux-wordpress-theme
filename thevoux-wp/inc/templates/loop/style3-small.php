<?php 
	$vars = $wp_query->query_vars;
	$thb_offset_style = array_key_exists('thb_offset_style', $vars) ? $vars['thb_offset_style'] : '';
	$imagesize = $thb_offset_style ? 'thevoux-style3' : 'thevoux-style3-small';
	add_filter( 'excerpt_length', 'thb_widget_excerpt_length' ); 
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style3-small '.$thb_offset_style); ?> id="post-<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery <?php do_action('thb_is_gallery'); ?><?php do_action('thb_is_review'); ?>">
		<?php do_action('thb_post_review_average'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail($imagesize); ?></a>
	</figure>
	<?php } ?>
	<aside class="post-author small cf">
		<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
	</aside>
	<header class="post-title entry-header offset-title-container">
		<h5 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
	</header>
	<div class="post-content small">
		<?php the_excerpt(); ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>