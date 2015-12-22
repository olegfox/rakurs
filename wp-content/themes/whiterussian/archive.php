<!-- t: archive -->
<?php get_header(); ?>
	<div class="b-max-width">
		<div class="b-content">
<?php if ( have_posts() ): ?>
<ul class="b-list__list">
<?php while ( have_posts() ) : the_post(); ?>
	<li>
		<article>
					<div class="b-list__item-img-wrapper">
					<a href="<?php esc_url( the_permalink() ); ?>"><?php the_post_thumbnail('crop_thumb'); ?></a>
					</div>
					<div class="b-list__item-text">
					<time class="b-list__item-date" datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php echo get_the_date(); ?></time><br/>
					<a href="<?php esc_url( the_permalink() ); ?>" class="b-list__item-title"><?php the_title(); ?></a>
					<?php the_excerpt(); ?></div>
					<div class="b-list__read-more-wrapper"><a href="<?php esc_url( the_permalink() ); ?>" class="b-list__read-more-link">Подробнее ›</a></div>					
		</article>
	</li>
<?php endwhile; ?>
</ul>
<?php else: ?>
<h2>Новостей пока не нашлось</h2>
<?php endif; ?>
<?php wr_pagenavi(); ?>

		</div>
<?php get_sidebar('news_side'); ?>

	</div>

<?php get_footer(); ?>