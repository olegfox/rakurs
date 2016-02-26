<?php
/**
 * Template Name: Главная страница
 */
?>
<!-- t: template-main -->
<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div class="b-max-width">
		<section class="b-index__slider">
			<div class="b-index__slider-top-left"></div>

			<div class="owl-carousel index-1">
				<div class="owl-item-wrapper"><?php
        $image = get_field('slide_1');
        $size = 'slide';
        if( $image ) {
          echo wp_get_attachment_image( $image, $size );
        }?></div>
				<div class="owl-item-wrapper"><?php
        $image = get_field('slide_2');
        $size = 'slide';
        if( $image ) {
          echo wp_get_attachment_image( $image, $size );
        }?></div>
				<div class="owl-item-wrapper"><?php
        $image = get_field('slide_3');
        $size = 'slide';
        if( $image ) {
          echo wp_get_attachment_image( $image, $size );
        }?></div>
				<div class="owl-item-wrapper"><?php
        $image = get_field('slide_4');
        $size = 'slide';
        if( $image ) {
          echo wp_get_attachment_image( $image, $size );
        }?></div>
				<div class="owl-item-wrapper"><?php
        $image = get_field('slide_5');
        $size = 'slide';
        if( $image ) {
          echo wp_get_attachment_image( $image, $size );
        }?></div>
			</div>

			<div class="b-index__slider-right-bottom"></div>

			<div class="b-index__slider-text">
				<div><?php echo get_field('slidertext');?></div>
			</div>
		</section>
	</div>

	<div class="b-max-width _clearfix">

		<div class="b-content b-index-content">

			<div class="b-manuf b-index-section">
				<h2 class="h2">Поиск товаров по производителям <span style="font-size:16px;">(нажмите на логотип производителя)</span></h2>
					<ul class="b-manuf__list">
					  <li class="b-manuf__item">
							<a href="../omron" class="b-manuf__link"> <img src="<?php echo ot_get_option( 'omron'); ?>"></a>
						</li>
						<li class="b-manuf__item">
							<a href="../schneider-electric" class="b-manuf__link"> <img src="<?php echo ot_get_option( 'schneider_electric'); ?>"></a>
						</li>
						<li class="b-manuf__item">
							<a href="../yaskawa" class="b-manuf__link"> <img src="<?php echo ot_get_option( 'yaskawa'); ?>"></a>
						</li>
						<li class="b-manuf__item">
							<a href="../siemens" class="b-manuf__link"> <img src="<?php echo ot_get_option( 'siemens'); ?>"></a>
						</li>
						<li class="b-manuf__item">
							<a href="../tr-electronic" class="b-manuf__link"> <img src="<?php echo ot_get_option( 'tr_electronic'); ?>"></a>
						</li>
						<li class="b-manuf__item">
							<a href="../cognex" class="b-manuf__link"> <img src="<?php echo ot_get_option( 'cognex'); ?>"></a>
						</li>
							<li class="b-manuf__item">
							<a href="../optex-fa" class="b-manuf__link"> <img src="<?php echo ot_get_option( 'optex_fa'); ?>"></a>
						</li>
					</ul>
			</div>

			<div class="b-index-cat b-index-section">
				<h2 class="h2">Поиск товаров по категориям <span style="font-size:16px;">(нажмите на интересующую Вас категорию)</span></h2>
				<ul class="b-index-cat__list">
					<?php foreach (get_terms('type', array('parent' => 0)) as $cat)  :  ?>
					<li class="b-index-cat__item">
							<a href="<?php echo get_term_link($cat->slug, 'type'); ?>" class="b-index-cat__link" title=" <?php echo $cat->name; ?>">

							<?php
                $image = get_field('picturecat', $cat);
                $size = 'medium';
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

			<div class="b-index-search b-index-section">
				<h2 class="h2">Поиск товаров по названию <span style="font-size:16px;">(введите название интересующего Вас товара)</span></h2>

				<!--<form action="" method="post" class="js-validate">
					<input class="b-index-search__field" type="text" name="search_main" required>
					<input class="b-index-search__button b-button" type="submit" value="Искать">
				</form>-->

           <? echo get_post_meta(9, 'main_search_form', true);?>

         <!--
					<form class="b-content-search" action="<?php bloginfo('url');?>" method="GET">



            <input class="b-content-search__what" name="s" id="s" type="text" placeholder="Введите запрос">

            <div class="b-content-search__where">
              <select class="js-selectboxit" name="post_type">
                <option value="any">Весь сайт</option>
                <option value="omron,schenider-electric,yaskawa,siemens,tr-electronic,cognex,optex-fa">Продукция</option>
                <option value="solutions">Решения</option>
              </select>
            </div>

            <input class="b-content-search__submit b-button _invert" type="submit" value="Искать">

          </form>			-->
			</div>

		</div>

    <?php get_sidebar('true_side'); ?>
    <div class="b-clients">
      <div class="b-max-width">
        <h2 class="h2">Наши заказчики</h2>
      </div>

      <div class="b-clients__wrapper">
        <div class="b-index-section b-max-width" style="padding-top:15px;padding-bottom:15px;">
          <?php kw_sc_logo_carousel('partners'); ?>
        </div>
      </div>
    </div>
        <?php the_content(); ?>
    <div class="b-index-about">
      <div class="b-max-width">
        <h2 class="h2">Компания &laquo;Ракурc&raquo; &mdash; это:</h2>
          <?php
          echo do_shortcode("[URIS id=11268]");
          ?>
      </div>
    </div>
  </div>

<?php endwhile; ?>
<?php get_footer(); ?>