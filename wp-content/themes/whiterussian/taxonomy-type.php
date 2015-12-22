<?php
/**
 * Template Name: Поиск по категории
 */
?>
<!-- t: taxonomy-type -->
<?php get_header(); ?>
      <?php
      global $wpdb;
      $cat_name = single_term_title('',0);
      $term = get_term_by( 'name', $cat_name, 'type' );
      $cats = get_categories('parent='.$term->term_taxonomy_id.'&taxonomy=type');
      $type_id = $term->term_id;
      $actual_link = $_GET['post_type'];
      if (!$actual_link){
          $sql = "SELECT tax.term_id  FROM $wpdb->term_taxonomy as tax
                LEFT JOIN $wpdb->term_relationships as rl
                ON rl.term_taxonomy_id = tax.term_taxonomy_id
                RIGHT JOIN $wpdb->posts as p
                ON rl.object_id = p.ID
                WHERE tax.taxonomy = 'type' AND p.post_type IN ('omron','schneider-electric','yaskawa','siemens','cognex','tr-electronic') AND tax.count > 0 AND tax.parent = '$term->term_id'";
      }
      else{
          $sql = "SELECT tax.term_id  FROM $wpdb->term_taxonomy as tax
                LEFT JOIN $wpdb->term_relationships as rl
                ON rl.term_taxonomy_id = tax.term_taxonomy_id
                RIGHT JOIN $wpdb->posts as p
                ON rl.object_id = p.ID
                WHERE tax.taxonomy = 'type' AND p.post_type = '$actual_link' AND tax.count > 0 AND tax.parent = '$term->term_id'";
      }
      //print_r($sql);
$result = $wpdb->get_results($sql);
$i = 0;
foreach ($result as $new_item){
    $new_result[$i] = $new_item->term_id;
    $i++;
}
$new_result = array_unique($new_result);
?>
<?php
  $sql_new = "SELECT p.post_type,tax.term_taxonomy_id FROM $wpdb->posts as p
                                          RIGHT JOIN $wpdb->term_relationships as rl
                                          ON rl.object_id = p.ID
                                          LEFT JOIN $wpdb->term_taxonomy as tax
                                          ON rl.term_taxonomy_id = tax.term_taxonomy_id
                                          WHERE tax.taxonomy = 'type' AND p.post_type NOT IN ('page','post','acf','solutions','goods') ";
                                          $result_new = $wpdb->get_results($sql_new);
                                         /* foreach ($result_new as $result_new_item){
                                              $wow = get_term_by('id',$result_new_item->term_taxonomy_id,'type');
                                              $result_new_item-> = $wow->id;
                                          } */
                                          ?>
  <div class="b-max-width">
    <p id="breadcrumbs"><a href="/">Главная</a> » <?php if ($_GET['post_type']){ $p_t = get_post_type_object($_GET['post_type']); echo '<a href="/">'.$p_t->labels->name.'</a> » '; }?><span><?php single_term_title();$url = home_url(); ?></span></p>
    <?php get_template_part( 'part_brand_old' ); ?>
        <div class="b-content _padding-top _padding-bottom _left-sidebar">
      <h1><?php single_term_title();$url = home_url(); ?></h1>
   <?php if ($_GET['post_type']){ ?>
                 <?php  } else { ?>

      <div class="search_description">Выберите категорию и параметры, по которым хотите осуществить поиск.<br/>
Для отмены выбора нажмите второй раз на выделенный параметр или воспользуйтесь кнопкой "Сбросить". <br/>
Для просмотра результатов нажмите кнопку "Перейти к результатам".</div>
<?php } ?>
        <div class="b-cat type3">
        <?php $i = 0;
        asort($new_result);
        $n = 0;
    foreach ($new_result as $item) {
      $cur_term_iter = get_term_by( 'id', $item, 'type' );
      $final_res[$n]->term_order = $cur_term_iter->term_order;
      $final_res[$n]->term_id = $item;
      $n++;
    }
        function cmp($a, $b)
        {
            //return strcmp($a->term_order, $b->term_order);
            /*if((int)$a->term_order == (int)$b->term_order)return 0;
            if((int)$a->term_order  > (int)$b->term_order)return 1;
            if((int)$a->term_order  < (int)$b->term_order)return -1;*/
            return (int)$a->term_order-(int)$b->term_order;
        }
        usort($final_res, "cmp");
        for ($m =0; $m < sizeof($new_result); $m++){
          $new_result_res[$m] = $final_res[$m]->term_id;
        }
   foreach ($new_result_res as $item){ ?>
        <?php $cur_term = get_term_by( 'id', $item, 'type' ); ?>
                  <div class="b-cat__subcat">
            <div class="b-cat__subcat-toggle" href="#" data-toggle="#subcat<?php echo $i; ?>"><?php echo $cur_term->name; ?></div>
             <form id="filter_form" action="<?php echo $url;?>/vydacha" method="POST">
             <input type="hidden" name="general_rubric" value="<?php echo $cur_term->term_id; ?>">
              <?php if ($_GET['post_type']){ ?>
              <div id="subcat<?php echo $i; ?>" style="display:none;" class="b-cat__subcat-contents _with-border">
                <ul class="b-list__list _no-pad">
                <?php print_r($catt); ?>
                <?php  query_posts(array('post_type' => $_GET['post_type'],'post__in'=>get_option('sticky_posts'),'tax_query' => array(
                                    array(
                                      'taxonomy' => 'type',
                                      'field'    => 'slug',
                                      'terms'    => $cur_term->slug,
                                    )),	'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1'));
                                if (have_posts()) : while (have_posts()) :the_post();  ?>
                <li class="b-list__item">
                  <div class="b-list__item-img-wrapper"><a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()){ the_post_thumbnail('crop_thumb');} else{ ?><img src="<?php bloginfo('url');echo "/";echo "wp-content/uploads/2015/rakurs_logo.png";?>"> <?php } ?></a></div>
                  <div class="b-list__item-text"><a href="<?php the_permalink(); ?>" class="b-list__item-title"><?php the_title(); ?></a>
<?php the_excerpt(); ?></div>
                </li>
              <?php endwhile;else: endif; ?>
              <?php wp_reset_query(); ?>
               <?php  query_posts(array('post_type' => $_GET['post_type'],'post__not_in'=>get_option('sticky_posts'),'tax_query' => array(
                                    array(
                                      'taxonomy' => 'type',
                                      'field'    => 'slug',
                                      'terms'    => $cur_term->slug,
                                    )), 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '-1'));
                                if (have_posts()) : while (have_posts()) :the_post();  ?>
                <li class="b-list__item">
                  <div class="b-list__item-img-wrapper"><a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()){ the_post_thumbnail('crop_thumb');} else{ ?><img src="<?php bloginfo('url');echo "/";echo "wp-content/uploads/2015/rakurs_logo.png";?>"> <?php } ?></a></div>
                  <div class="b-list__item-text"><a href="<?php the_permalink(); ?>" class="b-list__item-title"><?php the_title(); ?></a>
