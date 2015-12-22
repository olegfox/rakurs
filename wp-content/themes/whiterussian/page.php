<?php
/**
 * The template for displaying all pages
 */
?>
<!-- t: page -->
<?php get_header(); ?>

	<div class="b-max-width">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php global $post;$tit = get_the_title($post); $post_par = $post->post_parent; $par = get_post($post_par); ?>
      <p id="breadcrumbs"><a href="/">Главная</a> » <a href="<?php echo get_permalink($post_par); ?>"><?php echo $par->post_title; ?></a> <?php if($tit == $par->post_title){  } else { ?>» <span><?php the_title(); ?></span> <?php } ?></p>
      <div class="b-content<?php if( in_array( 'off', get_field('banner') ) ) { ?> _no-sidebar<?php } else { ?><?php } ?>">
        <?php the_title('<h1>', '</h1>'); ?>
        <?php the_content(); ?>
        <br/>
      </div>
      <?php get_sidebar('page_side'); ?>
    <?php endwhile; ?>

	</div>

<?php get_footer(); ?>