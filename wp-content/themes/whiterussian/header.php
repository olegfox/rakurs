<!doctype html>
<!--[if IE 8]> <html class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title('|', true, 'right'); ?></title>
		
		<style type="text/css" media="screen">
		<?php // echo ot_get_option( 'custom_css'); ?>
		</style>

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
    <meta name='yandex-verification' content='66d5218b66150c75' />
	<!--[if lte IE 8]>
		<script src="/wp-content/themes/whiterussian/js/libs/html5.js" type="text/javascript"></script>
		<script src="/wp-content/themes/whiterussian/js/libs/css3-mediaqueries.js" type="text/javascript"></script>
		<script src="/wp-content/themes/whiterussian/js/libs/selectivizr-min.js" type="text/javascript"></script>
		<script src="/wp-content/themes/whiterussian/js/libs/placeholders.min.js" type="text/javascript"></script>
	<![endif]-->
		<?php echo ot_get_option( 'head'); ?>
		<?php wp_head(); ?>
		<?php $sticky = get_field('is_sticky'); 
		if (!$sticky){ ?>
		<!-- script src="<?php echo get_template_directory_uri();?>/js/jquery.stickyheader.js" type="text/javascript"></script -->
		<link rel="stylesheet" id="contact-form-7-css" href="<?php echo get_template_directory_uri();?>/css/component.css?2" type="text/css" media="all">
    <?php } ?>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-15839216-1', 'auto');
      ga('send', 'pageview');

    </script>

	</head>
	
	<body <?php body_class(); ?>>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter5227012 = new Ya.Metrika({id:5227012,
                        webvisor:true,
                        clickmap:true,
                        trackLinks:true});
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/5227012" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

	<noscript><b>В вашем браузере выключен javascript!</b> Полная функциональность сайта может быть недоступна.</noscript>


<div class="md-perspective">
	<div class="md-other md-other-deep">

	<div class="b-wrapper _clearfix">
		<header class="b-h">
			<div class="b-max-width">
				<a href="/" class="b-h__logo">
					<img src="/wp-content/themes/whiterussian/img/logo/rakurs.png" title="Ракурс">
				</a>
				<div class="b-h__order">
					<a class="b-button" data-modal-open="#modal_order">Заказать оборудование</a>
				</div>
				<div class="b-h__contact">
					<div class="b-h__contact-phone ya-phone"><?php echo ot_get_option( 'phone'); ?></div>
					<div class="b-h__contact-email"><a title="Написать нам" href="mailto:sales@rakurs.su">sales@rakurs.su</a></div>
				</div>
			</div>
			<nav class="b-h__nav">
				<div class="b-max-width">
					<a href="#" class="b-h__menu-button"></a>
					<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_class' => 'b-h__menu-list', 'walker'=> new Up_Walker_Nav_Menu(), 'container' => '', 'depth' => '1') ); ?>
					<a id="header_search_toggle" class="b-h__menu-search" href=""></a>
				</div>
			</nav>

			

			<div class="b-max-width b-h__search-wrapper">
				<?php get_search_form(); ?>
			</div>

			<div class="b-h__menu-popup-wrapper">
				<div class="b-max-width">
					<ul class="b-h__link-group-list">
						<li class="b-h__link-group-item _open">
							<?php
$aboutmenu = array('theme_location' => 'about', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,); 
print strip_tags( wp_nav_menu($aboutmenu ), '<a>');
?> 
						</li>
						<li class="b-h__link-group-item _open">
							<?php
$productsmenu = array('theme_location' => 'products', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,); 
print strip_tags( wp_nav_menu($productsmenu ), '<a>');
?>
 						</li>
						<li class="b-h__link-group-item _open">
							<?php
$solutionsmenu = array('theme_location' => 'solutions', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,); 
print strip_tags( wp_nav_menu($solutionsmenu ), '<a>');
?>
 						</li>
						<li class="b-h__link-group-item _open">
							<?php
$servicesmenu = array('theme_location' => 'services', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,); 
print strip_tags( wp_nav_menu($servicesmenu ), '<a>');
?>
						</li>
						<li class="b-h__link-group-item _open">
							<?php
$newsmenu = array('theme_location' => 'news', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,); 
print strip_tags( wp_nav_menu($newsmenu ), '<a>');
?>
						</li>
		                <li class="b-h__link-group-item _open">				
<?php
$waremenu = array('theme_location' => 'ware', 'container' => false, 'echo' => false, 'items_wrap' => '%3$s', 'walker'=> new rakurstimesub_walker_nav_menu(), 'depth' => 0,); 
print strip_tags( wp_nav_menu($waremenu ), '<a>');
?>			
                        </li>
					</ul>
				</div>
			</div>



<?php if ( is_page( 'o-kompanii' ) || '14' == $post->post_parent ) { ?>   
			<div class="b-h__submenu">
			<div class="b-max-width">
				<div class="b-h__submenu-text"><a href="/o-kompanii/">О компании:</a></div>
					<ul class="b-h__submenu-list">
					<?php wp_nav_menu( array( 'theme_location' => 'about',  'walker'=> new rakurssub_walker_nav_menu(), 'container' => '', 'items_wrap' => '%3$s', 'depth' => '1') ); ?>
					</ul>
			</div>
			</div>

<?php } elseif ( is_page( 'uslugi' ) || '58' == $post->post_parent ) { ?>	
			<div class="b-h__submenu">
			<div class="b-max-width">
				<div class="b-h__submenu-text"><a href="/uslugi/">Услуги:</a></div>
					<ul class="b-h__submenu-list">
					<?php wp_nav_menu( array( 'theme_location' => 'services',  'walker'=> new rakurssub_walker_nav_menu(), 'container' => '', 'items_wrap' => '%3$s', 'depth' => '1') ); ?>
					</ul>
			</div>
			</div>
			
<?php } elseif ( is_page( 'sklad' ) || '53' == $post->post_parent ) { ?>	
			<div class="b-h__submenu">
			<div class="b-max-width">
				<div class="b-h__submenu-text"><a href="/sklad/">Склад:</a></div>
					<ul class="b-h__submenu-list">
					<?php wp_nav_menu( array( 'theme_location' => 'ware',  'walker'=> new rakurssub_walker_nav_menu(), 'container' => '', 'items_wrap' => '%3$s', 'depth' => '1') ); ?>
					</ul>
			</div>
			</div>			

<?php } elseif ( is_category() || (in_category( array( 'news', 'seminars', 'aktsii' ) )&&(!is_search()))  ) { ?>
			<div class="b-h__submenu">
			<div class="b-max-width">
				<div class="b-h__submenu-text"><a href="/category/news/">Новостной центр:</a></div>
					<ul class="b-h__submenu-list">
					<?php wp_nav_menu( array( 'theme_location' => 'news',  'walker'=> new rakurssub_walker_nav_menu(), 'container' => '', 'items_wrap' => '%3$s', 'depth' => '1') ); ?>
					</ul>
			</div>
			</div>

<?php } ?>

		</header>
		
