<!-- t: brand-filter -->
<?php require_once('../../../wp-load.php'); ?>
<?php require_once('../../../wp-includes/taxonomy.php'); ?>
<?php global $wpdb;
if ($_POST['filter_brand']){
    $brs =  preg_replace('/^(.*?)$/', "'$1'", $_POST['filter_brand']); 
}
else{
    $brs[0] = "'omron'";
    $brs[1] = "'schneider-electric'";
    $brs[2] = "'yaskawa'";
    $brs[3] = "'optex-fa'";
    $brs[4] = "'tr-electronic'";
    $brs[5] = "'cognex'";
    $brs[6] = "'siemens'";
}
$char = $_POST['opts'];
$kk = $_POST['general_rubric'];
$i =0;
if ($char){
foreach ($char as $char_item){
   // $ids[$i] = get_term_by('name',$char_item,'type')->term_id;
    $ids[$i] = $char_item;
    $i++;
}
$brs = implode(",", $brs);
$sql = "SELECT post_title,post_content,post_name FROM $wpdb->posts as p 
INNER JOIN $wpdb->term_relationships as rl
                ON rl.object_id = p.ID
                INNER JOIN $wpdb->term_taxonomy as tax
                ON rl.term_taxonomy_id = tax.term_taxonomy_id
                WHERE p.post_type IN ($brs)";
                /*if (!$ids){
                $sql .= " AND tax.term_taxonomy_id = '$kk'"; }
foreach ($ids as $kids){ $sql .= " AND tax.term_taxonomy_id = '$kids'";} */
if (!$ids){
                $sql .= " AND tax.term_taxonomy_id = '$kk'"; }
                else{
                    $ki = 0;
                    foreach ($ids as $kids){ if ($ki == 0){$sql .= " AND tax.term_taxonomy_id = '$kids'";} else{$sql .= " OR tax.term_taxonomy_id = '$kids'"; }$ki++;} 
                }
                $count = sizeof($ids);
                $sql .= "GROUP BY ID HAVING count(*) = $count";
$result = $wpdb->get_results($sql);  
 ?>
<?php  //print_r($sql);
print_r(count($result)); 
}
else{
    echo '0';
}
?>