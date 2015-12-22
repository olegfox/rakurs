<?php
/**
 * Template Name: Поиск по производителю
 */
?>
<!-- t: taxonomy-brands -->
<?php get_header(); ?>
	<div class="b-max-width">
		<?php get_template_part( 'part_brand' ); ?>
			<div class="b-content _padding-top _padding-bottom _left-sidebar">
			<h1><?php single_term_title(); ?></h1>
			<?php 
			$cat_name = single_term_title('',0);
			$term = get_term_by( 'name', $cat_name, 'brands' );
			$type_id = $term->term_id;  ?>
			<form action="" method="POST">

				<div class="b-cat type2">
				<?php $count = 0; ?>
			<?php foreach (get_terms('type', array('hide_empty' => true, 'parent' => 0)) as $cat)  :  ?>
				<?php $count++; ?>					
				<?php $args = array(
					'post_type' => 'goods',
					'brands' => $cat_name,
					'type' => $cat->name
				); 
				$query = new WP_Query($args); if ( $query->have_posts() ) { ?>
					<div class="b-cat__subcat">
						<div class="b-cat__subcat-toggle" href="#" data-toggle="#subcat<?php echo $count; ?>"><?php echo $cat->name; ?></div>
							<div id="subcat<?php echo $count; ?>" style="display:none;" class="b-cat__subcat-contents">
								<ul class="b-list__list _no-pad">
					<?php while($query->have_posts()){ $query->the_post(); ?>
								<li class="b-list__item">
									<div class="b-list__item-img-wrapper"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('crop_thumb'); ?></a></div>
									<a href="<?php the_permalink(); ?>" class="b-list__item-title"><?php the_title(); ?></a>
									<div class="b-list__item-text"><?php the_excerpt(); ?></div>
								</li>
					<?php } ?>
								</ul>
							</div>
					</div>
				<?php } ?>
				<?php wp_reset_postdata() ; ?>

			<?php endforeach; ?>
				</div>

			</form>


		</div>
	</div>
<?php get_footer(); ?>

