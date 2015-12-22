<?php
/**
 * Template Name: Отызывы
 */
?>
<!-- t: template-reviews -->
<?php get_header(); ?>
	<div class="b-max-width">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php global $post; $post_par = $post->post_parent; $par = get_post($post_par); ?>
			<p id="breadcrumbs"><a href="/">Главная</a> » <a href="<?php echo get_permalink($post_par); ?>"><?php echo $par->post_title; ?></a> » <span><?php the_title(); ?></span></p>


		<div class="b-content">
<?php the_title('<h1>', '</h1>'); ?>
<ul class="b-list__list _more-space">
<?php $i =0; ?>
<?php query_posts(array('post_type'=>'reviews', 'orderby'=>'date')); ?> 
<?php if (have_posts()) : while (have_posts()) :the_post(); ?>
				
				<li style="position:relative;cursor:pointer;" class="b-list__item review_item">
				    <?php if (has_post_thumbnail()){ ?>
					<div class="b-list__item-img-wrapper">
						<?php the_post_thumbnail('thumbnail'); ?>
					</div>
					<?php } ?>
					<div class="b-list__item-text"><div class="b-list__item-title"><?php the_title(); ?></div>
<?php the_content(); ?></div>
					<a id="<?php echo 'modal'; echo $i; ?>" class="read_more" style="position: absolute;top:0;bottom:0;left:0;right:0; display:block;"></a>
					<?php $i++; ?>
				</li>
				<?php endwhile;else: endif;?>
<?php wp_reset_query(); ?>	
			</ul>
			<br/>
		</div>
<?php get_sidebar('page_side'); ?>
<?php endwhile; ?>
	</div>

<?php get_footer(); ?>