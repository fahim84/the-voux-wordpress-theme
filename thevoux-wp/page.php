<?php get_header(); ?>
<?php if ( post_password_required() ) { ?>
	<?php get_template_part( 'inc/loop/password' ); ?> 
<?php } else { ?>
	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<!-- Start #comments -->
			<?php comments_template('', true); ?>
			<!-- End #comments -->
		<?php endif; ?>
	<?php endwhile; else : endif; ?>
<?php } ?>
<?php get_footer(); ?>