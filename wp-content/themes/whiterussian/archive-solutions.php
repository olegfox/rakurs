<?php
/**
 * Archive page: Поиск по решениям
 */
?>
<!-- t: archive-solutions -->
<?php get_header(); ?>
	<div class="b-max-width">
								<p id="breadcrumbs"><a href="/">Главная</a> » <span>Решения</span></p>
				<div class="b-content">
							<div class="b-index-cat b-index-section">
				<h1 class="h1">Отрасли решений</h1>
				<ul class="b-index-cat__list">
					<?php foreach (get_terms('brunch', array('parent' => 0)) as $cat)  :  ?>
					<li class="b-index-cat__item">
							<a href="<?php echo get_term_link($cat->slug, 'brunch'); ?>" class="b-index-cat__link" title=" <?php echo $cat->name; ?>"> 
														<?php 

$image = get_field('picturecat', $cat);
$size = 'cats_thumb';

if( $image ) {

	echo wp_get_attachment_image( $image, $size );

}

?>
							<span class="b-index-cat__title"><i><?php echo $cat->name; ?></i></span>
							</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>

		</div>
				<?php get_sidebar('page_side'); ?>

	</div>
<?php get_footer(); ?>

