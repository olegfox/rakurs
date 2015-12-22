<?php
ini_set( 'upload_max_size' , '100M' );
ini_set( 'post_max_size', '100M');
ini_set( 'max_execution_time', '300' );

//Тема
     // Поддержка миниатюр
    add_theme_support( 'post-thumbnails' );
    
    if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'news_thumb', 220, 136, array( 'center', 'center' ));
		add_image_size( 'slide', 940, 348, array( 'center', 'center' ));		
		add_image_size( 'cats_thumb', 200, 136, array( 'center', 'center' ));
		add_image_size( 'crop_thumb', 150, 150, false);
		}

    add_action('template_redirect', 'one_match_redirect');
    function one_match_redirect() {
        if (is_search()) {
            global $wp_query;
            if ($wp_query->post_count == 1) {
                wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
            }
        }
    }

    function mytheme_add_init() {
        if ( is_admin() ) {
            $sticky = get_field('is_sticky');
            if (!$sticky){
//                wp_enqueue_script("functions", get_template_directory_uri()."/js/libs/jquery-1.10.2.min.js");
                wp_enqueue_script("functions", get_template_directory_uri()."/js/tinymce_table.js");
            }
        }
    }
    add_action( 'admin_enqueue_scripts', 'mytheme_add_init' );

    // Добавляем меню 

    register_nav_menus(array(
'top' => 'Верхнее меню',
'about' => 'О компании',
'products' => 'Продукция',
'solutions' => 'Решения',
'services' => 'Услуги',
'news' => 'Новостной центр',
'ware' => 'Склад',
'contacts' => 'Контакты',
'types' => 'Категории'
));

// Построение верхнего меню:
class Up_Walker_Nav_Menu extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;           

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		/*
		 * Генерируем строку с CSS-классами элемента меню
		 */
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'b-h__menu-item';
 
		// функция join превращает массив в строку
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		/*
		 * Генерируем ID элемента
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
 
		/*
		 * Генерируем элемент меню
		 */
		$output .= $indent . '<li' . $value . $class_names .'>';
 
		// атрибуты элемента, title="", rel="", target="" и href=""
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		// ссылка и околоссылочный текст
		$item_output = $args->before;
		$item_output .= '<a class="b-h__menu-item-link" '. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
 
 		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
class Popup_Walker_Nav_Menu extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;           

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		/*
		 * Генерируем строку с CSS-классами элемента меню
		 */
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'b-h__link-group-item _open';
 
		// функция join превращает массив в строку
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		/*
		 * Генерируем ID элемента
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
 
		/*
		 * Генерируем элемент меню
		 */
		$output .= $indent . '<li' . $value . $class_names .'>';
 
		// атрибуты элемента, title="", rel="", target="" и href=""
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		// ссылка и околоссылочный текст
		$item_output = $args->before;
		$item_output .= '<a '. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
 
 		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


