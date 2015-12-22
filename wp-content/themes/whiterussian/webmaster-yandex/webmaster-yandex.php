<?php
/*
 * Plugin Name: Webmaster Yandex
 * Description: Add your website to Yandex Webmaster service. Send new text content to Yandex, to prevent it from stealing by others.
 * Version: 1
 */

add_action( 'init', 'initWebmasterYandex' );
function initWebmasterYandex(){	
	// выходим если не админка
	if( ! defined('WP_ADMIN') )
		return;

	// подключаем все php файлы из папки includes
	$includesFiles = glob( plugin_dir_path( __FILE__ )."includes/*.php" );
	foreach ( $includesFiles as $file )
		include_once $file;
	
	new WebmasterYandex();	
}

register_activation_hook(__FILE__, 'wm_ya_db_install');

function wm_ya_db_install() {
    global $wpdb;
    global $ya_wm_db_verstion;

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $tableName = $wpdb->prefix . 'wm_ya_texts';
    $sql = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `timestamp_added` INT NULL ,
            `post_id` INT NULL ,
            `yandex_text_id` VARCHAR(255) NULL ,
            `yandex_link` VARCHAR(255) NULL ,
            PRIMARY KEY (`id`) ,
            UNIQUE INDEX `post_id` (`post_id` DESC) ,
            INDEX `yandex_id` (`yandex_text_id` ASC) );
          "; 
    dbDelta($sql);
	
    $tableName = $wpdb->prefix . 'wm_ya_stat_texts';
    $sql = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
            `id` INT NOT NULL AUTO_INCREMENT ,
            `date` DATE NULL ,
            `texts_sent` INT NULL ,
            PRIMARY KEY (`id`) ,
            UNIQUE INDEX `date` (`date` DESC) );
          ";
    dbDelta($sql);
	
    $ya_wm_db_verstion = '0.1';
	
    add_option("ya_wm_db_verstion", $ya_wm_db_verstion);
}