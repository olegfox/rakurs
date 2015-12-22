<!-- t: sidebar-page_side -->

			<?php if( in_array( 'off', get_field('banner') ) ) { ?>
			<?php } else { ?>
		<div class="b-sidebar">
			<div><?php $adlink = ot_get_option( 'adlink' );?><?php if ( ! empty( $adlink ) ) {?><a href="<?php echo ot_get_option( 'adlink'); ?>" target="_blank"><?php }?>
<img src="<?php echo ot_get_option( 'ad'); ?>"><?php if ( ! empty( $adlink ) ) {?></a><?php }?>
			</div>
			<br><br>
			<a class="b-button" data-modal-open="#modal_order">Заказать оборудование</a>
		</div>
				<?php } ?>