// Построение выпадающего подменю:
class rakurstimesub_walker_nav_menu extends Walker_Nav_Menu {

// add classes to ul sub-menus
function start_lvl( &$output, $depth ) {
	// depth dependent classes
	$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
	$display_depth = ( $depth + 1); // because it counts the first submenu as 0
	$classes = array(
		'sub-menu',
		( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
		( $display_depth >=2 ? 'sub-sub-menu' : '' ),
		'menu-depth-' . $display_depth
		);
	$class_names = implode( ' ', $classes );

	// build html
	$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}

// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth, $args ) {
	global $wp_query;
	$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

	// depth dependent classes
	$depth_classes = array(
		( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
		( $depth >=2 ? 'sub-sub-menu-item' : '' ),
		( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
		'menu-item-depth-' . $depth
	);
	$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

	// passed classes
	$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	// build html
	$output .= $indent . '<li class="b-h__submenu-item ' . $depth_class_names . ' ' . $class_names . '">';

	// link attributes
	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	$attributes .= ' class="' . $class_names . '"';

	$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
		$args->before,
		$attributes,
		$args->link_before,
		apply_filters( 'the_title', $item->title, $item->ID ),
		$args->link_after,
		$args->after
	);

	// build html
	$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}

// Построение левого меню:
class left_walker_nav_menu extends Walker_Nav_Menu {

// add classes to ul sub-menus
function start_lvl( &$output, $depth ) {
	// depth dependent classes
	$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
	$display_depth = ( $depth + 1); // because it counts the first submenu as 0
	$classes = array(
		'sub-menu',
		( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
		( $display_depth >=2 ? 'sub-sub-menu' : '' ),
		'menu-depth-' . $display_depth
		);
	$class_names = implode( ' ', $classes );

	// build html
	$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}

// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth, $args ) {
	global $wp_query;
	$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

	// depth dependent classes
	$depth_classes = array(
		( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
		( $depth >=2 ? 'sub-sub-menu-item' : '' ),
		( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
		'menu-item-depth-' . $depth
	);
	$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

	// passed classes
	$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	// build html
	$output .= $indent . '<li class="b-side-menu__item ' . $depth_class_names . ' ' . $class_names . '">';

	// link attributes
	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	$attributes .= ' class="b-side-menu__link ' . $class_names . '"';

	$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
		$args->before,
		$attributes,
		$args->link_before,
		apply_filters( 'the_title', $item->title, $item->ID ),
		$args->link_after,
		$args->after
	);

	// build html
	$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}



// Построение постоянного подменю:
class rakurssub_walker_nav_menu extends Walker_Nav_Menu {

// add classes to ul sub-menus
function start_lvl( &$output, $depth ) {
	// depth dependent classes
	$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
	$display_depth = ( $depth + 1); // because it counts the first submenu as 0
	$classes = array(
		'sub-menu',
		( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
		( $display_depth >=2 ? 'sub-sub-menu' : '' ),
		'menu-depth-' . $display_depth
		);
	$class_names = implode( ' ', $classes );

	// build html
	$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}

// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth, $args ) {
	global $wp_query;
	$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

	// depth dependent classes
	$depth_classes = array(
		( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
		( $depth >=2 ? 'sub-sub-menu-item' : '' ),
		( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
		'menu-item-depth-' . $depth
	);
	$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

	// passed classes
	$classes = empty( $item->classes ) ? array() : (array) $item->classes;
	$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

	// build html
	$output .= $indent . '<li class="b-h__submenu-item ' . $depth_class_names . ' ' . $class_names . '">';

	// link attributes
	$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
	$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
	$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
	$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	$attributes .= ' class="b-h__submenu-item-link  menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

	$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
		$args->before,
		$attributes,
		$args->link_before,
		apply_filters( 'the_title', $item->title, $item->ID ),
		$args->link_after,
		$args->after
	);

	// build html
	$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}

//Отключаем автоматическую простановку ссылок у картинок
function wpb_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);



    // Включаем шорткоды
    add_filter('the_content', 'do_shortcode');
    add_filter('widget_text', 'do_shortcode');

	// CPT
	add_action('init', 'cptui_register_my_cpt_goods');
function cptui_register_my_cpt_goods() {
register_post_type('goods', array(
'label' => 'Товары',
'description' => '',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => false,
'rewrite' => array('slug' => 'goods', 'with_front' => true),
'query_var' => true,
'has_archive' => true,
'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes','post-formats'),
'labels' => array (
  'name' => 'Товары',
  'singular_name' => 'Товар',
  'menu_name' => 'Товары',
  'add_new' => 'Добавить товар',
  'add_new_item' => 'Добавить новый товар',
  'edit' => 'Редактировать',
  'edit_item' => 'Редактировать товар',
  'new_item' => 'Новый товар',
  'view' => 'Посмотреть товар',
  'view_item' => 'Посмотреть товар',
  'search_items' => 'Найти товар',
  'not_found' => 'Товаров не найдено',
  'not_found_in_trash' => 'В корзине товаров не найдено',
  'parent' => 'Родительский товар',
)
) ); }
add_action('init', 'cptui_register_my_cpt_omron');
function cptui_register_my_cpt_omron() {
register_post_type('omron', array(
'label' => 'Omron',
'description' => '',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => true,
'rewrite' => array('slug' => 'omron', 'with_front' => true),
'query_var' => true,
'supports' => array('title','editor','excerpt','custom-fields','revisions','thumbnail','author'),
'taxonomies' => array('type'),
'labels' => array (
  'name' => 'Omron',
  'singular_name' => 'Товар (Omron)',
  'menu_name' => 'Omron',
  'add_new' => 'Добавить товар',
  'add_new_item' => 'Добавить товар',
  'edit' => 'Редактировать',
  'edit_item' => 'Редактировать',
  'new_item' => 'Новый',
  'view' => 'Посмотреть',
  'view_item' => 'Посмотреть',
  'search_items' => 'Поиск',
  'not_found' => 'Не найдено',
  'not_found_in_trash' => 'В корзине не найдено',
  'parent' => 'Родительский товар',
)
) ); }

add_action('init', 'cptui_register_my_cpt_schneider_electric');
function cptui_register_my_cpt_schneider_electric() {
register_post_type('schneider-electric', array(
'label' => 'Schneider Electric',
'description' => '',
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'capability_type' => 'post',
'map_meta_cap' => true,
'hierarchical' => true,
'rewrite' => array('slug' => 'schneider-electric', 'with_front' => true),
'query_var' => true,
'supports' => array('title','editor','excerpt','custom-fields','revisions','thumbnail','author'),
'labels' => array (
  'name' => 'Schneider Electric',
  'singular_name' => 'Товар (se)',
  'menu_name' => 'Schneider Electric',
  'add_new' => 'Добавить товар',
  'add_new_item' => 'Добавить товар',
  'edit' => 'Редактировать',
  'edit_item' => 'Редактировать',
  'new_item' => 'Новый',
  'view' => 'Посмотреть',
  'view_item' => 'Посмотреть',
  'search_items' => 'Поиск',
  'not_found' => 'Не найдено',
  'not_found_in_trash' => 'В корзине не найдено',
  'parent' => 'Родительский товар',
)
) ); }

add_action('init', 'cptui_register_my_taxes_type');
function cptui_register_my_taxes_type() {
register_taxonomy( 'type',array (
  0 => 'goods',
  1 => 'omron',
  2 => 'schneider-electric',
  3 => 'yaskawa',
  4 => 'siemens',
  5 => 'tr-electronic',
  6 => 'cognex',
  7 => 'optex-fa'
),
array( 'hierarchical' => true,
	'label' => 'Категории',
	'show_ui' => true,
	'query_var' => true,
	'show_admin_column' => false,
	'labels' => array (
  'search_items' => 'Категория',
  'popular_items' => 'Часто используемые',
  'all_items' => 'Все типы',
  'parent_item' => 'Родительская категория',
  'parent_item_colon' => '',
  'edit_item' => 'Редактировать тип',
  'update_item' => 'Обновить',
  'add_new_item' => 'Добавить новый',
  'new_item_name' => 'Название',
  'separate_items_with_commas' => '',
  'add_or_remove_items' => '',
  'choose_from_most_used' => '',
)
) ); 
}

add_action('init', 'cptui_register_my_taxes_brands');
function cptui_register_my_taxes_brands() {
register_taxonomy( 'brands',array (
  0 => 'goods',
),
array( 'hierarchical' => true,
	'label' => 'Бренды',
	'show_ui' => true,
	'query_var' => true,
	'show_admin_column' => false,
	'labels' => array (
  'search_items' => 'Бренд',
  'popular_items' => '',
  'all_items' => '',
  'parent_item' => '',
  'parent_item_colon' => '',
  'edit_item' => '',
  'update_item' => '',
  'add_new_item' => '',
  'new_item_name' => '',
  'separate_items_with_commas' => '',
  'add_or_remove_items' => '',
  'choose_from_most_used' => '',
)
) ); 
}

//Подключаем поддержку слагов
function the_slug($echo=false){
  $slug = basename(get_permalink());
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  if( $echo ) echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}


	/* Свой фон темы
	$defaults = array(
	'default-image'          => '', // без изображения
	'default-repeat'         => 'repeat', // повторять
	'default-position-x'     => 'left', // выровнять по левому краю
	'default-attachment'     => 'fixed',
	'default-color'          => '', // без цвета
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $defaults );*/

	// Регистрация виджетов

	function my_widgets_init() 
	{
    register_sidebar(array  
    (    
        'id'            => 'index-block-1',
        'name'            => 'Index Block 1',
        'before_widget' => false,
        'after_widget'    => false,
        'before_title'    => '<h2 class="widget-index-title">',
        'after_title'    => '</h2>'
    ));
	}
add_action( 'widgets_init', 'my_widgets_init' );
	//Добавляем хлебные крошки
function russian_breadcrumbs( $sep=' » ' ){

	global $post, $wp_query, $wp_post_types;
	// для локализации
	$l = array(
		'home' => 'Главная'
		,'paged' => 'Страница %s'
		,'404' => 'Ошибка 404'
		,'search' => 'Результаты поиска по запросу - <b>%s</b>'
		,'author' => 'Архив автора: <b>%s</b>'
		,'year' => 'Архив за <b>%s</b> год'
		,'month' => 'Архив за: <b>%s</b>'
		,'day' => ''
		,'attachment' => 'Медиа: %s'
		,'tag' => 'Записи по метке: <b>%s</b>'
		,'tax_tag' => '%s из "%s" по тегу: <b>%s</b>'
	);

	$w1 = '<div class="kama_breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
	$w2 = '</div>';
	$patt1 = '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">';
	$sep .= '</span>'; // закрываем span после разделителя!
	$patt = $patt1.'%s</a>';

	if( $paged = $wp_query->query_vars['paged'] ){
		$pg_patt = $patt1;
		$pg_end = '</a>'. $sep . sprintf($l['paged'], $paged);
	}

	$out = '';
	if( is_front_page() )
		return print $w1.($paged?sprintf($pg_patt, get_bloginfo('url')):'') . $l['home'] . $pg_end .$w2;

	elseif( is_404() )
		$out = $l['404']; 

	elseif( is_search() ){
		$out = sprintf( $l['search'], strip_tags($GLOBALS['s']) );
	}
	elseif( is_author() ){
		$q_obj = &$wp_query->queried_object;
		$out = ($paged?sprintf( $pg_patt, get_author_posts_url($q_obj->ID, $q_obj->user_nicename) ):'') . sprintf($l['author'], $q_obj->display_name) . $pg_end;
	}
	elseif( is_year() || is_month() || is_day() ){
		$y_url = get_year_link( $year=get_the_time('Y') );
		$m_url = get_month_link( $year, get_the_time('m') );
		$y_link = sprintf($patt, $y_url, $year);
		$m_link = sprintf($patt, $m_url, get_the_time('F'));
		if( is_year() )
			$out = ($paged?sprintf($pg_patt, $y_url):'') . sprintf($l['year'], $year) . $pg_end;
		elseif( is_month() )
			$out = $y_link . $sep . ($paged?sprintf($pg_patt, $m_url):'') . sprintf($l['month'], get_the_time('F')) . $pg_end;
		elseif( is_day() )
			$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
	}
	
	// Страницы и древовидные типы записей
	elseif( $wp_post_types[$post->post_type]->hierarchical ){
		$parent = $post->post_parent;
		$crumbs=array();
		while($parent){
		  $page = &get_post($parent);
		  $crumbs[] = sprintf($patt, get_permalink($page->ID), $page->post_title);
		  $parent = $page->post_parent;
		}
		$crumbs = array_reverse($crumbs);
		foreach ($crumbs as $crumb)
			$out .= $crumb.$sep;
		$out = $out . $post->post_title;
	}
	else // Таксономии, вложения и не древовидные типы записей
	{
		// Определяем термины
		if( is_singular() ){
			if( ! $taxonomies ){
				$taxonomies = get_taxonomies( array('hierarchical' => true, 'public' => true) );
				if( count( $taxonomies ) == 1 ) $taxonomies = 'category';
			}
			if( $term = get_the_terms( $post->post_parent ? $post->post_parent : $post->ID, $taxonomies ) ){
				$term = array_shift( $term );
			}
		}
		else
			$term = &$wp_query->get_queried_object();

		if( ! $term && ! is_attachment() )
			return print "Error: Taxonomy is not defined!"; 

		$pg_term_start = ($paged && $term->term_id) ? sprintf( $pg_patt, get_term_link( (int)$term->term_id, $term->taxonomy ) ) : '';

		if( is_attachment() ){
			if(!$post->post_parent)
				$out = sprintf($l['attachment'], $post->post_title);
			else
				$out = crumbs_tax($term->term_id, $term->taxonomy, $sep, $patt) . sprintf($patt, get_permalink($post->post_parent), get_the_title($post->post_parent) ).$sep.$post->post_title;
		}
		elseif( is_single() )
			$out = crumbs_tax($term->parent, $term->taxonomy, $sep, $patt) . sprintf($patt, get_term_link( (int)$term->term_id, $term->taxonomy ), $term->name). $sep.$post->post_title;
		// Метки, архивная страница типа записи, произвольные одноуровневые таксономии
		elseif( ! is_taxonomy_hierarchical( $term->taxonomy ) ){
			// метка
			if( is_tag() )
				$out = $pg_term_start . sprintf($l['tag'], $term->name) . $pg_end;
			// архивная страница произвольного типа записи
			elseif( !$term->term_id ) 
				$home_after = sprintf($patt, '/'. $term->name, $term->label). $pg_end;
			// таксономия
			else {
				$post_label = $wp_post_types[$post->post_type]->labels->name;
				$tax_label = $GLOBALS['wp_taxonomies'][$term->taxonomy]->labels->name;
				$out = $pg_term_start . sprintf($l['tax_tag'], $post_label, $tax_label, $term->name) .  $pg_end;
			}
		}
		// Рубрики и таксономии
		else
			$out = crumbs_tax($term->parent, $term->taxonomy, $sep, $patt) . $pg_term_start . $term->name . $pg_end;
	}

	// замена ссылки на архивную страницу для типа записи 
	if( $post->post_type == 'book' )
		$home_after = sprintf($patt, '/about_book', 'Книжки'). $sep;

	// ссылка на архивную страницу произвольно типа поста
	if( ! $home_after && ! empty($post->post_type) && $post->post_type != 'post' && !is_page() && !is_attachment() )
		$home_after = sprintf($patt, '/'. $post->post_type, $wp_post_types[$post->post_type]->labels->name ). $sep;

	$home = sprintf($patt, get_bloginfo('url'), $l['home'] ). $sep . $home_after;

	return print $w1. $home . $out .$w2;
}
function crumbs_tax($term_id, $tax, $sep, $patt){
	$termlink = array();
	while( (int)$term_id ){
		$term2 = &get_term( $term_id, $tax );
		$termlink[] = sprintf($patt, get_term_link( (int)$term2->term_id, $term2->taxonomy ), $term2->name). $sep;
		$term_id = (int)$term2->parent;
	}
	$termlinks = array_reverse($termlink);
	return implode('', $termlinks);
}

	//Регистрация сайдбаров
	function true_register_wp_sidebars() {
 
	/* В боковой колонке */
	register_sidebar(
		array(
			'id' => 'true_side',
			'name' => 'Боковая колонка',
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.',
			'before_widget' => '<div id="%1$s" class="side widget %2$s ">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>'
		)
	);
	register_sidebar(
		array(
			'id' => 'news_side',
			'name' => 'Боковая колонка в новостях',
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в сайдбар.',
			'before_widget' => '<div class="newssidebar">',
			'after_widget' => '</div>',
			'before_title' => '',
			'after_title' => ''
		)
	);
 
	/* В подвале */
	register_sidebar(
		array(
			'id' => 'true_foot-1',
			'name' => 'Футер-1',
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в футер.',
			'before_widget' => '<div id="%1$s" class="foot widget %2$s white-text">',
			'after_widget' => '</div>',
			'before_title' => '<h5  class="white-text">',
			'after_title' => '</h5>'
		)
	);
	register_sidebar(
		array(
			'id' => 'true_foot-2',
			'name' => 'Футер-2',
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в футер.',
			'before_widget' => '<div id="%1$s" class="foot widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5  class="white-text">',
			'after_title' => '</h5>'
		)
	);
	register_sidebar(
		array(
			'id' => 'true_foot-3',
			'name' => 'Футер-3',
			'description' => 'Перетащите сюда виджеты, чтобы добавить их в футер.',
			'before_widget' => '<div id="%1$s" class="foot widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h5  class="white-text">',
			'after_title' => '</h5>'
		)
	);
}
 
add_action( 'widgets_init', 'true_register_wp_sidebars' );

//Записи одного автора
function get_related_author_posts() {
    global $authordata, $post;

    $authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 3 ) );

    $output = '<ul>';
    foreach ( $authors_posts as $authors_post ) {
        $output .= '<li><div class="card"><div class="card-image alone"><a href="' . get_permalink( $authors_post->ID ) . '">' . get_the_post_thumbnail( $authors_post->ID, thumbnail ) . '</a></div></div></li>';
    }
    $output .= '</ul>';

    return $output;
}

//Пагинация 
function wr_pagenavi( $before = '', $after = '', $echo = true ) {
	/* ================ Настройки ================ */
	$text_num_page = ''; // Текст перед пагинацией. {current} - текущая; {last} - последняя (пр. 'Страница {current} из {last}' получим: "Страница 4 из 60" )
	$num_pages = 10; // сколько ссылок показывать
	$stepLink = 10; // ссылки с шагом (значение - число, размер шага (пр. 1,2,3...10,20,30). Ставим 0, если такие ссылки не нужны.
	$dotright_text = '…'; // промежуточный текст "до".
	$dotright_text2 = '…'; // промежуточный текст "после".
	$backtext = '‹-'; // текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
	$nexttext = '-›'; // текст "перейти на следующую страницу". Ставим 0, если эта ссылка не нужна.
	$first_page_text = '« '; // текст "к первой странице". Ставим 0, если вместо текста нужно показать номер страницы.
	$last_page_text = ' »'; // текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.
	/* ================ Конец Настроек ================ */ 

	global $wp_query;

	$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
	$paged = (int) $wp_query->query_vars['paged'];
	$max_page = $wp_query->max_num_pages;

	//проверка на надобность в навигации
	if( $max_page <= 1 )
		return false; 

	if( empty($paged) || $paged == 0 ) 
		$paged = 1;

	$pages_to_show = intval( $num_pages );
	$pages_to_show_minus_1 = $pages_to_show-1;

	$half_page_start = floor( $pages_to_show_minus_1/2 ); //сколько ссылок до текущей страницы
	$half_page_end = ceil( $pages_to_show_minus_1/2 ); //сколько ссылок после текущей страницы

	$start_page = $paged - $half_page_start; //первая страница
	$end_page = $paged + $half_page_end; //последняя страница (условно)

	if( $start_page <= 0 ) 
		$start_page = 1;
	if( ($end_page - $start_page) != $pages_to_show_minus_1 ) 
		$end_page = $start_page + $pages_to_show_minus_1;
	if( $end_page > $max_page ) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = (int) $max_page;
	}

	if( $start_page <= 0 ) 
		$start_page = 1;

	//выводим навигацию
	$out = '';

	// создаем базу чтобы вызвать get_pagenum_link один раз
	$link_base = get_pagenum_link( 99999999 ); // 99999999 будет заменено
	$link_base = str_replace( 99999999, '___', $link_base);
	$first_url = get_pagenum_link( 1 );
	$out .= $before . "<div class='b-pager'><ul>\n";

		if( $text_num_page ){
			$text_num_page = preg_replace( '!{current}|{last}!', '%s', $text_num_page );
			$out.= sprintf( "<li><span class='pages'>$text_num_page</span></li> ", $paged, $max_page );
		}
		// назад
		if ( $backtext && $paged != 1 ) 
			$out .= '<li><a class="prev" href="'. str_replace( '___', ($paged-1), $link_base ) .'">'. $backtext .'</a></li> ';
		// в начало
		if ( $start_page >= 2 && $pages_to_show < $max_page ) {
			$out.= '<li><a class="first" href="'. $first_url .'">'. ( $first_page_text ? $first_page_text : 1 ) .'</a></li> ';
			if( $dotright_text && $start_page != 2 ) $out .= '<li><span class="extend">'. $dotright_text .'</span></li> ';
		}
		// пагинация
		for( $i = $start_page; $i <= $end_page; $i++ ) {
			if( $i == $paged )
				$out .= '<li><span class="current">'.$i.'</span></li> ';
			elseif( $i == 1 )
				$out .= '<li><a href="'. $first_url .'">1</a></li> ';
			else
				$out .= '<li><a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a></li> ';
		}

		//ссылки с шагом
		if ( $stepLink && $end_page < $max_page ){
			for( $i = $end_page+1; $i<=$max_page; $i++ ) {
				if( $i % $stepLink == 0 && $i !== $num_pages ) {
					if ( ++$dd == 1 ) 
						$out.= '<li><span class="extend">'. $dotright_text2 .'</span></li> ';
					$out.= '<li><a href="'. str_replace( '___', $i, $link_base ) .'">'. $i .'</a></li> ';
				}
			}
		}
		// в конец
		if ( $end_page < $max_page ) {
			if( $dotright_text && $end_page != ($max_page-1) ) 
				$out.= '<li><span class="extend">'. $dotright_text2 .'</span></li> ';
			$out.= '<li><a class="last" href="'. str_replace( '___', $max_page, $link_base ) .'">'. ( $last_page_text ? $last_page_text : $max_page ) .'</a></li> ';
		}
		// вперед
		if ( $nexttext && $paged != $end_page ) 
			$out.= '<li><a class="next" href="'. str_replace( '___', ($paged+1), $link_base ) .'">'. $nexttext .'</a></li> ';

	$out .= "</ul></div>". $after ."\n";
	
	if ( ! $echo ) 
		return $out;
	echo $out;
}



//Текст

function russian_date_forms($the_date = '') {
	if ( substr_count($the_date , '---') > 0 ) {
		return str_replace('---', '', $the_date);
	}
	// массив замен для русской локализации движка и для английской
	$replacements = array(
		"Январь" => "января", // "Jan" => "января"
		"Февраль" => "февраля", // "Feb" => "февраля"
		"Март" => "марта", // "Mar" => "марта"
		"Апрель" => "апреля", // "Apr" => "апреля"
		"Май" => "мая", // "May" => "мая"
		"Июнь" => "июня", // "Jun" => "июня"
		"Июль" => "июля", // "Jul" => "июля"
		"Август" => "августа", // "Aug" => "августа"
		"Сентябрь" => "сентября", // "Sep" => "сентября"
		"Октябрь" => "октября", // "Oct" => "октября"
		"Ноябрь" => "ноября", // "Nov" => "ноября"
		"Декабрь" => "декабря" // "Dec" => "декабря"
	);
	return strtr($the_date, $replacements);
	}





//Система
	//Защита
	if (strpos($_SERVER['REQUEST_URI'], "eval(") ||	strpos($_SERVER['REQUEST_URI'], "CONCAT") || strpos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||	strpos($_SERVER['REQUEST_URI'], "base64")) {
	@header("HTTP/1.1 400 Bad Request");
	@header("Status: 400 Bad Request");
	@header("Connection: Close");
	@exit;
	}

	
	//Система
	function wp_usage(){
	printf( ('SQL: %d за %s сек. '), get_num_queries(), timer_stop(0, 3) );
	if ( function_exists('memory_get_usage') ) echo round( memory_get_usage()/1024/1024, 2 ) . ' mb ';
	}
	add_filter('admin_footer_text', 'wp_usage');

