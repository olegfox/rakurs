<!-- t: index -->
<?php get_header(); ?>
  <a class="btn-floating head waves-effect waves-light" href="/contact/"><i class="mdi-editor-mode-edit"></i></a>
<div class="container">
<div class="empty"></div>
<div class="row">
<?php if ( have_posts() ): ?>
<ol class="wr_blog">
<?php while ( have_posts() ) : the_post(); ?>
	<div class="col s12 m4">

	<li>
		<article>
		<div class="card">
   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
		<div class="card-image">
		<?php if ( has_post_thumbnail()) { ?>
   <?php the_post_thumbnail('thumbnail'); ?>
 <?php } ?></div>   </a>
		<div class="card-content">
		<span class="card-title grey-text darken-4"><?php the_title(); ?></span>
		</div>
		<!--div class="card-action">
		<p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >more</a></p>
		</div-->
		</div>
		</article>
	</li>
	</div>
<?php endwhile; ?>
</ol>
<?php else: ?>
<h2 class="header <?php echo ot_get_option( 'headings_color' ); ?>">No posts to display</h2>
<?php endif; ?>

<?php wr_pagenavi(); ?>

</div>
</div>

<?php get_footer(); ?>