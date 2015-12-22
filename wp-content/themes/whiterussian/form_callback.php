<!-- t: form-callback -->
<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
?>
<?php
$i = 0;
// check if the repeater field has rows of data
if( have_rows('head_form','option') ):

 	// loop through the rows of data
    while ( have_rows('head_form','option') ) : the_row();

        // display a sub field value
        $arr[$i] = get_sub_field('head_form_item');
        $i++;

    endwhile;

else :

    // no rows found

endif;

?>
<?php
$username = $_POST['username'];
$phone = $_POST['phone'];
$topic = $_POST['topic'];
$job = $_POST['job'];
$email = $_POST['email'];
$brand = implode("," , $_POST['brand']);
$company = $_POST['company'];
$message_inner = $_POST['message'];
$to = "marketing@rakurs.su";
$from = "marketing@rakurs.su";
$subject = "Message from website rakurs.su";
$headers = "From: $from"; 
$message_contact = "Имя: $username \n E-mail: $email \n Номер телефона: $phone \n Должность: $job \n Компания: $company \n Интересующие бренды: $brand \n Сообщение: $message_inner";
//wp_mail($to, $subject, $message_contact,  $headers, "-f " . $from);
foreach($arr as $arr_item){
wp_mail($arr_item, $subject, $message_contact,  $headers, "-f " . $from);
}
$url = $_SERVER['HTTP_REFERER'];
?>
<script>
window.location.href = '<?php echo $url; ?>';
</script>