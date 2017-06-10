<?php
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id, 'full');
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style11 light-title'); ?> id="post-<?php the_ID(); ?>">
	<div class="parallax_bg" 
				data-center-bottom="transform: translate3d(0px, -5%, 0px);"
				data-center-top="transform: translate3d(0px, 5%, 0px);"
				style="background-image: url(<?php echo esc_html($image_url[0]); ?>);"></div>
	<?php do_action('thb_categories'); ?>
	
	<aside class="post-author cf">
		<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
	</aside>
	<header class="post-title">
		<h2 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	</header>
	<div class="post-content">
		<?php get_template_part( 'inc/templates/postbits/post-links-style3' ); ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>