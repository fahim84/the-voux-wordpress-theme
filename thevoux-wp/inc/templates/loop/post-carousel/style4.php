<article <?php post_class('post featured-style7'); ?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-vertical'); ?></a>
	</figure>
	<aside class="post-meta cf"><?php the_category(', '); ?></aside>
	<div class="post-title">
		<h4 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
		<aside class="post-author">
			<em><?php _e('by', 'thevoux'); ?></em> <?php the_author_posts_link(); ?>
		</aside>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>