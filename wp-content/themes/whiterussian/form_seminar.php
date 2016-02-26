<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
?>
<?php
$i = 0;
// check if the repeater field has rows of data
if( have_rows('seminar_form','option') ):

 	// loop through the rows of data
    while ( have_rows('seminar_form','option') ) : the_row();

        // display a sub field value
        $arr[$i] = get_sub_field('seminar_form_item');
        $i++;

    endwhile;

else :

    // no rows found

endif;

?>
<?php
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$topic = $_POST['topic'];
$job = $_POST['job'];
$spec = $_POST['spec'];
$company = $_POST['company'];
$message_inner = $_POST['message'];
$website = $_POST['website'];
$to = "marketing@rakurs.su";
$from = "marketing@rakurs.su";
$subject = "Форма обратной связи с сайта Ракурс";
$headers = "From: $from"; 
$message_contact = "$url \n Имя пользователя: $username \n Email: $email \n Номер телефона: $phone \n Должность: $job \n Компания: $company \n Специализация: $spec \n Сайт: $website \n Сообщение: $message_inner";


$valid = false;

if ( !empty($_POST['email']) ) {
  if ( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
    $valid = true;
  }
}
if ( !empty($_POST['phone']) ) {
  if ( preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$/", $_POST['phone']) ) {
    $valid = true;
  }
}

if ( $valid ) {
  foreach($arr as $arr_item){
  wp_mail($arr_item, $subject, $message_contact,  $headers, "-f " . $from);
  }
}
$url = $_SERVER['HTTP_REFERER'];
?>
<script>
window.location.href = '<?php echo $url; ?>';
</script>