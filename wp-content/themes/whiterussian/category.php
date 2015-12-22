<!-- t: category -->
<?php get_header(); ?>
	<div class="b-max-width">
		<div class="b-content">
			<?php $obj = get_the_category(); ?>
			<?php $title = single_cat_title("", 0);
			      $catID = get_cat_ID( $title );
			      $thisCat = get_category($catID,false);
			      $slug = $thisCat->slug;?>
			<p id="breadcrumbs"><a href="/">Главная</a> » <span><?php echo $thisCat->name; ?></span></p>
			<?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  ?>
      <?php
        /* Get all Sticky Posts */
        $sticky = get_option( 'sticky_posts' );

        /* Sort Sticky Posts, newest at the top */
        rsort( $sticky );


        /* Query Sticky Posts */
        $query = new WP_Query( array( 'post_type'=>'post','post__in' => $sticky, 'ignore_sticky_posts' => 0,'paged' => $paged,'category_name' => $slug,'posts_per_page'=>'10') );
        $quanity = 10 - $query->found_posts;
        $query_new = new WP_Query( array( 'post_type'=>'post','post__not_in' => $sticky, 'ignore_sticky_posts' => 0,'paged' => $paged,'category_name' => $slug,'posts_per_page'=>$quanity) );

      ?>
      <h1><?php $cats = get_the_category(); echo $cats[0]->name; ?></h1>
      <?php if (( $query->have_posts() ) || ( $query_new->have_posts() )) { ?>

      <ul class="b-list__list">

        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <li>
            <article>
              <div class="b-list__item-img-wrapper">
                <a href="<?php esc_url( the_permalink() ); ?>"><?php the_post_thumbnail('crop_thumb'); ?></a>
              </div>
              <div class="b-list__item-text">
                <time class="b-list__item-date" datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php echo get_the_date(); ?></time><br/>
                <a href="<?php esc_url( the_permalink() ); ?>" class="b-list__item-title"><?php the_title(); ?></a>
                <?php the_excerpt(); ?>
              </div>
              <div class="b-list__read-more-wrapper"><a href="<?php esc_url( the_permalink() ); ?>" class="b-list__read-more-link">Подробнее ›</a></div>
            </article>
          </li>
        <?php endwhile; ?>
        <?php while ( $query_new->have_posts() ) : $query_new->the_post(); ?>
          <li>
            <article>
              <div class="b-list__item-img-wrapper">
                <a href="<?php esc_url( the_permalink() ); ?>"><?php the_post_thumbnail('crop_thumb'); ?></a>
              </div>
              <div class="b-list__item-text">
                <time class="b-list__item-date" datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php echo get_the_date(); ?></time><br/>
                <a href="<?php esc_url( the_permalink() ); ?>" class="b-list__item-title"><?php the_title(); ?></a>
                <?php the_excerpt(); ?>
              </div>
              <div class="b-list__read-more-wrapper"><a href="<?php esc_url( the_permalink() ); ?>" class="b-list__read-more-link">Подробнее ›</a></div>
            </article>
          </li>
        <?php endwhile; ?>

      </ul>

      <?php } else { ?>
        <h2>Новостей пока не нашлось</h2>
      <?php } ?>
        <?php wr_pagenavi(); ?>

		</div>
    <?php get_sidebar('news_side'); ?>

	</div>

<?php get_footer(); ?>
