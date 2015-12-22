<?php
/*
	Plugin Name:	WP Best Tree
	Plugin URI: 	http://www.rafaelmarques.com/product/wp-best-tree-plugin/
	Description: 	This plugin preserves the category hierarchy and adds toggle style to improve usability for categories meta boxes on the post editing screen.
	Author: 		Rafael Marques
	Author URI: 	http://www.rafaelmarques.com/
	Version: 		1.3
*/

class WP_Best_Tree {

	/* Plugin Init */
	function init() {
		add_action('admin_head', array('WP_Best_Tree', 'best_tree_scripts'));
		add_filter( 'wp_terms_checklist_args', array( __CLASS__, 'checklist_args' ) );
		if (!version_compare(get_bloginfo('version'), '3.0',  '>=')) {
			add_action('admin_footer', array('WP_Best_Tree', 'min_version_error'));
		}
	}

	/* Checklist Args */
	function checklist_args( $args ) {
		$args['checked_ontop'] = false;
		return $args;
	}

	/* Wordpress Version Error Message */
	function min_version_error() {
		echo '<div id="message" class="error"><p>WP Best Tree <strong>requires WordPress version 3.1</strong> or higher to function properly. You\'re using WordPress version ' . get_bloginfo('version') . '. Please upgrade.</p></div>';
		return;
	}

	/* Enqueue Scripts */
	function best_tree_scripts() { 
		wp_enqueue_script('best-tree-js', plugin_dir_url(__FILE__).'js/tree.min.js', array('jquery'));
		wp_enqueue_style('best-tree-css', plugin_dir_url(__FILE__).'css/style.css');
	}

}

WP_Best_Tree::init();

?>