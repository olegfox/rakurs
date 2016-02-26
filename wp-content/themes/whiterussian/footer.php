        <!-- t: footer -->
      </div><!-- /wrapper -->

      <footer class="b-f">
        <div class="b-max-width">
          <ul class="b-f__link-group-list">
            <li class="b-f__link-group-item">
              <?php
                $popupmenu = array('theme_location' => 'about', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,);
                print strip_tags( wp_nav_menu($popupmenu ), '<a>');
              ?>
            </li>
            <li class="b-f__link-group-item">
              <?php
                $popupmenu = array('theme_location' => 'products', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,);
                print strip_tags( wp_nav_menu($popupmenu ), '<a>');
              ?>
            </li>
            <li class="b-f__link-group-item">
              <?php
                $popupmenu = array('theme_location' => 'solutions', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,);
                print strip_tags( wp_nav_menu($popupmenu ), '<a>');
              ?>
            </li>
            <li class="b-f__link-group-item">
              <?php
                $popupmenu = array('theme_location' => 'services', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,);
                print strip_tags( wp_nav_menu($popupmenu ), '<a>');
              ?>
            </li>
            <li class="b-f__link-group-item">
              <?php
                $popupmenu = array('theme_location' => 'news', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,);
                print strip_tags( wp_nav_menu($popupmenu ), '<a>');
              ?>
            </li>
            <li class="b-f__link-group-item _small">
              <?php
                $popupmenu = array('theme_location' => 'ware', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,);
                print strip_tags( wp_nav_menu($popupmenu ), '<a>');
              ?>
            </li>
            <li class="b-f__link-group-item _small">
              <?php
                $popupmenu = array('theme_location' => 'contacts', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,);
                print strip_tags( wp_nav_menu($popupmenu ), '<a>');
              ?>
            </li>
          </ul>
          <div class="b-f__contact">
            <?php echo ot_get_option( 'contacts'); ?>
          </div>
        </div>
      </footer>

    </div><!-- /md-other md-other-deep -->


    <div id="modals_container" class="b-modals md-overlay" style="display:none">

      <section id="modal_order" class="b-modal md-modal _order md-effect-11">

        <a data-modal-hide="#modal_order" class="b-modal__close md-close" href="#" title="Закрыть"></a>

        <div class="b-modal__title">
          Если Вы хотите заказать оборудование, пожалуйста, оставьте свою заявку, заполнив форму ниже.
        </div>


        <form class="b-form _popup _clearfix js-validate" method="post" data-action="/wp-content/themes/whiterussian/form_callback.php" data-goal="zakaz-ok">

          <div class="b-form__col _left">
            <h3 class="b-form__subtitle">Контактное лицо</h3>
            <div class="b-form__field">
              <input class="b-form__text-input" name="username" type="text" placeholder="ФИО*" required>
            </div>

            <div class="b-form__field">
              <input class="b-form__text-input" name="job" type="text" placeholder="Должность*" required>
            </div>

            <div class="b-form__field">
              <input class="b-form__text-input" name="company" type="text" placeholder="Компания*" required>
            </div>
          </div>

          <div class="b-form__col _right">
            <div class="b-form__field">
              <h3 class="b-form__subtitle">Интересующий вас бренд:</h3>
              <?php $omron = ot_get_option('is_omron'); if ($omron[0] == 'true'){ ?>
              <div><input id="c_1" type="checkbox" name="brand[]" value="Omron"><label for="c_1"> Omron</label></div><?php } ?>
              <?php $tr_electronic = ot_get_option('is_tr_electronic'); if ($tr_electronic[0] == 'true'){ ?>
              <div><input id="c_2" type="checkbox" name="brand[]" value="TRelectronic"><label for="c_2"> TR-electronic</label></div><?php } ?>
              <?php $siemens = ot_get_option('is_siemens'); if ($siemens[0] == 'true'){ ?>
              <div><input id="c_3" type="checkbox" name="brand[]" value="Siemens"><label for="c_3"> Siemens</label></div><?php } ?>
              <?php $yaskawa = ot_get_option('is_yaskawa'); if ($yaskawa[0] == 'true'){ ?>
              <div><input id="c_4" type="checkbox" name="brand[]" value="Yaskawa"><label for="c_4"> Yaskawa</label></div><?php } ?>
              <?php $schneider_electric = ot_get_option('is_schneider_electric'); if ($schneider_electric[0] == 'true'){ ?>
              <div><input id="c_5" type="checkbox" name="brand[]" value="Schneider"><label for="c_5"> Schneider</label></div><?php } ?>
              <?php $cognex = ot_get_option('is_cognex'); if ($cognex[0] == 'true'){ ?>
              <div><input id="c_6" type="checkbox" name="brand[]" value="Cognex"><label for="c_6"> Cognex</label></div><?php } ?>
              <?php $optex_fa = ot_get_option('is_optex_fa'); if ($optex_fa[0] == 'true'){ ?>
              <div><input id="c_7" type="checkbox" name="brand[]" value="Optex-FA"><label for="c_7"> Optex-FA</label></div><?php } ?>
              <div><input id="c_8" type="checkbox" name="brand[]" value="Все бренды"><label for="c_8"> Все бренды</label></div>
            </div>
          </div>
          
          <div class="_clearfix"></div>
          
          <div class="b-form__col _left">
            <div class="b-form__field">
              <input class="b-form__text-input" name="phone" type="tel" placeholder="Телефон*" required>
            </div>
            <div class="b-form__field">
              <input class="b-form__text-input" name="email" type="email" placeholder="E-mail*" required>
            </div>
          </div>
          
          <div class="b-form__col _right">
            <div class="b-form__field">
              <textarea class="b-form__text-input _message" name="message" placeholder="Сообщение"></textarea>
            </div>
          </div>
          
          <div class="_clearfix" style="margin-bottom:5px"></div>
          
          <div class="b-form__col _left">
            <label>
              <input type="checkbox" name="spec" required>
              <span>Я ознакомлен и согласен с <a style="color:white;text-decoration: underline;" href="/soglashenie-o-konfidentsialnosti" target="_blank">соглашением о конфиденциальности</a></span>
            </label>
          </div>
          
          <div class="b-form__col _right">
            <div class="b-form__field">
              <button type="submit" class="b-button b-seminar__button _no-roll">Отправить заявку</button>
            </div>
          </div>

        </form>

      </section>

      <section id="modal_order2" class="b-modal md-modal _order md-effect-11">

        <a data-modal-hide="#modal_order2" class="b-modal__close md-close" href="#" title="Закрыть"></a>

        <div class="b-modal__title">
          Подписаться на рассылку
        </div>

        <form class="b-form _popup _clearfix js-validate" method="post" data-action="/wp-content/themes/whiterussian/form_callback_new.php" onsubmit="yaCounter5227012.reachGoal('rassilka-OK'); return true;">

          <div class="b-form__col _left">
            <h3 class="b-form__subtitle">Контактное лицо</h3>
            <div class="b-form__field">
              <input class="b-form__text-input" name="username" type="text" placeholder="ФИО*" required>
            </div>
          </div>
          <div class="b-form__col _right">
            <div class="b-form__field">
              <h3 class="b-form__subtitle">Интересующий вас бренд:</h3>
              <?php $omron = ot_get_option('is_omron'); if ($omron[0] == 'true'){ ?>
              <div><input id="c_1" type="checkbox" name="brand[]" value="Omron"><label for="c_1"> Omron</label></div><?php } ?>
              <?php $tr_electronic = ot_get_option('is_tr_electronic'); if ($tr_electronic[0] == 'true'){ ?>
              <div><input id="c_2" type="checkbox" name="brand[]" value="Relectronic"><label for="c_2"> TR-electronic</label></div><?php } ?>
              <?php $siemens = ot_get_option('is_siemens'); if ($siemens[0] == 'true'){ ?>
              <div><input id="c_3" type="checkbox" name="brand[]" value="Siemens"><label for="c_3"> Siemens</label></div><?php } ?>
              <?php $yaskawa = ot_get_option('is_yaskawa'); if ($yaskawa[0] == 'true'){ ?>
              <div><input id="c_4" type="checkbox" name="brand[]" value="Yaskawa"><label for="c_4"> Yaskawa</label></div><?php } ?>
              <?php $schneider_electric = ot_get_option('is_schneider_electric'); if ($schneider_electric[0] == 'true'){ ?>
              <div><input id="c_5" type="checkbox" name="brand[]" value="Schneider"><label for="c_5"> Schneider</label></div><?php } ?>
              <?php $cognex = ot_get_option('is_cognex'); if ($cognex[0] == 'true'){ ?>
              <div><input id="c_6" type="checkbox" name="brand[]" value="Cognex"><label for="c_6"> Cognex</label></div><?php } ?>
              <?php $optex_fa = ot_get_option('is_optex_fa'); if ($optex_fa[0] == 'true'){ ?>
              <div><input id="c_7" type="checkbox" name="brand[]" value="Optex-FA"><label for="c_7"> Optex-FA</label></div><?php } ?>
              <div><input id="c_8" type="checkbox" name="brand[]" value="Все бренды"><label for="c_8"> Все бренды</label></div>
            </div>
          </div>
          <div class="b-form__col _left">
            <div class="b-form__field">
              <input class="b-form__text-input" name="email" type="email" placeholder="E-mail*" required>
            </div>
          </div>
          <div class="_clearfix" style="margin-bottom:5px"></div>
          <div class="b-form__col _left">
            <label>
              <input type="checkbox" name="spec" required>
              <span>Я ознакомлен и согласен с <a style="color:white;text-decoration: underline;" href="/soglashenie-o-konfidentsialnosti" target="_blank">соглашением о конфиденциальности</a></span>
            </label>
          </div>
          <div class="b-form__col _right">
            <div class="b-form__field">
              <button type="submit" class="b-button  _no-roll">Подписаться на рассылку</button>
            </div>
          </div>

        </form>

      </section>

    </div><!--/#modals_container -->
  
  </div><!-- /.md-perspective -->

