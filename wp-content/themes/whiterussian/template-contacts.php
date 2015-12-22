<?php
/**
 * Template Name: Contacts
 */
?>
<!-- t: template-contacts -->
<?php get_header(); ?>
	<div class="b-max-width">
		<p id="breadcrumbs"><a href="/">Главная</a> » <span>Контакты</span></p>
		<div class="b-content _no-sidebar _padding-bottom _clearfix">
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="b-warehouse__map">
				<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=CTe98fPQVZLiFHhKfKFKdwelsQyJMWsk&width=500&height=370"></script>
			</div>
			<?php the_title('<h1>', '</h1>'); ?>
			<div class="b-contacts">
			<?php the_content(); ?>
			</div>
			<div class="b-download__wrapper">
				<?php if (get_field('download')) { ;?><a class="b-download" href="<?php the_field('download');?>" onclick="yaCounter5227012.reachGoal('rekvizity'); return true;">Скачать реквизиты</a><?php };?>
			</div>


			<form class="b-form _clearfix _padding-top js-validate" method="post" enctype="multipart/form-data" data-action="../wp-content/themes/whiterussian/form.php" action="../wp-content/themes/whiterussian/form.php">
				<div class="b-form__title">Напишите нам:</div>

				<div class="b-form__col _left">
					<div class="b-form__field">
						<input class="b-form__text-input" name="username" type="text" placeholder="Имя*" required>
					</div>
					
					<div class="b-form__field">
						<input class="b-form__text-input" name="email" type="email" placeholder="E-mail">
					</div>
					
					<div class="b-form__field">
						<input class="b-form__text-input" name="phone" type="tel" placeholder="Телефон">
					</div>
					
					<div class="b-form__field">
						<div class="b-form__text-input _fake">Прикрепить документ</div>
						<input class="b-form__text-input _doc" name="doc" type="file">
					</div>
				</div>

				<div class="b-form__col _right">
					<div class="b-form__field">
						<input  class="b-form__text-input" name="topic" type="text" placeholder="Тема">
					</div>

					<div class="b-form__field">
						<textarea class="b-form__text-input _message" name="message" placeholder="Сообщение*" required></textarea>
					</div>

					<div class="b-form__field">
						<input class="b-button" type="submit" value="Отправить" onclick="yaCounter5227012.reachGoal('write-Me'); return true;">
					</div>
				</div>

			</form>


		</div>
	</div>
		<?php endwhile; ?>
		</div>
	</div>

<?php get_footer(); ?>