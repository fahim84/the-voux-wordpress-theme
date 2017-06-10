<?php $hide_zero_shares = ot_get_option('hide_zero_shares', 'off'); ?>
<footer class="post-style3-links">
	<aside class="post-author style2">
		<em><?php _e('by', 'thevoux'); ?></em> <span itemprop="author"><?php the_author_posts_link(); ?></span>
		<span><?php comments_number(__('0 Comments', 'thevoux'), __('1 Comment', 'thevoux'), __('% Comments', 'thevoux') ); ?></span>
	</aside>
</footer>