<?php
/*
* Search results page
*/
?>
<!-- t: search -->
<?php get_header(); ?>
<?php
    $translit = array(
   
            'а' => 'a',   'б' => 'b',   'в' => 'v',
  
            'г' => 'g',   'д' => 'd',   'е' => 'e',
  
            'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',
  
            'и' => 'i',   'й' => 'j',   'к' => 'k',
  
            'л' => 'l',   'м' => 'm',   'н' => 'n',
  
            'о' => 'o',   'п' => 'p',   'р' => 'r',
  
            'с' => 's',   'т' => 't',   'у' => 'u',
  
            'ф' => 'f',   'х' => 'x',   'ц' => 'c',
  
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',
  
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'\'',
  
            'э' => 'e\'',   'ю' => 'yu',  'я' => 'ya',
          
  
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
  
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
  
            'Ё' => 'YO',   'Ж' => 'Zh',  'З' => 'Z',
  
            'И' => 'I',   'Й' => 'J',   'К' => 'K',
  
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
  
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
  
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
  
            'Ф' => 'F',   'Х' => 'X',   'Ц' => 'C',
  
            'Ч' => 'CH',  'Ш' => 'SH',  'Щ' => 'SHH',
  
            'Ь' => '\'',  'Ы' => 'Y\'',   'Ъ' => '\'\'',
  
            'Э' => 'E\'',   'Ю' => 'YU',  'Я' => 'YA',
  
        );
