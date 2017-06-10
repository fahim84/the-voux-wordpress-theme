<?php get_header(); ?>
<div class="row">
	<section class="blog-section small-12 medium-8 columns">
		<div class="row">
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<div class="small-12 medium-6 columns">
				<?php get_template_part( 'inc/templates/loop/style6' ); ?>
				</div>
			<?php endwhile; else : ?>
			  	<?php get_template_part( 'inc/templates/loop/notfound' ); ?>
			<?php endif; ?>
		</div>
		<?php if ( get_next_posts_link() || get_previous_posts_link()) { ?>
		<div class="blog_nav">
			<?php if ( get_next_posts_link() ) : ?>
				<a href="<?php echo next_posts(); ?>" class="next"><i class="fa fa-angle-left"></i> <?php _e( 'Older Posts', 'thevoux' ); ?></a>
			<?php endif; ?>
		
			<?php if ( get_previous_posts_link() ) : ?>
				<a href="<?php echo previous_posts(); ?>" class="prev"><?php _e( 'Newer Posts', 'thevoux' ); ?> <i class="fa fa-angle-right"></i></a>
			<?php endif; ?>
		</div>
		<?php } ?>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>