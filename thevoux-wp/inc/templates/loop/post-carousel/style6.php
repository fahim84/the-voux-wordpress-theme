<article <?php post_class('post featured-style7 inline-category-style text-center'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style1'); ?></a>
	</figure>
	<?php if(has_category()) { ?>
	<aside class="post-meta cf"><?php the_category(', '); ?></aside>
	<?php } ?>
	<aside class="post-author cf">
		<time class="time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo thb_human_time_diff_enhanced(); ?></time>
	</aside>
	<div class="post-title">
		<h4 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>