<div class="overlay">
	<?php $i =0; ?>
	<?php query_posts(array('post_type'=>'reviews','post_status'=>'publish','posts_per_page'=>'-1')); ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="modal" id="<?php echo 'modal'; echo $i; ?>">
		<div class="close"></div>
		<?php $k = get_field('img_review');?>
		<img src="<?php echo $k['url']; ?>">
		<?php $i++; ?>
	</div>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
</div>
<script>
	$('.review_item').on('click',function(){
		var
      k = $(this).find('.read_more').attr('id');
    var
      w,
      h;
      
		$('.overlay').css('display','block');
		k = 'div#' + k;
    w = $(k).find('img').css('width');
     h = $(k).find('img').css('height');
     
		$(k).css('display','block');	
		$(k).css('width',w);
		$(k).css('height',h);
		//console.log(k);
	});
  
	$('.close').on('click',function(){
    var
      k;
    $(this).parent().css('display','none');
    $('.overlay').css('display','none');
    k = 'div#' + k;
    $(k).css('display','block');
  });
  
  $(document).on('click',function(e){
	  if ($('.overlay').is(e.target)) {
      $('.modal').css('display','none');
      $('.overlay').css('display','none');
	  }
  });
  
  $('.b-content-search').on('submit',function(){
    if ($(this).find('input[type=text]').val().length >= 3) {

    } else {
    	return false;
    }
   });
   
   $('#header_search_form').on('submit',function(){
    if ($(this).find('input[type=text]').val().length >= 3) {

    } else {
    	return false;
    }
   });
  
  $('.b-side-news__list li:nth-child(n+4)').css('display','none');
</script>
  
  <?php echo ot_get_option( 'analytics'); ?>
	<?php wp_footer(); ?>

	<a href="#" class="b-goto-top">Наверх</a>

</body>
</html>