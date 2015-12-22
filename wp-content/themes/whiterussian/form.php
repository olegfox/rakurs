<!-- t: form -->
<?php

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
require_once 'PHPMailer-master/PHPMailerAutoload.php';
?>
<?php
$i = 0;
// check if the repeater field has rows of data
if( have_rows('contacts_form','option') ):

 	// loop through the rows of data
    while ( have_rows('contacts_form','option') ) : the_row();

        // display a sub field value
        $arr[$i] = get_sub_field('contacts_form_item');
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
$message_inner = $_POST['message'];
$message_contact = "Имя пользователя: $username \n E-mail: $email \n Телефон: $phone \n Тема сообщения: $topic \n Сообщение: $message_inner";
//get file details we need
$file_tmp_name    = $_FILES['doc']['tmp_name'];
$file_name        = $_FILES['doc']['name'];
$file_size        = $_FILES['doc']['size'];
$file_type        = $_FILES['doc']['type'];
$file_error       = $_FILES['doc']['error'];
$email = new PHPMailer();
$email->CharSet = 'UTF-8';
$email->From      = 'sales@rakurs.su';
$email->FromName  = 'Rakurs';
$email->Subject   = 'Форма обратной связи с сайта Ракурс (контакты)';
$email->Body      = $message_contact;
foreach($arr as $arr_item){
$email->AddAddress( $arr_item );
}
if ($_FILES){
$uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['doc']['name']));
if (move_uploaded_file($_FILES['doc']['tmp_name'], $uploadfile)) {
    $email->addAttachment($uploadfile, $_FILES['doc']['name']);
} 
else {
    $msg = 'Failed to move file to ' . $uploadfile;
}
}
if (!$email->send()) {
    $msg = "Mailer Error: " . $email->ErrorInfo;
} else {
    $msg = "Message sent!";
}
?>


<?php
$to = "marketing@rakurs.su";

?>
<script>
    window.location.href = '/kontakty/';
</script>