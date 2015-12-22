<?php
/**
 * Template Name: Один Бренд
 */
?>
<!-- t: archive-brand -->
<?php get_header(); ?>

  <div class="b-max-width">
		<?php  /* get_template_part( 'part_brand' ); */ ?>
		<?php
      global $wpdb;
      $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $link = get_home_url();
      $actual_link = str_replace($link, "", $actual_link);
      $actual_link = ltrim ($actual_link, '/');
      $actual_link = rtrim ($actual_link, '/');
      if (!empty($_GET['_openstat'])) {
        $actual_link = mysql_real_escape_string($actual_link);
        $actual_link_parts = parse_url($actual_link);
        $actual_link = $actual_link_parts['path'];
        $actual_link = rtrim($actual_link, '/');
      }
      $head_cats = get_terms('type',array('parent'=>'0'));

      /*$sql = "SELECT tax.term_id FROM $wpdb->term_taxonomy as tax
              JOIN $wpdb->term_relationships as rl
              ON rl.term_taxonomy_id = tax.term_taxonomy_id
              JOIN $wpdb->posts as p
              ON rl.object_id = p.ID
              WHERE p.post_type = '$actual_link'  AND tax.count > 0 AND tax.parent = 0";*/
      $sql = "SELECT tax.term_id,tax.parent  FROM $wpdb->term_taxonomy as tax
              LEFT JOIN $wpdb->term_relationships as rl
              ON rl.term_taxonomy_id = tax.term_taxonomy_id
              RIGHT JOIN $wpdb->posts as p
              ON rl.object_id = p.ID
              WHERE tax.taxonomy = 'type' AND p.post_type = '$actual_link' AND tax.count > 0";
      $result = $wpdb->get_results($sql);
      $i = 0;
      foreach ($result as $item) {
        foreach ($head_cats as $head_cats_item) {
          if (($item->parent == $head_cats_item->term_id) || ($item->parent == '0')) {
            if ($item->parent == '0') {
              $new_ar[$i] = $item->term_id;
            } else {
              $new_ar[$i] = $item->parent;
            }
            $i++;
          }
        }
      }

      $new_ar = array_unique($new_ar);
      $i = 0;

      foreach ($new_ar as $item_arr){
        $k = get_term_by('id',$item_arr,'type');
        $str = 'category_name=' + $k->name;
        $test = get_posts($str);
        if ($test){
          $cats[$i] = $k->name;
          $i++;
        }
      }
      asort($cats);
    ?>

    <?php $p_type = get_post_type_object( $actual_link ); ?>

    <p id="breadcrumbs"><a href="/">Главная</a> » <a href="/<?php echo $actual_link; ?>"><?php echo $p_type->labels->name; ?></a> » <span></span></p>
		<div class="b-side-menu">
      <ul class="b-side-menu__list">
	    	<?php
        /*	$cat_name = single_term_title('',0);
          $term = get_term_by( 'name', $cat_name, 'brands' );
          $type_id = $term->term_id;  ?>
          <ul class="b-side-menu__list">
          <?php $count = 0; ?>
          <?php foreach (get_terms('type', array('hide_empty' => true, 'parent' => 0)) as $cat)  :  ?>
            <?php $count++; ?>
            <?php $args = array(
              'post_type' => 'goods',
              'brands' => $cat_name,

            );
            $query = new WP_Query($args); if ( $query->have_posts() ) {
             while($query->have_posts()){ $query->the_post(); ?>
                <li class="b-side-menu__item main-menu-item  menu-item-even menu-item-depth-0 menu-item menu-item-type-taxonomy menu-item-object-brands">
                    <a href="<?php the_permalink(); ?>" class="b-side-menu__link menu-item menu-item-type-taxonomy menu-item-object-brands">
                    <?php the_title(); ?></a></li>
              <?php } } ?>
            <?php wp_reset_postdata() ; ?>

          <?php endforeach; ?>*/
          $k = 0;
          $l = 0;
          foreach ($cats as $cats_s) {
            $cat_s_term = get_term_by('name',$cats_s,'type');
            $all[$l] = $cat_s_term;
            $l++;
          }
          for ($kkk = 0; $kkk < count($all); $kkk++) {
            for ($kk = 1; $kk < count($all); $kk++) {
              if ($all[$kk]->term_order < $all[$kk-1]->term_order) {
                $temp = $all[$kk];
                $all[$kk] = $all[$kk-1];
                $all[$kk-1] = $temp;
              }
            }
          }
          foreach ($all as $all_item) {
            // Get the ID of a given category
            $categor = get_term_by('name',$all_item->name,'type');

            // Get the URL of this category
            $category_link = get_category_link( $categor->slug );

          $k++;
        ?>
        <?php if ($all_item->name != "") { ?>
          <li class="<?php if ($k == 1){ echo 'active'; $lupa = $categor->term_id; $titt = $all_item->name;} ?> b-side-menu__item main-menu-item  menu-item-even menu-item-depth-0 menu-item menu-item-type-taxonomy menu-item-object-brands">
            <a value="<?php echo $categor->term_id; ?>" href="<?php echo bloginfo('url') ?>/?taxonomy=type&type=<?php echo $categor->slug; ?>&post_type=<?php echo $actual_link; ?>" class="b-side-menu__link menu-item menu-item-type-taxonomy menu-item-object-brands">
              <?php echo $all_item->name; ?>
            </a>
          </li>
        <?php }
      } ?>
			</ul>
		</div>

    <div class="b-content _padding-top _padding-bottom _left-sidebar">

      <h1><?php echo $titt; ?></h1>
			<?php
        $cat_name = single_term_title('',0);
        $term = get_term_by( 'name', $cat_name, 'brands' );
        $type_id = $term->term_id;
      ?>
			<form action="" method="POST" value="<?php echo $categor->term_id; ?>">
				<div class="b-cat type1">
        <?php
          $cats = get_categories('parent='.$lupa.'&taxonomy=type');
          asort($cats);
          function cmp($a, $b) {
            //return strcmp($a->term_order, $b->term_order);
            /*if((int)$a->term_order == (int)$b->term_order)return 0;
            if((int)$a->term_order  > (int)$b->term_order)return 1;
            if((int)$a->term_order  < (int)$b->term_order)return -1;*/
            return (int)$a->term_order-(int)$b->term_order;
          }
          usort($cats, "cmp");
          $i = 0;
          foreach ($cats as $catt) { ?>
					<div class="b-cat__subcat">
						<div class="b-cat__subcat-toggle" href="#" data-toggle="#subcat<?php echo $i; ?>"><?php echo $catt->name; ?></div>
							<div id="subcat<?php echo $i; ?>" style="display:none;" class="b-cat__subcat-contents">
								<ul class="b-list__list _no-pad">
								<?php
                  query_posts(array('post_type' => $actual_link,'post__in'=>get_option('sticky_posts'),'tax_query' => array(
                    array(
                      'taxonomy' => 'type',
                      'field'    => 'slug',
                      'terms'    => $catt->slug,
                    )),
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'posts_per_page' => '-1'));
                    if (have_posts()) : while (have_posts()) :the_post();
                ?>
								<li class="b-list__item">
									<div class="b-list__item-img-wrapper"><a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()){ the_post_thumbnail('crop_thumb'); } else { ?><img src="<?php bloginfo('url');echo "/";echo "wp-content/uploads/2015/rakurs_logo.png";?>"><?php } ?></a></div>
									<div class="b-list__item-text"><a href="<?php the_permalink(); ?>" class="b-list__item-title"><?php the_title(); ?></a><?php the_excerpt(); ?></div>
								</li>
							<?php endwhile; else: endif; ?>
              <?php wp_reset_query(); ?>
              <?php  query_posts(array('post_type' => $actual_link,'post__not_in'=>get_option('sticky_posts'),'tax_query' => array(
                      array(
                        'taxonomy' => 'type',
                        'field'    => 'slug',
                        'terms'    => $catt->slug,
                      )),
                      'orderby' => 'title',
                      'order' => 'ASC','posts_per_page' => '-1'));
                if (have_posts()) : while (have_posts()) :the_post();  ?>
								<li class="b-list__item">
									<div class="b-list__item-img-wrapper"><a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()){ the_post_thumbnail('crop_thumb'); } else { ?><img src="<?php bloginfo('url');echo "/";echo "wp-content/uploads/2015/rakurs_logo.png";?>"><?php } ?></a></div>
									<div class="b-list__item-text"><a href="<?php the_permalink(); ?>" class="b-list__item-title"><?php the_title(); ?></a><?php the_excerpt(); ?></div>
								</li>
							<?php endwhile;else: endif; ?>
              <?php wp_reset_query(); ?>
								</ul>
							</div>
					    </div>
						<?php $i++; } ?>
				</div>
			</form>
		</div>
	</div>
<?php get_footer(); ?>
<script>
    jQuery(document).ready(function(){
        jQuery('.b-cat__subcat').each(function() {
            var in_html = jQuery(this).children('.b-cat__subcat-contents').children('ul').children('li').html();
            if (typeof in_html != 'undefined'){
            }
            else{
                jQuery(this).remove();
            }
        });
        if (jQuery('.b-cat>div').length == 1){
        	$(this).find('.b-cat__subcat-toggle').addClass('_open');
        	$('._open').next().css('display','block');
        }
        jQuery('#breadcrumbs span').html(jQuery('h1').html());
    });
</script>