?>
	<div class="b-max-width">
		<div class="b-content">
					<a class="b-content__go-back" onclick="history.back();">‹― Назад</a>
			<div class="b-content__text">
			<?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
			if (($_GET['post_type'] != 'any') && ($_GET['post_type'] != 'solutions')){
				//$po = 'array('.$_GET['post_type'].')'";
				$po = stripcslashes($_GET['post_type']);
				$po = explode(',', $po);
				$i = 0;
				foreach ($po as $po_item) {
					$po[$i] = "'$po[$i]'";
					$i++;
				}
				$po = implode(',', $po);
				$po = 'array('.$po.')';
				$ho = "'post_type'=>$po";
				$search = new WP_Query(array('s' => get_search_query(),'post_type'=>array('omron','schenider-electric','yaskawa','siemens','tr-electronic','cognex','optex-fa'), 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1,/*'paged' => $paged,*/'post__in'=>get_option('sticky_posts')));
				$not_st = 10 - $search->found_posts;
				$last_search = new WP_Query(array('s' => get_search_query(),'post_type'=>array('omron','schenider-electric','yaskawa','siemens','tr-electronic','cognex','optex-fa'), 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1',/* 'paged' => $paged,*/'post__not_in'=>get_option('sticky_posts')));
			    $word = strtr(get_search_query(), $translit); // транслитерация. Переменная $word получит значение 'prochee'
			    $not_st_new = $not_st - $last_search->found_posts;
			    $search_new = new WP_Query(array('s' => $word,'post_type'=>array('omron','schenider-electric','yaskawa','siemens','tr-electronic','cognex','optex-fa'), 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' =>'-1',/*'paged' => $paged,*/'post__in'=>get_option('sticky_posts')));
				$not_st_new_new = $not_st_new - $search_new->found_posts;
				$last_search_new = new WP_Query(array('s' => $word,'post_type'=>array('omron','schenider-electric','yaskawa','siemens','tr-electronic','cognex','optex-fa'), 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1',/* 'paged' => $paged,*/'post__not_in'=>get_option('sticky_posts')));
				$first_ar = new WP_Query();
				$first_ar->posts = array_merge($search->posts,$search_new->posts);
				$first_ar->post_count = $search->post_count+$search_new->post_count;
				$second_ar = new WP_Query();
				$second_ar->posts = array_merge($last_search->posts,$last_search_new->posts);
				$second_ar->post_count = $last_search->post_count+$last_search_new->post_count;
				$all_ar = new WP_Query();
				$all_ar->posts = array_merge($first_ar->posts,$second_ar->posts);
				$all_ar->post_count = $first_ar->post_count+$second_ar->post_count;
				$all_ar->posts = array_unique($all_ar->posts, SORT_REGULAR);
			}
			else{
				$search = new WP_Query(array('s' => get_search_query(),'post_type'=>$_GET['post_type'], 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1,/*'paged' => $paged,*/'post__in'=>get_option('sticky_posts')));
				$not_st = 10 - $search->found_posts;
				$last_search = new WP_Query(array('s' => get_search_query(),'post_type'=>$_GET['post_type'], 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, /*'paged' => $paged,*/'post__not_in'=>get_option('sticky_posts')));
				$word = strtr(get_search_query(), $translit); // транслитерация. Переменная $word получит значение 'prochee'
				$not_st_new = $not_st - $last_search->found_posts;
				$search_new = new WP_Query(array('s' => $word,'post_type'=>$_GET['post_type'], 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1,/*'paged' => $paged,*/'post__in'=>get_option('sticky_posts')));
				$not_st_new_new = $not_st_new-$search_new->found_posts;
				$last_search_new = new WP_Query(array('s' => $word,'post_type'=>$_GET['post_type'], 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1',/* 'paged' => $paged,*/'post__not_in'=>get_option('sticky_posts')));
				$first_ar = new WP_Query();
				$first_ar->posts = array_merge($search->posts,$search_new->posts);
				$first_ar->post_count = $search->post_count+$search_new->post_count;
				$second_ar = new WP_Query();
				$second_ar->posts = array_merge($last_search->posts,$last_search_new->posts);
				$second_ar->post_count = $last_search->post_count+$last_search_new->post_count;
				$all_ar = new WP_Query();
				$all_ar->posts = array_merge($first_ar->posts,$second_ar->posts);
				$all_ar->post_count = $first_ar->post_count+$second_ar->post_count;
				$all_ar->posts = array_unique($all_ar->posts, SORT_REGULAR);		
			}

  ?>
			
<ul class="b-list__list servicelist">
<form class="b-content-search" action="<?php bloginfo('url');?>" method="GET">
				<input class="b-content-search__what" name="s" id="s" type="text" placeholder="<?php echo get_search_query(); ?>" value="<?php echo get_search_query(); ?>">

				<div class="b-content-search__where">
					<?php 
					$options = array('any'=>'Весь сайт','omron,schenider-electric,yaskawa,siemens,tr-electronic,cognex,optex-fa' => 'Продукция','solutions'=>'Решения');
					$selected = $_GET['post_type']; ?>
					<select class="js-selectboxit" name="post_type">
						<?php
						foreach ($options as $key => $value) {
						?>
							<option <?php if ($key == $_GET['post_type']) {  echo "selected='selected'"; } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
						<?php
						}
						?>
					</select>
				</div>

				<input class="b-content-search__submit b-button _invert" type="submit" value="Искать">

			</form>
<?php if (($last_search->have_posts()) || ($search->have_posts()) || ($last_search_new->have_posts()) || ($search_new->have_posts())): 
?>
<?php while ( $all_ar->have_posts() ) :$all_ar->the_post(); ?>
	<?php $kk = get_the_title(get_the_ID()); if ($kk) { ?>
	<li <?php post_class();?>>
					<div class="b-list__item-img-wrapper">
					<a href="<?php esc_url( the_permalink() ); ?>"><?php if (has_post_thumbnail()){ the_post_thumbnail('crop_thumb');} else{?> <img src="http://rakurs.8stein.ru/wp-content/uploads/2015/rakurs_logo.png"> <?php  } ?></a>
					</div>
					
					<div class="b-list__item-text"><a href="<?php esc_url( the_permalink() ); ?>" class="b-list__item-title"><?php the_title(); ?><?php echo " (";$pst = get_post_type(); $psti = get_post_type_object($pst);print_r($psti->labels->name);echo ")"; ?></a><?php the_excerpt(); ?></div>
					<div class="b-list__read-more-wrapper"><a href="<?php esc_url( the_permalink() ); ?>" class="b-list__read-more-link">Подробнее ›</a></div>		
	</li>
	<?php } else { continue; } ?>
<?php endwhile; ?>
</ul>
<?php else: ?>
<h2>По запросу '<?php echo get_search_query(); ?>' результатов не найдено</h2>
<?php endif; ?>
			</div>
			<?php if (($last_search->have_posts()) || ($search->have_posts())){ ?>
			<?php //wr_pagenavi(); 
			?>
			<?php } ?>
			<div class="b-pager supapagi">
				<ul>
				</ul>
			</div>
		</div>
  </div>
<script>
	$(document).ready(function(){
		var schet = 0;
		$('ul.servicelist li').each(function(){
			if (schet < 10)
				$(this).css('display','block');
			else{
				$(this).css('display','none');
			}
			++schet;
		});
		var k = 0;
		var kd = 1;
		$('ul.servicelist li').each(function(){
			if (k == 11){
				var str = "<li><a>"+kd+"</a></li>";
				$('.supapagi ul').append(str);
				if (kd == 1){
					$('.supapagi ul li a').addClass('current');
				}
				++kd;
				k = k - 10;
			}
			++k;
		});
		if (($('.supapagi ul').has('li').length) && (k != '0')){
			console.log($('ul.servicelist').has('li').length);
			var stri = "<li><a>"+kd+"</a></li>";
			$('.supapagi ul').append(stri);
		} 
		$('.supapagi ul li a').on('click',function(){
			var iter = $(this).html();
			$(this).parent().parent().find('a').removeClass('current');
			$(this).addClass('current');
			var till = iter*10 - 1;
			var from = till - 9;
			console.log(from);
			console.log(till);
			var schetochka = 0;
			$(document).scrollTop('0');
			$('ul.servicelist li').each(function(){
				if ((schetochka <= till) && (schetochka >= from))
				$(this).css('display','block');
			else{
				$(this).css('display','none');
			}
			++schetochka;	
			});
		});
	});
</script>
<style>
	.supapagi a{
		cursor:pointer;
	}
	.supapagi a.current{
		cursor: none;
		color: black;
	}
</style>
<?php get_footer(); ?>