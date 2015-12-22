<?php 
if( ! defined('WP_UNINSTALL_PLUGIN') )
	exit;

// проверка пройдена успешно. Начиная от сюда удаляем опции и все остальное.
global $wpdb;

$sql = 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'wm_ya_texts';
$wpdb->query($sql);
$sql = 'DROP TABLE IF EXISTS ' . $wpdb->prefix . 'wm_ya_stat_texts';
$wpdb->query($sql);

delete_option("ya_wm_db_verstion");
delete_option("webmaster_yandex_app_id");
delete_option("webmaster_yandex_app_password");
delete_option("webmaster_yandex_token");
delete_option("webmaster_yandex_token_expire");
delete_option("webmaster_yandex_website_id");
delete_option("webmaster_yandex_options_app");
