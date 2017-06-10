<article <?php post_class('post featured-style-carousel'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
	</figure>
	<div class="post-title">
		<h6 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>