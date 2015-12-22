<?php
/**
 * Template Name: Выдача
 */
?>
<!-- t: filter -->
<?php get_header(); ?>
	<div class="b-max-width">
		<div class="b-content">
					<a class="b-content__go-back" onclick="history.back();">‹― Назад</a>
			<div class="b-content__text">
			<h1>Результаты поиска</h1>
<?php global $wpdb; 
$brs =  preg_replace('/^(.*?)$/', "'$1'", $_POST['filter_brand']); 
$char = $_POST['inner_character'];
$new_brs = str_replace("'", "", $brs);
if (!$new_brs[0]){
	$brs = $new_brs;
    $brs[0] = "'omron'";
    $brs[1] = "'schneider-electric'";
    $brs[2] = "'yaskawa'";
    $brs[3] = "'optex-fa'";
    $brs[4] = "'tr-electronic'";
    $brs[5] = "'cognex'";
    $brs[6] = "'siemens'";
}
$i = 0;
foreach ($char as $char_item){
   // $ids[$i] = get_term_by('name',$char_item,'type')->term_id;
    $ids[$i] = $char_item;
    $i++;
}
$brs = implode(",", $brs);
$sql = "SELECT post_title,post_content,post_excerpt,post_name,ID,guid FROM $wpdb->posts as p 
INNER JOIN $wpdb->term_relationships as rl
                ON rl.object_id = p.ID
                INNER JOIN $wpdb->term_taxonomy as tax
                ON rl.term_taxonomy_id = tax.term_taxonomy_id
                WHERE p.post_type IN ($brs)"; 
//foreach ($char as $kids){ $sql .= " AND tax.term_taxonomy_id = '$kids[0]'";} 
//if (!$char){
//	$gen = $_POST['general_rubric'];
//	$sql .= " AND tax.term_taxonomy_id = '$gen'";
//}
                if (!$ids){
                	$gen = $_POST['general_rubric'];
					$sql .= " AND tax.term_taxonomy_id = '$gen'"; 
				}
                else{
                	$ki = 0;
					foreach ($ids as $kids){ 
						if ($ki == 0)
						{
							$sql .= " AND tax.term_taxonomy_id = '$kids[0]'";
						} 
						else{
							$sql .= " OR tax.term_taxonomy_id = '$kids[0]'"; 
						}
						$ki++;
					} 
					$count = sizeof($ids);
					$sql .= " GROUP BY ID HAVING count(*) = $count";  
				}         
			
$result = $wpdb->get_results($sql);  ?>
<ul class="b-list__list servicelist">
<?php // location.href = '$urlenich' 
?>
<?php if ($result){ ?>
<?php 
	if (count($result) == 1){
		$urlenich = get_bloginfo('url');
		$urlenich .= "/";
		$urlenich .= $result[0]->post_name;
		echo "<script type='text/javascript'>
			location.href = '$urlenich'
      </script>";
	}
	$option_sql = "SELECT option_value FROM $wpdb->options WHERE option_name = 'sticky_posts'";
	$result_options = $wpdb->get_results($option_sql);
	$start_str = $result_options[0]->option_value;
	$new_ar = explode('{',$start_str);
	$new_arr = explode('}', $new_ar[1]);
	$arros = explode(';',$new_arr[0]);
	$i = 0;
	foreach ($arros as $arros_item) {
		$arros_item = str_replace('i:', '', $arros_item);
		$arch[$i] = $arros_item;
		$i ++;
	}
?>
<?php foreach ($result as $result_item) {
	$key = array_search($result_item->ID, $arch);
	if ($key){ ?>
		<li>	
		<?php $Featured_image = $wpdb->get_results("
	    SELECT p.*
	      FROM $wpdb->postmeta AS pm
	     INNER JOIN $wpdb->posts AS p ON pm.meta_value=p.ID 
	     WHERE pm.post_id = $result_item->ID
	       AND pm.meta_key = '_thumbnail_id' 
	",'ARRAY_A'); ?>
						<div class="b-list__item-img-wrapper">
							<a href="<?php bloginfo('url');echo "/";echo $result_item->post_name; ?>"><img src="<?php if ($Featured_image[0]['guid']){ echo $Featured_image[0]['guid']; } else { bloginfo('url');echo "/";echo "wp-content/uploads/2015/rakurs_logo.png"; ?>" <?php }?>" class="attachment-thumbnail wp-post-image" style="max-height:150px;" alt="TL-W"></a>
						</div>
						<div class="b-list__item-text"><a href="<?php bloginfo('url');echo "/";echo $result_item->post_name; ?>" class="b-list__item-title"><?php echo $result_item->post_title;  ?></a><br/>
	<p><?php if ($result_item->post_excerpt) { echo $result_item->post_excerpt; } else {echo  wp_trim_words( $result_item->post_content, 30 );}  ?></p></div>
						<div class="b-list__read-more-wrapper"><a href="<?php bloginfo('url');echo "/";echo $result_item->post_name; ?>" class="b-list__read-more-link">Подробнее ›</a></div>		
		</li>
	<?php } 
}
?>
<?php foreach( $result as $result_item){  
	$key = array_search($result_item->ID, $arch); 
	if (!$key) {?>
	<li>	
					<?php $Featured_image = $wpdb->get_results("
    SELECT p.*
      FROM $wpdb->postmeta AS pm
     INNER JOIN $wpdb->posts AS p ON pm.meta_value=p.ID 
     WHERE pm.post_id = $result_item->ID
       AND pm.meta_key = '_thumbnail_id' 
",'ARRAY_A'); ?>
					<div class="b-list__item-img-wrapper">
						<a href="<?php bloginfo('url');echo "/";echo $result_item->post_name; ?>"><img src="<?php if ($Featured_image[0]['guid']){ echo $Featured_image[0]['guid']; } else { bloginfo('url');echo "/";echo "wp-content/uploads/2015/rakurs_logo.png"; ?>" <?php }?>" class="attachment-thumbnail wp-post-image" style="max-height:150px;" alt="TL-W"></a>
					</div>
					<div class="b-list__item-text"><a href="<?php bloginfo('url');echo "/";echo $result_item->post_name; ?>" class="b-list__item-title"><?php echo $result_item->post_title;  ?></a><br/>
<p><?php if ($result_item->post_excerpt) { echo $result_item->post_excerpt; } else {echo  wp_trim_words( $result_item->post_content, 30 );} ?></p></div>
					<div class="b-list__read-more-wrapper"><a href="<?php bloginfo('url');echo "/";echo $result_item->post_name; ?>" class="b-list__read-more-link">Подробнее ›</a></div>		
	</li>
	<?php }} ?>
	<?php }  else { ?>
    <h2>По вашему запросу ничего не найдено</h2>
    <?php } ?>
</ul>
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
			</div>
			<div class="b-pager supapagi">
				<ul>
				</ul>
			</div>
		</div>
  </div>

<?php get_footer(); ?>
<?php if (!$result){
    return NULL;
}
?>