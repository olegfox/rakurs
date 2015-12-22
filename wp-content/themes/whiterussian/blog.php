<?php
/**
 * Template Name: Blog
 */
?>
<!-- t: blog -->
<?php get_header(); ?>
<div class="container">
<div class="empty"></div>
<div class="row">
<div class="col s12 m8">
<?php if ( have_posts() ): ?>
<ol class="wr_blog">
<?php while ( have_posts() ) : the_post(); ?>
	<li>
		<article class="wr_card">
			<h3 class="header"><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
			<?php the_content(); ?>
		</article>
	</li>
<?php endwhile; ?>
</ol>
<?php else: ?>
<h2 class="header <?php echo ot_get_option( 'headings_color' ); ?>">No posts to display</h2>
<?php endif; ?>

<?php wr_pagenavi(); ?>
</div>
<div class="col s12 m4">
<?php if ( is_active_sidebar( 'true_side' ) ) : ?>
	<div id="true_side" class="sidebar"> 
	<?php dynamic_sidebar( 'true_side' ); ?>
	</div>
<?php endif; ?></div>
</div>
</div>


<?php get_footer(); ?>

