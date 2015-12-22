<?php
/**
 * The Template for displaying all single posts
 */
?>
<!-- t: single -->
<?php get_header(); ?>
	<div class="b-max-width">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 <?php global $post; ?>
 <?php if (get_post_type($post) != 'post') { ?>
 <p id="breadcrumbs"><a href="/">Главная</a> »
 <a href="/<?php echo get_post_type($post); ?>">
 <?php $type = get_post_type($post);$obj = get_post_type_object( $type ); echo $obj->labels->name; ?></a> »
 <?php
 if (get_post_type($post) != 'solutions') {
 $type_terms = wp_get_object_terms( $post->ID,  'type' );
 foreach ($type_terms as $type_term){
     if ($type_term->parent == 0){
         $my_term = $type_term;
     }
 }
 $catek = get_the_terms( $post->ID,'type' );ksort($catek);$keys = array_keys($catek); $par = get_term_by('id',$catek[$keys[0]]->parent,'type'); ?>
 <a href="/type/<?php
 //if ($par) { echo $par->slug; } else{ echo $catek[$keys[0]]->slug; }
 echo $my_term->slug;
 ?>/?post_type=<?php echo get_post_type($post); ?>">
 <?php  //if ($par) { echo $par->name; } else{ echo $catek[$keys[0]]->name; }
    echo $my_term->name;
 ?>
 </a>
 <?php } else{ $sol = get_the_terms($post->ID,'brunch');ksort($sol);$keys_sol = array_keys($sol);?><a href="/brunch/<?php if ($sol) { echo $sol[$keys_sol[0]]->slug; }   ?>"><?php  if ($sol) { echo $sol[$keys_sol[0]]->name; }  ?></a> <?php } ?>
  » <span><?php the_title(); ?></span>
 <?php } else { ?>
 <p style="font-size:14px;" id="breadcrumbs"><a href="/">Главная</a> »
 <?php $post_cat = get_the_category(); ?>
 <a href="/category/<?php echo $post_cat[0]->slug; ?>"><?php echo $post_cat[0]->name; ?></a> »
 <span><?php the_title(); ?></span></p>
 <?php } ?>
 <div class="b-content<?php if( in_array( 'off', get_field('banner') ) ) { ?> _no-sidebar<?php } else { ?><?php } ?>">
<?php if (in_category('news')) {  get_sidebar('news_side'); } else { get_sidebar('page_side'); }?>
<article>
    <br/>
    <div class="news_date b-list__item-date"><?php the_time('D, M, Y') ?></div>
	<?php the_title('<h1>', '</h1>'); ?>
			<div class="b-content__text tovar">
	<?php the_content(); ?>
			</div>

	<?php if ( in_category( 'seminars' ) && get_field('showform')) { ?>
			<form class="b-form _clearfix _padding-top _border-bottom js-validate" method="post" action="../wp-content/themes/whiterussian/form_seminar.php">
				<div class="b-form__title"><?php the_field('formhead');?></div>

				<div class="b-form__col _left">
					<div class="b-form__field">
						<h3 class="b-form__subtitle">Информация о компании</h3>
						<input class="b-form__text-input" name="company" type="text" placeholder="Имя">
					</div>

					<div class="b-form__field">
						<h3 class="b-form__subtitle _spec">Специализация компании</h3>
						<div><label><input type="radio" name="spec" value="Конечный пользователь"> Конечный пользователь</label></div>
						<div><label><input type="radio" name="spec" value="Производитель оборудования"> Производитель оборудования</label></div>
						<div><label><input type="radio" name="spec" value="Инжиниринговая компания"> Инжиниринговая компания</label></div>
						<div><label><input type="radio" name="spec" value="Торгующая организация"> Торгующая организация</label></div>
					</div>


				</div>


				<div class="b-form__col _right">
					<h3 class="b-form__subtitle">Контактное лицо</h3>
					<div class="b-form__field">
						<input class="b-form__text-input" name="username" type="text" placeholder="ФИО*" required>
					</div>

					<div class="b-form__field">
						<input class="b-form__text-input" name="job" type="text" placeholder="Должность*" required>
					</div>

					<div class="b-form__field">
						<input class="b-form__text-input" name="phone" type="tel" placeholder="Телефон*" required>
					</div>

					<div class="b-form__field">
						<input class="b-form__text-input" name="email" type="email" placeholder="E-mail*" required>
					</div>
				</div>


				<div class="_clearfix"></div>


				<div class="b-form__col _left">
					<div class="b-form__field">
						<input class="b-form__text-input" name="website" type="text" placeholder="Веб-сайт">
					</div>

					<div class="b-form__field">
						<input class="b-form__text-input" name="city" type="text" placeholder="Город*" required>
					</div>

					<div class="b-form__field">
						<input class="b-button b-seminar__button" type="submit" value="Отправить заявку">
					</div>
				</div>


				<div class="b-form__col _right">
					<div class="b-form__field">
						<textarea class="b-form__text-input _message" name="message" placeholder="Сообщение"></textarea>
					</div>
				</div>

			</form>

</article>
			<br/>
			<div class="_clearfix b-prev-next">
<?php previous_post_link('%link', '<div class="b-button _float-left roll">‹―&nbsp;Предыдущее&nbsp;событие</div>', true); ?>
<?php next_post_link('%link', '<div class="b-button _float-right roll">Следующее&nbsp;событие&nbsp;―›</div>', true); ?>
			</div>

		<?php } elseif ( in_category( 'news' ) ) { ?>
			<br/>
			<div class="_clearfix b-prev-next">
<?php previous_post_link('%link', '<div class="b-button _float-left roll">‹―&nbsp;Предыдущая&nbsp;новость</div>', true); ?>
<?php next_post_link('%link', '<div class="b-button _float-right roll">Следующая&nbsp;новость&nbsp;―›</div>', true); ?>
			</div>

		<?php } elseif ( in_category( 'aktsii' ) ) { ?>
			<br/>
			<div class="_clearfix b-prev-next">
<?php previous_post_link('%link', '<div class="b-button _float-left roll">‹―&nbsp;Предыдущая&nbsp;акция</div>', true); ?>
<?php next_post_link('%link', '<div class="b-button _float-right roll">Следующая&nbsp;акция&nbsp;―›</div>', true); ?>
			</div>


		<?php } ?>
		</div>

<?php endwhile; ?>
	</div>
<?php get_footer(); ?>