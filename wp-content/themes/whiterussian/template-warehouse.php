<?php
/**
 * Template Name: Склад
 */
?>
<!-- t: template-warehouse -->
<?php get_header(); ?>
	<div class="b-max-width">
		<p id="breadcrumbs"><a href="/">Главная</a> » <span>Склад</span></p>
		<div class="b-content _no-sidebar _padding-bottom _clearfix">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="b-warehouse__map">
				<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=CTe98fPQVZLiFHhKfKFKdwelsQyJMWsk&width=500&height=620"></script>
			</div>
			<?php the_title('<h1>', '</h1>'); ?>
			<div class="b-warehouse__text">
			<?php the_content(); ?>
			</div>
		</div>
	</div>
		<?php endwhile; ?>
		</div>
	</div>

<?php get_footer(); ?>