<?php
/**
 * Template Name: Архив решений
 */
?>
<!-- t: taxonomy-branch  -->
<?php get_header(); ?>
			<?php 
			$cat_name = single_term_title('',0);
			$term = get_term_by( 'name', $cat_name, 'brunch' );
			$cat_id = $term->term_id;
			$cat_slug = $term->slug; ?>
	<div class="b-max-width">
<p id="breadcrumbs"><a href="/">Главная</a> » <a href="/solutions">Решения</a> » <span><?php echo $cat_name; ?></span></p>
		<?php get_template_part( 'part_solutions' ); ?>
				<div class="b-content _padding-top _padding-bottom _left-sidebar">
<?php $args = array(
					'post_type' => 'solutions','tax_query' => array(
                                    array(
                                      'taxonomy' => 'brunch',
                                      'field'    => 'slug',
                                      'terms'    => $cat_slug,
                                    )),
					/* 'brunch' => $cat_slug, */
					'size' => 'kompleksnoe',
				); 
				$query = new WP_Query($args); if (count($query->posts) > 0) { ?> 
			<h1 class="b-list__title">Комплексные решения</h1>
			<?php } ?>
			<ul class="b-list__list _no-pad">
		<?php  if ( $query->have_posts() ) while($query->have_posts()){ $query->the_post(); ?>		
				<li class="b-list__item">
					<div class="b-list__item-img-wrapper">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('crop_thumb'); ?></a>
					</div>
					
					<div class="b-list__item-text"><a href="<?php the_permalink(); ?>" class="b-list__item-title"><?php the_title(); ?></a><?php the_excerpt(); ?></div>
					<div class="b-list__read-more-wrapper"><a href="<?php the_permalink(); ?>" class="b-list__read-more-link">Подробнее ›</a></div>
				</li>
					<?php } ?>				
					<?php wr_pagenavi(); ?>
				<?php wp_reset_postdata() ; ?>
				
			</ul>
			<?php $args = array(
					'post_type' => 'solutions','tax_query' => array(
                                    array(
                                      'taxonomy' => 'brunch',
                                      'field'    => 'slug',
                                      'terms'    => $cat_slug,
                                    )),
					/*'brunch' => $cat_name, */
					'size' => 'lokalnoe'
				); 
			$query = new WP_Query($args); if (count($query->posts) > 0) { ?> 
			<h1 class="b-list__title">Локальные решения</h1>
			<?php } ?>
			<ul class="b-list__list _no-pad">			
			<?php  if ( $query->have_posts() ) while($query->have_posts()){ $query->the_post(); ?>		

				<li class="b-list__item">
					<div class="b-list__item-img-wrapper">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('crop_thumb'); ?></a>
					</div>
					
					<div class="b-list__item-text"><a href="<?php the_permalink(); ?>" class="b-list__item-title"><?php the_title(); ?></a><?php the_excerpt(); ?></div>
					<div class="b-list__read-more-wrapper"><a href="<?php the_permalink(); ?>" class="b-list__read-more-link">Подробнее ›</a></div>
				</li>
					<?php } ?>				
					<?php wr_pagenavi(); ?>
				<?php wp_reset_postdata() ; ?>
				
			</ul>

		</div>
	</div>
<?php get_footer(); ?>

