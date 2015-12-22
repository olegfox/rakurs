<?php
/**
 * Template Name: О компании
 */
?>
<!-- t: template-about -->
<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="b-max-width">
			<p id="breadcrumbs"><a href="/">Главная</a> » <span><?php the_title(); ?></span></p>
			</div>	
	<div class="b-content _no-sidebar">
			<div class="b-max-width">
			<?php the_title('<h1>', '</h1>'); ?>
			</div>
		<div class="b-about__cite">
			<div class="b-about__cite-text b-max-width">
			<?php the_field('quot'); ?>
			</div>
		</div>
	<div class="b-about__text b-max-width">
		<?php the_content(); ?>
	</div>
<?php endwhile; ?>
  </div>

<?php get_footer(); ?>