<?php the_excerpt(); ?></div>
                </li>
              <?php endwhile;else: endif; ?>
              <?php wp_reset_query(); ?>
                </ul>
              </div>
              <?php  } else { ?>
              <div id="subcat<?php echo $i; ?>" style="display:none;" class="b-cat__subcat-contents _with-border">
                  <?php $char_terms = get_terms('type',array('hide_empty'=>'true','parent'=>$cur_term->term_id)); ?>
                  <?php foreach ($char_terms as $char_term){ ?>
                  <div class="b-cat__group chars_list" data-choice="">
                    <div class="b-cat__group-title"><?php echo $char_term->name; ?></div>
                    <div class="b-cat__group-options">
                        <?php $char_terms_inner = get_terms('type',array('hide_empty'=>'true','parent'=>$char_term->term_id)); ?>
                      <ul class="b-cat__group-options-list">
                          <?php foreach ($char_terms_inner as $char_term_inner){ ?>
                        <li class="b-cat__group-options-item">
                          <label class="b-cat__group-options-label">
                            <input name="inner_character['<?php echo $char_term->name; ?>'][]" type="radio" class="b-cat__group-options-input" data-deselectable="false" value="<?php echo $char_term_inner->term_id; ?>">
                            <span class="b-cat__group-options-text"><?php echo $char_term_inner->name; ?></span>
                          </label>
                        </li>
                        <?php } ?>
                      </ul>

                    </div>
                  </div>
                  <?php } ?>
                  <div class="b-cat__brands _width100">
                    <div class="b-cat__brands-label">Бренды:</div>
                    <?php
                    $sql = "SELECT tax.term_id  FROM $wpdb->term_taxonomy as tax
                    LEFT JOIN $wpdb->term_relationships as rl
                    ON rl.term_taxonomy_id = tax.term_taxonomy_id
                    RIGHT JOIN $wpdb->posts as p
                    ON rl.object_id = p.ID
                    WHERE tax.taxonomy = 'type' AND p.post_type IN ('omron','schneider-electric') AND tax.count > 0 AND tax.parent = '$term->term_id'";?>
                    <div class="b-manuf _small">
                      <ul class="b-manuf__list_new">
                        <li class="b-manuf__item" id="omron">
                          <label href="#" class="b-manuf__link">
                            <input name="filter_brand[]" type="checkbox" value="omron">
                            <span></span>
                            <?php $br_1 = ot_get_option( 'omron' ); ?>
                            <img src="<?php echo $br_1;?>">
                          </label>
                        </li>
                        <li class="b-manuf__item" id="tr-electronic">
                          <label href="#" class="b-manuf__link">
                            <input name="filter_brand[]" type="checkbox" value="tr-electronic">
                            <span></span>
                            <?php $br_2 = ot_get_option( 'tr_electronic' ); ?>
                            <img src="<?php echo $br_2;?>">
                          </label>
                        </li>
                        <li class="b-manuf__item" id="siemens">
                          <label href="#" class="b-manuf__link">
                            <input name="filter_brand[]" type="checkbox" value="siemens">
                            <span></span>
                            <?php $br_3 = ot_get_option( 'siemens' ); ?>
                            <img src="<?php echo $br_3;?>">
                          </label>
                        </li>
                        <li class="b-manuf__item" id="yaskawa">
                          <label href="#" class="b-manuf__link">
                            <input name="filter_brand[]" type="checkbox" value="yaskawa">
                            <span></span>
                            <?php $br_4 = ot_get_option( 'yaskawa' ); ?>
                            <img src="<?php echo $br_4;?>">
                          </label>
                        </li>
                        <li class="b-manuf__item" id="schneider-electric">
                          <label href="#" class="b-manuf__link">
                            <input name="filter_brand[]" type="checkbox" value="schneider-electric">
                            <span></span>
                            <?php $br_5 = ot_get_option( 'schneider_electric' ); ?>
                            <img src="<?php echo $br_5;?>">
                          </label>
                        </li>
                        <li class="b-manuf__item" id="cognex">
                          <label href="#" class="b-manuf__link">
                            <input name="filter_brand[]" type="checkbox" value="cognex">
                            <span></span>
                            <?php $br_6 = ot_get_option( 'cognex' ); ?>
                            <img src="<?php echo $br_6;?>">
                          </label>
                        </li>
                        <li class="b-manuf__item" id="optex-fa">
                          <label href="#" class="b-manuf__link">
                            <input name="filter_brand[]" type="checkbox" value="optex-fa">
                            <span></span>
                            <?php $br_7 = ot_get_option( 'optex_fa' ); ?>
                            <img src="<?php echo $br_7;?>">
                          </label>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="b-cat__submit-reset">
                    <input class="b-cat__reset" type="reset" title="Вернуть параметры поиска в исходное положение">
                    <input class="b-button _invert b-cat__submit" type="submit" value="Перейти к результатам поиска">
                  </div>
                  </form>
                                                                         <!--    <ul class="b-list__list _no-pad">
                                                                              <?php   if (!$actual_link) {
                                                                                   query_posts(array('post_type' => array('omron','schneider-electric','tr-electronic','yaskawa','siemens','cognex','optex-fa'),'tax_query' => array(
                                                                                                  array(
                                                                                                    'taxonomy' => 'type',
                                                                                                    'field'    => 'slug',
                                                                                                    'terms'    => $cur_term->slug,
                                                                                                  ))));
                                                                              }
                                                                              else{
                                                                                  query_posts(array('post_type' => $actual_link,'tax_query' => array(
                                                                                                  array(
                                                                                                    'taxonomy' => 'type',
                                                                                                    'field'    => 'slug',
                                                                                                    'terms'    => $cur_term->slug,
                                                                                                  ))));
                                                                              }
                                                                                              if (have_posts()) : while (have_posts()) :the_post();   ?>
                                                                              <li class="b-list__item">
                                                                                <div class="b-list__item-img-wrapper"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a></div>
                                                                                <a href="<?php the_permalink(); ?>" class="b-list__item-title"><?php the_title(); ?></a>
                                                                                <div class="b-list__item-text"><?php the_excerpt(); ?></div>
                                                                              </li>
                                                                        <?php endwhile;else: endif; ?>
                                                              <?php wp_reset_query(); ?>
                                                                              </ul> -->
              </div>
              <?php } ?>
          </div>


      <?php $i++; } ?>
        </div>




    </div>
  </div>