	function true_change_admin_footer () {
	$footer_text = array(
		'Разработано в <a href="http://8stein.ru" target="_blank">лаборатории</a>'
	);
	return implode( ' &bull; ', $footer_text);
	}
		//Logo
	function loginLogo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
    </style>';
	}
 
	add_action('login_head', 'loginLogo');
 
	add_filter('admin_footer_text', 'true_change_admin_footer');

//Дублирование страниц

function true_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'true_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('Нечего дублировать!');
	}
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	$post = get_post( $post_id );
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
	if (isset( $post ) && $post != null) {
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
		$new_post_id = wp_insert_post( $args );
		$taxonomies = get_object_taxonomies($post->post_type); 
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Ошибка создания поста, не могу найти оригинальный пост с ID=: ' . $post_id);
	}
}
add_action( 'admin_action_true_duplicate_post_as_draft', 'true_duplicate_post_as_draft' );
function true_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=true_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Дублировать этот пост" rel="permalink">Дублировать</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'true_duplicate_post_link', 10, 2 );
add_filter( 'page_row_actions', 'true_duplicate_post_link', 10, 2);

	//Head
	remove_action('wp_head', 'wp_generator');
	function true_remove_wp_version_wp_head_feed() {
	return '';
	}
	add_filter('the_generator', 'true_remove_wp_version_wp_head_feed');

	//Скрипты и стили
	add_action( 'init', 'true_jquery_register' );
 
		function true_jquery_register() {
			if ( !is_admin() ) {
				wp_deregister_script( 'jquery' );
				wp_register_script( 'jquery', get_template_directory_uri().'/js/libs/jquery-1.10.2.min.js' , false, null, false );
				wp_enqueue_script( 'jquery' );
			}
		}
	if ( !is_admin() ) {
    function register_my() {

        wp_register_style( 'reset', get_stylesheet_directory_uri().'/css/default/reset.css', '', '' );
        wp_enqueue_style( 'reset' );		
		
		wp_register_script( 'modernizr', get_template_directory_uri().'/js/libs/modernizr.all.min.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'modernizr' );		

		wp_register_script( 'owljs', get_template_directory_uri().'/js/libs/owl.carousel.min.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'owljs' );

        wp_register_style( 'owl', get_stylesheet_directory_uri().'/css/default/owl.carousel.css', '', '' );
        wp_enqueue_style( 'owl' );

		wp_register_script( 'jquery-uijs', get_template_directory_uri().'/js/libs/jquery-ui.all.min.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'jquery-uijs' );

        wp_register_style( 'jquery-ui', get_stylesheet_directory_uri().'/css/default/jquery-ui.all.edit.css', '', '' );
        wp_enqueue_style( 'jquery-ui' );

        wp_register_style( 'selectboxit', get_stylesheet_directory_uri().'/css/default/selectboxit.css', '', '' );
        wp_enqueue_style( 'selectboxit' );
        
		wp_register_script( 'selectboxitjs', get_template_directory_uri().'/js/libs/jquery.selectBoxIt.min.edit.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'selectboxitjs' );
                
		wp_register_script( 'modaljs', get_template_directory_uri().'/js/modules/modal.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'modaljs' );

		wp_register_script( 'validatejs', get_template_directory_uri().'/js/libs/jquery.validate.min.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'validatejs' );

		wp_register_script( 'univalidatejs', get_template_directory_uri().'/js/modules/uni-validate.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'univalidatejs' );

        wp_register_style( 'rakursstyle', get_stylesheet_directory_uri().'/css/common.css', '', '' );
        wp_enqueue_style( 'rakursstyle' );
        
        wp_register_style( 'modal', get_stylesheet_directory_uri().'/css/default/modal.css', '', '' );
        wp_enqueue_style( 'modal' );

        wp_register_script( 'masonry', get_template_directory_uri().'/js/modules/masonry.pkgd.min.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'masonry' );
        
		wp_register_script( 'scriptjs', get_template_directory_uri().'/js/script.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'scriptjs' );
        
        wp_register_style( 'style', get_stylesheet_directory_uri().'/style.css', '', '' );
        wp_enqueue_style( 'style' );
        

		//wp_register_script( 'stickyheader', get_template_directory_uri().'/js/jquery.stickyheader.js', array( 'jquery' ), false, false );
		//wp_enqueue_script( 'stickyheader' );

        //wp_register_style( 'stickyheadercss', get_stylesheet_directory_uri().'/css/component.css', '', '' );
        //wp_enqueue_style( 'stickyheadercss' );
    }
    add_action('init', 'register_my');
}
	
	//Настройки темы
//	add_filter( 'ot_theme_mode', '__return_true' );
//	require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );	
//	require( trailingslashit( get_template_directory() ) . 'includes/theme-options.php' );
	
	//Подключаем плагины
	include_once('webmaster-yandex/webmaster-yandex.php');
	include_once('acf/acf.php');

	
	//Cyr-to-lat
	function ctl_sanitize_title($title) {
	global $wpdb;

	$iso9_table = array(
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
		'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
		'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
		'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
		'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
		'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
		'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
		'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
		'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
		'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
		'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
		'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
		'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
		'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
		'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
		'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
		'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
	);
	$geo2lat = array(
		'?' => 'a', '?' => 'b', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'v',
		'?' => 'z', '?' => 'th', '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'm',
		'?' => 'n', '?' => 'o', '?' => 'p','?' => 'zh','?' => 'r','?' => 's',
		'?' => 't','?' => 'u','?' => 'ph','?' => 'q','?' => 'gh','?' => 'qh',
		'?' => 'sh','?' => 'ch','?' => 'ts','?' => 'dz','?' => 'ts','?' => 'tch',
		'?' => 'kh','?' => 'j','?' => 'h'
	);
	$iso9_table = array_merge($iso9_table, $geo2lat);

	$locale = get_locale();
	switch ( $locale ) {
		case 'bg_BG':
			$iso9_table['Щ'] = 'SHT';
			$iso9_table['щ'] = 'sht'; 
			$iso9_table['Ъ'] = 'A';
			$iso9_table['ъ'] = 'a';
			break;
		case 'uk':
			$iso9_table['И'] = 'Y';
			$iso9_table['и'] = 'y';
			break;
		case 'uk_ua':
			$iso9_table['И'] = 'Y';
			$iso9_table['и'] = 'y';
			break;
	}

	$is_term = false;
	$backtrace = debug_backtrace();
	foreach ( $backtrace as $backtrace_entry ) {
		if ( $backtrace_entry['function'] == 'wp_insert_term' ) {
			$is_term = true;
			break;
		}
	}

	$term = $is_term ? $wpdb->get_var("SELECT slug FROM {$wpdb->terms} WHERE name = '$title'") : '';
	if ( empty($term) ) {
		$title = strtr($title, apply_filters('ctl_table', $iso9_table));
		if (function_exists('iconv')){
			$title = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $title);
		}
		$title = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $title);
		$title = preg_replace('/\-+/', '-', $title);
		$title = preg_replace('/^-+/', '', $title);
		$title = preg_replace('/-+$/', '', $title);
	} else {
		$title = $term;
	}

	return $title;
	}
	add_filter('sanitize_title', 'ctl_sanitize_title', 9);
	add_filter('sanitize_file_name', 'ctl_sanitize_title');

	function ctl_convert_existing_slugs() {
	global $wpdb;

	$posts = $wpdb->get_results("SELECT ID, post_name FROM {$wpdb->posts} WHERE post_name REGEXP('[^A-Za-z0-9\-]+') AND post_status IN ('publish', 'future', 'private')");
	foreach ( (array) $posts as $post ) {
		$sanitized_name = ctl_sanitize_title(urldecode($post->post_name));
		if ( $post->post_name != $sanitized_name ) {
			add_post_meta($post->ID, '_wp_old_slug', $post->post_name);
			$wpdb->update($wpdb->posts, array( 'post_name' => $sanitized_name ), array( 'ID' => $post->ID ));
		}
	}

	$terms = $wpdb->get_results("SELECT term_id, slug FROM {$wpdb->terms} WHERE slug REGEXP('[^A-Za-z0-9\-]+') ");
	foreach ( (array) $terms as $term ) {
		$sanitized_slug = ctl_sanitize_title(urldecode($term->slug));
		if ( $term->slug != $sanitized_slug ) {
			$wpdb->update($wpdb->terms, array( 'slug' => $sanitized_slug ), array( 'term_id' => $term->term_id ));
		}
	}
	}

	function ctl_schedule_conversion() {
	add_action('shutdown', 'ctl_convert_existing_slugs');
	}
	register_activation_hook(__FILE__, 'ctl_schedule_conversion');
	function custom_excerpt_length( $length ) {
	return 25;
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	

	/*$type = $_GET['post_type'];
	$taxonomy_names = get_object_taxonomies( $type);
	$name = "manage_taxonomies_for_";
	$name .= $type;
	$name .= "_columns";
	add_filter( $name, 'omron_type_columns' );
	function omron_type_columns( $taxonomies ) {
	    $taxonomies[] = 'type';
	    return $taxonomies;
	}*/
	add_filter( 'manage_taxonomies_for_omron_columns', 'omron_type_columns' );
	function omron_type_columns( $taxonomies ) {
	    $taxonomies[] = 'type';
	    return $taxonomies;
	}
	add_filter( 'manage_taxonomies_for_schneider-electric_columns', 'schneiderelectric_type_columns' );
	function schneiderelectric_type_columns( $taxonomies ) {
	    $taxonomies[] = 'type';
	    return $taxonomies;
	}
	add_filter( 'manage_taxonomies_for_yaskawa_columns', 'yaskawa_type_columns' );
	function yaskawa_type_columns( $taxonomies ) {
	    $taxonomies[] = 'type';
	    return $taxonomies;
	}
	add_filter( 'manage_taxonomies_for_siemens_columns', 'siemens_type_columns' );
	function siemens_type_columns( $taxonomies ) {
	    $taxonomies[] = 'type';
	    return $taxonomies;
	}
	add_filter( 'manage_taxonomies_for_tr-electronic_http://codex.wordpress.org/Plugin_API/Filter_Reference/manage_$post_type_posts_columnscolumns', 'trelectronic_type_columns' );
	function trelectronic_type_columns( $taxonomies ) {
	    $taxonomies[] = 'type';
	    return $taxonomies;
	}
	add_filter( 'manage_taxonomies_for_optex-fa_columns', 'optexfa_type_columns' );
	function optexfa_type_columns( $taxonomies ) {
	    $taxonomies[] = 'type';
	    return $taxonomies;
	}
	add_filter( 'manage_taxonomies_for_cognex_columns', 'cognex_type_columns' );
	function cognex_type_columns( $taxonomies ) {
	    $taxonomies[] = 'type';
	    return $taxonomies;
	}

    function removeHeadLinks() {
    remove_action('wp_head', 'rel_canonical');
	}
    add_action('init', 'removeHeadLinks');
    add_filter( 'wpseo_canonical', '__return_false' );

/* 01.10.2015 custom brand titles */
function filter_wp_title( $title ) {
  if ( !empty($post->post_type) ) {
    return $post->post_type;
  }
  
  return $title;
}
add_filter( 'wp_title', 'filter_wp_title' );
    
?>