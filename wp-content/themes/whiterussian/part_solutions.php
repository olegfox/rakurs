<!-- t: part_solutions -->
<?php
global $wpdb;
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$link = get_home_url();
$actual_link = str_replace($link, "", $actual_link);
$actual_link = ltrim ($actual_link, '/');
$actual_link = rtrim ($actual_link, '/');
$actual_link = mysql_real_escape_string($actual_link);
$head_cats = get_terms('brunch',array('parent'=>'0'));
$cat_name_new  = single_term_title('',0);
$sql = "SELECT tax.term_id,tax.parent  FROM $wpdb->term_taxonomy as tax
    LEFT JOIN $wpdb->term_relationships as rl
    ON rl.term_taxonomy_id = tax.term_taxonomy_id
    RIGHT JOIN $wpdb->posts as p
    ON rl.object_id = p.ID
    WHERE tax.taxonomy = 'brunch' AND p.post_type='solutions' AND tax.count > 0";
$result = $wpdb->get_results($sql);
$i = 0;
foreach ($result as $item){
  foreach ($head_cats as $head_cats_item) {
    if (($item->parent == $head_cats_item->term_id) || ($item->parent == '0')) {
      if ($item->parent == '0') {
        $new_ar[$i] = $item->term_id;
      } else {
        $new_ar[$i] = $item->parent;
      }
      $i++;
    }
  }
}
$new_ar = array_unique($new_ar);
$i = 0;
foreach ($new_ar as $item_arr) {
  $k = get_term_by('id',$item_arr,'brunch');
  $str = 'category_name=' + $k->name;
  $test = get_posts($str);
  if ($test) {
    $cats[$i] = $k->name;
    $i++;
  }
}
?>
		<div class="b-side-menu">
		<ul class="b-side-menu__list">
	    	<?php 
			$k = 0;
			asort($cats);
			$l = 0;
            foreach ($cats as $cats_s){
                $cat_s_term = get_term_by('name',$cats_s,'brunch');
                $all[$l] = $cat_s_term;
                $l++;
            }
            for ($kkk = 0; $kkk < count($all); $kkk++){
            for ($kk = 1; $kk < count($all); $kk++){
                if ($all[$kk]->term_order < $all[$kk-1]->term_order){
                    $temp = $all[$kk];
                    $all[$kk] = $all[$kk-1];
                    $all[$kk-1] = $temp;
                }
            }
            }
			foreach ($all as $all_item){
			// Get the ID of a given category
   // $categor = get_term_by('name',$cats_item,'brunch');
    // Get the URL of this category
    $category_link = get_category_link( $all_item->slug );
    $k++;?>
    <?php if ($all_item->name != ""){ ?>
			<li class="<?php if ($cat_name_new  == $all_item->name){ echo 'active';} ?> b-side-menu__item main-menu-item  menu-item-even menu-item-depth-0 menu-item menu-item-type-taxonomy menu-item-object-brands">
				        <a href="<?php echo bloginfo('url') ?>/brunch/<?php echo $all_item->slug; ?>" class="b-side-menu__link menu-item menu-item-type-taxonomy menu-item-object-brands">
				        <?php echo $all_item->name; ?></a>
			</li>
			<?php }} ?>
			</ul>
			
		</div>
	