<?php get_footer(); ?>
<script>
$(document).ready(function(){

    /* сброс значений формы */
     var radio = document.querySelectorAll('[data-deselectable]');
      var clicked = null;
      for (var i = 0; i < radio.length; i++)
      {
            radio[i].checked = false;
            clicked = null;
            radio[i].setAttribute("data-deselectable",'false');
      }
      $('.b-cat__group.chars_list').each(function(){
        $(this).attr('data-choice','')
      });
      $('.b-manuf__list_new li').each(function(){
        $(this).css('display','none');
      });
      $('.b-manuf__list_new li').find('input').removeAttr('checked');






    // клик по опции
    $('.b-cat__group-options-text').on('click', function()
    {




        $(this).parent().parent().parent().parent().parent().parent().find('.b-cat__brands').css('display', 'inline-block');
        $(this).parent().parent().parent().parent().parent().parent().masonry({ gutter: 16, transitionDuration: 0 });
        if ($(this).prev().attr('data-deselectable') == 'true')
        {
            $(this).parent().parent().parent().parent().parent().attr('data-choice', '');
        }
        else
        {
            var k = $(this).html();
            $(this).parent().parent().parent().parent().parent().attr('data-choice', k);
        }
        var our_form = $(this).parent().parent().parent().parent().parent().parent();
        var opts = [];
        //console.log(our_form);
        $(our_form).find('.b-cat__group.chars_list').each(function()
        {
            console.log($(this).attr('data-choice'));
            if ($(this).attr('data-choice') != "")
            {
                var vartt = $(this).attr('data-choice');
                $(this).find('span').each(function()
                {
                    if ($(this).html() == vartt)
                    {
                        //console.log($(this).prev().attr('value'));
                        opts.push($(this).prev().attr('value'));
                    }
                });
            }
        });





        var ar;


        $.ajax(
        {
            url: "../../../wp-content/themes/whiterussian/filter_new_new.php",
            type: "POST",
            dataType: "JSON",
            context: $(this),
            data:
            {
                opts: opts
            },
            success: function(data)
            {
                console.log("NEWNEW", data);
                var that = $(this).parent().parent().parent().parent().parent().parent();
                if (data.length > 0)
                {
                    $(that).find('ul.b-manuf__list_new li').each(function()
                    {
                        $(this).css('display', 'none');
                    });
                    $(that).find('ul.b-manuf__list_new li').each(function()
                    {
                        var curr = $(this).attr('id');
                        if (data.length > 1)
                        {
                            $.each(data, function(index, value)
                            {
                                console.log(value);
                                if (value == curr)
                                {
                                    var k = '#' + value;
                                    //console.log($(this));
                                    if ($(that).find(k).css('display') == 'none'){
                                        $(that).find(k).css({
                                            'display': 'inline-block',
                                            'visibility': 'visible'
                                        });
                                    }

                                    //continue;
                                }
                            });
                        }
                        else
                        {
                            // console.log($(that));
                            $(that).find('ul.b-manuf__list_new li').each(function()
                            {
                                $(this).css('display', 'none');
                            });
                            $(that).find('ul.b-manuf__list_new li').each(function()
                            {
                                var curr = $(this).attr('id');
                                //console.log(curr);
                                if (curr = data[0])
                                {
                                    //console.log(data[0]);
                                    var kk = '#' + data[0];
                                    $(that).find(kk).css('display', 'inline-block');
                                }
                            });
                        }
                    });
                }
                else
                {
                    $(that).find('ul.b-manuf__list_new li').each(function()
                    {
                        $(this).css('display', 'none');
                    });
                }
                $('.b-cat__subcat-contents').masonry();
            },
            error: function(data)
            {
                console.log(data['responseText']);
            }
        });









        $.ajax(
        {
            url: "../../../wp-content/themes/whiterussian/new_filter.php",
            type: "POST",
            dataType: "JSON",
            context: $(this),
            data:
            {
                opts: opts
            },
            success: function(data)
            {
              console.log("NEW", data);

                if (!data)
                {
                    var kkk = 0;
                    $(this).parents('.b-cat__subcat-contents').find('.chars_list').each(function()
                    {
                        if ($(this).attr('data-choice') == "")
                        {
                            ++kkk;
                        }
                        else
                        {
                            $(this).parent().parent().parent().parent().parent().parent().find('.b-button._invert.b-cat__submit').css('display', 'none').attr('value', 'Перейти к результатам поиска');
                            return;
                        }
                    });
                    if (kkk == $(this).parents('.b-cat__subcat-contents').find('.chars_list').length)
                    {
                        $(this).parents('.b-cat__subcat-contents').find('.b-button._invert.b-cat__submit').css('display', 'inline-block').attr('value', 'Перейти к результатам поиска');
                        $(this).parents('.b-cat__subcat-contents').find('.b-cat__brands').css('display', 'none');
                    }
                    else
                    {
                        $(this).parents('.b-cat__subcat-contents').find('.b-cat__brands').css('display', 'inline-block');
                    }
                }
                else
                {
                    $(this).parent().parent().parent().parent().parent().parent().find('.b-button._invert.b-cat__submit').css('display', 'inline-block').attr('value', 'Перейти к результатам поиска');
                    var kk = $(this).parent().parent().parent().parent().parent().parent().find('.b-button._invert.b-cat__submit').attr('value');
                    kk += '(' + data + ')';
                    $(this).parent().parent().parent().parent().parent().parent().find('.b-button._invert.b-cat__submit').attr('value', kk);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            }
        });
    });









console.log('SETTING CLICK HANDLER');

// Обработка событий с отсечкой по таймауту:
;$.fn.onTimeout=function(e,t,n){var r=null,i=function(){if(r)clearTimeout(r);r=setTimeout(t,n)};return $(this).on(e,i)};



// клик на брэнде
$('ul.b-manuf__list_new').on('click', 'input', function(event)
{
    console.log("\n\nCLICK");

    var $ul = $(this).parents('ul'),
        $form = $ul.parents('form'),
        opts = [],
        filter_brand = [];


    // Собираем чекнутые опции в массив:
    $form.find('.b-cat__group.chars_list').each(function()
    {
        $(this).find('input:checked').each(function()
        {
            opts.push($(this).val());
        });
    });


    // Собираем чекнутые брэнды в массив:
    $ul.find('li').each(function()
    {
        $(this).find('input:checked').each(function()
        {
            filter_brand.push($(this).val());
        });
    });


    $.ajax(
    {
        url: "../../../wp-content/themes/whiterussian/brand_filter.php",
        type: "POST",
        dataType: "JSON",
        context: $ul,
        data:
        {
            opts: opts,
            filter_brand: filter_brand
        },
        success: function(data)
        {
          console.log('DATA', data)
            if (!data)
            {
                var kkk = 0;
                $(this).parents('.b-cat__subcat-contents').find('.chars_list').each(function()
                {
                    if ($(this).attr('data-choice') == "")
                    {
                        ++kkk;
                    }
                    else
                    {
                        $(this).parent().parent().parent().parent().parent().parent().find('.b-button._invert.b-cat__submit').css('display', 'none').attr('value', 'Перейти к результатам поиска');

                        return;
                    }
                });
                if (kkk == $(this).parents('.b-cat__subcat-contents').find('.chars_list').length)
                {
                    $(this).parents('.b-cat__subcat-contents').find('.b-button._invert.b-cat__submit').css('display', 'inline-block').attr('value', 'Перейти к результатам поиска');
                    $(this).parents('.b-cat__subcat-contents').find('.b-cat__brands').css('display', 'none');
                }
                else
                {
                    $(this).parents('.b-cat__subcat-contents').find('.b-cat__brands').css('display', 'inline-block');
                }
            }
            else
            {
                $(this).parent().parent().parent().parent().parent().parent().find('.b-button._invert.b-cat__submit').css('display', 'inline-block').attr('value', 'Перейти к результатам поиска');
                var kk = $(this).parent().parent().parent().parent().parent().parent().find('.b-button._invert.b-cat__submit').attr('value');
                kk += '(' + data + ')';
                //console.log('kol-vo tovarov dlya etih brands');
                // console.log(data);
                $(this).parent().parent().parent().parent().parent().find('.b-button._invert.b-cat__submit').attr('value', kk);
                //event.preventDefault();

            }
            //event.stopPropagation();
            return false;
        },
        error: function(data) {

        }
    });


    console.log('next_event');

    //$(this).unbind('click').bind('click', function () { });
});











    $('.b-cat__reset').on('click',function(){
      // $('ul.b-manuf__list_new li').css('display','block');
       $('.b-button._invert.b-cat__submit').css('display','inline-block');
      });


});
</script>