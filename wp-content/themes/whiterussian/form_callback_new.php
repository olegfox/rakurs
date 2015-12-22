<!-- t: form_callback_new -->
<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
?>
<?php
$i = 0;
// check if the repeater field has rows of data
if( have_rows('subscribe_form','option') ):

 	// loop through the rows of data
    while ( have_rows('subscribe_form','option') ) : the_row();

        // display a sub field value
        $arr[$i] = get_sub_field('subscribe_form_item');
        $i++;

    endwhile;

else :

    // no rows found

endif;

?>
<?php
$username = $_POST['username'];
$brand = implode("," , $_POST['brand']);
$spec = $_POST['spec'];
$email = $_POST['email'];
$to = "marketing@rakurs.su";
$from = "marketing@rakurs.su";
$subject = "Add to mail list rakurs.su";
$headers = "From: $from"; 
$message_contact = "Имя: $username \n E-mail: $email \n Интересующие бренды: $brand";
foreach($arr as $arr_item){
    wp_mail($arr_item, $subject, $message_contact,  $headers, "-f " . $from);
}

$url = $_SERVER['HTTP_REFERER'];
?>
<script>
window.location.href = '<?php echo $url; ?>';
</script>