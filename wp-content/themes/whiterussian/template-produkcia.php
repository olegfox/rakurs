<?php
/**
 * Template Name: Поиск по продукции
 */
?>
<!-- t: template-produkcia -->
<?php get_header(); ?>
	<div class="b-max-width">
		<p id="breadcrumbs"><a href="/">Главная</a> »  <span>Продукция</span></p>
		<div class="b-content _no-sidebar _pro">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div class="b-manuf b-pro-section">
				<h2 class="h2">Поиск по производителям <span style="font-size:16px;">(нажмите на логотип производителя)</span></h2>	
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

			<div class="b-pro-cat b-pro-section">
				<h2 class="h2">Поиск по категориям <span style="font-size:16px;">(нажмите на интересующую Вас категорию)</span></h2>
				<ul class="b-pro-cat__list">
					<?php foreach (get_terms('type', array('parent' => 0)) as $cat)  :  ?>
					<li class="b-pro-cat__item">
							<a href="<?php echo get_term_link($cat->slug, 'type'); ?>" class="b-pro-cat__link" title=" <?php echo $cat->name; ?>"> 
														<?php 

$image = get_field('picturecat', $cat);
$size = 'medium';

if( $image ) {

	echo wp_get_attachment_image( $image, $size );

}

?>
							<span class="b-pro-cat__title"><i><?php echo $cat->name; ?></i></span>
							</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>




			<div class="b-pro-search b-pro-section">
				<h2 class="h2">Поиск по названию <span style="font-size:16px;">(введите название интересующего Вас товара)</span></h2>
				<!--<form action="" method="post" class="js-validate">
					<input class="b-index-search__field" type="text" name="search_main" required>
					<input class="b-index-search__button b-button" type="submit" value="Искать">
				</form> -->
				<form class="b-content-search" action="<?php bloginfo('url');?>" method="GET" style="width:630px;">

				<input class="b-content-search__what" name="s" id="s" type="text" placeholder="Введите запрос">

				<div class="b-content-search__where">
					<select class="js-selectboxit" name="post_type">
						<option value="any">Весь сайт</option>
						<option value="omron,schenider-electric,yaskawa,siemens,tr-electronic,cognex,optex-fa">Продукция</option>
						<option value="solutions">Решения</option>
					</select>
				</div>

				<input class="b-content-search__submit b-button _invert" type="submit" value="Искать">

			</form>
			
			</div>


<?php endwhile; ?>
		</div>
  </div>

<?php get_footer(); ?>