<?php
	$vars = $wp_query->query_vars;
	$style = array_key_exists('thb_style', $vars) ? $vars['thb_style'] : 'featured-style1';
	
  $photo_id = get_post_thumbnail_id();
  $image = wp_get_attachment_image_src( $photo_id, 'full' );
			
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-slider '.$style); ?>>
	<figure class="post-gallery has-parallax">
		<div class="parallax_bg" 
					data-center-bottom="transform: translate3d(0px, -5%, 0px);"
					data-center-top="transform: translate3d(0px, 5%, 0px);" style="background-image: url('<?php echo esc_attr($image[0]); ?>');"></div>
	</figure>
	<div class="featured-title">
		<?php do_action('thb_categories'); ?>
		<div class="post-title">
			<h3 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		</div>
		<aside class="post-author">
			<em><?php _e('by', 'thevoux'); ?></em> <?php the_author_posts_link(); ?>
		</aside>
		<?php if ($style === 'featured-style10') { get_template_part( 'inc/templates/postbits/post-links-style2' );  } ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>